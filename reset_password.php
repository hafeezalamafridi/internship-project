<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset password</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">

        <h2>Reset Password</h2>
        <form id="resetPasswordForm">
            <input type="hidden" id="token" name="token" value="<?php echo $_GET['token']; ?>">
            <div class="form-group">
                <label for="password">New Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm New Password:</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn btn-primary">Reset Password</button>
        </form>


    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#resetPasswordForm').on('submit', function(e) {
                e.preventDefault();

                var password = $('#password').val();
                var confirmPassword = $('#confirm_password').val();

                if (password !== confirmPassword) {
                    alert("Passwords do not match");
                    return;
                }

                $.ajax({
                    url: 'actions/reset_password_action.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response) {
                            alert("Password reset successful. Please login.");
                            window.location.href = 'login.php';
                        } else {
                            alert("Don't match information. Please try again.");
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>