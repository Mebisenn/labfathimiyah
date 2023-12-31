<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Forms / Elements - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../../../assets/assets/img/SMKS AL FATHIMIYAH.png" rel="icon">
  <link href="../../../assets/assets/img/SMKS AL FATHIMIYAH.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../../../assets/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../../assets/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../../../assets/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../../../assets/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../../../assets/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../../../assets/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../../../assets/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../../../assets/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Nov 17 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
<body>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="#" class="logo d-flex align-items-center">
        <img src="../../../assets/assets/img/SMKS AL FATHIMIYAH.png" alt="">
        <span class="d-none d-lg-block">LabFathimiyah</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <!-- <img src="assets/assets/img/profile-img.jpg" alt="Profile" class="rounded-circle"> -->
            <span class="d-none d-md-block ">guest</span>
          </a><!-- End Profile Iamge Icon -->

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <?php include 'sidebar.php'; ?>