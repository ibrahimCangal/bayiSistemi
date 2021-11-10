<?php
session_start();
?>
<?php
include("inc/link.php");
include("database.php");
?>
<?php  
if (isset($_POST["yonetici_giris"])) {
  header("location:adminLogin.php");
}
?>
<?php  

if (isset($_POST["yeni_kayit"])) {
  header("location:sign_up.php");
}
?>

<?php 
if (isset($_POST["giris"])) {

  $kullanici_adi = $_POST['KullaniciAdi']; 
  $sifre_gir = $_POST['Sifre'];

  $girisYap=$baglanti->prepare("SELECT cari.id as cari_id, cari.yetkiliAdSoyad, cari.kullaniciAdi, cari.sifre, cari.cepTelefon, 
    cari.mail, cari.sehirAdi, cari.ilceAdi, cari.postaKodu, cari.adres FROM cari WHERE kullaniciAdi = '$kullanici_adi' AND sifre = '$sifre_gir' ");
  $girisYap->execute();
  $girisKontrol=$girisYap->fetch(PDO::FETCH_ASSOC);
  if($girisKontrol)
  {
    $_SESSION["id"] = $girisKontrol['cari_id'];
    $_SESSION["kullaniciAdi"] = $kullanici_adi;
    $_SESSION["sifre"] = $sifre_gir;

    header("Location:homePage.php");
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
          <div class="card-header card-header-primary">
            <h1 class="card-title">Giriş Yap</h1>
          </div>
          <form action="" method="POST">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Kullanıcı Adı</label>
                    <input type="text" class="form-control" id="KullaniciAdi" name="KullaniciAdi" autocomplete="off" value="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Şifre</label>
                    <input type="password" class="form-control" id="Sifre" name="Sifre" value="">
                  </div>
                </div>
              </div>
              <button type="submit" name="yonetici_giris" class="btn btn-warning pull-left" value="yonetici">
                Yönetici Girişi
              </button>
              <input type="hidden" name="giris_yap" value="">
              <button type="submit" name="giris" id="giris" class="btn btn-primary pull-right" value="girisYap">
                Giriş Yap
              </button>
              <a href="sign_up.php">
                <button type="submit" name="yeni_kayit" id="yeni_kayit" class="btn btn-success pull-right" value="yeni">
                  Üye Ol
                </button>
              </a>
            </form>
