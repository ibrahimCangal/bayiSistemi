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
<!--veritabanından verileri çeken sorgu -->
<?php 
require_once "database.php";
require_once "inc/head.php";

$siparisdty =$baglanti->prepare("SELECT urun.urunAdi, siparisdetay.id, siparisdetay.siparisId, siparisdetay.urunId, siparisdetay.adet, siparisdetay.tutarKdvHaric, siparisdetay.tutarKdv, siparisdetay.tutarKdvDahil, siparisdetay.iskonto1, siparisdetay.iskonto2, siparisdetay.iskonto3 FROM siparisdetay 
  LEFT JOIN urun ON siparisdetay.urunId = urun.id WHERE siparisdetay.siparisId = '".$_GET['sid']."'");
$siparisdty->execute();

?>

<div class="content" style="padding-top:1px;">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header card-header-primary">
        <h1 class="card-title">Sipariş Detayı</h1>
      </div>
      <div>
        <table class="table">
          <thead class=" text-primary">
            <th>
              Ürün Adı
            </th>
            <th>
              Adet
            </th>
            <th>
              Tutar KDV Hariç
            </th>
            <th>
              KDV Tutarı
            </th>
            <th>
              Tutar KDV Dahil
            </th>
            <th>
              iskonto 1
            </th>
          </thead>
          <tbody>
            <!-- while döngüsü -->
            <?php 
            while ($siparisDetay=$siparisdty->fetch(PDO::FETCH_ASSOC)) {

              ?>
              <tr>
                <td>
                  <?php 
                  echo $siparisDetay['urunAdi'];
                  ?>
                </td>
                <td>
                  <?php 
                  echo $siparisDetay['adet'];
                  ?>
                </td>
                <td>
                  <?php 
                  $adettoplam1 = $siparisDetay['adet'];
                  $adettoplam2 = $siparisDetay['tutarKdvHaric'];

                  $toplamsonuc1 = $adettoplam1 * $adettoplam2;
                  echo($toplamsonuc1)." TL";
                  ?>
                </td>
                <td>
                  <?php 
                  $adettoplam3 = $siparisDetay['adet'];
                  $adettoplam4 = $siparisDetay['tutarKdv'];

                  $toplamsonuc2 = $adettoplam3 * $adettoplam4;
                  echo($toplamsonuc2)." TL";
                  ?>
                </td>
                <td>
                  <?php 
                  $adettoplam5 = $siparisDetay['adet'];
                  $adettoplam6 = $siparisDetay['tutarKdvDahil'];

                  $toplamsonuc3 = $adettoplam5 * $adettoplam6;
                  echo($toplamsonuc3)." TL";
                  ?>
                </td>
                <td>
                  <?php 
                  echo $siparisDetay['iskonto1'];
                  ?>
                </td>
              </tr>
              <!--while döngüsü parantez kapama -->
              <?php 
            }
            ?>
          </tbody>
        </table>
        <a href="orders.php">
          <div style="padding-bottom: 50px; padding-right:10px;">
            <button style="width:250px;" class="button pull-right" name="buton">Geri Dön</button>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include("inc/footer.php");
?>