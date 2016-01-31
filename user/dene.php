<meta charset="utf-8">
<?php 
include ("../crud/db.php");
//session baslat
ob_start();
session_start(); 

echo $_SESSION["email"];

 ?>