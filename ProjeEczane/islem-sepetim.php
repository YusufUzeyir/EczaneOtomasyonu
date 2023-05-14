<?php

include 'baglanti.php';


if(isset($_GET['sepetsat'])){


$sil=$baglanti->prepare("DELETE FROM sepet WHERE barkod=:barkod");

$sil->execute(array(

'barkod'=>$_GET['barkod']

));


if($sil){
    Header("Location:sepetim.php?durum=yes");
}
else{
    Header("Location:sepetim.php?durum=no");
}


}




?>
