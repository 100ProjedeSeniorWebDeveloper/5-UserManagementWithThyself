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
		if(isset($_POST["password"]) && isset($_POST["password2"]))
		{
			if( !$_POST["password"]=="" && !$_POST["password2"]=="")			
			{
				/* Gelen Post degerlerini değişkenlere atadım */
				$password  = trim($_POST["password"]);
				$password2 = trim($_POST["password2"]);
				
				if($password==$password2)
				{
					
						$update = $db->prepare("UPDATE uyeler SET aktif=?, password=?,kod=? WHERE kod=?");
						$update->execute(array("1",md5($password),"",$kod));
						if($update)
						{
							echo "Üyeliğiniz başarı ile oluşturuldu.Yönlendiriliyorsunuz...";
							header("refresh:2; url=../user/index.php");
						}else
						echo "güncelleme sırasında bir hata oluştu";
				}else
				echo "Lütfen aynı şifreyi girdiğinizden emin olunuz!";
			}else
			echo "Lütfen tüm alanları doldurunuz!";
		}
?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Sifre Sec</title>
 </head>
 <body>
 <form action="" method="post">
 	<table>
 		
 		<tr>
 			<td>Lütfen bir şifre belirleyiniz:</td>
 			<td><input type="password" name="password"></td>
 		</tr>
 		<tr>
 			<td>Lütfen şifreyi tekrar giriniz:</td>
 			<td><input type="password" name="password2"></td>
 		</tr>
 		<tr>
 			<td></td>
 			<td><input type="submit"></td>
 		</tr>
 	</table>
 </form>
 </body>
 </html>
<?php 
 }else
	header("refresh:2; url=../user/index.php");
}
 ?>