<?php
$servername = "103.163.138.146";
$username = "sinarumi_mliuser";
$password = "DLPz?SmROn.P";
$db = "sinarumi_mliterm";
//$conn = mysqli_connect("localhost", "distudi1_maindb", "LCh5F4XZD", "distudi1_maindb");
// Create connection
$conn = new mysqli($servername, $username, $password,$db);


// Check connection
if ($conn->connect_error) {
    //echo "connection Fail"    ;
  die("Connection failed: " . $conn->connect_error);
}

?>