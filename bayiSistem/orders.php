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
<!--sipariş detay tablosunu sil butonu-->
<?php   
if (isset($_POST['siparisSil'])) 
{

  $sorgu1="DELETE FROM siparisdetay WHERE siparisId= ".$_POST['siparis_sil'];

  $baglanti->query($sorgu1);
}
?>
<!--sipariş genel tablosunu sil-->
<?php   
if (isset($_POST['siparisSil'])) 
{

  $sorgu2="DELETE FROM siparisgenel WHERE id= ".$_POST['siparis_sil'];

  $baglanti->query($sorgu2);
}
?>
<!--veritabanından verileri çeken sorgu -->
<?php 
require_once "database.php";
require_once "inc/head.php";

$siparis=$baglanti->prepare("
  SELECT siparisgenel.id, siparisgenel.siparisTarihi, siparisgenel.tutarKdvDahil, siparisgenel.asamaId, asama.id as asama_id, asama.asama, siparisgenel.SiparisNo 
  FROM siparisgenel 
  LEFT JOIN asama ON siparisgenel.asamaId = asama.id 
  WHERE cariId =".$_SESSION['id']);

$siparis->execute();
?>

<div class="content" style="padding-top:1px;">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header card-header-primary">
        <h1 class="card-title">Siparişlerim</h1>
      </div>
      <div>
        <table class="table">
          <thead class=" text-primary">
            <th>
              Sipariş Tarihi
            </th>
            <th>
              Tutar
            </th>
            <th>
              Süreç Durumu
            </th>
            <th>
              Sipariş No
            </th>
            <th style="text-align: right ; padding-right: 55px;">
              Detaylar
            </th>
            <th style="text-align: right ; padding-right: 35px;">
              Sipariş İptal
            </th>
          </thead>
          <tbody>
            <!-- while döngüsü -->
            <?php
            while($siparisveri=$siparis->fetch(PDO::FETCH_ASSOC)){
              ?>
              <tr>
                <td>
                  <?php 
                  echo $siparisveri['siparisTarihi'];
                  ?>
                </td>
                <td>
                  <?php 
                  echo $siparisveri['tutarKdvDahil']." TL";
                  ?>
                </td>
                <td>
                  <?php 
                  echo $siparisveri['asama'];
                  ?>
                </td>
                <td>
                  <?php 
                  echo "SPN-".$siparisveri['SiparisNo'];
                  ?>
                </td>
                <td>
                  <a href="orderDetail.php?sid=<?php echo $siparisveri['id']; ?>">
                    <button name="detay" id="detay" type="submit" class="btn btn-info pull-right" value="detay">Sipariş Detay</button>
                  </a>
                </td>
                <form action="" method="post">
                  <td>
                    <input type="hidden" name="siparis_sil" value="<?=$siparisveri['id']?>">
                    <button name="siparisSil" id="siparisSil" type="submit" class="btn btn-danger pull-right" value="siparisSil">Sipariş İptal</button>
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

<?php
include("inc/footer.php");
?>