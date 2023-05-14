<?php

include 'baglanti.php';

if(isset($_POST['stokekle'])){

    try {

        $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Form gönderildiğinde çalışacak kod bloğu
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Form verilerini alın
            $barkod = $_POST["barkod"];
        $ilacId = $_POST["ilac_id"];
        $adet = $_POST["adet"];
        $fiyat = $_POST["fiyat"];
        $uretimTarihi = $_POST["uretim_tarihi"];
        $sonKullanim = $_POST["son_kullanim"];
        $kategori = $_POST["kategori"];

            // ID değerini kontrol etmek için SQL sorgusu oluşturun
            $sql = "SELECT * FROM stok WHERE barkod = :barkod";
            $stmt = $baglanti->prepare($sql);
            $stmt->bindParam(":barkod", $barkod);
            $stmt->execute();

            // Barkod veritabanında varsa
        if ($stmt->rowCount() > 0) {
            echo "<script>alert('Bu barkod değerine sahip stok bulunmaktadır.')</script>";
            echo "<script>window.location.href = 'ilaclar.php';</script>";
            exit;
        } else {
            // Adet kontrolü
            if (!is_numeric($adet) || $adet <= 0) {
                echo "<script>alert('Geçersiz adet değeri. Adet bir pozitif tam sayı olmalıdır.')</script>";
                echo "<script>window.location.href = 'ilaclar.php';</script>";
                exit;
            }

            // Fiyat kontrolü
            if (!is_numeric($fiyat) || $fiyat <= 0) {
                echo "<script>alert('Geçersiz fiyat değeri. Fiyat bir pozitif sayı olmalıdır.')</script>";
                echo "<script>window.location.href = 'ilaclar.php';</script>";
                exit;
            }

            // Üretim tarihi kontrolü
            if (!strtotime($uretimTarihi)) {
                echo "<script>alert('Geçersiz üretim tarihi değeri. Tarih formatı hatalı.')</script>";
                echo "<script>window.location.href = 'ilaclar.php';</script>";
                exit;
            }

            // Son kullanım tarihi kontrolü
            if (!strtotime($sonKullanim)) {
                echo "<script>alert('Geçersiz son kullanım tarihi değeri. Tarih formatı hatalı.')</script>";
                echo "<script>window.location.href = 'ilaclar.php';</script>";
                exit;
            }
            

            else {
                // Veritabanına verileri ekleme işlemi
$sql = "INSERT INTO stok (barkod, ilac_id, adet, fiyat, uretim_tarihi, son_kullanim, kategori) 
VALUES (:barkod, :ilacId, :adet, :fiyat, :uretimTarihi, :sonKullanim, :kategori)";
$stmt = $baglanti->prepare($sql);
$stmt->bindParam(":barkod", $barkod);
$stmt->bindParam(":ilacId", $ilacId);
$stmt->bindParam(":adet", $adet);
$stmt->bindParam(":fiyat", $fiyat);
$stmt->bindParam(":uretimTarihi", $uretimTarihi);
$stmt->bindParam(":sonKullanim", $sonKullanim);
$stmt->bindParam(":kategori", $kategori);

                if ($stmt->execute()) {
                    Header("Location:stok.php?durum=yes");
                } else {
                    Header("Location:stok.php?durum=no");

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






if(isset($_POST['stokduzenle']))
{
$duzenle=$baglanti->prepare("UPDATE stok SET

        barkod = :barkod,
        ilac_id = :ilac_id,
        adet = :adet,
        fiyat = :fiyat,
        uretim_tarihi = :uretim_tarihi,
        son_kullanim = :son_kullanim,
        kategori = :kategori

WHERE barkod={$_POST['barkod']}


");

$update=$duzenle->execute(array(

        'barkod' => $_POST['barkod'],
        'ilac_id' => $_POST['ilac_id'],
        'adet' => $_POST['adet'],
        'fiyat' => $_POST['fiyat'],
        'uretim_tarihi' => $_POST['uretim_tarihi'],
        'son_kullanim' => $_POST['son_kullanim'],
        'kategori' => $_POST['kategori']


));

if($update){
    Header("Location:stok.php?durum=yes");
}
else{
    Header("Location:stok.php?durum=no");
}


}


if(isset($_GET['stoksil'])){


$sil=$baglanti->prepare("DELETE FROM stok WHERE barkod=:barkod");

$sil->execute(array(

'barkod'=>$_GET['barkod']

));


if($sil){
    Header("Location:stok.php?durum=yes");
}
else{
    Header("Location:stok.php?durum=no");
}


}





?>
