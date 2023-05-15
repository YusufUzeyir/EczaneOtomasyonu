<?php

include 'baglanti.php';




if(isset($_POST['receteekle'])){

    

    try {
        
        $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"];
            $verilenTarih = $_POST["verilen_tarih"];
            $ilacId = $_POST["ilac_id"];
            $miktar = $_POST["miktar"];
            $kullanim = $_POST["kullanim"];
    
            $sql = "SELECT * FROM recete WHERE id = :id";
            $stmt = $baglanti->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                echo "<script>alert('Bu ID değerine sahip reçete bulunmaktadır.')</script>";
                echo "<script>window.location.href = 'ekle-recete.php';</script>";
                exit;
            }
    else {
                if (!is_numeric($miktar) || $miktar <= 0) {
                    echo "<script>alert('Geçersiz miktar değeri. Miktar bir pozitif tam sayı olmalıdır.')</script>";
                    echo "<script>window.location.href = 'ekle-recete.php';</script>";
                    exit;
                }
                if (!is_numeric($ilacId) || $ilacId <= 0) {
                    echo "<script>alert('Geçersiz ilaç ID değeri. ID bir pozitif tam sayı olmalıdır.')</script>";
                    echo "<script>window.location.href = 'ekle-recete.php';</script>";
                    exit;
                }
    
                $verilenTarih = strtotime($verilenTarih); 
                if (!$verilenTarih) {
                    echo "<script>alert('Geçersiz tarih değeri. Tarih formatı hatalı.')</script>";
                    echo "<script>window.location.href = 'ekle-recete.php';</script>";
                    exit;
                }
                $sql = "INSERT INTO recete (id, verilen_tarih, ilac_id, miktar, kullanim) VALUES (:id, :verilenTarih, :ilacId, :miktar, :kullanim)";
                $stmt = $baglanti->prepare($sql);
                $stmt->bindParam(":id", $id);
                $stmt->bindParam(":verilenTarih", $verilenTarih);
                $stmt->bindParam(":ilacId", $ilacId);
                $stmt->bindParam(":miktar", $miktar);
                $stmt->bindParam(":kullanim", $kullanim);
    
                if ($stmt->execute()) {
                    Header("Location:receteler.php?durum=yes");
                } else {
                    Header("Location:receteler.php?durum=no");
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






if(isset($_POST['receteduzenle']))
{
$duzenle=$baglanti->prepare("UPDATE recete SET

        id = :id,
        verilen_tarih = :verilen_tarih,
        ilac_id = :ilac_id,
        miktar = :miktar,
        kullanim = :kullanim

WHERE id={$_POST['id']}


");

$update=$duzenle->execute(array(

    'id' => $_POST['id'],
    'verilen_tarih' => $_POST['verilen_tarih'],
    'ilac_id' => $_POST['ilac_id'],
    'miktar' => $_POST['miktar'],
    'kullanim' => $_POST['kullanim']


));

if($update){
    Header("Location:receteler.php?durum=yes");
}
else{
    Header("Location:receteler.php?durum=no");
}


}


if(isset($_GET['recetesil'])){



    
$sil=$baglanti->prepare("DELETE FROM recete WHERE id=:id");

$sil->execute(array(

'id'=>$_GET['id']

));


if($sil){
    Header("Location:receteler.php?durum=yes");
}
else{
    Header("Location:receteler.php?durum=no");
}


}




?>
