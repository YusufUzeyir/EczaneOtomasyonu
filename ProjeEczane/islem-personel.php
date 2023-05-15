<?php

include 'baglanti.php';


if(isset($_POST['personelekle'])){

    try {

        $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"];
            $personelAd = $_POST["personel_ad"];
            $personelSoyad = $_POST["personel_soyad"];
            $cinsiyet = $_POST["cinsiyet"];
            $dogumTarihi = $_POST["dogum_tarihi"];
            $girisTarih = $_POST["giris_tarih"];

            $sql = "SELECT * FROM personel WHERE id = :id";
            $stmt = $baglanti->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "<script>alert('Bu ID değerine sahip personel bulunmaktadır.')</script>";

                echo "<script>window.location.href = 'ekle-personel.php';</script>";

                exit;

                error_reporting(0);
                
            } else {
                if (!is_numeric($id)) {
                    echo "<script>alert('Hata: ID değeri bir sayı olmalıdır.')</script>";

                echo "<script>window.location.href = 'ekle-personel.php';</script>";

                exit;

                error_reporting(0);
                  
                } elseif (!is_string($personelAd)) {
                    echo "<script>alert('Hata: Personel Adı bir metin olmalıdır.')</script>";

                echo "<script>window.location.href = 'ekle-personel.php';</script>";

                exit;

                error_reporting(0);
                    
                } elseif (!is_string($personelSoyad)) {
                    echo "<script>alert('Hata: Personel Soyadı bir metin olmalıdır.')</script>";

                echo "<script>window.location.href = 'ekle-personel.php';</script>";

                exit;

                error_reporting(0);
                
                }  elseif (!strtotime($dogumTarihi)) {
                    echo "<script>alert('Hata: Geçersiz doğum tarihi formatı.')</script>";

                echo "<script>window.location.href = 'ekle-personel.php';</script>";

                exit;

                error_reporting(0);
                } elseif (!strtotime($girisTarih)) {
                    echo "<script>alert('Hata: Geçersiz giriş tarihi formatı.')</script>";

                echo "<script>window.location.href = 'ekle-personel.php';</script>";

                exit;

                error_reporting(0);
                }
            

            else {
                $sql = "INSERT INTO personel (id, personel_ad, personel_soyad, cinsiyet, dogum_tarihi, giris_tarih) VALUES (:id, :personelAd, :personelSoyad, :cinsiyet, :dogumTarihi, :girisTarih)";
                $stmt = $baglanti->prepare($sql);
                $stmt->bindParam(":id", $id);
                $stmt->bindParam(":personelAd", $personelAd);
                $stmt->bindParam(":personelSoyad", $personelSoyad);
                $stmt->bindParam(":cinsiyet", $cinsiyet);
                $stmt->bindParam(":dogumTarihi", $dogumTarihi);
                $stmt->bindParam(":girisTarih", $girisTarih);

                if ($stmt->execute()) {
                    Header("Location:personel.php?durum=yes");
                } else {
                    Header("Location:personel.php?durum=no");

                }
            }
        }
        }
        
    } catch (PDOException $e) {
        echo "Hata: " . $e->getMessage();
    }

    

}
else{
}






if(isset($_POST['personelduzenle']))
{
$duzenle=$baglanti->prepare("UPDATE personel SET

        id = :id,
        personel_ad = :personel_ad,
        personel_soyad = :personel_soyad,
        cinsiyet = :cinsiyet,
        dogum_tarihi = :dogum_tarihi,
        giris_tarih = :giris_tarih

WHERE id={$_POST['id']}


");

$update=$duzenle->execute(array(

    'id' => $_POST['id'],
    'personel_ad' => $_POST['personel_ad'],
    'personel_soyad' => $_POST['personel_soyad'],
    'cinsiyet' => $_POST['cinsiyet'],
    'dogum_tarihi' => $_POST['dogum_tarihi'],
    'giris_tarih' => $_POST['giris_tarih']


));

if($update){
    Header("Location:personel.php?durum=yes");
}
else{
    Header("Location:personel.php?durum=no");
}


}


if(isset($_GET['personelsil'])){



    
$sil=$baglanti->prepare("DELETE FROM personel WHERE id=:id");

$sil->execute(array(

'id'=>$_GET['id']

));


if($sil){
    Header("Location:personel.php?durum=yes");
}
else{
    Header("Location:personel.php?durum=no");
}


}




?>
