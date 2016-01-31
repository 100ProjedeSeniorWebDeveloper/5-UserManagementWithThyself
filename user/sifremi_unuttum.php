<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>ŞİFREMİ UNUTTUM</title>
</head>
<body>
	<form action="" method="post">
		<table>
			<tr>
				<td>E-Posta Adresiniz:</td>
				<td><input type="text" name="email"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="Şifre Gönder"></td>
			</tr>
		</table>
	</form>
</body>
</html>
<?php 
include ("../crud/db.php");

if(isset($_POST["email"]) && (!$_POST["email"]==""))
{
	$email = $_POST["email"];
	$sifre = md5(mt_rand());
	$update = $db->prepare("UPDATE uyeler SET kod=? WHERE email=?");
	$update->execute(array($sifre,$email));
	


/********************mail gönder********************/
    require("class.phpmailer.php");
    require("class.smtp.php");

    $mail = new PHPMailer();

    // ---------- adjust these lines ---------------------------------------
    $mail->Username = ""; // your GMail user name
    $mail->Password = ""; //your GMail password
    $mail->AddAddress($email); // recipients email
    $mail->FromName = "5-UserManagementWithThyself"; // readable name

    $mail->Subject = "E-Mail Onay";


    $mail->Body    = "https://localhost/5-UserManagementWithThyself/user/sifre_al.php?kod=".$sifre; 
    //-----------------------------------------------------------------------

    $mail->Host = "ssl://smtp.gmail.com"; // GMail
    $mail->Port = 465;
    $mail->IsSMTP(); // use SMTP
    $mail->SMTPAuth = true; // turn on SMTP authentication
    $mail->From = $mail->Username;
    if(!$mail->Send())
        echo "Mailer Error: " . $mail->ErrorInfo;


}
?>
