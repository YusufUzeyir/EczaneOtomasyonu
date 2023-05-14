<?php

include 'baglanti.php';

if(isset($_POST['hastaekle'])){

    try {

        $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Form gönderildiğinde çalışacak kod bloğu
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Form verilerini alın
            $id = $_POST["id"];
            $hastaAd = $_POST["hasta_ad"];
            $hastaSoyad = $_POST["hasta_soyad"];
            $cinsiyet = $_POST["cinsiyet"];
            $dogumTarih = $_POST["dogum_tarihi"];
            $adres = $_POST["adres"];


            // ID değerini kontrol etmek için SQL sorgusu oluşturun
            $sql = "SELECT * FROM hasta WHERE id = :id";
            $insert = $baglanti->prepare($sql);
            $insert->bindParam(":id", $id);
            $insert->execute();

            // ID veritabanında varsa
            if ($insert->rowCount() > 0) {
                echo "<script>alert('Bu ID değerine sahip hasta bulunmaktadır.')</script>";

                echo "<script>window.location.href = 'ekle-hasta.php';</script>";

                exit;

                error_reporting(0);
                
            } else {
                // Veri tipi kontrolleri
                if (!is_numeric($id)) {
                    echo "<script>alert('Hata: ID değeri bir sayı olmalıdır.')</script>";

                    echo "<script>window.location.href = 'ekle-hasta.php';</script>";
    
                    exit;
    
                    error_reporting(0);
                    
                } elseif (!is_string($hastaAd)) {
                    echo "<script>alert('Hata: Hasta Adı bir metin olmalıdır.')</script>";

                    echo "<script>window.location.href = 'ekle-hasta.php';</script>";
    
                    exit;
    
                    error_reporting(0);
                } elseif (!is_string($hastaSoyad)) {
                    echo "<script>alert('Hata: Hasta Soyadı bir metin olmalıdır.')</script>";

                    echo "<script>window.location.href = 'ekle-hasta.php';</script>";
    
                    exit;
    
                    error_reporting(0);
                }    elseif (!strtotime($dogumTarih)) {
                    echo "<script>alert('Hata: Geçersiz doğum tarihi formatı.')</script>";

                    echo "<script>window.location.href = 'ekle-hasta.php';</script>";
    
                    exit;
    
                    error_reporting(0);
                } elseif (!is_string($adres)) {
                    echo "<script>alert('Hata: Geçersiz adres formatı.')</script>";

                    echo "<script>window.location.href = 'ekle-hasta.php';</script>";
    
                    exit;
    
                    error_reporting(0);
                }
            

            else {
                // Veritabanına personel kaydını ekleme işlemi
                $sql = "INSERT INTO hasta (id, hasta_ad, hasta_soyad, cinsiyet, dogum_tarihi,adres) VALUES (:id, :hastaAd, :hastaSoyad, :cinsiyet, :dogumTarih, :adres)";
                $insert = $baglanti->prepare($sql);
                $insert->bindParam(":id", $id);
                $insert->bindParam(":hastaAd", $hastaAd);
                $insert->bindParam(":hastaSoyad", $hastaSoyad);
                $insert->bindParam(":cinsiyet", $cinsiyet);
                $insert->bindParam(":dogumTarih", $dogumTarih);
                $insert->bindParam(":adres", $adres);

                if ($insert->execute()) {
                    Header("Location:hastalar.php?durum=yes");
                } else {
                    Header("Location:hastalar.php?durum=no");
                }
            }
        }
        }
        
    } catch (PDOException $e) {
        echo "Hata: " . $e->getMessage();
    }


   
}
else{
   /* echo "Form gönderilmedi.";*/
}






if(isset($_POST['hastaduzenle']))
{
$duzenle=$baglanti->prepare("UPDATE hasta SET

        id = :id,
        hasta_ad = :hasta_ad,
        hasta_soyad = :hasta_soyad,
        cinsiyet = :cinsiyet,
        dogum_tarihi = :dogum_tarihi,
        adres = :adres 

WHERE id={$_POST['id']}


");

$update=$duzenle->execute(array(

    'id' => $_POST['id'],
    'hasta_ad' => $_POST['hasta_ad'],
    'hasta_soyad' => $_POST['hasta_soyad'],
    'cinsiyet' => $_POST['cinsiyet'],
    'dogum_tarihi' => $_POST['dogum_tarihi'],
    'adres' => $_POST['adres']



));

if($update){
    Header("Location:hastalar.php?durum=yes");
}
else{
    Header("Location:hastalar.php?durum=no");
}


}




if(isset($_GET['hastasil'])){

    
$sil=$baglanti->prepare("DELETE FROM hasta WHERE id=:id");

$sil->execute(array(

'id'=>$_GET['id']

));


if($sil){
    Header("Location:hastalar.php?durum=yes");
}
else{
    Header("Location:hastalar.php?durum=no");
}


}




?>
