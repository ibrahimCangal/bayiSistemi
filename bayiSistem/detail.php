<?php
session_start();
ob_start();
if(empty($_SESSION['id'])){
  header('location:login.php');
  exit();
}
?>
<?php
include("inc/head.php");
include("database.php");
?>

<?php

$urun=$baglanti->prepare("SELECT * FROM urun  WHERE id = '".$_GET['uid']."' ");
$urun->execute();

$urunbilgi=$urun->fetch(PDO::FETCH_ASSOC);
?>

<?php
$caritablo=$baglanti->prepare("SELECT * FROM cari ");
$caritablo->execute();
$cariId=$caritablo->fetch(PDO::FETCH_ASSOC);
?>
<!--ürünü kontrol etme ve sepete ekleme -->
<?php

$sepetKontrol = $baglanti->prepare("SELECT sepet.urunId FROM sepet WHERE urunId= ".$_GET['uid']." and cariId = ".$_SESSION['id']);
$sepetKontrol->execute();
$kontrol = $sepetKontrol->fetch(PDO::FETCH_ASSOC);

if (isset($_POST["buton"])) 
{
  if(empty($kontrol['urunId']))
  {
   $sql = "INSERT INTO `SEPET` ( `CARIID`, `URUNID`, `ADET`) VALUES ( '".$_SESSION['id']."', '".$_GET['uid']."', '".$_POST['adet']."' )";
   $gonder= $baglanti->prepare($sql);
   $gonder->execute();
 } 
 else
 {
  if($kontrol['urunId'] == $_GET['uid'])
  {
    $sepetUpd = $_POST['adet']; 

    $sql1="UPDATE sepet SET adet= ".$sepetUpd." WHERE urunId = ".$_POST['sGuncelle'];
    $baglanti->query($sql1);
  }
  else
  {
   $sql = "INSERT INTO `SEPET` ( `CARIID`, `URUNID`, `ADET`) VALUES ( '".$_SESSION['id']."', '".$_GET['uid']."', '".$_POST['adet']."' )";
   $gonder= $baglanti->prepare($sql);
   $gonder->execute();
   header("Refresh:0");
 }
}
}
?>

<!--yorum yapma bölümü-->
<?php
if (isset($_POST["yorumbuton"])) {
  $yorumunuz = $_POST['yorum'];

  $yorumtamamla = $baglanti->prepare("
    INSERT INTO `yorumlar` (`urunId`,`cariId`, `yorum`, `tarih`)
    VALUES ('".$_GET['uid']."', '".$_SESSION['id']."', '$yorumunuz', current_timestamp())");
  $yorumtamamla->execute();
  header("Refresh:0");
}

?>

<!--yorumları ekranda gösteren php kodu-->
<?php 
$yorumYap=$baglanti->prepare("
  SELECT cari.id, cari.kullaniciAdi, cari.yetkiliAdSoyad, yorumlar.id as yorumlar_id, yorumlar.urunId, yorumlar.cariId, yorumlar.yorum
  FROM yorumlar
  LEFT JOIN cari ON yorumlar.cariId = cari.id
  WHERE urunId=".$_GET['uid']);
$yorumYap->execute();

?>
<div style= "margin-top: 100px; margin-left: 100px; " class="col-md-10">
  <div style="background-color: #E8EAF6;" class="card card-stats">
    <div style="margin-top:10px; margin-left: 10px;">
      <div>
        <img src="images\<?php echo $urunbilgi['images'] ?>" style="max-width: 500px; max-height:500px;">
      </div>
      <div class="float-right" style="position:absolute; right: 10px; top: 15px; width: 400px;">
        <h1>
          <?php 
          echo $urunbilgi['urunAdi'];
          ?>
        </h1><br>
        <h5>
          <?php 
          echo $urunbilgi['urunAciklamasi'];
          ?>
        </h5>
      </div>
      <div class="float-right">
        <h1>                      
          <?php 
          echo $urunbilgi['fiyatKdvDahil']." ₺";
          ?>  
        </h1>
      </div>
    </div>
    <div class="card-footer">
      <div style="float-left">
        <a href="homePage.php">
          <button style="width:200px;" class="btn btn-info" name="buton">Anasayfaya Dön</button>
        </a>
      </div>
      <div class="stats"></div>
      <form class="" method="post" action="" >
        <div style="position: relative;">
          <div id="inner" style="position:absolute; left: -170px;">
            <div style="width: 150px;">
              <input type="number" class="form-control" placeholder="adet" name="adet"  min="1" autocomplete="off">
            </div>
          </div>
        </div>
        <input type="hidden" name="sGuncelle" value="<?=$urunbilgi['id']?>">
        <button style="width:300px;" class="button" name="buton">Sepete Ekle</button>
      </form>
    </div>
  </div>
  <div class="col-md-8">
    <form action="" method="POST" id="commentform" class="validate-form">   
      <p>  
        <label for="comment">Yorumunuz <span class="required">*</span></label>  
        <input style="width:920px; height: 100px; " type="text" name="yorum" value="" autocomplete="off"  required>   
      </p>
      <div style="padding-left:300px;">
        <p>  
          <button style="width:300px;" class="btn-primary btn-large" name="yorumbuton">Yorum Yap</button>  
        </p>
      </div> 
    </form> 
  </div>
</div>
<!--yorumları ekrana yazdıran kod-->
<?php
while ($yorumyapan=$yorumYap->fetch(PDO::FETCH_ASSOC)) {
  ?>
  <div style= "margin-top: 100px; margin-left: 100px; " class="col-md-10">
    <div style="background-color: #21806e3b;" class="card card-stats">
      <div style="margin-top:10px; margin-left: 10px;">
        <tr>
          <td>
            <h3><p style="padding-bottom:;padding-bottom:-40px;"><?php echo $yorumyapan['yetkiliAdSoyad'] ?></p></h3>
            <p><?php echo $yorumyapan['yorum'] ?></p>
          </td>
        </tr>
      </div>
    </div>
  </div>
  <?php 
} 
?>
<?php
include("inc/footer.php");
?>