<?php
define('TITLE' , 'Update Technician');
define('PAGE' , 'technician');
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

?>
<!-- Start 2nd Column -->
<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3 class="text-center">Update Technician Details</h3> 
    <?php 
        if(isset($_REQUEST['view']))
        {
            $sql = "SELECT * FROM technician_tb WHERE tech_id = {$_REQUEST['id']}";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
        }
        if(isset($_REQUEST['techupdate']))
            {
                if(($_REQUEST['tech_name'] == "")  ||  ($_REQUEST['tech_city'] == "") || ($_REQUEST['tech_mobile'] == "")
                || ($_REQUEST['tech_email'] == ""))
                {
                    $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2">Fill All Fileds</div>';
                }
                else
                {
                    $tid = $_REQUEST['tech_id'];
                    $tname = $_REQUEST['tech_name'];
                    $tcity = $_REQUEST['tech_city'];
                    $tmobile = $_REQUEST['tech_mobile'];
                    $temail = $_REQUEST['tech_email'];

                    //update code
                     $sql = "UPDATE technician_tb  SET 
                        tech_name = '$tname',tech_city = '$tcity', tech_mobile = '$tmobile', tech_email = '$temail' WHERE tech_id = '$tid'";
                     if($conn->query($sql) == TRUE)
                     {
                        $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2">Updated Successfully</div>';
                     }
                     else
                     {
                        $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2">Unable to Update</div>';
                     }
                }
            }
    ?>
    <form action="" method="post">
        <div class="form-group">
            <label for="tech_id">Technician ID</label>
            <input type="text" class="form-control"name="tech_id" id="tech_id" 
            value="<?php if(isset($row['tech_id'])) {echo $row['tech_id'];} ?>" readonly >
        </div>

        <div class="form-group">
            <label for="tech_name">Name</label>
            <input type="text" class="form-control"name="tech_name" id="tech_name" 
            value="<?php if(isset($row['tech_name'])) {echo $row['tech_name'];} ?>">
        </div>

        <div class="form-group">
            <label for="tech_city">City</label>
            <input type="text" class="form-control"name="tech_city" id="tech_city" 
            value="<?php if(isset($row['tech_city'])) {echo $row['tech_city'];} ?>">
        </div>

        <div class="form-group">
            <label for="tech_mobile">Mobile</label>
            <input type="text" class="form-control"name="tech_mobile" id="tech_mobile" 
            value="<?php if(isset($row['tech_mobile'])) {echo $row['tech_mobile'];} ?>"
            onkeypress="isInputNumber(event)">
        </div>

        <div class="form-group">
            <label for="tech_email">Email</label>
            <input type="email" class="form-control"name="tech_email" id="tech_email" 
            value="<?php if(isset($row['tech_email'])) {echo $row['tech_email'];} ?>">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-info" id="techupdate" name="techupdate">Update</button>
            <a href="technician.php" class="btn btn-secondary">Close</a>
        </div>
        <?php if(isset($msg)) {echo $msg;} ?>
    </form>
</div><!-- End 2nd Column -->
<!-- Only Number for input fields -->
<script>
  function isInputNumber(evt) {
    var ch = String.fromCharCode(evt.which);
    if (!(/[0-9]/.test(ch))) {
      evt.preventDefault();
    }
  }
</script>

<?php
include('adminincludes/adminfooter.php') 
?>