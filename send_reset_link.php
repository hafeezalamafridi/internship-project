<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Database connection
require 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Check if the email exists in the database
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $token = bin2hex(random_bytes(32)); // Generate a random token
        $stmt = $conn->prepare("UPDATE users SET reset_token = ? WHERE email = ?");
        $stmt->bind_param('ss', $token, $email);
        $stmt->execute();

        // Send password reset email
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.example.com'; 
            $mail->SMTPAuth   = true;
            $mail->Username   = 'hafeez@example.com';
            $mail->Password   = '123'; 
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            //Recipients
            $mail->setFrom('hafeez@example.com', 'Your Name');
            $mail->addAddress($email, $user['name']);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Instructions';
            $mail->Body    = 'Click <a href="http://yourwebsite.com/reset_password1.php?token=' . $token . '">here</a> to reset your password.';

            $mail->send();
            echo 'Password reset instructions have been sent to your email.';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo 'No user found with that email address.';
    }

    $stmt->close();
    $conn->close();
}
?>
