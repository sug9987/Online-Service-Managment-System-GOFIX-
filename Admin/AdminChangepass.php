<?php
define('TITLE' , 'ChangePassword');
define('PAGE' , 'AdminChangepass');
include('adminincludes/adminheader.php');
include('../dbConnection.php');
session_start();
    if(isset($_SESSION['is_adminlogin']))
    {
        $aEmail = $_SESSION['aEmail'];
    } 
    else
    {
        echo "<script> location.href='adminlogin.php'; </script>";
    } 

//after clicking update button
$aEmail = $_SESSION['aEmail'];
if(isset($_REQUEST['passupdate']))
{
    //Checking if password is empty or not
    if($_REQUEST['aPassword'] == "")
    {
         $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2"> Fill all fields </div>';
    }
    else
    {
        $aPass = $_REQUEST['aPassword'];
        //updating password
        $sql = "UPDATE gofix_adminlogin_tb SET a_password = '$aPass' 
        WHERE a_email = '$aEmail'";

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

<div class="col-sm-9 col-mt-10"> <!-- Start Admin Change Password Form 2nd Column -->
  <div class="row">
        <div class="col-sm-6">
            <form class="mt-5 mx-5" method="POST">
                <div class="form-group">
                <label for="inputEmail">Email</label>
                <input type="email" class="form-control" id="inputEmail" value=" <?php echo $aEmail ?>" readonly>
                </div>
                <div class="form-group">
                <label for="inputnewpassword">New Password</label>
                <input type="password" class="form-control" id="inputnewpassword" placeholder="New Password" name="aPassword">
                </div>
                <button type="submit" class="btn btn-info mr-4 mt-4" name="passupdate">Update</button>
                <button type="reset" class="btn btn-secondary mt-4">Reset</button>
                <!-- print error msg -->
                <?php if(isset($passmsg)) {echo $passmsg; } ?>
            </form>

        </div>
  </div>
</div><!-- End Admin Change Password Form 2nd Column -->



                
<?php
include('adminincludes/adminfooter.php') 
?>