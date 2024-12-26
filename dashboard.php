<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
     <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
        <style>
        body {
            background-color: #f8f9fa;
        }
        .dashboard-card {
            margin-top: 50px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0px 50px rgba(0, 0, 0, 0.6);
            background-color: #ffffff;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>

<body>
    <?php
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php");
            exit();
        }
        include 'includes/db.php';

        $user_id = $_SESSION['user_id'];
        $sql = "SELECT * FROM users WHERE id='$user_id'";
        $result = $conn->query($sql);
        $user = $result->fetch_assoc();
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
                                            <button class="btn btn-block btn-md login-btn btn btn-info" type="" style="color:;"><b>Dash Board</b></button>
                                            <br>
                                        
                                             <button class="btn btn-md login-btn btn btn-success"><p>Welcome, <?php echo $user['name']; ?>!</p></button>
                                                


    <div class="container mt-5">
        <div class="dashboard-card p-4 text-center">  
            <p><strong><button class="btn btn-block btn-sm login-btn btn btn-secondary disabled">Your Email
            </button>
            <?php echo $user['email']; ?>!</strong></p>
            
            <p><strong><button class="btn btn-block btn-sm login-btn btn-secondary disabled">Your Phone
            </button>
            <?php echo $user['phone']; ?>!</strong></p>

            <p><strong><button class="btn btn-block btn-sm login-btn btn-secondary disabled ">Gender
            </button>
            <?php echo $user['gender']; ?>!</strong></p>

             <a href="update_user.php" class="btn btn-info mt-5">Update Profile</a> 
            <a href="logout.php"class="btn btn-primary mt-5">Logout</a>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>



    </div>
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
</body>

</html>