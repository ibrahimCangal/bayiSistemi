<?php
try {
    $baglanti = new PDO('mysql:host=localhost:3307;dbname=deneme1', "root", "");

    echo "";

    $baglanti = $baglanti;
} 
catch (PDOException $e) {
    print "Hata!: " . $e->getMessage() . "<br/>";
    die();
}
?>
