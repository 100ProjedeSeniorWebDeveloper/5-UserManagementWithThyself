<meta charset="UTF-8">
<?php 
include "db.php";
if(isset($_GET["id"]))
	$id=$_GET['id'];


	$musteri=$db->prepare("SELECT * FROM musteriler where id=?");
	$musteri->execute(array($id));

	foreach ($musteri as $row) {
						$sil1=$row["image_80_80"];
						$sil2=$row["image_200_200"];
						$sil3=$row["image_300_300"];
	}

		$count=$musteri->rowCount();
			if($count==1)
			{
?>

<form method="post">
<label>Müsteri bilgilerini silmek istediğinizden emin misiniz?</label>
	<input type="submit" name="sil" value="SİL">
	<input type="submit" name="vazgec" value="Vazgec">
</form>

<?Php
				if(isset($_POST["vazgec"]))
					header("location:index.php");

 				if(isset($_POST["sil"]))
 				{

 				$delete = $db->prepare('DELETE FROM musteriler WHERE id = ? ');
				$delete->execute(array($id));

 					if($delete){
 						unlink($sil1);
 						unlink($sil2);
 						unlink($sil3);
 						header("location:index.php");
 				 }
 				 } 
			 }else{
			 	echo "Icerik Bulunamadi. Anasayfaya Yönlendiriliyorsunuz..";
						header("refresh:2; url=index.php");
				}
 ?>