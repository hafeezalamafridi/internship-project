<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Forget Password</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
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
                                            <button class="btn btn-block btn-md login-btn btn btn-info" type="" style="color:;"><b>Reset Form</b></button>
                                            <br>
                                    
        <h2>Forget Password</h2>
        <form id="forgetPasswordForm">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="row">
                <div class="col">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
            <div class="text-right">    
              <a class="forgot-link btn btn-success text" href="login.php"><h5>login back</h5></a>
                </div>
            </div>
        </form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>


    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#forgetPasswordForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: 'actions/forget_password_action.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response) {
                            alert("Password reset link has been sent to your email.");
                            window.location.href = 'reset_password1.php';
                        } else {
                            alert("Email not found. Please try again.");
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>