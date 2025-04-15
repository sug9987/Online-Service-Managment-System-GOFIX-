<!-- Database or Logic of AdminLogin -->
<?php
include('../dbConnection.php');
// login maintain
session_start();
if(!isset($_SESSION['is_adminlogin']))
{
    if(isset($_REQUEST['aEmail']))
    {
        $aEmail = mysqli_real_escape_string($conn, trim($_REQUEST['aEmail']));
        $aPassword = mysqli_real_escape_string($conn,trim($_REQUEST['aPassword']));

        $sql = "SELECT a_email, a_password FROM gofix_adminlogin_tb WHERE a_email = '".$aEmail."' AND a_password = '".$aPassword."' limit 1";  
        $result = $conn->query($sql);
        if($result->num_rows == 1)
        {
             // Session Variable
            $_SESSION['is_adminlogin'] = true;
            $_SESSION['aEmail'] = $aEmail;
            // linking userprofile when its user
            echo "<script> location.href='admindashboard.php'; </script>";
            exit;
        }
        else
        {
            $msg = '<div class ="alert alert-warning mt-3"> Invalid Email or Password</div>';
        }
    }
        
}
else
{
    echo "<script> location.href='admindashboard.php'; </script>";
}
?>


<!-- Design Part -->
<!DOCTYPE html>
<html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="../css/bootstrap.min.css1.css">

            <!-- Font Awesome CSS -->
            <link rel="stylesheet" href="../css/all.min.css">
            
            <!-- for 67line -->
            <style>
                .custom-margin{
                    margin-top: 8vh;
                }
            </style>

            <title>Admin Login</title>
        </head>
        <body>
        
        <div class=" mb-3 mt-5 text-center" style="font-size:30px;">
            <i class="fas fa-user-circle"></i>
            <span>GOFIX</span>
        </div>
        <p class="text-center" style="font-size:20px;">
            <i class="fas fa-user-secret text-danger" style="margin-right: 10px;"></i>Admin Login</p>
        <div class="container-fluid">
            <div class="row justify-content-center mt-5 custom-margin">
                <div class="col-sm-6 col-md-4">
                    <form action="" class="shadow-lg p-4" method="POST">
                        <div class="form-group">
                        <i class="fas fa-user"></i>
                            <label for="email" class="font-weight-bold pl-2">Email</label>
                            <input type="email" class="form-control" placeholder="Email" name="aEmail" required>
                            <small class="form-text">We'll never share your email with anyone else. </small>
                        </div>
                        <div class="form-group">
                        <i class="fas fa-key"></i>
                            <label for="pass" class="font-weight-bold pl-2">Password</label>
                            <input type="password" class="form-control" placeholder="Password" name="aPassword" required>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-outline-info mt-3 font-weight-bold btn-block shadow-sm">Login</button>
                            <!-- showing error in after button -->
                            <?php if(isset($msg)) {echo $msg;}?>
                        </div>
                    </form>
                    <div class="text-center">
                        <a href="../index.php" class="btn btn-info mt-3 font-weight-bold shadow-sm">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Javascript Files -->
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/all.min.js"></script>
        <script src="../js/popper.min.js"></script>

        </body>
</html>