<?php

include("database.php");
?>
<?php

session_start();
if (isset($_SESSION['kullaniciAdi'])) {
  header('Location:../homePage.php');
}else {

  header('Location:login.php');
  exit();
}
?>