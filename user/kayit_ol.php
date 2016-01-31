<meta charset="utf-8">
<?php 
include ("../crud/db.php");

if(isset($_POST["password"]) && isset($_POST["password2"]) && isset($_POST["email"]))
{
	if(!$_POST["password"]=="" && !$_POST["password2"]=="" && !$_POST["email"]=="")			
	{
		/* Gelen Post degerlerini değişkenlere atadım */
		$password  = trim($_POST["password"]);
		$password2 = trim($_POST["password2"]);
		$email	   = trim($_POST["email"]);

		if($password==$password2)
		{
			if(filter_var($email,FILTER_VALIDATE_EMAIL))
			{

				$kontrol = $db->prepare("SELECT * FROM uyeler WHERE email=?");
				$kontrol->execute(array($email));
					if(($kontrol->rowCount())==0)
					{
						$sifre = md5(mt_rand());
						$kayit = $db->prepare("INSERT INTO uyeler ( password, email,kod) values( ?, ?,?)");
						$kayit->execute(array( md5($password), $email, $sifre));

							if($kayit)
							{

								echo "Kayıt işlemini tamamlamak için lütfen E-posta'nızı kontrol ediniz ve aktivasyon işlemini gerçekleştiriniz.";
								require ("mail.php");
								header("refresh:5; url=../user/index.php"); 
							}else
							{
								echo "Kayıt Esnasında Bir Sorun ile Karşılaştık.Lütfen Tekrar Deneyiniz.";
								
							}
					}else
					echo "Bu Kullanıcı adını ya da E-mail adresi zaten kullanılıyor.";
			}else
			echo "mail formatı hatalı";
		}else
		echo "Lutfen aynı şifreleri yazdıgınızdan emin olunuz.";	
	}else
	echo "Lutfen bos alan bırakmayınız";
} 
?>
