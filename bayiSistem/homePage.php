<?php   
session_start();
if(empty($_SESSION['id'])){
  header('location:login.php');
  exit();
}
?>
<?php
include("inc/head.php");
include("database.php");
?>

<div class="content" style="padding-top:0px;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="card card-stats">
          <div class="card-header card-header-warning card-header-icon">
            <div class="card-icon">
              <i class="material-icons">filter_none</i>
            </div>
            <!--sayfada sepetteki toplam ürün bilgilerini gösteren bölümün işlemleri-->
            <?php
            require_once "database.php";
            $sepet=$baglanti->prepare("
              SELECT urun.id, urun.fiyatKdvDahil , sepet.adet, sepet.urunId, sum(adet) AS adet
              FROM sepet
              LEFT JOIN urun ON sepet.urunId = urun.id GROUP BY urun.id");
            $sepet->execute();
            $sepetfiyattoplam=0;
            $sepetToplam = 0;
            while($sepetbilgi=$sepet->fetch(PDO::FETCH_ASSOC)){
              $sepetfiyattoplam += ($sepetbilgi['adet'] * $sepetbilgi['fiyatKdvDahil']);
              $sepetToplam += $sepetbilgi['adet'];
            }
            ?>
            <p class="card-category">Sepetteki Toplam Ürün Adeti</p>
            <h3 class="card-title">
              <?php
              echo $sepetToplam ;
              ?>
            </h3>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="card card-stats">
          <div class="card-header card-header-success card-header-icon">
            <div class="card-icon">
              <i class="material-icons">paid</i>
            </div>
            <p class="card-category">Sepet Tutarı</p>
            <h3 class="card-title">
              <?php
              echo number_format($sepetfiyattoplam,2,",",".")." TL";
              ?>
            </h3>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="card card-stats">
          <div class="card-header card-header-primary card-header-icon">
            <div class="card-icon">
              <i class="material-icons">hourglass_top</i>
            </div>
            <?php  
            require_once "database.php";

            $siparisAsama=$baglanti->prepare("
              SELECT siparisgenel.asamaId, asama.id, asama.asama 
              FROM siparisgenel 
              LEFT JOIN asama ON siparisgenel.asamaId = asama.id
              WHERE cariId = ".$_SESSION['id']);
            $siparisAsama->execute();
            ?>
            <p class="card-category">Toplam Verilen Sipariş Sayısı</p>
            <h3 class="card-title">
              <?php 
              $sorgu = $baglanti->prepare("SELECT COUNT(*) FROM siparisgenel WHERE cariId = ".$_SESSION['id']);
              $sorgu->execute();
              $say = $sorgu->fetchColumn();
              echo $say ;
              ?>
            </h3>
          </div>
        </div>
      </div>
      <!--navbar menü-->
      <div class="col-md-12">
        <form action="" method="POST">
          <nav class="navbar navbar-light bg-light">
            <?php  
            $kategori=$baglanti->prepare("SELECT * FROM kategori ");
            $kategori->execute();
            while ($kategoribilgi=$kategori->fetch(PDO::FETCH_ASSOC)) {
              ?>
              <a class="navbar-brand" href="category.php?kid=<?php echo $kategoribilgi['id']; ?>" name="<?php $kategoribilgi['id']; ?>">
                <?php echo $kategoribilgi['Kategoriler']; ?>
              </a>
            <?php } ?>
          </nav>
        </form>
      </div>
      <!-- urunler -->
      <?php
      $urun=$baglanti->prepare("SELECT urun.id, urun.kategoriId, urun.images, urun.urunAdi, urun.fiyatKdvDahil 
        FROM urun ");
      $urun->execute();
      while ($urunbilgi=$urun->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <div class="col-lg-3 ">
          <div class="card card-stats" style="width:280px; height:auto;">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <a href="detail.php?uid=<?php echo $urunbilgi['id']; ?>"><img src="images/<?php echo $urunbilgi['images'] ?>" width="80" height="80"></a>
              </div>
              <h4>
                <a class="card-title" href="detail.php?uid=<?php echo $urunbilgi['id']; ?>">
                  <?php 
                  echo $urunbilgi['urunAdi'];
                  ?>
                </a>
              </h4>
              <a href="detail.php?uid=<?php echo $urunbilgi['id']; ?>">
                <h3 class="card-title" >                      
                  <?php 
                  echo number_format($urunbilgi['fiyatKdvDahil'],2,",",".")." ₺";
                  ?>  
                </h3>
              </a>
            </div>
          </div>
        </div>
        <!--while döngüsü parantez kapama-->      
        <?php 
      }
      ?>
    </div>          
  </div>
</div>
<?php
include("inc/footer.php");
?>