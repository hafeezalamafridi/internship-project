<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
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
                                            <button class="btn btn-block btn-md login-btn btn btn-info" type="" style="color:;"><b>Login Form</b></button>
                                            <br>
                                    <h2>Login</h2>
        <form id="loginForm">
            <div class="form-group">
                <label for="login">Name or Email:</label>
                <input type="text" class="form-control" id="login" name="login" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="row">
                <div class="col-md-3">
            <button type="submit" class="btn btn-primary text-center">Login</button>
        </div>
        <div class="col">
            <a href="forgot_password.php" class="btn btn-danger text-center" style="color: white;"><h6>Forgot Password</h6></a>
        </div>
        <div class="col">
            <a href="register.php" class="btn btn-info text-center">Register</a>
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
            $('#loginForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: 'actions/login_action.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response) {
                            window.location.href = 'dashboard.php';
                        } else {
                            alert("Invalid username or password.");
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>