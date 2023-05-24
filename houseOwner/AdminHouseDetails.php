<?php
session_start();
include "../server/connect.php";
 $client=$_SESSION["userName"];
$HouseOwner_Id=$_GET['ownerId'];
$trackID=$_GET['trackID'];
$HouseID=$_GET['HouseID'];
$houseOwnerName =$houseOwnerEmail = $houseOwnerPhone = "";              
$query2 = $conn->query("SELECT * FROM `HouseOwner` WHERE HouseOwner_Id='$HouseOwner_Id'");
  if($query2->num_rows > 0) {
         while($row = $query2->fetch_assoc()){
              $houseOwnerName =$row["FName"] . ' ' . $row["LName"] ;
              $houseOwnerEmail= $row["Email"];
              $houseOwnerPhone= $row["phone"];
         }
      }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
  HOUSE RENTING MANAGEMENT SYSTEM
  </title>
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
          <a class="nav-link text-white active bg-gradient-primary" href="dashboard.php">
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
          <a class="nav-link text-white " href="manageTenants.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">people</i>
            </div>
            <span class="nav-link-text ms-1">Manage Tenants</span>
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
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
      navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Welcome</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><?php echo  $client?></li>
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
          <div class="card my-6">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">House Detail</h6>
              </div>
            </div>
<!-- slider -->
<div class="container" style="margin-top:20px;">
		<div class="row">
			<div class="col-md-12">
				<div id="myCarousel" class="carousel slide" data-ride="carousel">
					<!-- Wrapper for slides -->
					<div class="carousel-inner">
						<?php

                $querySlider = $conn->query("SELECT * FROM `houseTable` WHERE HouseOwner_Id='$HouseOwner_Id' AND trackID='$trackID'");
                      if($querySlider->num_rows > 0) {
                      $i = 0;
                      $active = ($i == 0) ? "active" : "";
								      echo '<div class="carousel-item '.$active.'" style="width:100%; height:auto; display:flex; justify:center; align-items:center; flex-wrap: wrap; gap:19px;">';
                       while($row = $querySlider->fetch_assoc()){
                        $imageURL = '../houses/'.$row["image_name"];  
								        echo '<img src="'.$imageURL.'" alt="Image '.$i.'" style="width:31%; height:400px;">';
							$i++;
							}}
              echo '</div>';
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
    <!-- End of slider  -->
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <div class="card-body">
                  <?php
                $query = $conn->query("SELECT * FROM `houseTable` WHERE HouseOwner_Id='$HouseOwner_Id' AND 
                      imageNumCount=1 AND House_Id='$HouseID'");
                      if($query->num_rows > 0) {
                       $flag=True;
                       while($row = $query->fetch_assoc()){
                            $imageURL = '../houses/'.$row["image_name"];
                            $houseTitle= $row["houseTitle"];
                            $houseDescription= $row["houseDescription"];
                            $houseTitle= $row["houseTitle"];
                            $housePrice= $row["price"];
                            $houseStateAddress= $row["houseStateAddress"];
                            $houseAddress = $row["houseAddress"].' '. $houseStateAddress;
                            $HouseOwner_Id= $row["HouseOwner_Id"];
                            $_SESSION["images"]=$imageURL;
              ?>
                  <div class=""
                    style="width:100%;height:70%; margin: 2px; display:flex; justify-content:center; align-items:center;">
                    <div class="width:20%; height:inherit;">
                      <img src="<?php  echo $imageURL?>" class="card-img-top" alt="..."
                        style="width:100%; height:inherit">
                    </div>
                    <div class="card-body" style="height:100%; width:60%;padding-left:22px; margin:12px;">
                      <h5 class="card-title"><?php echo $houseTitle?></h5>
                      <p class="card-text"><?php echo $houseDescription?>.</p>
                      <p class="card-text" style="font-weight:bold"><span
                          style="font-weight:bold;margin-right: 24px">Price:</span> N <?php echo (0 + $housePrice)?> "
                        "<span>N <?php echo $paymentType?></span></p>
                      <p class="card-text" style="font-weight:bold;"><span
                          style="font-weight:bold;margin-right: 24px">Location:</span> <?php echo $houseAddress?>.</p>
                      <p class="card-text"><span style="font-weight:bold;margin-right: 24px">Uploaded By:</span>
                        <?php echo $houseOwnerName?></p>
                      <p class="card-text"><span style="font-weight:bold;margin-right: 24px">To Buy call:</span>
                        <?php echo $houseOwnerPhone?></p>
                      <p class="card-text"><span style="font-weight:bold;margin-right: 24px">To Email:</span>
                        <?php echo $houseOwnerEmail?></p>
                    </div>
                  </div>
                  <?php }}?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </main>

  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  
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
