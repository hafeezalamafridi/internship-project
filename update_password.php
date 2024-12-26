<?php
// Database connection
require 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        die("Passwords do not match.");
    }

    // Hash the new password
    $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the user's password in the database
    $stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL WHERE reset_token = ?");
    $stmt->bind_param('ss', $hashedPassword, $token);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo 'Your password has been successfully reset.';
    } else {
        echo 'Invalid or expired token.';
    }

    $stmt->close();
    $conn->close();
}
?>
