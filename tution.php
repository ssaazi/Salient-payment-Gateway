<?php
//echo uniqid();
if(isset($_POST["pay"])){
   $student = htmlspecialchars($_POST["student"]);
   $name = htmlspecialchars($_POST["name"]);
   $email = htmlspecialchars($_POST["email"]);
   $phone_number = htmlspecialchars($_POST["phone_number"]);
   $amount = htmlspecialchars($_POST["amount"]);


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

        "title" => "Paying for Salient  Tution Fees!",
        "description" => "A page for the collection of Tution Fees"
    ),

    "meta" =>array(
      "studentRno"=> $student,
        "reason" => "To paying Tution Fees",
        "address" => "Kampla,Uganda  Mengo road"
        
    ),
    "redirect_url" => "http://localhost/myproject/click_fees/Salient/verify.php"
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
            <li class="active"><a href="tution.php">Tution</a></li>
            <li ><a href="register.php">Registraction</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container -->
    </nav>
  </header>
  <!-- End Navbar -->
  <!-- Navbar -->
  <header class="header">

    <section>
      <div id="hero-section" class="register-hero" data-stellar-background-ratio="0">
        <div class="hero-content">
          <div class="container">
            <div class="container">
        <form id="contact" action="" method="POST">
            <h1>Tution Form</h1>
            <h3>Fill the form below and press the send payment <span id="IL_AD1" class="IL_AD">button</span>!</h3>
            <div class="row">
                <!-- first column -->
                <div class="column">
                 <fieldset>
                        <input type="text" placeholder="Your Student Registraction Number *" name="student" id="student" onkeyup="GetDetail(this.value)" value="" required autofocus>
                    </fieldset>                        
                    <fieldset>
                        <input type="text" placeholder="Your Full Name *" name="name" id="name" required autofocus>
                    </fieldset>
                    <fieldset>
                        <input type="text" placeholder="Your Phone Number *" name="phone_number" required autofocus>
                    </fieldset>
                   
                    
                    <!-- adding all country code list -->
                  
                </div>
                <!-- second column -->
                <div class="column">
                     <fieldset>
                        <input type="email" placeholder="Your email *" name="email" required autofocus>
                    </fieldset>
                    <fieldset>
                        <!-- <label for="idCard">Amount</label> -->
                        <input type="number" placeholder="Amount *" name="amount" required autofocus >
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
 
  <!-- End Navbar -->

     <script>
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("fetch.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>

    <script> 

  

        // onkeyup event will occur when the user  

        // release the key and calls the function 

        // assigned to this event 

        function GetDetail(str) { 

            if (str.length == 0) { 

                document.getElementById("name").value = ""; 

                // document.getElementById("stud_class").value = ""; 

                return; 

            } 

            else { 
             // Creates a new XMLHttpRequest object 

                var xmlhttp = new XMLHttpRequest();
                 // xhttp.open("GET", "filename", true); 

                xmlhttp.open("POST", "tution_pay.php?student=" + str, true);  

                xmlhttp.onreadystatechange = function () { 

                    // Defines a function to be called when 

                    // the readyState property changes 

                    if (this.readyState == 4 && this.status == 200) { 

                          

                        // Typical action to be performed 

                        // when the document is ready 

                        var myObj = JSON.parse(this.responseText); 

  

                        // Returns the response data as a 

                        // string and store this array in 

                        // a variable assign the value  

                        // received to first name input field 

                          

                        document.getElementById ("name").value = myObj[0]; 

                          

                        // Assign the value received to 

                        // last name input field 

                        // document.getElementById("stud_class").value = myObj[1]; 

                    }else if (this.readyState == 4 && this.status == 404) {
                        document.getElementById('name').value = 'Not Found';
                      
                    } 

                }; 
                  

                // Sends the request to the server 

                xmlhttp.send(); 

            } 

        } 

    </script> 

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