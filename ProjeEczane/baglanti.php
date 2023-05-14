<?php

try{

$baglanti=new PDO("mysql:host=localhost; dbname=eczane3",'root','');

}
catch(Exception $e){

echo $e->getMessage();

}

?>