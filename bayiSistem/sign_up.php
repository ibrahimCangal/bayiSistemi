<?php
include("inc/link.php");
include("database.php");
?>
<?php
$yeniKayit=$baglanti->prepare("SELECT * FROM cari ORDER BY id DESC");
$yeniKayit->execute();

$yeniUye=$yeniKayit->fetch(PDO::FETCH_ASSOC);
  if (isset($_POST["uyeOl"])) {
    $kullaniciAdi = $_POST['kullanici_adi']; 
    $email = $_POST['E_mail'];
    $adiSoyadi = $_POST['ad_soyad'];
    $telefonNo = $_POST['telefon'];
    $sifre = $_POST['sifre'];
    $adres = $_POST['adres'];
    $sehir = $_POST['sehir'];
    $ilce = $_POST['ilce'];
    $postaKodu = $_POST['postaKodu'];

    $kayitOlustur = "INSERT INTO `cari` ( `cariAdi`, `yetkiliAdSoyad`, `kullaniciAdi`, `sifre`, `vergiDairesi`, `vergiNo`, `telefon`, `cepTelefon`, `mail`, `sehirAdi`, `ilceAdi`, `postaKodu`, `adres`, `aktif`) VALUES ( 'mobius', '$adiSoyadi', '$kullaniciAdi', '$sifre', '', '', '', '$telefonNo', '$email', '$sehir', '$ilce', '$postaKodu', '$adres', '1');)";
    $olustur= $baglanti->prepare($kayitOlustur);
    $olustur->execute();
    
    header("location:login.php");
  }
?>

<div class="content" style="padding-top: 100px;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h1 class="card-title">Üye Ol</h1>
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
                    <label class="bmd-label-floating">E-mail</label>
                    <input type="email" class="form-control" id="Email" name="E_mail" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Adı Soyadı</label>
                    <input type="text" class="form-control" id="adSoyad" name="ad_soyad" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Telefon Numarası</label>
                    <input type="text" class="form-control" id="telefon" name="telefon" required>
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
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Adres</label>
                    <input type="text" class="form-control" id="adres" name="adres" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">Şehir</label>
                    <input type="text" class="form-control" id="sehir" name="sehir" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">İlçe</label>
                    <input type="text" class="form-control" id="ilce" name="ilce" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">Posta Kodu</label>
                    <input type="text" class="form-control" id="postaKodu" name="postaKodu" required>
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
