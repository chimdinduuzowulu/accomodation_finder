<?php
error_reporting (E_ALL ^ E_NOTICE); 
session_start();
include "server/tables.php";
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$uEmail= $_POST["username"];
$uP= $_POST["your_pass"];
$userType= $_POST["uType"];
$passError=$UserNameError="";
if (isset($_POST["signin"])){
    if($userType === "client"){
    $flag=0;
    $stud = $conn->query("SELECT * FROM TenantTb");
    if ($stud) {
        // output data of each row  
        while($row =$stud->fetch_assoc()) {
              if($row["Email"]==$uEmail && $row["passW"]==$uP){
                    $flag=1;
		                $passError=$UserNameError="";
		                $fnamehold=$row["FName"];
		                $lnamehold=$row["LName"];
                    $_SESSION["Email"]=$row["Email"];
                    $expiryDate=$row["expiryDate"];
                    $paidDate=$row["paidDate"];
                    $_SESSION["tenantEmail"] = $row["Email"];
                    $_SESSION["HouseOwner_Id"]=$row["HouseOwner_Id"];
                    $_SESSION["userName"] = $fnamehold." ".$lnamehold;
                    header("location: tenantDashboard.php");
                  }
              }
      } 
                    $passError=$UserNameError="password or username Error: *"; 
                      if($flag===0){header("location: index.html");}
    }
    elseif ($userType === "HouseOwner") {
    $flag=0;
        $HouseOwner = $conn->query("SELECT * FROM HouseOwner");
                if ($HouseOwner) {
        // output data of each row  
                while($row =$HouseOwner->fetch_assoc()) {
                     if($row["Email"]==$uEmail && $row["passW"]==$uP){
                              $flag=1;
		                        $passError=$UserNameError="";
		                         $fnamehold=$row["FName"];
		                          $lnamehold=$row["LName"];
		                           $_SESSION["email"]=$row["Email"];
                                $passError=$UserNameError="";
                                $_SESSION["fullname"]= $fnamehold." ".$lnamehold; 
                                $_SESSION["HouseOwner_Id"]=$row["HouseOwner_Id"];
                                header("location: houseOwner/dashboard.php");
                          }
                      }
                      $passError=$UserNameError="password or username Error: *"; 
                      if($flag===0){header("location: index.html");}
                      }
    }
    else {
    header("location: index.html");
    }
}
mysqli_close($conn);
?>