<?php
error_reporting (E_ALL ^ E_NOTICE);
  include "../server/connect.php";
  session_start();
  $emailId=$_SESSION["email"];
  $uploaderName=$_SESSION["fullname"];
  $HouseOwner_Id=$_SESSION["HouseOwner_Id"];
  $trackID = rand();
  // Create connection
  $conn = mysqli_connect($serverName, $userName, $password,$database);
// Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }
$total=0;
$targetDir = "../houses/";
$statusMsg=$successMessage="";
$uploadOk = 1;
$success = false;
$allowTypes = array('jpg','png','jpeg','gif'); 
if(isset($_POST["submit"])) {
$houseStateAddress=$_POST["houseStateAddress"]; 
  $Tittle=$_POST["Tittle"];
  $Price=$_POST["Price"]; 
  $Description=$_POST["Description"];
  $Payment=$_POST["Payment"];
  $Address=$_POST["Address"]; 

   $imageNumCount=1;
   foreach($_FILES['files']['name'] as $key=>$val){ 
     $fileName = basename($_FILES['files']['name'][$key]); 
     $targetFilePath = $targetDir . $fileName; 
     $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
     if(in_array($fileType,$allowTypes))
     { 
         if(move_uploaded_file($_FILES["files"]["tmp_name"][$key],$targetFilePath)){ 
         $count="";
         $sqlqr = $conn->query("SELECT MAX(imageNumCount) AS totalUploads FROM houseTable
         WHERE HouseOwner_Id='$HouseOwner_Id'");
         if ($sqlqr) {
             while($row =$sqlqr->fetch_assoc()) {
             $total=$row["totalUploads"];
             $total=intval($total); 
               }
           }
           $insertValuesSQL .= "('".$Tittle."','".$Description."','".$Payment."','".$Price."','".$Address."','".$houseStateAddress."','".$fileName."','".$imageNumCount."','".$HouseOwner_Id."','".$trackID."',NOW()),";
           $imageNumCount++;
         }else{$statusMsg= "Sorry, your file was not uploaded.".$_FILES['files']['name'][$key].' | ';} 
          }else{$statusMsg= "only png,jpeg,gif file types allowed!";}
     }
      //  ......
       if(!empty($insertValuesSQL)){ 
            $insertValuesSQL = trim($insertValuesSQL, ','); 
               $insert = $conn->query("INSERT INTO houseTable (houseTitle,houseDescription,paymentType,price,houseAddress,houseStateAddress,image_name,imageNumCount,HouseOwner_Id,trackID,uploaded_on) VALUES $insertValuesSQL"); 
              if($insert){ 
              $image_countIncrement=0;
              $uploadCount=$total+1;
              $updateQuery=$conn->query("UPDATE HouseOwner
                SET uploadCount ='$uploadCount'
                WHERE HouseOwner_Id= '$HouseOwner_Id'");
                // $returnResult= mysqli_query($conn,$updateQuery);
                if($updateQuery){
                }else{$SaveMessage="Slight Error occured: **";} 
                $statusMsg = "Files are uploaded successfully.".$errorMsg; 
                $success = true;
            }else{$statusMsg = "Sorry, there was an error uploading your file."; }
      }
}
if($success){header("Refresh:0");}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <title>House Management System</title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css"
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
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
  <aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main">

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
          <a class="nav-link text-white active bg-gradient-primary" href="publish.php">
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
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
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
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Sign In</span>
              </a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="" class="nav-link text-body p-0" id="iconNavbarSidenav">
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
              <a href="" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="fa fa-bell cursor-pointer"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">

      <div class="page-header align-items-start min-vh-100"
        style="background-image: url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container my-auto">
          <div class="row">
            <div class="col-lg-4 col-md-8 col-12 mx-auto">
              <div class="card z-index-0 fadeIn3 fadeInBottom">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                  <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                    <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Publish House</h4>
                    <div class="row mt-3">

                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <form role="form" class="text-start" method="POST" enctype="multipart/form-data">
                    <div class="input-group input-group-outline my-3">
                      <label class="form-label"></label>
                      <input type="text" class="form-control" name="Tittle" placeholder="Type of house">
                    </div>
                    <div class="input-group input-group-outline my-3">
                      <label class="form-label"></label>
                      <input type="text" class="form-control" name="Description" placeholder="House Description">
                    </div>
                    <!-- address -->
                    <div class="input-group input-group-outline my-3">
                      <label class="form-label"></label>
                      <input type="text" class="form-control" name="houseStateAddress" placeholder="State">
                    </div>
                    <div class=" input-group input-group-outline my-3">
                      <label class="form-label"></label>
                      <input type="text" class="form-control" name="Address"
                        placeholder="City and town address Location Address">
                    </div>
                    <!-- address -->
                    <div class="input-group input-group-outline my-3">
                      <label class="form-label"></label>
                      <input type="number" class="form-control" name="Price" placeholder="Price">
                    </div>
                    <div class="form-control">
                      <select name="Payment" class="form-label" style="width:90%;padding:20px">
                        <option class="form-control" value=""> Payment Type</option>
                        <option class="form-control" value="Per annum"> per annum</option>
                        <option class="form-control" value="Monthly">Monthly</option>

                      </select class="form-control">
                      <!-- <input type="email" class="form-control"> -->
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <input type="file" class="form-control" name="files[]" multiple>
                    </div>
                    <div class="text-center">
                      <button type="submit" name="submit"
                        class="btn bg-gradient-primary w-100 my-4 mb-2">Publish</button>
                    </div>
                  </form>
                  <div class="text-center">
                    <p><?php echo $statusMsg?></p>
                  </div>
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
