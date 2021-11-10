<?php
if (isset($_POST["AdminCikis"])) {

  session_destroy();
  header("Location:adminLogin.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="bayiSistem/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../bayiSistem/assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Bayi Sistemi Yonetici
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="../bayiSistem/assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../bayiSistem/assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="black" data-image="../bayiSistem/assets/img/sidebar-1.jpg">
      <div class="logo">
        <div align="center">
          <a class="nav-link" href="./AdminHomePage.php">
            Bayi Sistemi
          </a>
        </div>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="./AdminHomePage.php">
              <i class="material-icons">home</i>
              <p>Anasayfa</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./OrderStatus.php">
              <i class="material-icons">local_shipping</i>
              <p>Sipariş Durumları</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./AdminProfile.php">
              <i class="material-icons">person</i>
              <p>Profil</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
          </div>
          <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="javascript:;">
                  <i class="material-icons">home</i>
                  <p class="d-lg-none d-md-block">
                    Stats
                  </p>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" href="AdminProfile.php">Profil</a>
                  <div class="dropdown-divider"></div>
                  <form action="" method="POST">
                    <input align="center" type="submit" name="AdminCikis" class="dropdown-item" value="Çıkış Yap">
                  </form>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
