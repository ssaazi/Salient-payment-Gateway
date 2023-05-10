<?php
//echo uniqid();
if(isset($_POST["pay"])){
   $name = htmlspecialchars($_POST["name"]);
   $email = htmlspecialchars($_POST["email"]);
   $phone_number = htmlspecialchars($_POST["phone_number"]);
   $DOB = htmlspecialchars($_POST["date"]);
   $parent = htmlspecialchars($_POST["parent"]);
   $pphone_number = htmlspecialchars($_POST["pphone_number"]);
   $courses = htmlspecialchars($_POST["courses"]);
   $amount = htmlspecialchars($_POST["amount"]);
   $result = htmlspecialchars($_POST["result"]);
   $address = htmlspecialchars($_POST["address"]);

//Integrate Rave pament
$endpoint = "https://api.flutterwave.com/v3/payments";

//Required Data
$postdata = array(
    "tx_ref" => uniqid().uniqid(),
    "currency" => "UGX",
    "amount" => $amount,
    "customer" =>array(
        "name" => $name,
        "email" => $email,
        "phone_number" => $phone_number
    ),
    "customizations" =>array(
        "title" => "Paying for Salient  Registraction Fees!",
        "description" => "A page for the collection of Registraction Fees"
    ),
    "meta" =>array(
        "reason" => "To paying Registraction Fees",
        "address" => "Kampla,Uganda  Mengo road",
        "DOB" => $DOB,
        "parent" => $parent,
        "pphone_number" => $pphone_number,
        "course" => $courses,
        "result" => $result,
        "myaddress" => $address 
    ),
    "redirect_url" => "http://localhost/myproject/click_fees/Salient/Reverify.php"
);

//Init cURL handler
$ch = curl_init();

//Turn of SSL checking
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

//Set the endpoint
curl_setopt($ch, CURLOPT_URL, $endpoint);

//Turn on the cURL post method
curl_setopt($ch, CURLOPT_POST, 1);

//Encode the post field
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata));

//Make it reurn data
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//Set the waiting timeout
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 200);
curl_setopt($ch, CURLOPT_TIMEOUT, 200);

//Set the headers from endpoint
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  "Authorization: Bearer FLWSECK_TEST-522340d3e500750e5bb921ab2b190c48-X",
   "Content-Type: Application/json",
   "Cache-Control: no-cahe"
));

//Execute the cURL session
$request = curl_exec($ch);

$result = json_decode($request);
header("Location: ".$result->data->link);
//var_dump($result);
//Close the cURL session
curl_close($ch);
}

?>

<!DOCTYPE html>
<!--
  Salient by TEMPLATE STOCK
  templatestock.co @templatestock
  Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Salient - Free Responsive HTML5 Template | Template Stock</title>

  <!-- Custom Google fonts -->
  <link href='http://fonts.googleapis.com/css?family=Raleway:400,500,300,700' rel='stylesheet' type='text/css'>
  <link href="http://fonts.googleapis.com/css?family=Crimson+Text:400,600" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href= "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
<script src= "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"> </script> 


  <!-- Bootstrap CSS Style -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">

  <!-- Template CSS Style -->
  <link rel="stylesheet" href="assets/css/style.css">

  <!-- Animate CSS  -->
  <link rel="stylesheet" href="assets/css/animate.css">

  <!-- FontAwesome 4.3.0 Icons  -->
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">

  <!-- et line font  -->
  <link rel="stylesheet" href="assets/css/et-line-font/style.css">

  <!-- BXslider CSS  -->
  <link rel="stylesheet" href="assets/css/bxslider/jquery.bxslider.css">

  <!-- Owl Carousel CSS Style -->
  <link rel="stylesheet" href="assets/css/owl-carousel/owl.carousel.css">
  <link rel="stylesheet" href="assets/css/owl-carousel/owl.theme.css">
  <link rel="stylesheet" href="assets/css/owl-carousel/owl.transitions.css">

  <!-- Magnific-Popup CSS Style -->
  <link rel="stylesheet" href="assets/css/magnific-popup/magnific-popup.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  
