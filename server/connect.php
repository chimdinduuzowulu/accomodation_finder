<?php
// Create connection
$serverName = "localhost";
$userName = "root";
$password = "";
// Create connection
$conn = mysqli_connect($serverName, $userName, $password);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

   $sql = "CREATE  DATABASE IF NOT EXISTS Home_management";
       if(mysqli_query($conn, $sql)) {
          echo("");
       }
       else {
         echo("");
         
       }
       
$serverName = "localhost";
$userName = "root";
$password = "";
$database="Home_management";
$conn = mysqli_connect($serverName, $userName, $password,$database);
