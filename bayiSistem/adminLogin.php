<?php
session_start();
?>
<?php
include("inc/link.php");
include("database.php");
?>
<?php  
if (isset($_POST["Adminyeni_kayit"])) {
  header("location:AdminSignUp.php");
}
?>
<?php  
if (isset($_POST["kullanici_giris"])) {
  header("location:login.php");
}
?>

<?php 
if (isset($_POST["Ygiris"])) {

  $adminKullaniciAdi = $_POST['yonetici_kullaniciAdi']; 
  $adminSifre = $_POST['yonetici_sifre'];

  $yoneticiGirisYap=$baglanti->prepare("SELECT * FROM yonetici WHERE kullaniciAdi = '$adminKullaniciAdi' AND sifre = '$adminSifre' ");
  $yoneticiGirisYap->execute();
  $YgirisKontrol=$yoneticiGirisYap->fetch(PDO::FETCH_ASSOC);
  if($YgirisKontrol)
  {
    $_SESSION["Yid"] = $YgirisKontrol['id'];
    $_SESSION["kullaniciAdi"] = $kullanici_adi;
    $_SESSION["sifre"] = $sifre_gir;

    header("Location:AdminHomePage.php");
  }
  else{
    echo "Şifre veya Kullanıcı Adı Hatalı! Tekrar deneyin";
  }
}

?>

<div style="text-align: center; padding-top: 75px; padding-bottom: 50px;">
  <h1>Hoşgeldiniz</h1>
</div>
<div class="content" >
  <div class="container-fluid" style="padding-left: 375px;">
    <div class="row" style="text-align:center;">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header card-header-warning">
            <h1 class="card-title">Yönetici Olarak Giriş Yap</h1>
          </div>
          <form action="" method="POST">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Kullanıcı Adı</label>
                    <input type="text" class="form-control" name="yonetici_kullaniciAdi" autocomplete="off" value="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Şifre</label>
                    <input type="password" class="form-control" name="yonetici_sifre" value="">
                  </div>
                </div>
              </div>
              <button type="submit" name="kullanici_giris" class="btn btn-primary pull-left" value="kullanici">
                Kullanıcı Girişi
              </button>
              <input type="hidden" name="giris_yap" value="">
              <button type="submit" name="Ygiris" class="btn btn-warning pull-right" value="girisYap">
                Giriş Yap
              </button>
              <button type="submit" name="Adminyeni_kayit" class="btn btn-success pull-right" value="yeni">
                Üye Ol
              </button>
            </form>
