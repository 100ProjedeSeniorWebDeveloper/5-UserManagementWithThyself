<meta charset="utf-8">
<?php 
include ("../crud/db.php");
if(isset($_GET["kod"]) && $_GET["kod"]!="")
{
	$kod= $_GET["kod"];

	$kontrol=$db->prepare("SELECT * FROM uyeler where kod=?");
	$kontrol->execute(array($kod));

	$count=$kontrol->rowCount();
	if($count>0)
	{
		$update = $db->prepare("UPDATE uyeler SET aktif=? WHERE kod=?");
		$update->execute(array("1",$kod));
		if($update){
			echo "Üyeliğiniz başarı ile onaylandı.Yönlendiriliyorsunuz...";
			header("refresh:2; url=../user/index.php");
		}
	}
}else
header("url=../user/index.php");
 ?>
