<?php 
  $dbServername = "localhost";
  $dbUsername = "root";
  $dbPassword = "";
  $database = "grapesphp";

  // Create connection
  $conn = new mysqli($dbServername ,$dbUsername ,$dbPassword ,$database );

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

?>