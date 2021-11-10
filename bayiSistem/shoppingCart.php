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
<!--güncelle -->
<?php
if (isset($_POST['guncelle'])) 
{
  $adetTut = $_POST['adetTut']; 

  $sql1="UPDATE sepet SET adet= ".$adetTut." WHERE urunId = ".$_POST['kayit_guncelle'];
  $baglanti->query($sql1);
}
?>
<!--sil -->
<?php  
if (isset($_POST['sil'])) 
{
  $sorgu="DELETE FROM sepet WHERE urunId= ".$_POST['kayit_sil'];
  $baglanti->query($sorgu);
}
?>

<!--verileri çeken sorgu-->
<?php 
$sepet=$baglanti->prepare("
  SELECT urun.id as urun_id, urun.urunAdi, urun.fiyatKdvDahil, sepet.id, sepet.adet, sepet.urunId, sum(adet) AS adet 
  FROM sepet 
  LEFT JOIN urun ON sepet.urunId = urun.id 
  WHERE cariId =".$_SESSION['id']."
  GROUP BY urun.id ");
$sepet->execute();
?>
<?php
$siparisgnl=$baglanti->prepare("SELECT * FROM siparisgenel ORDER BY id DESC ");
$siparisgnl->execute();
$siparisgnl1=$siparisgnl->fetch(PDO::FETCH_ASSOC);
?>
<?php
$caritablo1=$baglanti->prepare("SELECT * FROM cari");
$caritablo1->execute();
$cariId1=$caritablo1->fetch(PDO::FETCH_ASSOC);
?>
<?php
$asama=$baglanti->prepare("SELECT * FROM asama");
$asama->execute();
$asamaveri=$asama->fetch(PDO::FETCH_ASSOC);
?>

<div class="content" style="padding-top:0px;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h1 class="card-title ">Sepet</h1>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                  <th>
                    Ürün Adı
                  </th>
                  <th>
                    Adet
                  </th>
                  <th>
                    Birim Fiyat
                  </th>
                  <th>
                    Toplam Fiyat
                  </th>
                  <th style="text-align: right ; padding-right: 70px;">
                    İşlem
                  </th>
                </thead>
                <!--while döngüsü ve genel toplam alma -->
                <?php
                $toplam=0;
                while ($sepetveri=$sepet->fetch(PDO::FETCH_ASSOC)) {
                  $toplam += $sepetveri['adet'] * $sepetveri['fiyatKdvDahil']; 
                  ?>
                  <tbody>
                    <tr>
                      <td>
                        <?php 
                        echo $sepetveri['urunAdi'];
                        ?>
                      </td>
                      <td>
                        <form action="" method="post">
                          <div style="width: 30px;">
                            <input type="number" class="form-control" placeholder="adetTut" name="adetTut"  min="1" value="<?php echo $sepetveri['adet'];?>">
                          </div> 
                        </td>
                        <td>
                          <?php 
                          echo $sepetveri['fiyatKdvDahil']." TL";
                          ?>
                        </td>
                        <td>
                          <!-- ürün toplamı-->
                          <?php

                          $sayi1 = $sepetveri['adet'];
                          $sayi2 = $sepetveri['fiyatKdvDahil'];

                          $sonuc = $sayi1 * $sayi2;
                          echo($sonuc)." TL";
                          ?>
                        </td>
                        <td>                         
                          <div align="right">
                            <!--güncelle butonu -->
                            <input type="hidden" name="kayit_guncelle" value="<?=$sepetveri['urun_id']?>">
                            <button name="guncelle" id="guncelle" type="submit" class="btn btn-success" value="guncelle"><i class="material-icons">update</i>
                              <!--sil butonu -->
                              <input type="hidden" name="kayit_sil" value="<?=$sepetveri['urun_id']?>">
                              <button name="sil" id="sil" type="submit" class="btn btn-danger pull-right" value="sil"><i class="material-icons">delete</i>
                              </div>
                            </form>
                          </td>
                        </tr>
                        <!--while döngüsü parantez kapama -->
                        <?php 
                      } 
                      ?>
                    </tbody>
                    <thead align="right">
                      <form action="" method="post">
                        <th>
                          <h3>Genel Toplam</h>
                          </th>
                          <th>
                            <h3>
                              <?= 
                              $toplam." TL";
                              ?>  
                            </h3>
                          </th>
                        </thead>
                      </table>
                      <button type="submit" name="tamamla" class="btn btn-primary pull-right">Siparişi Tamamla</button>
                      <!--sepette ürün yoksa sipariş tamamlamaması için sql sorgusu-->
                      <?php
                      $sqlsorguSatir=$baglanti->prepare("SELECT * FROM sepet ORDER BY id DESC");
                      $sqlsorguSatir->execute();
                      $satirSay = 0;
                      while($siparisveriSatir=$sqlsorguSatir->fetch(PDO::FETCH_ASSOC)){
                        $satirSay = $satirSay + 1;
                      }
                      if($satirSay > 0){
                        if (isset($_POST["tamamla"])) {
                          $sqltamamla = "INSERT INTO `siparisgenel` 
                          ( `cariId`, `tutarKdvHaric`, `tutarKdv`, `tutarKdvDahil`, `SiparisNo`, `asamaId`,`siparisTarihi`) 
                          VALUES ( '".$_SESSION['id']."', '','','".$toplam."','".$siparisgnl1['id']."', '".$asamaveri['id']."', current_timestamp() )";
                          $tamamla= $baglanti->prepare($sqltamamla);
                          $tamamla->execute();
                          
                        } 
                      }
                      ?>
                      <!--sipariş genel tablosunu sıralayan sql sorgusu-->
                      <?php  
                      $sqlsorgu1=$baglanti->prepare("SELECT * FROM siparisgenel ORDER BY id DESC");
                      $sqlsorgu1->execute();
                      $genelSiparisId=$sqlsorgu1->fetch(PDO::FETCH_ASSOC);
                      ?>
                      <!--sepetteki ürünleri sipariş oluşturmak için bilgileri çeken sorgu-->
                      <?php 
                      $sqlsorgu=$baglanti->prepare("
                        SELECT sepet.adet, sepet.urunId, urun.urunAdi, urun.fiyatKdvHaric, urun.kdvOran, urun.kdvTutar, urun.fiyatKdvDahil, urun.iskontoYuzde1, urun.iskontoYuzde2, urun.iskontoYuzde3  
                        FROM sepet 
                        LEFT JOIN urun ON sepet.urunId = urun.id");
                      $sqlsorgu->execute();
                      ?>

                      <?php
                      while($siparisveri=$sqlsorgu->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <!--sepet tamamlandığında oluşan sipariş-->
                        <?php
                        if (isset($_POST["tamamla"])) {
                          $sqltamamla2 = "INSERT INTO `siparisdetay` ( `siparisId`, `urunId`, `adet`, `tutarKdvHaric`, `tutarKdv`, `tutarKdvDahil`, 
                          `iskonto1`, `iskonto2`, `iskonto3`) 
                          VALUES ('".$genelSiparisId['id']."', '".$siparisveri['urunId']."', '".$siparisveri['adet']."', 
                          '".$siparisveri['fiyatKdvHaric']."', '".$siparisveri['kdvTutar']."', '".$siparisveri['fiyatKdvDahil']."', 
                          '".$siparisveri['iskontoYuzde1']."', '".$siparisveri['iskontoYuzde2']."', '".$siparisveri['iskontoYuzde3']."')";
                          $tamamla2= $baglanti->prepare($sqltamamla2);
                          $tamamla2->execute();
                        }
                        ?>
                        <?php
                      }
                      ?>
                      <!--sepet temizleme-->
                      <?php   
                      if (isset($_POST['tamamla'])) 
                      {
                        $sepetSil="DELETE FROM sepet WHERE cariId = ".$_SESSION['id'];
                        $baglanti->query($sepetSil);
                      }
                      ?>
                      
                    </form>
                    <a href="orders.php">
                      <button class="btn btn-success pull-right">Sipariş Sayfasına git</button>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  
      </div>

      <?php
      include("inc/footer.php");
    ?>