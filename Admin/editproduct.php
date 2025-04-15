<?php
define('TITLE' , 'Update  Product');
define('PAGE' , 'inventory');
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
//code for update button
if(isset($_REQUEST['pupdate']))
{
    if(($_REQUEST['pname'] == "") || ($_REQUEST['pdop'] == "") || ($_REQUEST['pava'] == "") || ($_REQUEST['ptotal'] == "") || ($_REQUEST['poriginalprice'] == "")
    || ($_REQUEST['psellingprice'] == ""))
    {
        $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">Fill All Fileds</div>';
    }
    else
    {
        $pid = $_REQUEST['pid'];
        $pname = $_REQUEST['pname'];
        $pdop = $_REQUEST['pdop'];
        $pava = $_REQUEST['pava'];
        $ptotal = $_REQUEST['ptotal'];
        $poriginalprice = $_REQUEST['poriginalprice'];
        $psellingprice = $_REQUEST['psellingprice'];
        //code for update
        $sql = "UPDATE  inventory_tb SET pname = '$pname', pdop = '$pdop', pava = '$pava', ptotal = '$ptotal',
        poriginalprice = '$poriginalprice', psellingprice = '$psellingprice' WHERE pid = '$pid'";
        if($conn->query($sql) == TRUE)
        {
            $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert">Updated Successfully</div>';
        }
        else
        {
            $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">Unable to Update</div>';
        }
    }
}
?>


<!-- Start 2nd Column -->
<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3 class="text-center">Update Product Details</h3>
    <!-- select query -->
     <?php 
     if(isset($_REQUEST['edit']))
     {
        $sql = "SELECT * FROM inventory_tb WHERE pid = {$_REQUEST['id']}";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
     } 
     ?>
    <form action="" method="post">
    <div class="form-group">
            <label for="pid">Product ID</label>
            <input type="text" class="form-control" id="pid" name="pid" value="<?php if(isset($row['pid'])) {echo $row['pid'];} ?>" readonly>
        </div>
        <div class="form-group">
            <label for="pname">Product Name</label>
            <input type="text" class="form-control" id="pname" name="pname"
            value="<?php if(isset($row['pname'])) {echo $row['pname'];} ?>">
        </div>
        <div class="form-group">
            <label for="pdop">Date of Purchase</label>
            <input type="date" class="form-control" id="pdop" name="pdop"
            value="<?php if(isset($row['pdop'])) {echo $row['pdop'];} ?>">
        </div>
        <div class="form-group">
            <label for="pava">Available</label>
            <input type="text" class="form-control" id="pava" name="pava" 
            value="<?php if(isset($row['pava'])) {echo $row['pava'];} ?>"
            onkeypress="isInputNumber(event)">
        </div>
        <div class="form-group">
            <label for="ptotal">Total</label>
            <input type="text" class="form-control" id="ptotal" name="ptotal" 
            value="<?php if(isset($row['ptotal'])) {echo $row['ptotal'];} ?>"
            onkeypress="isInputNumber(event)">
        </div>
        <div class="form-group">
            <label for="poriginalprice">Original Price Each</label>
            <input type="text" class="form-control" id="poriginalprice" name="poriginalprice"
            value="<?php if(isset($row['poriginalprice'])) {echo $row['poriginalprice'];} ?>"
             onkeypress="isInputNumber(event)">
        </div>
        <div class="form-group">
            <label for="psellingprice">Selling Price Each</label>
            <input type="text" class="form-control" id="psellingprice" name="psellingprice"
            value="<?php if(isset($row['psellingprice'])) {echo $row['psellingprice'];} ?>"
             onkeypress="isInputNumber(event)">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-info" id="pupdate" name="pupdate">Update</button>
            <a href="inventory.php"class="btn btn-secondary">Close</a>
        </div>
        <?php if(isset($msg)) {echo $msg;}?>
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