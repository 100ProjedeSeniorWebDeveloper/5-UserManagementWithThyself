<meta charset="UTF-8">
<?php 
include ("db.php");

if(isset($_GET["id"]))
$id=$_GET["id"];

	$musteri=$db->prepare("SELECT * FROM musteriler where id=?");
	$musteri->execute(array($id));
$count=$musteri->rowCount();
if($count>0){
			
			foreach($musteri as $row)
			{
						$sil1=$row["image_80_80"];
						$sil2=$row["image_200_200"];
						$sil3=$row["image_300_300"];


if(isset($_POST["ad"]) && isset($_POST["soyad"]) && isset($_POST["cep"]) && isset($_POST["email"]) && isset($_POST["ek"]))
{
	$ad=$_POST["ad"];
	$soyad=$_POST["soyad"];
	$cep=$_POST["cep"];
	$email=$_POST["email"];
	$ek=$_POST["ek"];

	include ("upload.php");

	$update = $db->prepare("UPDATE musteriler SET ad=?, soyad=?, cep=?, email=?, ek=?, image_200_200=?, image_80_80=?, image_300_300=? WHERE id=?");
	$update->execute(array($ad, $soyad, $cep, $email, $ek, $name_200_200,$name_80_80,$name_300_300,$id));
	if($update)
	{	
		
		header("location:index.php");
		unlink($sil1);
 		unlink($sil2);
 		unlink($sil3);
		
}	
}

?>

<form action="" method="post" enctype="multipart/form-data">
<h2>Müsteri Düzenle</h2>
	<table cellpadding="10">		
			<tr>
				<td><img src="<?=$row['image_200_200']; ?>" alt=""></td>
				<td>Ad:</td>
				<td><input type="text" name="ad" value="<?=$row['ad'];?>"></td>
				<td>Soyad:</td>
				<td><input type="text" name="soyad" value="<?=$row['soyad'];?>"></td>
				<td>Not :</td>
				<td><textarea name="ek" cols="50" rows="8"><?=$row['ek'];?></textarea></td>
			</tr>
			<tr>
				<td><input type="FILE" name="image"></td>
				<td>Tel No:</td>
				<td><input type="text" name="cep" value="<?=$row['cep'];?>"></td>
				<td>E-mail:</td>
				<td><input type="text" name="email" value="<?=$row['email'];?>"></td>
				<td></td>
				<td><input type="submit" value="Update"></td>				
			</tr>
	</table>
</form>
<?php 

			}
		}else{
			echo "Sayfa Bulunamadı. Anasayfaya Yönlendiriliyorsunuz..";
			header("refresh:2; url=index.php");
		}
		
?>