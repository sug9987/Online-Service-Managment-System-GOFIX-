<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="../css/bootstrap.min.css1.css">

<!-- Font Awesome CSS -->
<link rel="stylesheet" href="../css/all.min.css">

<!-- Custom CSS -->
<link rel="stylesheet" href="../css/custom.css">

<title><?php echo TITLE ?></title>

</head>
<body>
<!-- Top Navabar -->
<nav class="navbar navbar-dark fixed-top bg-info flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="UserProfile.php">GOFIX</a>
</nav>

<!-- Start Conatiner -->
<div class="container-fluid" style="margin-top:40px;">
<div class="row"> <!-- Start Row -->
<nav class="col-sm-2 bg-light sidebar py-5 d-print-none"><!-- Start Side Bar 1st Column -->
<div class="sidebar-sticky">
<ul class="nav flex-column">


<li class="nav-item">
<a class="nav-link <?php if(PAGE == 'UserProfile') {echo 'active';} ?>" href="UserProfile.php">
<i class="fas fa-user"></i>Profile</a>
</li>

<li class="nav-item">
<a class="nav-link  <?php if(PAGE == 'SubmitRequest') {echo 'active';} ?>" href="SubmitRequest.php">
<i class="fab fa-accessible-icon"></i>Submit Request</a>
</li>

<li class="nav-item">
<a class="nav-link  <?php if(PAGE == 'ServiceStatus') {echo 'active';} ?>" href="ServiceStatus.php">
<i class="fas fa-align-center"></i>Service Status</a>
</li>

 <!-- Payment History (New Item) -->
 <li class="nav-item">
    <a class="nav-link" href="payment_history.php">
        <i class="fas fa-credit-card"></i>Payment History
    </a>
</li>

<li class="nav-item">
<a class="nav-link  <?php if(PAGE == 'UserChangepass') {echo 'active';} ?>" href="UserChangepass.php">
<i class="fas fa-key"></i>Change Password</a>
</li>

<li class="nav-item">
<a class="nav-link" href="../logout.php">
<i class="fas fa-sign-out-alt"></i>Logout</a>
</li>
</ul>
</div>
</nav> <!-- End Side Bar 1st Column -->