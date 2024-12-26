<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upade info</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
   
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
                                            <button class="btn btn-block btn-md login-btn btn btn-info" type="" style="color:;"><b>Udate Profile</b></button>
                                            <br>
                                   

        <h2>Update Profile</h2>
        <form id="updateForm">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $user['name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $user['phone']; ?>" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <input type="text" class="form-control" id="gender" name="gender" value="<?php echo $user['gender']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
</div>
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
    <script>
        $(document).ready(function() {
            $('#updateForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: 'actions/update_user_action.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response) {
                            alert("Profile updated successfully.");
                            window.location.href = 'dashboard.php';
                        } else {
                            alert("Failed to update profile. Please try again.");
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>