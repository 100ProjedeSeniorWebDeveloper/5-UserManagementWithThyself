<meta charset="utf-8">
<?php 
include ("../crud/db.php");
//session baslat
ob_start();
session_start(); 

//sessio öldür
session_destroy();
header("location:index.php");

?>