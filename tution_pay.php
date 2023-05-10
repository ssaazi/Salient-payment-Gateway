
<?php
//Get the user id  

$student = $_REQUEST['student']; 
// Database connection 

$con = mysqli_connect("localhost", "root", "", "clickfees_db"); 

if ($student !== "") { 
    // Get corresponding first name and  

    // last name for that user id     

  $sql =  "SELECT name FROM student WHERE id_no='$student'";
    if ($query = mysqli_query($con,$sql)) {
      # code...

$row = mysqli_fetch_array($query); 
    // Get the first name 

    $name = $row["name"]; 
    // Get the first name 
// Store it in a array 

$result = array("$name");

  
// Send in JSON encoded form
if ($result > 0) {
$myJSON = json_encode($result); 
echo $myJSON;
  }


    }
    
    // $stud_class = $row["stud_class"]; 
} 
  





  ?>







 
