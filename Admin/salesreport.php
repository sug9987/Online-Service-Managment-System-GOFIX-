<?php
define('TITLE' , 'SalesReport');
define('PAGE' , 'salesreport');
include('adminincludes/adminheader.php');
include('../dbConnection.php');
session_start();
 if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
 } else {
  echo "<script> location.href='adminlogin.php'; </script>";
 } 
?>

<!-- Start 2nd Column-->
<div class="col-sm-9 col-md-10 mt-5 text-center">
  <form action="" method="POST" class="d-print-none">
    <div class="form-row">
      <div class="form-group col-md-2">
        <input type="date" class="form-control" id="startdate" name="startdate">
      </div> <span> to </span>
      <div class="form-group col-md-2">
        <input type="date" class="form-control" id="enddate" name="enddate">
      </div>
      <div class="form-group">
        <input type="submit" class="btn btn-secondary" name="searchsubmit" value="Search">
      </div>
    </div>
  </form>
  <?php
    if(isset($_REQUEST['searchsubmit']))
    {
        $startdate = $_REQUEST['startdate'];
        $enddate = $_REQUEST['enddate'];
        $sql = "SELECT * FROM customer_tb WHERE cpdate BETWEEN '$startdate' AND '$enddate'";
        $result = $conn->query($sql);
        if($result->num_rows > 0)
        {
                $total_sales = 0; // Initialize total sales variable
                
                echo '<p class=" bg-dark text-white p-2 mt-4">Details</p>';
                echo '<table class="table">';
                        echo  '<thead>';
                            echo  '<tr>';
                                echo  '<th scope="col">Customer ID</th>';
                                echo  '<th scope="col">Customer Name</th>';
                                echo  '<th scope="col">Address</th>';
                                echo  '<th scope="col">Product Name</th>';
                                echo  '<th scope="col">Quantity</th>';
                                echo  '<th scope="col">Price Each</th>';
                                echo  '<th scope="col">Total</th>';
                                echo  '<th scope="col">Date</th>';
                            echo  '</tr>';
                        echo  '</thead>';
                    echo  '<tbody>';
                        while($row = $result->fetch_assoc())
                        {
                            echo '<tr>';
                            echo  '<th scope="row">'.$row["custid"].'</th>';
                            echo  '<td>'.$row["custname"].'</td>';
                            echo  '<td>'.$row["custadd"].'</td>';
                            echo  '<td>'.$row["cpname"].'</td>';
                            echo  '<td>'.$row["cpquantity"].'</td>';
                            echo  '<td>'.$row["cpeach"].'</td>';
                            echo  '<td>'.$row["cptotal"].'</td>';
                            echo  '<td>'.$row["cpdate"].'</td>';
                            echo  '</tr>';

                            // Add to total sales
                            $total_sales += $row["cptotal"];
                        }
                        echo '<tr class="bg-light font-weight-bold">';
                            echo '<td colspan="6" class="text-right">Total Sales:</td>';
                            echo '<td>₹'.$total_sales.'</td>';
                            echo '<td></td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td>';
                            echo '<input class="btn btn-info d-print-none" type="submit" value="Print"
                            onClick="window.print()">';
                            echo '</td>';
                        echo '</tr>';
                    echo '</tbody>';
                echo '</table>';
        } 
        else
        {
            echo "<div class='alert alert-warning col-sm-6 ml-5 mt-2' role='alert'> No Records Found ! </div>";
        }
    }
  ?>
</div>


                
<?php
include('adminincludes/adminfooter.php') 
?>
