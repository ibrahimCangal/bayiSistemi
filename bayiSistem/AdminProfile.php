<?php   
session_start();
if(empty($_SESSION['Yid'])){
  header('location:login.php');
  exit();
}
?>
<?php
include("inc/adminHead.php");
include("database.php")
?>
<!--sepet sorgusu-->
<?php

if (isset($_POST['adminKaydet'])) 
{
  $kullaniciAdi = $_POST['kullanici_adi']; 
  $adiSoyadi = $_POST['adSoyad'];
  $sifre = $_POST['sifre'];
  $vergiNo = $_POST['vergi_no'];
  $vergiDairesi = $_POST['vergi_dairesi'];
  $firmaAdi = $_POST['firma_adi'];

  $kaydet="UPDATE `yonetici` SET `FirmaAdi` = '$firmaAdi', `vergiNo` = '$vergiNo', `vergiDairesi` = '$vergiDairesi', 
  `YoneticiAdiSoyadi` = '$adiSoyadi', 
  `kullaniciAdi` = '$kullaniciAdi', `sifre` = '$sifre' WHERE `yonetici`.`id` = ".$_POST['yonetici_kaydet'];
  $baglanti->query($kaydet);

}
?>

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h1 class="card-title">Profil</h1>
          </div>
          <div class="card-body">
            <form action="" method="POST">
              <?php  
              $yonetici=$baglanti->prepare("SELECT * FROM yonetici WHERE id =".$_SESSION['Yid']);
              $yonetici->execute();
              $yoneticibilgi=$yonetici->fetch(PDO::FETCH_ASSOC);
              ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Kullanıcı Adı</label>
                    <input type="text" class="form-control" id="kullaniciAdi" name="kullanici_adi" 
                    value="<?php echo $yoneticibilgi['kullaniciAdi'];?>" autocomplete="off" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Ad Soyad</label>
                    <input type="text" class="form-control" id="adSoyad" name="adSoyad" 
                    value="<?php echo $yoneticibilgi['YoneticiAdiSoyadi'];?>" required>
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
                    <input type="text" class="form-control" id="vergi_no" name="vergi_no" 
                    value="<?php echo $yoneticibilgi['vergiNo'];?>" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Vergi Dairesi</label>
                    <input type="text" class="form-control" id="vergi_dairesi" name="vergi_dairesi" 
                    value="<?php echo $yoneticibilgi['vergiDairesi'];?>" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Firma Adı</label>
                    <input type="text" class="form-control" id="firma_adi" name="firma_adi" 
                    value="<?php echo $yoneticibilgi['FirmaAdi'];?>" required>
                  </div>
                </div>
              </div>
              <input type="hidden" name="yonetici_kaydet" placeholder="yonetici_kaydet" value="<?= $yoneticibilgi['id'] ?>">
              <button type="submit" name="adminKaydet" id="kaydet" class="btn btn-primary pull-right" value="kaydet">
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