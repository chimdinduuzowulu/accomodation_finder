<?php
// error_reporting (E_ALL ^ E_NOTICE); 
session_start();
$HouseOwner_Id=$_SESSION["HouseOwner_Id"];
$tenantEmail=$_GET["tenantEmail"];
include "../server/connect.php";
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$UsedEmail =$message="";
        $edit= $conn->query("SELECT * FROM TenantTb WHERE Email='$tenantEmail' AND HouseOwner_Id='$HouseOwner_Id'");
          if($edit){
           while($row =$edit->fetch_assoc()) {
                $H_no=$row["House_number"];
                $Fname=$row["FName"];
                $Email=$row["Email"];
                $Lname=$row["LName"];
                $phone=$row["phone"];
                $password=$row["passW"];
                $password_retype=$row["confirmPassW"];
                 } 
            }
            else{echo "wow";}

if(isset($_POST["submit"]))
{
  $fname = $_POST["Fname"];
  $lname = $_POST["Lname"];
  $H_no = $_POST["H_no"];
  $Email = $_POST["email"];
  $phone = $_POST["phone"];

      
        $update = "UPDATE TenantTb SET FName='$fname',LName='$lname',Email='$Email',HouseOwner_Id='$HouseOwner_Id',House_number='$H_no',phone='$phone' WHERE Email ='$Email'";
          $f=mysqli_query($conn, $update);
          if($f){$message="Tenant updated succesfully";
          }
          else{
          $message="Tenant not Updated";
          }
}
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>House Renting Management System</title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-200">
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">

    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white " href="dashboard.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <!--  -->
        <li class="nav-item">
          <a class="nav-link text-white " href="publish.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">pulish house</span>
          </a>
        </li>
      
        <li class="nav-item">
          <a class="nav-link text-white " href="manageHouses.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">house</i>
            </div>
            <span class="nav-link-text ms-1">Manage Houses</span>
          </a>
        </li>
         <li class="nav-item">
          <a class="nav-link text-white " href="addTenants.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">person</i>
            </div>
            <span class="nav-link-text ms-1">Add Tenants</span>
          </a>
        </li>
         <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="manageTenants.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">people</i>
            </div>
            <span class="nav-link-text ms-1">Manage Tenant</span>
          </a>
        </li>
         <li class="nav-item">
          <a class="nav-link text-white " href="broadCastMessages.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">message</i>
            </div>
            <span class="nav-link-text ms-1">Broadcast Message</span>
          </a>
        </li>
         <li class="nav-item">
          <a class="nav-link text-white " href="../logout.php">
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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><?php echo $superVName?></li>
          </ol>
          <h6 class="font-weight-bolder mb-0"></h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
        
          <ul class="navbar-nav  justify-content-end">
            
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
              </a>
            </li>
            <li class="nav-item dropdown pe-2 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-bell cursor-pointer"></i>
              </a>
              <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                      </div>
                
                    </div>
                  </a>
                </li>
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="../assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm bg-gradient-dark  me-3 ">
                      </div>
                 
                    </div>
                  </a>
                </li>
                <li>
   
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
     <!-- End Navbar -->
    <div class="container-fluid py-4">
      
               <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-4 col-md- col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Edit Tenant</h4>
                 
                </div>
              </div> 
              <div class="card-body ">
                <form role="form" class="text-start" method="POST" enctype="multipart/form-data">
                <label class="form-label"></label>
                <div class="input-group input-group-outline my-3">
                    <input type="text" class="form-control" name="H_no" value="<?php echo $H_no?>" placeholder="House Number">
                  </div>
                  <label class=""></label>
                  <div class="input-group input-group-outline my-3">
                    <input type="text" class="form-control" name="Fname" value="<?php echo $Fname?>" placeholder="First Name">
                  </div>
                  <label class=""></label>
                  <div class="input-group input-group-outline my-3">
                    <input type="text" class="form-control" name="Lname" value="<?php echo $Lname?>" placeholder="Last Name">
                  </div>
                  <label class="form-label"></label>
                  <div class="input-group input-group-outline my-3">
                    <input type="text" class="form-control" name="email" value="<?php echo $Email?>" placeholder="Email">
                  </div>
                  <label class="form-label"></label>
                  <div class="input-group input-group-outline my-3">
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone?>" placeholder="Phone">
                  </div>
                 
                  <div class="text-center">
                    <button type="submit" name="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Update</button>
                  </div>
                </form>
                <div class="text-center">
                    <p><?php echo $message?></p>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    </div>
  </main>
  
  </div>
  
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.0.0"></script>
</body>

</html>