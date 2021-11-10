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
<?php
$satır = 0 ;
if ($satır > 0) {

  if (isset($_POST['surecguncel']))
  {
    $sql1="UPDATE siparisgenel SET asamaId= ".$_POST['surecDurumu']." WHERE id = ".$_POST['surec_guncelle'];
    $baglanti->query($sql1);
  }
}
?>
<!--veritabanından verileri çeken sorgu -->
<?php

$siparis=$baglanti->prepare("
  SELECT siparisgenel.id, siparisgenel.siparisTarihi, siparisgenel.tutarKdvDahil, siparisgenel.asamaId, asama.id as asama_id, asama.asama, siparisgenel.SiparisNo
  FROM siparisgenel
  LEFT JOIN asama ON siparisgenel.asamaId = asama.id");
$siparis->execute();
?>
<div class="content">
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
            <th style="text-align: right ; padding-right: 35px;">
              Süreç Güncelle
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
                  echo number_format($siparisveri['tutarKdvDahil'],2,",",".")." TL"
                  ?>
                </td>
                <form action="" method="post">
                  <td>
                    <select name="surecDurumu" id="surecDurumu">
                      <option selected disabled hidden><?php echo $siparisveri['asama'] ; ?></option>
                      <option value="1">Sipariş Alındı</option>
                      <option value="2">Sipariş Hazırlanıyor</option>
                      <option value="3">Sipariş Kargoya Verildi</option>
                      <option value="4">Sipariş Teslim Edildi</option>
                    </select>
                  </td>
                  <td>
                    <?php
                    echo $siparisveri['SiparisNo'];
                    ?>
                  </td>
                  <td>
                    <input type="hidden" name="surec_guncelle" value="<?=$siparisveri['id']?>">
                    <button name="surecguncel" id="surecguncel" type="submit" class="btn btn-success pull-right" value="surecguncel">Süreç Güncelle</button>
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