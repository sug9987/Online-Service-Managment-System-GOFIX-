<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap Css-->
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="css/bootstrap.min.css1.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css"> -->
    
    <!-- Font Awesome Css-->
    <link rel="stylesheet" href="css/all.min.css">

    <link rel="stylesheet" href="css/styles.css">

    <link rel="stylesheet" href="css/animation.css">


    <!-- Font Awesome CDN (new version) -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"> -->

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    
    <!-- Custom Css-->
    <link rel="stylesheet" href="css/custom.css">
        
    <title>GOFIX</title>
</head>
<body>
    <!--- Start Navigation -->
    <nav class="navbar navbar-expand-sm navbar-dark bg-info pl-5 fixed-top">
        <a href="index.php" class="navbar-brand">GOFIX</a>
        <span class="navbar-text">Your service needs, our top priority</span>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#myMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="myMenu">
            <ul class="navbar-nav pl-5 custom-nav">
                <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="#services" class="nav-link">Services</a></li>
                <li class="nav-item"><a href="#registration" class="nav-link">Registration</a></li>
                <li class="nav-item"><a href="User/UserLogin.php" class="nav-link">Login</a></li>
                <li class="nav-item"><a href="#Contact" class="nav-link">Contact</a></li>
                <!-- <li class="nav-item"><a href="User/ServiceStatus.php" class="nav-link">Track Service Request</a></li> -->
            </ul>
        </div>
    </nav>
    <!-- End Navigation-->

    <!--- Start  Header Jumbotron --->
    <header class="jumbotron back-image" style="background-image:url(images/Banner11.jpg);">
        <div class="myclass mainHeading">
            <h1 class="text-info font-weight-bold">WELCOME TO GOFIX</h1>
            <p class="font-italic">Your service needs, our top priority</p>
            <a href="User/UserLogin.php"class="btn btn-success mr-4">Login</a>
            <a href="#registration"class="btn btn-danger mr-4">Sign Up</a>   
        </div>
    </header><!--- End Header Jumbotron --->

    <!--- Start Introduction Section  Container--->
    <div class="container">
        <div class="jumbotron">
            <h4 class="text-center">GOFIX Services</h4>
            <p>GOFIX Services is India’s leading chain of multi-brand Electronics and Electrical service workshops offering a wide array of services. 
            We focus on enhancing your user experience by providing world-class Electronic Appliances maintenance services.
            Our sole mission is “To deliver top-notch Electronic Appliances care services to keep your devices fit and healthy, ensuring our customers remain happy and satisfied.”  
            With well-equipped Electronic Appliances service centres and fully trained mechanics, 
            we guarantee quality services with excellent packages tailored to offer you substantial savings.
            Our state-of-the-art workshops are strategically located in multiple cities across the country.
            Now, you can conveniently book your service online by registering with us.</p>
        </div>
    </div> <!--- End Introduction Section Container--->

    <!--- Start Services Section --->
    <div class="container text-center border-bottom" id="services">
        <h2>Explore Our Services</h2>

        <div class="row row-cols-2 row-cols-md-5 g-4">
            <div class="col">
                <div class="service-box text-center">
                    <img src="images/AC.webp" alt="AC Repair">
                    <h6>AC Repair & Service</h6>
                </div>
            </div>
            <div class="col">
                <div class="service-box text-center">
                    <img src="images/TV.jpg" alt="TV Warranty">
                    <h6>Television Extended Warranty</h6>
                </div>
            </div>
            <div class="col">
                <div class="service-box text-center">
                    <img src="images/refrigerator-warranty.webp" alt="Refrigerator Warranty">
                    <h6>Refrigerator Extended Warranty</h6>
                </div>
            </div>
            <div class="col">
                <div class="service-box text-center">
                    <img src="images/water-purifier.webp" alt="Water Purifier">
                    <h6>Water Purifier Repair & Service</h6>
                </div>
            </div>
            <div class="col">
                <div class="service-box text-center">
                    <img src="images/Room Cleaner.jpg" alt="Room Cooler">
                    <h6>Room Cooler Extended Warranty</h6>
                </div>
            </div>
            <div class="col">
                <div class="service-box text-center">
                    <img src="images/Washing-machine.webp" alt="Washing Machine">
                    <h6>Washing Machine Extended Warranty</h6>
                </div>
            </div>
            <div class="col">
                <div class="service-box text-center">
                    <img src="images/Mobile-phone.webp" alt="Mobile Warranty">
                    <h6>Mobile Extended Warranty</h6>
                </div>
            </div>
            <div class="col">
                <div class="service-box text-center">
                    <img src="images/Laptop_1.jpg" alt="Laptop Care">
                    <h6>Laptop Complete Care</h6>
                </div>
            </div>
            <div class="col">
                <div class="service-box text-center">
                    <img src="images/micro wave.jpg" alt="Microwave Warranty">
                    <h6>Microwave Extended Warranty</h6>
                </div>
            </div>
            <div class="col">
                <div class="service-box text-center">
                    <img src="images/geyser.jpg" alt="Microwave Warranty">
                    <h6>Geyser Repair & Service</h6>
                </div>
            </div>
        </div>
    </div> 

    <!--- Start Registration Form --->
    <?php include('UserRegistration.php') ?>
    <!--- End Registration Form --->

    <!-- Start Happy Customer -->
    <div class="jumbotron bg-info" id="Customer">
        <div class="container">
            <h2 class="text-center text-white">Satisfied Clients, Happy Results</h2>
            <div class="row mt-5">
                      <div class="col-lg-3 col-sm-6"> <!-- Start 1st Column-->
                          <div class="card shadow-lg mb-2">
                              <div class="card-body text-center">
                                  <img src="images/avtar1.jpeg" class="img-fluid" style="border-radius:100px; width: 80px; height: 80px;" alt="avt1">
                                  <h4 class="card-title">Rahul Kumar</h4>
                                  <p class="card-text">"GOFIX made the process smooth, technician polite, on time, fixed issue quickly. Recommend!"</p>
                              </div>
                          </div>
                      </div><!-- End 1st Column -->

                      <div class="col-lg-3 col-sm-6"> <!-- Start 2st Column-->
                          <div class="card shadow-lg mb-2">
                              <div class="card-body text-center">
                                  <img src="images/avatar5.jpg" class="img-fluid" style="border-radius:100px; width: 80px; height: 80px;" alt="avt5">
                                  <h4 class="card-title">Tanya Kapoor</h4>
                                  <p class="card-text">"GOFIX was a lifesaver! On-time technician, comfortable process, and excellent service!"</p>
                              </div>
                          </div>
                      </div><!-- End 2st Column -->
                    
                      <div class="col-lg-3 col-sm-6"> <!-- Start 3rd Column-->
                          <div class="card shadow-lg mb-2">
                              <div class="card-body text-center">
                                  <img src="images/avtar3.jpeg" class="img-fluid" style="border-radius:100px; width: 80px; height: 80px;" alt="avt3">
                                  <h4 class="card-title">Aman Verma</h4>
                                  <p class="card-text">GOFIX is my go-to for service needs; punctual, polite, thorough team, excellent experience!</p>
                              </div>
                          </div>
                      </div><!-- End 3rd Column -->

                      <div class="col-lg-3 col-sm-6"> <!-- Start 4th Column-->
                          <div class="card shadow-lg mb-2">
                              <div class="card-body text-center">
                                  <img src="images/avatar7.jpg" class="img-fluid" style="border-radius:100px; width: 80px; height: 80px;" alt="avt4">
                                  <h4 class="card-title">Ishita Sharma</h4>
                                  <p class="card-text">Superb service by GOFIX! Easy booking, perfect technician handling, glad I found this platform!</p>
                              </div>
                          </div>
                      </div><!-- End 4th Column -->
            </div>
        </div>
    </div><!-- End Happy Customer -->

    <!--- Start Contact us -->
    <div class="container" id="Contact">
        <h2 class="text-center mb-4">Contact Us</h2>
        <div class="row">
            <!--- Start 1st Column -->
            <?php include('contactform.php') ?>
            <!--- End 1st Column -->

            <div class="col-md-4 text-center"><!--- Start 2nd Column --->
                <strong>Headquarter:</strong><br>
                GOFIX Pvt Ltd, <br>
                Sec IV, Bokaro <br>
                Jharkhand - 834005 <br>
                Phone: +91 44 56789012 <br>
                <a href="#" target="_blank">www.gofix.com</a> <br>

                <br><br>

                <strong>Delhi Branch:</strong> <br>
                GOFIX Pvt Ltd, <br>
                Ashok Nagar, Delhi <br>
                Delhi - 804002 <br>
                Phone: +91 11 23456789 <br>
                <a href="#" target="_blank">www.gofix.com</a> <br>
            </div><!--- End 2nd Column --->
        </div>
    </div><!--- End Contact us -->

    <!-- Start Footer -->
    <footer class="container-fluid bg-dark  text-white mt-5" style="border-top: 3px solid #0DCAF0;">
      <div class="container"> 
          <!-- Start Footer Container -->
          <div class="row py-3"> 
              <!-- Start Footer Row -->
              <div class="col-md-6">  
                  <!--- Start Footer 1st Column  -->
                  <span class="pr-2">Follow Us:</span>
                  <a href="#" target="_blank" class="pr-2 fi-color"><i class="fab fa-facebook-f"></i></a>
                  <a href="#" target="_blank" class="pr-2 fi-color"><i class="fab fa-twitter"></i></a>
                  <a href="#" target="_blank" class="pr-2 fi-color"><i class="fab fa-youtube"></i></a>
                  <a href="#" target="_blank" class="pr-2 fi-color"><i class="fab fa-google-plus-g"></i></a>
                  <a href="#" target="_blank" class="pr-2 fi-color"><i class="fas fa-rss"></i></a>
              </div> <!--- End Footer 1st Column  -->

              <div class="col-md-6 text-right"> <!-- Start Footer 2nd Column -->
                  <small> Designed by Sumit Gupta &copy; 2025.</small>
                  <small class="ml-2"><a href="Admin/Adminlogin.php">Admin Login</a></small>
              </div> <!-- End Footer 2nd Column -->
          </div><!-- End Footer Row -->
          
      </div> <!-- End Footer Container -->
    </footer><!--- End Footer --->

    <!--- JavaScript --->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/all.min.js"></script>
    <script src="js/password.js"></script>
    <script src="js/animation.js"></script>

    <!-- for terms and condition -->
    <script>
        document.getElementById("terms").addEventListener("change", function()
        {
            document.getElementById("signup-btn").disabled = !this.checked;
        });
    </script>    
  </body>
</html>