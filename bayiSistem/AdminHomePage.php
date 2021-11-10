<?php   
session_start();
if(empty($_SESSION['Yid'])){
  header('location:adminLogin.php');
  exit();
}
?>
<?php
include("inc/adminHead.php");
include("database.php");
?>

<!--silinen ürünü sepetten de sil-->
<?php   
if (isset($_POST['urunSil'])) 
{
  $urunuSepettenSil="DELETE FROM sepet WHERE urunId= ".$_POST['urun_sil'];
  $baglanti->query($urunuSepettenSil);
}
?>
<!--ürünü sil-->
<?php   
if (isset($_POST['urunSil'])) 
{
  $urunSil="DELETE FROM urun WHERE id= ".$_POST['urun_sil'];
  $baglanti->query($urunSil);
}
?>
<?php

if (isset($_FILES['urun_fotografi'])) {
  $yol = "images/";
  $yuklemeYeri = __DIR__ . DIRECTORY_SEPARATOR . $yol . DIRECTORY_SEPARATOR . $_FILES["urun_fotografi"]["name"];
  $sonuc = move_uploaded_file($_FILES["urun_fotografi"]["tmp_name"], $yuklemeYeri);

}
?>
<!--Ürün ekleme-->
<?php
if (isset($_POST["urunEkle"])) {
  $urunAd = $_POST['urunAdi']; 
  $urunFotografi = $_FILES['urun_fotografi']["name"];
  $urunFiyati = $_POST['urunFiyat'];
  $urunKdv = $_POST['KdvTutari'];
  $urunKdvDahil = $_POST['KdvDahilTutari'];
  $iskonto = $_POST['iskonto'];
  $ozelKodu = $_POST['ozel_kod'];
  $kategori = $_POST['kategorisi'];
  $aciklama = $_POST['urunAciklamasi'];

  $urunekle = "INSERT INTO `urun` (`kategoriId`, `urunAdi`, `images`, `fiyatKdvHaric`, `kdvOran`, `kdvTutar`, `fiyatKdvDahil`,
  `urunAciklamasi`, `iskontoYuzde1`, `iskontoYuzde2`, `iskontoYuzde3`, `ozelkod1`, `ozelkod2`, `ozelkod3`, `birimId`, `aktif`) 
  VALUES ('$kategori', '$urunAd', '$urunFotografi', '$urunFiyati', '', '$urunKdv', '$urunKdvDahil', '$aciklama', '$iskonto', '', '', '$ozelKodu', '', '', '1', '1');";
  $ekle= $baglanti->prepare($urunekle);
  $ekle->execute();
  header("Refresh:0");
}
?>

<div class="content" style="padding-top:0px;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h1 class="card-title">Ürün Ekle</h1>
          </div>
          <div class="card-body">
            <form enctype="multipart/form-data" action="" method="POST">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Ürün Adı</label>
                    <input type="text" class="form-control" id="urunAdi" name="urunAdi" autocomplete="off" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">KDV Dahil Fiyatı</label>
                    <input type="text" class="form-control" id="KdvDahilTutari" name="KdvDahilTutari" autocomplete="off" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6" style="padding-top:8px;">
                  <label class="bmd-label-floating">Ürün Fotoğrafı</label>
                  <input type="file" name="urun_fotografi" required>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Ürün Kategorisi</label>
                    <select style="width: 170px;" name="kategorisi" id="kategorisi" required>
                      <option selected disabled hidden value="">Seçiniz</option>
                      <option value="1">Giyim</option>
                      <option value="2">Aksesuar</option>
                      <option value="3">Kozmetik</option>
                      <option value="4">Mobilya</option>
                      <option value="5">Elektronik</option>
                      <option value="6">Kırtasiye</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">KDV Hariç Ürün Fiyatı</label>
                    <input type="text" class="form-control" id="urunFiyat" name="urunFiyat" autocomplete="off" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">KDV Tutarı</label>
                    <input type="text" class="form-control" id="KdvTutari" name="KdvTutari" autocomplete="off" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Ürün Açıklaması</label>
                    <input type="text" class="form-control" id="urunAciklamasi" name="urunAciklamasi" autocomplete="off" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">İskonto</label>
                    <input type="text" class="form-control" id="iskonto" autocomplete="off" name="iskonto">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Özel Kod</label>
                    <input type="text" class="form-control" id="ozel_kod" autocomplete="off" name="ozel_kod">
                  </div>
                </div>
              </div>
              <button type="submit" name="urunEkle" id="urunEkle" class="btn btn-success pull-right" value="ekle">
                Ürünü Ekle
              </button>
            </form>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<!--ürünü sil-->
<?php  
$urunler=$baglanti->prepare("SELECT * FROM urun");
$urunler->execute();
?>
<div style="padding-top:-100px;">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header card-header-primary">
        <h1 class="card-title">Ürün Sil</h1>
      </div>
      <div>
        <table class="table">
          <thead class=" text-primary">
            <th>
              Ürün Adı
            </th>
            <th>
              Ürün Fiyatı
            </th>
            <th style="text-align: right ; padding-right: 50px;">
              Ürünü Sil
            </th>
          </thead>
          <tbody>
            <!-- while döngüsü -->
            <?php
            while($urunVeri=$urunler->fetch(PDO::FETCH_ASSOC)){
              ?>
              <tr>
                <td>
                  <?php 
                  echo $urunVeri['urunAdi'];
                  ?>
                </td>
                <td>
                  <?php 
                  echo $urunVeri['fiyatKdvDahil']." TL";
                  ?>
                </td>
                <form action="" method="post">
                  <td>
                    <input type="hidden" name="urun_sil" value="<?=$urunVeri['id']?>">
                    <button name="urunSil" id="urunSil" type="submit" class="btn btn-danger pull-right" value="urunSil">
                      Ürünü Sil
                    </button>
                  </td>
                </form>
              </tr>
              <!--while döngüsü parantez kapama -->
              <?php
            } 
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<form action="" method="POST">

</form>
<?php
include("inc/footer.php");
?>
