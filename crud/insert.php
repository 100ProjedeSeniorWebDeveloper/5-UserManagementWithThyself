<!DOCTYPE html>
<html>
<head>
	<title>Yeni Müşteri Ekle</title>
	<meta charset="utf-8">
</head>
<body>
<div >
	<form action="" method="post" enctype="multipart/form-data">
	<h2>Müsteri Ekle</h2>
		<table>
			<tr>
				<td>Ad:</td>
				<td><input type="text" name="ad"></td>
				<td>Soyad:</td>
				<td><input type="text" name="soyad"></td>
			</tr>
			<tr>
				<td>Tel No:</td>
				<td><input type="text" name="cep"></td>
				<td>E-mail:</td>
				<td><input type="text" name="email"></td>
				
			</tr>
			<tr>
				<td>Not :</td>
				<td><textarea name="ek" cols="40" rows="8"></textarea></td>
			</tr>
			<tr>
				<td>Resim ekle:</td>
				<td><input type="FILE" name="image"></td>
							<td></td>
				<td><input type="submit" value="Kayıt Ekle"></td>
			</tr>
		</table>
	</form>
</div>
</body>
</html>


<?php 

include "db.php";

session_start();
if(isset($_SESSION["id"]))
	$parent_id=$_SESSION["id"];

if(isset($_POST["ad"]) && isset($_POST["soyad"]) && isset($_POST["cep"]) && isset($_POST["email"]) && isset($_POST["ek"]) && isset($_FILES["image"]["name"]))	{
		$ad=$_POST["ad"];
		$soyad=$_POST["soyad"];
		$cep=$_POST["cep"];
		$email=$_POST["email"];
		$ek=$_POST["ek"];
		

	include ("upload.php");

		if($ad!='' && $soyad!=''){

			$query = $db->prepare('INSERT INTO musteriler (ad, soyad, email, cep, ek,image_80_80, image_200_200,image_300_300) values( ?, ?, ?, ?, ?, ?, ?, ?)');
			$query->execute(array($ad, $soyad, $email, $cep, $ek,$name_80_80,$name_200_200,$name_300_300));

				if($query){

						$sifre = md5(mt_rand());
						

						$kayit = $db->prepare("INSERT INTO uyeler (parent_id, email,kod) values( ?, ?,?)");
						$kayit->execute(array($parent_id, $email, $sifre));
                  /*******************************************/
						$sec=$db->prepare("select * from musteriler where email=?");
						$sec->execute(array($email));
						foreach ($sec as $key) {
							$musteri_id=$key["id"];
						}

						$sec=$db->prepare("select * from uyeler where email=?");
						$sec->execute(array($email));
						foreach ($sec as $key) {
							$uye_id=$key["id"];
						}
                   /***************************************/
						$kayit = $db->prepare("INSERT INTO musteri_uye (uye_id, musteri_id) values( ?, ?)");
						$kayit->execute(array($uye_id, $musteri_id));

						if($kayit){

							$kontrol = $db->prepare("SELECT * FROM uyeler WHERE email=?");
							$kontrol->execute(array($email));

							if(($kontrol->rowCount())==1)
							{

						/* mail gönder*/

						require("../user/class.phpmailer.php");
					    require("../user/class.smtp.php");

					    $mail = new PHPMailer();

					    // ---------- adjust these lines ---------------------------------------
					    $mail->Username = ""; // your GMail user name
					    $mail->Password = ""; //your GMail password
					    $mail->AddAddress($email); // recipients email
					    $mail->FromName = "5-UserManagementWithThyself"; // readable name

					    $mail->Subject = "Alt Musteri ekleme sistemi";

					    $mail->Body    = "https://localhost/5-UserManagementWithThyself/user/sifre_sec.php?kod=".$sifre; 
					    //-----------------------------------------------------------------------

					    $mail->Host = "ssl://smtp.gmail.com"; // GMail
					    $mail->Port = 465;
					    $mail->IsSMTP(); // use SMTP
					    $mail->SMTPAuth = true; // turn on SMTP authentication
					    $mail->From = $mail->Username;
					    if(!$mail->Send())
					        echo "Mailer Error: " . $mail->ErrorInfo;
					}else
					echo "user tablosuna eklenemedi";
				}
/**************************************mail bitti*******************************************************/
					header("location:index.php");
				}
		}
	}

 ?>