<!-- //importing or linking coomon code// -->
<?php 
define('TITLE' , 'Change Password');
define('PAGE' , 'UserChangepass');

include('includes/header.php');
include('../dbConnection.php');
//Checking User is login or Not
session_start();
if($_SESSION['is_login'])
{
 $rEmail = $_SESSION['rEmail'];
} else 
{
 echo "<script> location.href='UserLogin.php' </script>";
}

//after clicking update button
$rEmail = $_SESSION['rEmail'];
if(isset($_REQUEST['passupdate']))
{
    //Checking if password is empty or not
    if($_REQUEST['rPassword'] == "")
    {
    $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2"> Fill all fields </div>';
    }
    else
    {
        $rPass = $_REQUEST['rPassword'];
        //updating password
        $sql = "UPDATE requesterlogin_tb SET r_password = '$rPass' 
        WHERE r_email = '$rEmail'";

        //executing query
        if($conn->query($sql) == TRUE)
        {
            $passmsg = '<div class="alert alert-success col-sm-6 ml-5 mt-2">Updated Successfully</div>';
        }
        else
        {
            $passmsg = '<div class="alert alert-danger col-sm-6 ml-5 mt mt-2">Unable to Update</div>';
        }
    }
}
?>

<div class="col-sm-9 col-mt-10"> <!-- Start User Change Password Form 2nd Column -->
  <div class="row">
        <div class="col-sm-6">
            <form class="mt-5 mx-5" method="POST">
                <div class="form-group">
                <label for="inputEmail">Email</label>
                <input type="email" class="form-control" id="inputEmail" value=" <?php echo $rEmail ?>" readonly>
                </div>
                <div class="form-group">
                <label for="inputnewpassword">New Password</label>
                <input type="password" class="form-control" id="inputnewpassword" placeholder="New Password" name="rPassword">
                </div>
                <button type="submit" class="btn btn-info mr-4 mt-4" name="passupdate">Update</button>
                <button type="reset" class="btn btn-secondary mt-4">Reset</button>
                <!-- print error msg -->
                <?php if(isset($passmsg)) {echo $passmsg; } ?>
            </form>

        </div>
  </div>
</div><!-- End User Change Password Form 2nd Column -->
<!-- importing common footer code -->
<?php 
include('includes/footer.php');
?>