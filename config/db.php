<?php
// $servername = "localhost";
// $username = "root";
// $password = "";

// try {
  
//   $conn = new PDO("mysql:host=$servername;dbname=db_ga", $username, $password);
 
//   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
// } catch(PDOException $e) {
 
// }


$servername = "localhost";
$username = "inwzacom_ga";
$password = "!QAZxsw23edc";
$database = "inwzacom_ga";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Connected successfully";
} catch(PDOException $e) {
  // echo "Connection failed: " . $e->getMessage();
}
?>
