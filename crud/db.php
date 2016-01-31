<?php
////////////// Veritabanına bağlanmayı sağlayan sorgu ////
try{
$db= new PDO("mysql:host=localhost;dbname=proje5","root","");
}
catch (PDOexception $e){
print $e->getMessage();
}
?>