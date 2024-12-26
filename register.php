<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'user_registration');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO users (name, email, phone, gender, password) VALUES ('$name', '$email', '$phone', '$gender', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Send welcome email
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
            $mail->addAddress($email, $name);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Welcome to Our Website';
            $mail->Body    = 'Thank you for registering with us!';

            $mail->send();
            echo 'Registration successful. Welcome email has been sent.';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo 'Error: ' . $sql . '<br>' . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
   <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
</head>
<body>
    <?php
        include 'includes/functions.php';
    ?>
    <!-- Page Content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                        
                            <!-- Account Content -->
                            <div class="account-content">
                                <div class="row align-items-center justify-content-center">
                                
                                    <div class="col-md-12 col-lg-6 login-right">
                                        <div class="login-header">
                                            <button class="btn btn-block btn-md login-btn btn btn-info" type="" style="color:;"><b>Registration</b></button>
                                            <br>
                                            <h3 class="text-center">Register Form</h3>
                                        </div>
                                <form id="registerForm">
                                    <div class="form-group form-focuse">
                                        <label for="name">Name:</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone:</label>
                                        <input type="text" class="form-control" id="phone" name="phone" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="gender">Gender:</label>
                                        <input type="text" class="form-control" id="gender" name="gender" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password:</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm_password">Confirm Password:</label>
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                    <button type="submit" class="btn btn-primary" class="text-center">Register</button>
                                            </div>
                                            <div class="text-right">    
                                                <a class="forgot-link btn btn-success text-" href="login.php">Already have an account?</a>
                                            </div>
                                        </div>
</form>

                                    </div>
                                </div>
                            </div>
                            <!-- /Account Content -->
                                
                        </div>
                    </div>

                </div>

            </div>      
            <!-- /Page Content -->
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    
<script>
$(document).ready(function() {
    $('#registerForm').on('submit', function(e) {
        e.preventDefault();

        var password = $('#password').val();
        var confirmPassword = $('#confirm_password').val();

        if (password !== confirmPassword) {
            alert("Passwords do not match");
            return;
        }

        $.ajax({
            url: 'actions/register_action.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response) {
                    alert("Registration successful! Please check your email.");
                    window.location.href = 'login.php';
                } else {
                    alert("Registration failed. Please try again.");
                }
            }
        });
    });
});
</script>
<!-- jQuery -->
        <script src="assets/js/jquery.min.js"></script>
        
        <!-- Bootstrap Core JS -->
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        
        <!-- Custom JS -->
        <script src="assets/js/script.js"></script>
</body>

</html>
