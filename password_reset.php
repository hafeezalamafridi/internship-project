<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Database connection
    $conn = new mysqli('localhost', 'your_username', 'your_password', 'your_database');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

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
            $mail->Host       = 'smtp.example.com'; // Replace with your SMTP server
            $mail->SMTPAuth   = true;
            $mail->Username   = 'your_email@example.com'; // Replace with your SMTP username
            $mail->Password   = 'your_email_password'; // Replace with your SMTP password
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            //Recipients
            $mail->setFrom('your_email@example.com', 'Your Name');
            $mail->addAddress($email, $user['name']);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Instructions';
            $mail->Body    = 'Click <a href="http://yourwebsite.com/reset_password.php?token=' . $token . '">here</a> to reset your password.';

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
