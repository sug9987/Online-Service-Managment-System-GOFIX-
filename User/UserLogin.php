        <!-- Database or Logic of UserLogin -->
        <?php
        include('../dbConnection.php');
        // login maintain
        session_start();
        if(!isset($_SESSION['is_login']))
        {
            if(isset($_REQUEST['rEmail']))
            {
                $rEmail = mysqli_real_escape_string($conn, trim($_REQUEST['rEmail']));
                $rPassword = mysqli_real_escape_string($conn,trim($_REQUEST['rPassword']));

                $sql = "SELECT r_email, r_password FROM requesterlogin_tb WHERE r_email = '".$rEmail."' AND r_password = '".$rPassword."' limit 1";  
                $result = $conn->query($sql);
                if($result->num_rows == 1)
                {
                        // Session Variable
                    $_SESSION['is_login'] = true;
                    $_SESSION['rEmail'] = $rEmail;
                    // linking userprofile when its user
                    echo "<script> location.href='UserProfile.php'; </script>";
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
        echo "<script> location.href='UserProfile.php'; </script>";
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

            <link rel="stylesheet" href="../css/background.css">


            <!-- Font Awesome CSS -->
            <link rel="stylesheet" href="../css/all.min.css">

            <title>Login</title>
        </head>
        <body>
        
        <div class=" mb-3 mt-5 text-center" style="font-size:30px;">
            <i class="fas fa-user-circle"></i>
            <span>GOFIX</span>
        </div>
        <p class="text-center" style="font-size:20px;">
            <i class="fas fa-user-secret text-danger" style="margin-right: 10px;"></i>User Login</p>
        <div class="container-fluid">
            <div class="row justify-content-center mt-5">
                <div class="col-sm-6 col-md-4">
                    <form action="" class="shadow-lg p-4" method="POST">
                        <div class="form-group">
                        <i class="fas fa-user"></i>
                            <label for="email" class="font-weight-bold pl-2">Email</label>
                            <input type="email" class="form-control" placeholder="Email" name="rEmail" required>
                            <small class="form-text">We'll never share your email with anyone else. </small>
                        </div>
                        <div class="form-group">
                            <i class="fas fa-key"></i>
                                <label for="pass" class="font-weight-bold pl-2">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" placeholder="Password" name="rPassword" id="password" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-white border-left-0">
                                        <i class="fas fa-eye" id="eyeIcon" onclick="togglePassword('password', 'eyeIcon')"></i>
                                        </span>
                                    </div>
                                </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-outline-info mt-3 font-weight-bold btn-block shadow-sm" id="loginBtn">Login</button>
                            <!-- showing error in after botton -->
                            <?php if(isset($msg)) {echo $msg;}?>
                        </div>

                        <!-- Add Register Link Below Login Button -->
                        <div class="text-center mt-3">
                            <p>Don't have an account? <a href="../#registration" class="text-info font-weight-bold">Register Here</a></p>
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
        <script src="../js/password.js"></script>
        <!-- <script src="../js/loginbutton.js"></script> -->
        

        </body>
        </html>