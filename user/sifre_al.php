<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Yeni Şifre Al</title>
</head>
<body>
	<form action="" method="post">
		<table>
			<tr>
				<td>Yeni şifreyi giriniz:</td>
				<td><input type="text" name="password"></td>
			</tr>
			<tr>
				<td>Şifreyi tekrar giriniz:</td>
				<td><input type="text" name="password2"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="Şifre al"></td>
			</tr>
		</table>
	</form>
</body>
</html>




<?php 
include ("../crud/db.php");
if(isset($_GET["kod"])  && $_GET["kod"]!="")
{
	if(isset($_POST["password"]) && isset($_POST["password2"]))
	{
		$password = $_POST["password"];
		$password2 = $_POST["password2"];

			if($password==$password2)
			{
				
				$kod= $_GET["kod"];

				$kontrol=$db->prepare("SELECT * FROM uyeler where kod=?");
				$kontrol->execute(array($kod));

				$count=$kontrol->rowCount();
				if($count>0)
				{
					$update = $db->prepare("UPDATE uyeler SET password=? WHERE kod=?");
					$update->execute(array(md5($password),$kod));
					if($update){
						echo "Şifreniz başarıyla güncellendi.Yönlendiriliyorsunuz...";
						header("refresh:2; url=../user/index.php");
					}
				}
			}else
			echo "lütfen aynı şifreyi yazdiğinizdan emin olun";
	}
}else
header("url=../user/index.php");

 ?>
