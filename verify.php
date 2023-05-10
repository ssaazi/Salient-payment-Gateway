<?php
if(isset($_GET["transaction_id"]) AND isset($_GET["status"])  AND isset($_GET["tx_ref"])){
    $trans_id = htmlspecialchars($_GET['transaction_id']);
    $trans_status = htmlspecialchars($_GET['status']);
    $trans_ref = htmlspecialchars($_GET['tx_ref']);

    //Verify Endpoint
    $url = "https://api.flutterwave.com/v3/transactions/".$trans_id."/verify";

    //Create cURL session
    $curl = curl_init($url);

    //Turn off SSL checker
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

    //Decide the request that you want
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
    
    //Set the API headers
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer FLWSECK_TEST-522340d3e500750e5bb921ab2b190c48-X",
        "Content-Type: Application/json"
    ]);

    //Run cURL
    $run = curl_exec($curl);

    //Check for erros
    $error = curl_error($curl);
    if($error){
        die("Curl returned some errors: " . $error);
    }

   //echo"<pre>" . $run . "</pre>";
   //Convert to json obj
   $result = json_decode($run);
  $status = $result->data->status;
  $message = $result->message;
  $id = $result->data->id;
  $reference =  $result->data->tx_ref;
  $amount =  $result->data->amount;
  $charged_amount = $result->data->charged_amount;
  $student =  $result->data->meta->studentRno;
  $fullName =  $result->data->customer->name;
  $email =  $result->data->customer->email;
  $phone =  $result->data->customer->phone_number;

  if(($status != $trans_status) OR ($trans_id != $id)){
     header("Location: index.php");
     exit;
  }else{
      //Give value=[]
  }
  curl_close($curl);

}else{
    header("Location: index.php");
     exit; 
}
//QR CODE
require_once 'phpqrcode/qrlib.php';

$path = 'images/';
// $qrcode =$path.time().".png";
$filename =$fullName;
$codeContents ='Student: '.$student.' Full_Name:'.$fullName .' Phone_Number: '.$phone. ' Email: '.$email .' Transaction_status:'.$status.' Reference: '.$reference.' Transaction_Id: '.$id.' Amount: '.$amount .' Charged_Amount: '.$charged_amount;
/* QRcode::png("text", $qrcode);*/
QRcode::png($codeContents, $path.''.$filename.'.png', QR_ECLEVEL_L, 5);

//insert into database
require "connection/config.php";
$sql = "INSERT INTO online_tution (reg_no, name, contact, email, amount ) VALUES ('$student', '$fullName', '$phone', '$email', '$amount')";
if (mysqli_query($conn, $sql)) {
  // $last_id = $conn->insert_id;
  // echo "<h1>New record inserted successfully. Last inserted ID is: " . $last_id . "</h1>";

  // echo "<h1>Records inserted successfully.</h1>";
} else {
  // echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SUCCESS</title>
    <link rel="stylesheet" href="assets/css/css/style.css">
</head>
<body>
   <div id="verify">
    <div class="qrframe" style="border:2px solid black; width:150px; height:150px; margin-right: 5px;">
           <?php echo '<img src="images/'. @$filename.'.png" style="width:145px; height:145px;"><br>'; ?>  
          </div>
   <h1>THANK YOU FOR SALIENT FEES!</h1>
   <hr>
   <div class="container verify"  >
   <table>
    <tr>
      <th>Full Name</th>
       <th>Student Rno</th>
       <th>Phone Number</th>
       <th>Email</th>
       <th>Transaction Status</th>
       <th>Reference</th>
       <th>Transaction Id</th>
       <th>Amount</th>
       <th>Charged Amount</th>
       </tr>
       <tr>
            <td><?php echo $fullName; ?></td>
            <td><?php echo $student; ?></td>
            <td><?php echo $phone; ?></td>
            <td><?php echo $email; ?></td>
            <td><?php echo $status; ?></td>
            <td><?php echo $reference; ?></td>
            <td><?php echo $id; ?></td>
            <td><?php echo $amount; ?></td>
            <td><?php echo $charged_amount; ?></td>
       </tr>
     </table>
   </div> 
   </div>
   <div class="col-md-12 mb-4">
                    <center>
                        <div class="download-container">
      <a href="#" class="download-btn">Download Files <i class="fas fa-download"></i></a>
      <div class="countdown"></div>
      <div class="pleaseWait-text">Please wait..</div>
      <div class="manualDownload-text">
        If the download didn't start automatically, <a href="" class="manualDownload-link">click here.</a>
      </div>
    </div>
                    </center>
                </div>
               
                <script type="text/javascript">
    const downloadBtn = document.querySelector(".download-btn");
    const countdown = document.querySelector(".countdown");
    const pleaseWaitText = document.querySelector(".pleaseWait-text");
    const manualDownloadText = document.querySelector(".manualDownload-text");
    const manualDownloadLink = document.querySelector(".manualDownload-link");
    var timeLeft = 10;

    downloadBtn.addEventListener("click", () => {
      downloadBtn.style.display = "none";
      countdown.innerHTML = "Download will begin automatically in <span>" + timeLeft + "</span> seconds."; //for quick start of countdown

      var downloadTimer = setInterval(function timeCount(){
        timeLeft -= 1;
        countdown.innerHTML = "Download will begin automatically in <span>" + timeLeft + "</span> seconds.";

        if(timeLeft <= 0){
          clearInterval(downloadTimer);
          pleaseWaitText.style.display = "block";
          let download_href = "javascript:window.print()" ; //enter the downloadable file link URL here
          window.location.href = download_href;
          manualDownloadLink.href = download_href;

          setTimeout(() => {
            pleaseWaitText.style.display = "none";
            manualDownloadText.style.display = "block";
          }, 4000);
        }
      }, 1000);
    });
    </script>
   
</body>
</html>