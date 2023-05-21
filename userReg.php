<?php
error_reporting (E_ALL ^ E_NOTICE);
include "server/connect.php";
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$studFId=0;
$UsedEmail ="";
$passwordNoM="";
$flag = false;


if(isset($_POST["signup"])) {
  $fname = $_POST["Fname"];
  $lname = $_POST["Lname"];
  $utype = $_POST["uType"];
  $address = $_POST["address"];
  $Email = $_POST["email"];
  $phone = $_POST["phone"];
  $passW = $_POST["pass"];
  $confirmPassW = $_POST["re_pass"];

   if($_POST["uType"] === 'client'){
        $checkEmail = "SELECT * FROM TenantTb";
        $result = mysqli_query($conn, $checkEmail);
        if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
            if($row["Email"]==$Email){
              $flag=TRUE;
              $UsedEmail="This email already exits...";
              header("location: register.html");
            }
         }
        }
      if($passW !=$confirmPassW){
          $passwordNoM="password Does Not Macth!";
          $flag=TRUE;
            header("location: register.html");
          }
      if($flag == False) {
          $put = "INSERT INTO TenantTb (FName,LName,Email,phone,passW,confirmPassW)
          VALUES('$fname','$lname','$Email','$phone','$passW','$confirmPassW')";
          $f=mysqli_query($conn, $put);
          if($f){header("location: index.html");}
          }
  }
  else{
        $checkEmail = "SELECT * FROM HouseOwner";
        $result = mysqli_query($conn, $checkEmail);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                  if($row["Email"]==$Email){
                  $flag=TRUE;
                  $UsedEmail="This email already exits...";
                  header("location: register.html");
                  return;
                    }
                 }
           }
          //  
      if($passW != $confirmPassW){
          $passwordNoM="password Does Not Macth!";
          $flag=TRUE;
            header("location: register.html");
            return;
          }
      if($flag == false) {
        $put = "INSERT INTO HouseOwner (FName,LName,Email,userAddress,phone,passW,confirmPassW)
          VALUES('$fname','$lname','$Email','$address','$phone','$passW','$confirmPassW')";
          $f=mysqli_query($conn, $put);
          if($f){header("location: index.html");}
          }
  }
}
?>
