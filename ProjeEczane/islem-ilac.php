<?php
include 'baglanti.php';






if(isset($_POST['urunekle'])){

    try {
        
        $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"];
            $ureticiFirma = $_POST["uretici_firma"];
            $dozaj = $_POST["dozaj"];
            $fiyat = $_POST["fiyat"];
            $ilacAdi = $_POST["ilac_adi"];
            $kategori = $_POST["kategori"];
    
            $sql = "SELECT * FROM ilaclar WHERE id = :id";
            $stmt = $baglanti->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
    
           if ($stmt->rowCount() > 0) {
            echo "<script>alert('Bu ID değerine sahip ilaç bulunmaktadır.')</script>";

            echo "<script>window.location.href = 'ekle-ilac.php';</script>";

            exit;

            error_reporting(0);
            
        } else {
            if (!is_numeric($id)) {
                echo "<script>alert('Hata: ID değeri bir sayı olmalıdır.')</script>";

            echo "<script>window.location.href = 'ekle-ilac.php';</script>";

            exit;

            error_reporting(0);
              
            } elseif (!is_string($ureticiFirma)) {
                echo "<script>alert('Hata: Firma Adı bir metin olmalıdır.')</script>";

            echo "<script>window.location.href = 'ekle-ilac.php';</script>";

            exit;

            error_reporting(0);
                
            } elseif (!is_string($dozaj)) {
                echo "<script>alert('Hata: Dozaj değeri bir metin olmalıdır.')</script>";

            echo "<script>window.location.href = 'ekle-ilac.php';</script>";

            exit;

            error_reporting(0);
            
            }  elseif (!is_numeric($fiyat)) {
                echo "<script>alert('Hata: Fiyat değeri bir sayı olmalıdır.')</script>";

            echo "<script>window.location.href = 'ekle-ilac.php';</script>";

            exit;

            error_reporting(0);
            } elseif (!is_string($ilacAdi)) {
                echo "<script>alert('Hata: İlaç Adı bir metin olmalıdır.')</script>";

            echo "<script>window.location.href = 'ekle-ilac.php';</script>";

            exit;

            error_reporting(0);
            } elseif (!is_string($kategori)) {
                echo "<script>alert('Hata: Kategori bir metin olmalıdır.')</script>";

            echo "<script>window.location.href = 'ekle-ilac.php';</script>";

            exit;

            error_reporting(0);
            } 
            
            
            else {
                    $sql = "INSERT INTO ilaclar (id, uretici_firma, dozaj, fiyat, ilac_adi, kategori) VALUES (:id, :ureticiFirma, :dozaj, :fiyat, :ilacAdi, :kategori)";
                    $stmt = $baglanti->prepare($sql);
                    $stmt->bindParam(":id", $id);
                    $stmt->bindParam(":ureticiFirma", $ureticiFirma);
                    $stmt->bindParam(":dozaj", $dozaj);
                    $stmt->bindParam(":fiyat", $fiyat);
                    $stmt->bindParam(":ilacAdi", $ilacAdi);
                    $stmt->bindParam(":kategori", $kategori);
    
                    if ($stmt->execute()) {
                        Header("Location:ilaclar.php?durum=yes");
                    } else {
                        Header("Location:ilaclar.php?durum=no");
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




if(isset($_POST['urunduzenle']))
{
$duzenle=$baglanti->prepare("UPDATE ilaclar SET

        id = :id,
        uretici_firma = :uretici_firma,
        dozaj = :dozaj,
        fiyat = :fiyat,
        ilac_adi = :ilac_adi,
        kategori = :kategori

WHERE id={$_POST['id']}


");

$update=$duzenle->execute(array(

    'id' => $_POST['id'],
    'uretici_firma' => $_POST['uretici_firma'],
    'dozaj' => $_POST['dozaj'],
    'fiyat' => $_POST['fiyat'],
    'ilac_adi' => $_POST['ilac_adi'],
    'kategori' => $_POST['kategori']


));

if($update){
    Header("Location:ilaclar.php?durum=yes");
}
else{
    Header("Location:ilaclar.php?durum=no");
}


}




if(isset($_GET['urunsil'])){

$sil=$baglanti->prepare("DELETE FROM ilaclar WHERE id=:id");

$sil->execute(array(

'id'=>$_GET['id']

));


if($sil){
    Header("Location:ilaclar.php?durum=yes");
}
else{
    Header("Location:ilaclar.php?durum=no");
}


}




?>
