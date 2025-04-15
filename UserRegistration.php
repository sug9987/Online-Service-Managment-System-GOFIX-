    <!-- Connecting User Registration with database  -->
    <?php 
    include('dbConnection.php');
        if(isset($_REQUEST['rSignup']))
        {
            //checking  if all field is empty filed or not //
        if(($_REQUEST['rName'] == "") || ($_REQUEST['rEmail'] == "") || ($_REQUEST['rPassword'] == "") || ($_REQUEST['rConfirmPassword'] == ""))
        {
            $regmsg = '<div class="alert alert-warning mt-2 role="alert"> All Fileds are Required </div>';
        }
            else
            {
                // email already registered
                $sql = "SELECT r_email FROM requesterlogin_tb WHERE r_email = '".$_REQUEST['rEmail']."'";
                $result = $conn->query($sql);
                if($result->num_rows==1)
                {
                    $regmsg = '<div class="alert alert-warning mt-2 role="alert"> Email ID Already Registered </div>';
                }
                else
                {
                    // Assigning Users Values to Variables
                    $rName =  $_REQUEST['rName'];
                    $rEmail =  $_REQUEST['rEmail'];
                    $rPassword =  $_REQUEST['rPassword'];
                    $rConfirmPassword =  $_REQUEST['rConfirmPassword'];
                
                    // ✅ Place password confirmation check here
                    if ($rPassword !== $rConfirmPassword) 
                    {
                        $regmsg = '<div class="alert alert-warning mt-2" role="alert"> Passwords do not match! </div>';
                    }
                    else
                    {
                        // Code to link database
                        $sql = "INSERT INTO requesterlogin_tb(r_name,r_email,r_password,r_confirmpassword) VALUES('$rName', '$rEmail', '$rPassword', '$rConfirmPassword')";
                        if($conn->query($sql) == TRUE)
                        {
                            $regmsg = '<div class="alert alert-success mt-2 role="alert"> Account Succesfuuly Created </div>';
                        }
                        else
                        {
                            $regmsg = '<div class="alert alert-danger mt-2 role="alert"> Unable to Create Account </div>';
                        }
                }   }
            }
        }
    ?>

    <!--- Start Registration Form --->
    <div class="container pt-5" id="registration">
        <h2 class="text-center">Create an Account</h2>
        <div class="row mt-4 mb-4">
            <div class="col-md-6 offset-md-3">
                <form action="" class="shadow-lg p-4" method="POST">
                    <div class="form-group">
                        <i class="fas fa-user"></i><label for="name" class="font-weight-bold pl-2">Name</label>
                        <input type="text" class="form-control" placeholder="Name" name="rName">
                    </div>
                    <div class="form-group">
                        <i class="fas fa-envelope"></i><label for="email" class="font-weight-bold pl-2">Email</label>
                        <input type="email" class="form-control" placeholder="Email" name="rEmail">
                        <small class="form-text">We will always keep your email safe and private.</small>
                    </div>
                    <div class="form-group">
                        <i class="fas fa-key"></i><label for="pass" class="font-weight-bold pl-2">New Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" placeholder="Password" name="rPassword" id="password">
                            <div class="input-group-append">
                                <span class="input-group-text bg-white border-left-0">
                                    <i class="fas fa-eye" id="eyeIcon1" onclick="togglePassword('password', 'eyeIcon1')" style="cursor: pointer;"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <i class="fas fa-key"></i>
                        <label for="confirm_pass" class="font-weight-bold pl-2">Confirm Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" placeholder="Confirm Password" name="rConfirmPassword" id="confirmPassword">
                            <div class="input-group-append">
                                <span class="input-group-text bg-white border-left-0">
                                    <i class="fas fa-eye" id="eyeIcon2" onclick="togglePassword('confirmPassword', 'eyeIcon2')" style="cursor: pointer;"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- for terms and  condition -->
                    <input type="checkbox" id="terms" required>
                    <label for="terms">I agree to the <a href="#">Terms & Privacy Policy</a></label>

                    <button type="submit" disabled id="signup-btn" class="btn btn-info  mt-4 btn-block shadow-sm font-weight-bold"
                        name="rSignup">Sign Up</button>
                    <!-- <em style="font-size:10px;">Note - By clicking Sign Up, you agree to our Terms, Data Policy and Cookie Policy.</em> -->

                    <!-- Already have an account? -->
                    <div class="text-center mt-3">
                        <p class="font-weight" style="font-size: px;">
                            Already have an account? <a href="User/UserLogin.php" class="font-weight-bold text-info">Login here</a>
                        </p>
                    </div>

                    <?php if(isset($regmsg)) {echo $regmsg;} ?>
                </form>
            </div>
        </div> 
    </div> <!--- End Registration Form --->