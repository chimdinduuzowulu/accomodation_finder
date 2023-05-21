<?php
session_start();
include "server/connect.php";
 $tenant=$_SESSION["userName"];
  $HouseOwner_Id=$_SESSION["HouseOwner_Id"];
$stateSearch = '';
if(isset($_POST["submit"])) {
$stateSearch = $_POST["stateSearch"];

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
  <link rel="stylesheet" type="text/css"
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
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
  <aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main">

    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white " href="tenantDashboard.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <!--  -->
        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="otherHouses.php">
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
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
      navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Welcome</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><?php echo  $tenant?></li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Dashboard</h6>
        </nav>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-6">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">View Houses</h6>

              </div>
              <form action="" method="post">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center mt-6" style="width: 60%;">
                  <div class="input-group input-group-outline" style="width: 80%; margin-right: 12px;">
                    <label class="form-label"></label>
                    <input type="text" class="form-control" name="stateSearch" placeholder="Search by state...">
                  </div>
                  <!--  -->
                  <div class="input-group input-group-outline" style="width: 20%;">
                    <input type="submit" class="form-control" value="Search"
                      style="background-color:#e12d6c; color: white;" name="submit">
                  </div>
                </div>
              </form>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <div class="card-body"
                  style="display: flex; flex-wrap:wrap; justify-content:center; align-items:center;">
                  <?php
                  if($stateSearch === ''){
                  $query = $conn->query("SELECT imageNumCount,House_Id,image_name,houseTitle,paymentType,houseDescription,HouseOwner_Id,price,houseAddress,houseStateAddress,trackID FROM `houseTable` 
                     WHERE imageNumCount = '1'");
                         if($query->num_rows > 0){
                       $flag=True;
                       while($row = $query->fetch_assoc()){
                            $imageURL = 'houses/'.$row["image_name"];
                            $houseTitle= $row["houseTitle"];
                            $houseDescription= $row["houseDescription"];
                            $houseTitle= $row["houseTitle"];
                            $housePrice= $row["price"];
                            $fullAddress = $row["houseStateAddress"] .' '. $row["houseAddress"];                            
                            $paymentType = $row["paymentType"];
                            $HouseOwner_Id= $row["HouseOwner_Id"];
                            $HouseID= $row["House_Id"];
                            $trackID= $row["trackID"];
                            $_SESSION["images"]=$imageURL;
              ?>
                  <div class="card" style="width: 31%; margin: 4px;">
                    <img src="<?php  echo $imageURL?>" class="card-img-top" alt="..." style="width:100%; height:300px;">
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $houseTitle?></h5>
                      <p class="card-text"><?php echo $houseDescription?>.</p>
                      <p class="card-text">N <?php echo (0 + $housePrice)?> <span><?php echo $paymentType?> </span>
                      </p>
                      <p class="card-text" style="font-weight:bold;"><?php echo $fullAddress?>.</p>
                      <a href="houseDetails.php?ownerId=<?php echo $HouseOwner_Id ?>&HouseID=<?php echo $HouseID ?>&trackID=<?php echo $trackID ?>"
                        class="btn btn-primary">View House</a>
                    </div>
                  </div>
                  <?php }}

                  }
                  else{
                   $query = $conn->query("SELECT imageNumCount,House_Id,image_name,houseTitle,paymentType,houseDescription,HouseOwner_Id,price,houseStateAddress,houseAddress,trackID FROM `houseTable` 
                     WHERE houseStateAddress = '$stateSearch' AND imageNumCount= '1'");
                         if($query->num_rows > 0){
                       $flag=True;
                       while($row = $query->fetch_assoc()){
                            $imageURL = 'houses/'.$row["image_name"];
                            $houseTitle= $row["houseTitle"];
                            $houseDescription= $row["houseDescription"];
                            $houseTitle= $row["houseTitle"];
                            $housePrice= $row["price"];
                            $fullAddress = $row["houseStateAddress"] .' '. $row["houseAddress"];
                            $paymentType = $row["paymentType"];
                            $HouseOwner_Id= $row["HouseOwner_Id"];
                            $HouseID= $row["House_Id"];
                            $trackID= $row["trackID"];
                            $_SESSION["images"]=$imageURL;
                          ?>
                  <div class="card" style="width: 31%; margin: 4px;">
                    <img src="<?php  echo $imageURL?>" class="card-img-top" alt="..." style="width:100%; height:300px;">
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $houseTitle?></h5>
                      <p class="card-text"><?php echo $houseDescription?>.</p>
                      <p class="card-text">N <?php echo (0 + $housePrice)?> <span><?php echo $paymentType?> </span>
                      </p>
                      <p class="card-text" style="font-weight:bold;"><?php echo $fullAddress?>.</p>
                      <a href="houseDetails.php?ownerId=<?php echo $HouseOwner_Id ?>&HouseID=<?php echo $HouseID ?>&trackID=<?php echo $trackID ?>"
                        class="btn btn-primary">View House</a>
                    </div>
                  </div>
                  <?php }}
                  }
?>
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