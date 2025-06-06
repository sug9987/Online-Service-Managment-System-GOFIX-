<?php
define('TITLE' , 'Update Requester');
define('PAGE' , 'requester');
include('adminincludes/adminheader.php');
include('../dbConnection.php');
//session code
session_start();
//to check admin login or not
if(isset($_SESSION['is_adminlogin']))
{
    $aEmail = $_SESSION['aEmail'];
}
else
{
    echo "<script> location.href='adminlogin.php' </script>";
}
//code for insert
if(isset($_REQUEST['reqsubmit']))
{
    if(($_REQUEST['r_name'] == "") || ($_REQUEST['r_email'] == "")
    || ($_REQUEST['r_password'] == ""))
    {
        $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2 role="alert"> Fill All Fileds </div>';
    }
    else
    {
        $rname = $_REQUEST['r_name'];
        $rEmail = $_REQUEST['r_email'];
        $rPassword = $_REQUEST['r_password'];
        //code for insert
        $sql = "INSERT INTO requesterlogin_tb (r_name, r_email, r_password) VALUES ('$rname', '$rEmail', '$rPassword')";
        if($conn->query($sql) == TRUE)
        {
            $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Added Successfully </div>';
        }
        else
        {
            $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Add </div>';
        }
    }
}
?>


<!-- Start 2nd Column -->
 <div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3 class="text-center">Add New Requester</h3>
    <form action="" method="post">
        <div class="form-group">
            <label for="r_name">Name</label>
            <input type="text" class="form-control" id="r_name" name="r_name">
        </div>

        <div class="form-group">
            <label for="r_email">Email</label>
            <input type="text" class="form-control" id="r_email" name="r_email">
        </div>

        <div class="form-group">
            <label for="r_password">Password</label>
            <input type="password" class="form-control" id="r_password" name="r_password">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary" id="reqsubmit" name="reqsubmit">Submit</button>
            <a href="requester.php"class="btn btn-secondary">Close</a>
        </div>
        <!-- if error come here to display -->
         <?php if(isset($msg)) {echo $msg;} ?>
    </form>
 </div>


<?php
include('adminincludes/adminfooter.php') 
?>