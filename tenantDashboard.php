<?php
 session_start();
 include "server/connect.php";
 $broadcastedMessage=$tenantHouseNumber="";
 $tenantFullname=$_SESSION["userName"];
 $tenantEmail=$_SESSION["Email"];
 $HouseOwner_Id=$_SESSION["HouseOwner_Id"];
$houseOwnerNumber=$row["broadCastedMessage"];

  $sql = $conn->query("SELECT * FROM TenantTb WHERE Email='$tenantEmail'");
         if($sql){
              while($row =$sql->fetch_assoc()){
                    $broadcastedMessage = $row["broadCastedMessage"];
                    $tenantHouseNumber=$row["House_number"];
                    $paidDate=$row["paidDate"];
                    $expiryDate=$row["expiryDate"];}
                }
    $sql2 = $conn->query("SELECT HouseOwner.HouseOwner_Id,houseTable.HouseOwner_Id,HouseOwner.phone,houseTable.price FROM HouseOwner, houseTable 
    WHERE HouseOwner.HouseOwner_Id='$HouseOwner_Id' AND HouseOwner.HouseOwner_Id=houseTable.HouseOwner_Id");
         if($sql2){
              while($row =$sql2->fetch_assoc()){
                    $phone = $row["phone"];
                    $price=$row["price"];}
                }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
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
          <a class="nav-link text-white active bg-gradient-primary" href="tenantDashboard.php">
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
          <a class="nav-link text-white " href="makeRequest.php">
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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><?php echo  $tenantFullname?></li>
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
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Tenant Dashboard</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tenant Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">House No</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Price</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Paid Date</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Expiry Date</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">House Owner Number</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <p class="text-xs text-secondary mb-0"><?php echo $tenantFullname?></p>
                      </td>
                      <td>
                        <p class="text-xs text-secondary mb-0"><?php echo $tenantEmail?></p>
                      </td>
                      <td>
                        <p class="text-xs text-secondary mb-0"><?php echo $tenantHouseNumber?></p>
                      </td>
                      <td class="align-middle">
                       <p class="text-xs text-secondary mb-0"><?php echo $price?></p>
                      </td>
                      <td class="align-middle text-center">
                        <p class="text-xs text-secondary mb-0"><?php echo $paidDate?></p>
                      </td>
                       <td class="align-middle text-center">
                        <p class="text-xs text-secondary mb-0"><?php echo $expiryDate?></p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-success"><?php echo $phone?></span>
                      </td>
                      
                    </tr>
                    
                   
                  </tbody>
                </table>
                <p class="align-middle text-center" style="color:red;margin-top:50px"><?php echo $broadcastedMessage?></p>
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