</head>
<body>

  <!-- Preload the Whole Page -->
  <!-- <div id="preloader">      
    <div id="loading-animation">&nbsp;</div>
  </div>
 -->
  <!-- Navbar -->
  <header class="header">
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation-nav">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
           <a class="navbar-brand" href="#"><img src="assets/images/logo.png" alt=""></a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navigation-nav">
          <ul class="nav navbar-nav navbar-right">
            <li ><a class="section-scroll" href="index.php">Home</a></li>
            <li><a href="tution.php">Tution</a></li>
            <li class="active"><a href="register.php">Registraction</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container -->
    </nav>
  </header>
  <!-- End Navbar -->
    <!-- Hero
  ================================================== -->
    <section>
      <div id="hero-section" class="register-hero" data-stellar-background-ratio="0">
        <div class="hero-content">
          <div class="container">

           <div class="container">
        <form id="contact" action="" method="post">
            <h1>Registration Form</h1>
            <h3>Fill the form below ! and your student registraction number will send to you  after paying </h3>
            <div class="row">
                <!-- first column -->
                <div class="column">                        
                    <fieldset>
                        <input type="text" placeholder="Your Full Name *" name="name" required autofocus>
                    </fieldset>
                    <fieldset>
                        <input type="text" placeholder="Your Phone Number *" name="phone_number" required autofocus>
                    </fieldset>
                    <fieldset>
                        <input type="email" placeholder="Your email *" name="email" required autofocus>
                    </fieldset>
                    <fieldset>
                        <input type="text" placeholder="Date of birth *" name="date" onfocus="(this.type = 'date')" required autofocus>
                    </fieldset>
                    <fieldset>
                        <input type="text" placeholder="Next of kind/Parent`s name *" name="parent" required autofocus>
                    </fieldset>
                    <fieldset>
                        <input type="text" placeholder="Your Parent`s Phone Number  *" name="pphone_number" required autofocus>
                    </fieldset>
                    
                    <!-- adding all country code list -->
                  
                </div>
                <!-- second column -->
                <div class="column">
                    <fieldset>
                        <p>Courses Offered</p>
                       
                             <select class="choices form-select" name="courses" style="width: 70%;  ">
                                            <optgroup label="Short Courses ">
                                                <option value="romboid">Software Engineering(c,c++,JAVASCRIPT)</option>
                                                <option value="trapeze">Microsoft Office + Basic & Funddamentals of Networking(CompTIA N+) </option>
                                                <option value="triangle">Web Designing(Photoshop, HTML, CSS, JAVASCRIPT)</option>
                                                <option value="polygon">Certificate in science and Technology</option>
                                            </optgroup>
                                            <optgroup label="Diploma Courses">
                                                <option value="Diploma in Software Engineering">Diploma in Software Engineering</option>
                                                <option value="green">Diploma in infrastructure Management Services</option>
                                                <option value="Diploma in Visual Effect">Diploma in Visual Effects and Animation</option>
                                            </optgroup>
                                        </select>
                       
                    </fieldset>
                    <fieldset>
                        <label for="idCard">Amount</label>
                        <input type="number" placeholder="Amount *" name="amount" value="50000">
                    </fieldset>
                    <fieldset>
                        <p>Upload Your Results</p>
                        <input type="file" id="file" name="result" required>
                    </fieldset>
                     <fieldset>
                        <textarea class="form-control" name="address" placeholder="Address  *"
                                id="floatingTextarea"></textarea>
                    </fieldset>
                </div>
            </div>
            <!-- submit button -->
            <fieldset>
                <button type="submit" name="pay" class="btn btn-primary me-1 mb-1 ">Send Payment</button>
            </fieldset>
        </form>
    </div>
            </div> <!-- End container -->
          </div><!-- End hero-content -->
        </div>  <!-- End hero-section -->
    </section>




 <!--    <form class="form form-vertical" action="" method="post">
      <div>
        <h1>
          REGISTRACTION FORM
        </h1>
      </div>
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group has-icon-left">
                                                <label for="name-icon"> Name</label>
                                                <div class="position-relative">
                                                    <input type="text" name="name" class="form-control"
                                                        placeholder="Name" id="first-name-icon">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-person"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">

                                            <div class="form-group has-icon-left">
                                                <label for="email-id-icon">Email</label>
                                                <div class="position-relative">
                                                    <input type="text" name="email" class="form-control" placeholder="Email"
                                                        id="email-id-icon">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-envelope"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group has-icon-left">
                                                <label for="mobile-id-icon">Mobile</label>
                                                <div class="position-relative">
                                                    <input type="text" name="phone" class="form-control" placeholder="Mobile"
                                                        id="mobile-id-icon">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-phone"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group has-icon-left">
                                                <label for="Amount-id-icon">Amount</label>
                                                <div class="position-relative">
                                                    <input type="number" name="amount" class="form-control" placeholder="Amount"
                                                        id="Amount-id-icon">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-cash"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      
                                        <div class="col-12 d-flex justify-content-center">
       
                                            <button type="submit" name="pay" class="btn btn-primary me-1 mb-1">Send Payment</button>
                                            
                                    </div>
                                </div>
                            </form> -->
             

<footer>
      <div id="footer-section" class="text-center">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
              <ul class="footer-social-links">
                <li><a href="#">Facebook</a></li>
                <li><a href="#">Twitter</a></li>
                
              </ul>
              <p class="copyright">
                &copy; 2022 Salient Fee Payment Gateway- Created By <a href="#">VINTECH</a>
              </p>
            </div> <!-- End col-sm-8 -->
          </div> <!-- End row -->
        </div> <!-- End container -->
      </div> <!-- End footer-section  -->
    </footer>
    <!-- End footer -->

  </div> <!-- End wrapper -->

  <!-- Back-to-top
  ================================================== -->
  <div class="back-to-top">
    <i class="fa fa-angle-up fa-3x"></i>
  </div>


  <!-- JS libraries and scripts -->
  <script src="assets/js/jquery-1.11.3.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/bootstrap-hover-dropdown.min.js"></script>
  <script src="assets/js/jquery.appear.min.js"></script>
  <script src="assets/js/jquery.bxslider.min.js"></script>
  <script src="assets/js/jquery.owl.carousel.min.js"></script>
  <script src="assets/js/jquery.countTo.js"></script>
  <script src="assets/js/jquery.easing.1.3.js"></script>
  <script src="assets/js/jquery.imagesloaded.min.js"></script>
  <script src="assets/js/jquery.isotope.js"></script>
  <script src="assets/js/jquery.placeholder.js"></script>
  <script src="assets/js/jquery.smoothscroll.js"></script>
  <script src="assets/js/jquery.stellar.min.js"></script>
  <script src="assets/js/jquery.waypoints.js"></script>
  <script src="assets/js/jquery.fitvids.js"></script>
  <script src="assets/js/jquery.magnific-popup.min.js"></script>
  <script src="assets/js/jquery.ajaxchimp.min.js"></script>
  <script src="assets/js/jquery.countdown.js"></script>
  <script src="assets/js/jquery.navbar-scroll.js"></script>
  <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
  <script src="assets/js/jquery.gmaps.js"></script>
  <script src="assets/js/main.js"></script>


</body>
</html>