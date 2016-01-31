<meta charset="utf-8">
<?php 
include ("../crud/db.php");
ob_start();
session_start();
$_SESSION["login"]=false;
if(isset($_POST["email"])  && isset($_POST["password"]))
{

	if(!$_POST["email"]==""  && !$_POST["password"]=="")
	{

		$email = trim($_POST["email"]);
		$password = trim($_POST["password"]);

			$kontrol = $db->prepare("SELECT * FROM uyeler WHERE email=? and password=?");
			$kontrol->execute(array($email,md5($password)));

			if(($kontrol->rowCount())==1)
			{

				$aktiv = $db->prepare("SELECT * FROM uyeler WHERE aktif=? and email=? and password=?");
				$aktiv->execute(array(1,$email,md5($password)));

				if(($aktiv->rowCount())==1)
				{
					$sorgu=$kontrol->fetch();
					if($sorgu)
					{
						$_SESSION["login"]   = true;
						$_SESSION["id"]= $sorgu["id"];
						$_SESSION["parent_id"]= $sorgu["parent_id"];
						$_SESSION["email"]   = $sorgu["email"];

						header("location:dene.php");
					}
				}else
				echo "Lutfen uyeliğinizi mailinize gelen e-posta yardimiyla aktifleştirin!";
			}
			else
				echo "Sifrenizi veya Kullanıcı Adını Doğru Girdiginizden Emin Olunuz!";
	}else
	echo "Lütfen Tüm Alanları Doldurunuz.";
}
ob_end_flush();
 ?>