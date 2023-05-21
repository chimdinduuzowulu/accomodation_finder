<?php
session_start();
$HouseOwner_Id=$_SESSION["HouseOwner_Id"];
$tenantEmail=$_GET["tenantEmail"];
include "../server/connect.php";
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$UsedEmail =$message="";
        $edit= $conn->query("DELETE FROM `TenantTb` WHERE Email='$tenantEmail' AND HouseOwner_Id='$HouseOwner_Id'");
          if($edit){
           header("location: manageTenants.php");
            }

mysqli_close($conn);
?>



