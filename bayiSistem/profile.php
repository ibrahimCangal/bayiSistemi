<?php   
session_start();
if(empty($_SESSION['id'])){
  header('location:login.php');
  exit();
}
?>
<?php
include("inc/head.php");
include("database.php")
?>
<!--sepet sorgusu-->
<?php

if (isset($_POST['kaydet'])) 
{
  $kullaniciAdi = $_POST['kullanici_adi']; 
  $email = $_POST['E_mail'];
  $adiSoyadi = $_POST['ad_soyad'];
  $telefonNo = $_POST['telefon'];
  $adres = $_POST['adres'];
  $Sehir = $_POST['sehir'];
  $ilce = $_POST['ilce'];
  $postaKodu = $_POST['postaKodu'];

  $kaydet="UPDATE `cari` SET `yetkiliAdSoyad` = '$adiSoyadi', `kullaniciAdi` = '$kullaniciAdi', `cepTelefon` = '$telefonNo', `mail` = '$email', `sehirAdi` = '$Sehir', `ilceAdi` = '$ilce', `postaKodu` = '$postaKodu', `adres` = '$adres' WHERE `cari`.`id` =".$_POST['kullanici_kaydet'];
  $baglanti->query($kaydet);

}
?>

<div class="content" style="padding-top:0px;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h1 class="card-title">Profilinizi Düzenleyin</h1>
          </div>
          <div class="card-body">
            <form action="" method="POST">
              <?php  
              $cari=$baglanti->prepare("SELECT * FROM cari WHERE id =".$_SESSION['id']);
              $cari->execute();
              $caribilgi=$cari->fetch(PDO::FETCH_ASSOC);
              ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Kullanıcı Adı</label>
                    <input type="text" class="form-control" id="kullaniciAdi" name="kullanici_adi" value="<?php echo $caribilgi['kullaniciAdi'];?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">E-mail</label>
                    <input type="email" class="form-control" id="Email" name="E_mail" value="<?php echo $caribilgi['mail'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Adı Soyadı</label>
                    <input type="text" class="form-control" id="adSoyad" name="ad_soyad" value="<?php echo $caribilgi['yetkiliAdSoyad'];?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Telefon Numarası</label>
                    <input type="text" class="form-control" id="telefon" name="telefon" value="<?php echo $caribilgi['cepTelefon'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Adres</label>
                    <input type="text" class="form-control" id="adres" name="adres" value="<?php echo $caribilgi['adres'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">Şehir</label>
                    <input type="text" class="form-control" id="sehir" name="sehir" value="<?php echo $caribilgi['sehirAdi'];?>">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">İlçe</label>
                    <input type="text" class="form-control" id="ilce" name="ilce" value="<?php echo $caribilgi['ilceAdi'];?>">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">Posta Kodu</label>
                    <input type="text" class="form-control" id="postaKodu" name="postaKodu" value="<?php echo $caribilgi['postaKodu'];?>">
                  </div>
                </div>
              </div>
              <input type="hidden" name="kullanici_kaydet" placeholder="kullanici_kaydet" value="<?= $caribilgi['id'] ?>">
              <button type="submit" name="kaydet" id="kaydet" class="btn btn-primary pull-right" value="kaydet">
                Profili Güncelle
              </button>
              <div class="clearfix"></div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include("inc/footer.php");
?>