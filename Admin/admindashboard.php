<!-- code for database -->
<?php
define('TITLE' , 'Dashboard');
define('PAGE' , 'admindashboard');
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
//code for dynamic dashboard
//for request recieved making dynamic
$sql = "SELECT max(request_id) FROM submitrequest_tb";
$result = $conn->query($sql);
// $row = mysqli_fetch_row($result);
//object oriented code
$row = $result->fetch_row();
$submitrequest = $row[0];



//code for assigned work dynamic
$sql = "SELECT max(rno) FROM assignwork_tb";
$result = $conn->query($sql);
//object oriented code
$row = $result->fetch_row();
$assignwork = $row[0];

//code for no. of technician dynamic
$sql = "SELECT *  FROM technician_tb";
$result = $conn->query($sql);
$totaltech = $result->num_rows;


?>


                <div class="col-sm-9 col-md-10"><!-- Start Dashboard 2nd Column -->
                    <div class="row text-center mx-5">
                        <!-- for request recieved -->
                        <div class="col-sm-4 mt-5">
                            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                                <div class="card-header">Requests Received</div>
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo $submitrequest; ?></h4>
                                    <a class="btn text-white" href="request.php">View</a>
                                </div>
                            </div>
                        </div>

                        <!-- for assign work -->
                        <div class="col-sm-4 mt-5">
                            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                                <div class="card-header">Assigned Work</div>
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo $assignwork; ?></h4>
                                    <a class="btn text-white" href="workorder.php">View</a>
                                </div>
                            </div>
                        </div>

                        <!-- for no.of technician -->
                        <div class="col-sm-4 mt-5">
                            <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                                <div class="card-header">No.of Technician</div>
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo $totaltech; ?></h4>
                                    <a class="btn text-white" href="technician.php">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--  -->
                    <div class="mx-5 mt-5 text-center">
                        <p class="bg-dark text-white p-2">List of Requesters</p>
                        <!-- html code in php -->
                         <?php 
                         //sql query
                         $sql = "SELECT * FROM requesterlogin_tb";
                         $result = $conn->query($sql);
                         if($result->num_rows > 0)
                         {
                            echo ' 
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Requester ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                    </tr>
                                </thead>
                                <tbody>';
                                //while loop
                                while($row = $result->fetch_assoc())
                                {
                                    echo  '<tr>';
                                    echo  '<td>' .$row["r_login_id"].'</td>';
                                    echo  '<td>' .$row["r_name"]. '</td>';
                                    echo  '<td>' .$row["r_email"].'</td>';
                                    echo '</tr>';
                                } 
                               echo '</tbody>
                            </table>';
                         }
                         else
                         {
                            echo 'No Data Found';
                         }
                         ?>

                    </div>
                </div><!-- End Dashboard 2nd Column -->

<?php
include('adminincludes/adminfooter.php') 
?>