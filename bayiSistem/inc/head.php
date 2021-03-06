<?php   
if(!isset($_SESSION)) 
{ 
  session_start(); 
} 
?>
<?php
include("database.php");
?>
<?php
if (isset($_POST["cikis"])) {

  session_destroy();
  header("Location:login.php");
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
    Bayi Sistemi
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
  <div class="wrapper">
    <div class="sidebar" data-color="purple" data-background-color="black" data-image="../bayiSistem/assets/img/sidebar-1.jpg">
      <div class="logo">
        <div align="center">
          <a class="nav-link" href="./homePage.php">
            Bayi Sistemi
          </a>
        </div>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="./homePage.php">
              <i class="material-icons">home</i>
              <p>Anasayfa</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./profile.php">
              <i class="material-icons">person</i>
              <p>Profil</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./shoppingCart.php">
              <i class="material-icons">shopping_cart</i>
              <p>Sepet</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./orders.php">
              <i class="material-icons">shopping_basket</i>
              <p>Sipari??lerim</p>
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
            <form action="" method="POST">
              <div class="input-group no-border">
                <input type="text" value="" name="arama" class="form-control" placeholder="Arama...">
                <a href="category.php">
                  <button type="submit" name="aramaYap" class="btn btn-white btn-round btn-just-icon">
                  </a>
                  <i class="material-icons">search</i>
                  <div class="ripple-container"></div>
                </button>
              </div>
            </form>
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
                <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">notifications</i>
                  <span class="notification">5</span>
                  <p class="d-lg-none d-md-block">
                    Some Actions
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">bildirim 1</a>
                  <a class="dropdown-item" href="#">bildirim 2</a>
                  <a class="dropdown-item" href="#">bildirim 3</a>
                  <a class="dropdown-item" href="#">bildirim 4</a>
                  <a class="dropdown-item" href="#">bildirim 5</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" href="profile.php">Profil</a>
                  <div class="dropdown-divider"></div>
                  <form action="" method="POST">
                    <input align="center" type="submit" name="cikis" class="dropdown-item" value="????k???? Yap">
                  </form>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>