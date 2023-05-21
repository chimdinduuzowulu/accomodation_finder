<?php
include "connect.php";

if (!$conn) {
  // die();
}
$t1 = "CREATE TABLE IF NOT EXISTS TenantTb (
tenantId INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
FName VARCHAR (30) NOT NULL,
LName VARCHAR (30) NOT NULL,
Email VARCHAR (30) NOT NULL UNIQUE,
HouseOwner_Id INT(6) UNSIGNED ,
House_number VARCHAR (30) ,
broadCastedMessage VARCHAR (430),
phone VARCHAR (30) NOT NULL,
passW VARCHAR (30) NOT NULL,
confirmPassW VARCHAR (30) NOT NULL,
paidDate VARCHAR (30),
expiryDate VARCHAR (30)
)";
$t2 = "CREATE TABLE IF NOT EXISTS HouseOwner (
HouseOwner_Id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
FName VARCHAR (30) NOT NULL,
LName VARCHAR (30) NOT NULL,
Email VARCHAR (30) NOT NULL UNIQUE,
userAddress VARCHAR (120) NOT NULL,
phone VARCHAR (30) NOT NULL,
passW VARCHAR (30) NOT NULL,
confirmPassW VARCHAR (30) NOT NULL, 
uploadCount int(255) DEFAULT 0 NOT NULL,
Regdate TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
$t4="CREATE TABLE IF NOT EXISTS `houseTable` (
 `House_Id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  searchValue INT(255) UNSIGNED DEFAULT 0,
  viewValue INT(255) UNSIGNED DEFAULT 0,
  trackID INT(255) UNSIGNED DEFAULT 0,
  price INT(255) UNSIGNED, 
 `houseTitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 `houseDescription` varchar(355) COLLATE utf8_unicode_ci NOT NULL,
 `paymentType` varchar(355) COLLATE utf8_unicode_ci NOT NULL,
 `houseAddress` varchar(355) COLLATE utf8_unicode_ci NOT NULL,
 `houseStateAddress` varchar(355) COLLATE utf8_unicode_ci NOT NULL,
 `image_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 `imageNumCount` int(11) NOT NULL,
 `HouseOwner_Id` INT(6) UNSIGNED NOT NULL,
 `uploaded_on` datetime NOT NULL,
 `status` enum('1','0') COLLATE utf8_unicode_ci DEFAULT '0',
FOREIGN KEY (HouseOwner_Id) REFERENCES HouseOwner(HouseOwner_Id)
)";
// admin table creation....
$t3 = "CREATE TABLE IF NOT EXISTS AdminTable(
Admin_Id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
submissionNotice  INT(6)  UNSIGNED DEFAULT 0, 
AdminUserName VARCHAR (30) DEFAULT 'superAdmin12304',
AdminPassword VARCHAR (30) DEFAULT 'Admin123'
)";
// checking if the admin table and values already exit

if(mysqli_query($conn, $t1)===TRUE && mysqli_query($conn, $t2)===TRUE && mysqli_query($conn, $t3)===TRUE && mysqli_query($conn, $t4)===TRUE    ){
    $qry=$conn->query("SELECT * FROM AdminTable WHERE Admin_Id=1");
if($qry->num_rows > 0){
 echo "";
}
else{
$qry2 = $conn->query("INSERT INTO AdminTable (AdminUserName,AdminPassword) VALUES('superAdmin12304','Admin123')");
          if($qry2->num_rows > 0 ){echo "";}
}
// testing if the admin values already exist..
       }
else{
echo  " ".mysqli_error($conn);
} 
$serverName = "localhost";
$userName = "root";
$password = "";
$database="Home_management";
$conn=mysqli_connect($serverName, $userName, $password,$database);