<?php
session_start();
$tenant=$_SESSION["userName"];
$tenantEmail=$_SESSION["tenantEmail"];
include "server/connect.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once 'vendor2/autoload.php'; 

$emailSucess="";
$supervisorEmail=$_SESSION["supervisorEmail"];
$EmailBody=$emailSubject="";
$flag=false;
if(isset($_POST["submit"])){
$emailSubject=$_POST["emailSubject"];
$EmailBody=$_POST["EmailBody"];
$HouseOwner_Email=$_POST["houserOwnerEmail"];
// ..................
$mail = new PHPMailer;
$mail->SMTPDebug = 0;
$mail->isSMTP(); 
$mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
$mail->Port = 587; // TLS only
$mail->SMTPSecure =PHPMailer::ENCRYPTION_STARTTLS; ; // ssl is deprecated
$mail->SMTPAuth = true;
$mail->Username = 'chimdindu73@gmail.com'; // email
$mail->Password = 'Chimdindu.73.09030428141.'; // password
$mail->setFrom($tenantEmail ,$tenant); // From email and name
$mail->addAddress($HouseOwner_Email, "House Owner"); // to email and name
$mail->isHTML(true);
$mail->Subject = "$emailSubject";
$mail->Body='<p align=center font-family=fantasy;line-height=45.8px;>  ' .$EmailBody.'<br> From'. $tenantEmail.'</p>';
// $mail->msgHTML("Signup Happened"); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
$mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
if(!$mail->send()){
    $emailSucess= "Message Not Sent!";
}else{
   $emailSucess="message sent!";  
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">  
  <title>House Renting Management System</title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="houseOwner/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="houseOwner/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="houseOwner/assets/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-200">
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">

    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white" href="tenantDashboard.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <!--  -->
        <li class="nav-item">
          <a class="nav-link text-white " href="otherHouses.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">house</i>
            </div>
            <span class="nav-link-text ms-1">See other houses</span>
          </a>
        </li>
         <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="makeRequest.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">message</i>
            </div>
            <span class="nav-link-text ms-1">Make a request</span>
          </a>
        </li>
     
         <li class="nav-item">
          <a class="nav-link text-white " href="logout.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">logout</i>
            </div>
            <span class="nav-link-text ms-1">Log Out</span>
          </a>
        </li>    
      </ul>
    </div>
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Welcome</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><?php echo  $tenant?></li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Dashboard</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline">
              <label class="form-label">Type here...</label>
              <input type="text" class="form-control">
            </div>
          </div>
      
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
       <div class="container-fluid py-4">
      
        <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Send an Email Request To House Owner</h4>
                  <div class="row mt-3">                
                  </div>
                </div>
              </div>
              <div class="card-body">
                <form role="form" class="text-start" method="POST">
                  <div class="input-group input-group-outline my-3">
                    <label class="form-label"></label>
                    <input type="text" class="form-control" name="emailSubject" placeholder="Request Subject">
                  </div>  
                  <div class="input-group input-group-outline my-3">
                    <label class="form-label"></label>
                    <input type="email" class="form-control" name="houserOwnerEmail" placeholder="House Ower Email">
                  </div>  
                  <div class="input-group input-group-outline my-3">
                    <label class="form-label"></label>
                    <input type="text" class="form-control" name="EmailBody" placeholder="Email Body">
                  </div>    
                  <div class="text-center">
                    <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2" name="submit">Send</button>
                  </div>
                </form>
                <p class="text-center"><?php echo $emailSucess?></p>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
     
    </div>
  </main>

  <!--   Core JS Files   -->
  <script src="Supervisor/assets/js/core/popper.min.js"></script>
  <script src="Supervisor/assets/js/core/bootstrap.min.js"></script>
  <script src="Supervisor/assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="Supervisor/assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="Supervisor/assets/js/plugins/chartjs.min.js"></script>
  
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.0.0"></script>
</body>
</html>