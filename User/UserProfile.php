<?php 
 define('TITLE' , 'User Profile');
 define('PAGE' , 'UserProfile');
//importing or linking coomon code
include('includes/header.php');

include('../dbConnection.php');
session_start();
if($_SESSION['is_login'])
{
$rEmail = $_SESSION['rEmail'];
}
else
{
echo "<script> location.href='UserLogin.php'</script>";
}
// sql query
$sql = "SELECT  r_name, r_email FROM requesterlogin_tb WHERE r_email = '$rEmail'";
$result = $conn->query($sql);
//Condition
if($result->num_rows == 1)
{
$row = $result->fetch_assoc();
$rName = $row['r_name'];
}


// After clicking update btn 
if(isset($_REQUEST['nameupdate']))
{
//Check name field is empty or not 
if($_REQUEST['rName'] == "")
{
$passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fields </div>';
}
else
{
$rName = $_REQUEST['rName'];
//update query for name
$sql = "UPDATE requesterlogin_tb SET r_name = '$rName' WHERE r_email='$rEmail'";
if($conn->query($sql) == TRUE)
{
$passmsg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Name Updated Successfully </div>';
}
else
{
$passmsg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Update </div>';
}
}
}
?>

<div class="col-sm-6 mt-5"> <!-- Start Profile Area 2nd Column -->
<form action="" method="POST" class="mx-5">
    <div class="form-group">
        <label for="rEmail">Email</label>
        <input type="email" class="form-control" id="rEmail" name="rEmail"  value="<?php echo $rEmail ?>" readonly>
    </div>
    <div class="form-group">
        <label for="rName">Name</label>  
        <input type="text"class="form-control" name="rName" id="rName" value="<?php echo $rName ?>">
    </div>
    <button type="submit" class="btn btn-success" name="nameupdate">Update</button>
    <!-- showing error message -->
    <?php if(isset($passmsg)) {echo $passmsg;}?>
</form>
</div> <!-- End Profile Area 2nd Column -->

<!-- importing common footer code -->
<?php 
include('includes/footer.php');
?>