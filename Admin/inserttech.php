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
//code for insert
if(isset($_REQUEST['techsubmit']))
{
    if(($_REQUEST['tech_name'] == "") || ($_REQUEST['tech_city'] == "") ||
     ($_REQUEST['tech_mobile'] == "") || ($_REQUEST['tech_email'] == ""))
    {
        $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2 role="alert"> Fill All Fileds </div>';
    }
    else
    {
        $tName = $_REQUEST['tech_name'];
        $tCity = $_REQUEST['tech_city'];
        $tMobile = $_REQUEST['tech_mobile'];
        $tEmail = $_REQUEST['tech_email'];
       
        //code for insert
        $sql = "INSERT INTO technician_tb (tech_name, tech_city, tech_mobile, tech_email) VALUES ('$tName', '$tCity', '$tMobile', '$tEmail')";
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
    <h3 class="text-center">Add New Technician</h3>
    <form action="" method="post">
        <div class="form-group">
            <label for="tech_name">Name</label>
            <input type="text" class="form-control" id="tech_name" name="tech_name">
        </div>

        <div class="form-group">
            <label for="tech_city">City</label>
            <input type="text" class="form-control" id="tech_city" name="tech_city">
        </div>

        <div class="form-group">
            <label for="tech_mobile">Mobile</label>
            <input type="text" class="form-control" id="tech_mobile" name="tech_mobile"
            onkeypress="isInputNumber(event)">
        </div>

        <div class="form-group">
            <label for="tech_email">Email</label>
            <input type="email" class="form-control" id="tech_email" name="tech_email">
        </div>


        <div class="text-center">
            <button type="submit" class="btn btn-primary" id="techsubmit" name="techsubmit">Submit</button>
            <a href="technician.php"class="btn btn-secondary">Close</a>
        </div>
        <!-- if error come here to display -->
         <?php if(isset($msg)) {echo $msg;} ?>
    </form>
 </div>
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