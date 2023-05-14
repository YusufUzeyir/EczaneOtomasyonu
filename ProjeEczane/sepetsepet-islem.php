<?php

include 'baglanti.php';

if(isset($_POST['sepetekle'])){

    

    $urunkaydet = $baglanti->prepare("INSERT INTO sepet SET 

        hasta_id = :hasta_id,
        barkod = :barkod,
        adet = :adet,
        fiyat = :fiyat
        
    ");

    $insert = $urunkaydet->execute(array(

        'hasta_id' => $_POST['hasta_id'],
        'barkod' => $_POST['barkod'],
        'adet' => $_POST['adet'],
        'fiyat' => $_POST['fiyat']
       
    ));

    if($insert){
        Header("Location:sepetim.php?durum=yes");
    }
    else{
        Header("Location:sepetim.php?durum=no");
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
