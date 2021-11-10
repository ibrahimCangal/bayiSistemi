<?php
include("inc/link.php");
include("database.php");
?>
<?php
$yoneticiYeniKayit=$baglanti->prepare("SELECT * FROM yonetici");
$yoneticiYeniKayit->execute();

$YoneticiYeniUye=$yoneticiYeniKayit->fetch(PDO::FETCH_ASSOC);
if (isset($_POST["uyeOl"])) {
  $kullaniciAdi = $_POST['kullanici_adi']; 
  $adiSoyadi = $_POST['adSoyad'];
  $sifre = $_POST['sifre'];
  $vergiNo = $_POST['vergi_no'];
  $vergiDairesi = $_POST['vergi_dairesi'];
  $firmaAdi = $_POST['firma_adi'];


  $YoneticiKayitOlustur = "INSERT INTO `yonetici` (`FirmaAdi`, `vergiNo`, `vergiDairesi`, `YoneticiAdiSoyadi`, `kullaniciAdi`, `sifre`) 
  VALUES ('$firmaAdi', '$vergiNo', '$vergiDairesi', '$adiSoyadi', '$kullaniciAdi', '$sifre')";
  $olustur= $baglanti->prepare($YoneticiKayitOlustur);
  $olustur->execute();

  header("location:adminLogin.php");
}
?>

<div class="content" style="padding-top: 100px;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h1 class="card-title">Yönetici Olarak Üye Ol</h1>
          </div>
          <div class="card-body">
            <form action="" method="POST">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Kullanıcı Adı</label>
                    <input type="text" class="form-control" id="kullaniciAdi" name="kullanici_adi" autocomplete="off" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Ad Soyad</label>
                    <input type="text" class="form-control" id="adSoyad" name="adSoyad" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Şifre</label>
                    <input type="password" class="form-control" id="sifre" name="sifre" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Şifreyi Tekrar Girin</label>
                    <input type="password" class="form-control" id="sifreKontrol" name="sifreKontrol" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Vergi Kimlik No</label>
                    <input type="text" class="form-control" id="vergi_no" name="vergi_no" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Vergi Dairesi</label>
                    <input type="text" class="form-control" id="vergi_dairesi" name="vergi_dairesi" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Firma Adı</label>
                    <input type="text" class="form-control" id="firma_adi" name="firma_adi" required>
                  </div>
                </div>
              </div>
              <input type="hidden" name="uye_ol"value="">
              <button type="submit" name="uyeOl" id="uyeOl" class="btn btn-primary pull-right" value="uye">
                Üye Ol
              </button>
            </form>
            <a href="login.php">
              <button type="submit" name="girisYap" id="girisYap" class="btn btn-warning pull-right" value="geri">
                Giriş Yap
              </button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
