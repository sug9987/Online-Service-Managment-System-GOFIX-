<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITLE?></title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css1.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="../css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/custom.css">
</head>
<body>
  <!-- Top Navabar -->
    <nav class="navbar navbar-dark fixed-top bg-info flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="admindashboard.php">GOFIX</a>
    </nav>  

        <!-- Start Conatiner -->
         <div class="container-fluid" style="margin-top:40px;">
            <div class="row"> <!-- Start Row -->
                <nav class="col-sm-2 bg-light sidebar py-5 d-print-none"><!-- Start Side Bar 1st Column -->
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">


                            <li class="nav-item">
                            <a class="nav-link <?php if(PAGE == 'admindashboard') { echo 'active'; } ?>" href="admindashboard.php">
                            <i class="fas fa-tachometer-alt" style="margin-right: 5px;"></i>Dashboard</a>
                            </li>

                            <li class="nav-item">
                            <a class="nav-link <?php if(PAGE == 'workorder') { echo 'active'; } ?>" href="workorder.php">
                            <i class="fab fa-accessible-icon" style="margin-right: 5px;"></i>Work Order</a>
                            </li>

                            <li class="nav-item">
                            <a class="nav-link <?php if(PAGE == 'request') { echo 'active'; } ?>" href="request.php">
                            <i class="fas fa-align-center" style="margin-right: 5px;"></i>Requests</a>
                            </li>


                            <li class="nav-item">
                            <a class="nav-link <?php if(PAGE == 'inventory') { echo 'active'; } ?>" href="inventory.php">
                            <i class="fas fa-database" style="margin-right: 5px;"></i>Inventory</a>
                            </li>

                            <li class="nav-item">
                            <a class="nav-link <?php if(PAGE == 'technician') { echo 'active'; } ?>" href="technician.php">
                            <i class="fab fa-teamspeak" style="margin-right: 5px;"></i>Technician</a>
                            </li>

                            <li class="nav-item">
                            <a class="nav-link <?php if(PAGE == 'requester') { echo 'active'; } ?>" href="requester.php">
                            <i class="fas fa-users" style="margin-right: 5px;"></i>Requester</a>
                            </li>

                            <li class="nav-item">
                            <a class="nav-link <?php if(PAGE == 'salesreport') { echo 'active'; } ?>" href="salesreport.php">
                            <i class="fas fa-table" style="margin-right: 5px;"></i>Sales Report</a>
                            </li>

                            <li class="nav-item <?php if(PAGE == 'workreport') { echo 'active'; } ?>">
                            <a class="nav-link" href="workreport.php">
                            <i class="fas fa-table" style="margin-right: 5px;"></i>Work Report</a>
                            </li>

                            <li class="nav-item <?php if(PAGE == 'AdminChangepass') { echo 'active'; } ?>">
                            <a class="nav-link" href="AdminChangepass.php">
                            <i class="fas fa-key" style="margin-right: 5px;"></i>Change Password</a>
                            </li>

                            <li class="nav-item">
                            <a class="nav-link" href="../logout.php">
                            <i class="fas fa-sign-out-alt" style="margin-right: 5px;"></i>Logout</a>
                            </li>
                        </ul>
                    </div>
                </nav> <!-- End Side Bar 1st Column -->