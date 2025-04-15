<?php
define('TITLE' , 'Add New Product');
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
if(isset($_REQUEST['psubmit']))
{
    if(($_REQUEST['pname'] == "") || ($_REQUEST['pdop'] == "") ||
    ($_REQUEST['pava' ] == "") || ($_REQUEST['ptotal'] == "") ||
    ($_REQUEST['poriginalprice'] == "") || ($_REQUEST['psellingprice'] == ""))
    {
        $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">Fill All Fileds</div>';
    }
    else
    {
        $pname = $_REQUEST['pname'];
        $pdop = $_REQUEST['pdop'];
        $pava = $_REQUEST['pava'];
        $ptotal = $_REQUEST['ptotal'];
        $poriginalprice = $_REQUEST['poriginalprice'];
        $psellingprice = $_REQUEST['psellingprice'];
        $sql = "INSERT INTO inventory_tb (pname, pdop, pava, ptotal, poriginalprice, psellingprice) VALUES ('$pname', '$pdop', '$pava', '$ptotal', '$poriginalprice', '$psellingprice')";
        if($conn->query($sql) == TRUE)
        {
            $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert">Added Successfully </div>';
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
    <h3 class="text-center">Add New Product</h3>
    <form action="" method="post">
        <div class="form-group">
            <label for="pname">Product Name</label>
            <input type="text" class="form-control" id="pname" name="pname">
        </div>
        <div class="form-group">
            <label for="pdop">Date of Purchase</label>
            <input type="date" class="form-control" id="pdop" name="pdop">
        </div>
        <div class="form-group">
            <label for="pava">Available</label>
            <input type="text" class="form-control" id="pava" name="pava" onkeypress="isInputNumber(event)">
        </div>
        <div class="form-group">
            <label for="ptotal">Total</label>
            <input type="text" class="form-control" id="ptotal" name="ptotal" onkeypress="isInputNumber(event)">
        </div>
        <div class="form-group">
            <label for="poriginalprice">Original Price Each</label>
            <input type="text" class="form-control" id="poriginalprice" name="poriginalprice" onkeypress="isInputNumber(event)">
        </div>
        <div class="form-group">
            <label for="psellingprice">Selling Price Each</label>
            <input type="text" class="form-control" id="psellingprice" name="psellingprice" onkeypress="isInputNumber(event)">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-info" id="psubmit" name="psubmit">Submit</button>
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