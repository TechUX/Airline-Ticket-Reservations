<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = 'airlinesreservation';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("MySQL Connection failed: " . mysqli_connect_error());
  exit() ;
}
?>
