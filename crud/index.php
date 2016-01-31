<?php 
include ("db.php");
session_start();
if(isset($_SESSION["email"]))
echo "email: ".$_SESSION["email"];
//echo $_SESSION["parent_id"];
//echo $_SESSION["id"];


 ?>
<!DOCTYPE html>
<html>
<head>
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<meta charset="utf-8">
	<title>User-Management-Micro-Project</title>
	<style>
table, th, td {
    border: 1px solid #ccc;
}

	
	.box  {
	position: fixed;
    width: 100%;
    top: 0;
    z-index: 1;
    height: 100%;
    background: rgba(0, 0, 0, 0.9);
    left: 0;
    text-align: center;
}
.kapat {
    position: absolute;
    right: 30px;
    font-weight: bolder;
    background: rgba(0, 0, 0, 0.61);
    top: 30px;
    font-family: monospace;
    font-size: 60px;
    color: rgba(255,255,255,0.5);
    cursor: pointer;
    padding: 20px 40px;
    border-radius: 10px;
}
    


</style>

	
<script>				

         
	
	    $(function()
	    {
	    	$('.changable').mouseover(function  () {
				$(this).attr('src',$(this).data('image2'))
			})
				$('.changable').mouseleave(function  () {
				$(this).attr('src',$(this).data('image'));
			})

	   		$('td img').click(function  ()
	   		 {
	    		$('.box img').attr('src',$(this).data('image3'));
	    		$('.box').show();
	    	})
	    	

		});
</script>

</head>
<body>
<div style="float:right; padding:20px;">

	<a href="insert.php"><input type="button" value="Yeni Müşteri Ekle" style="width:200px; height:50px;"></a>
	<a href="search.php"><input type="button" value="ARAMA YAP" style="width:200px; height:50px;"></a>

</div>
 

<form action="">
<h2>Müsteri Listesi</h2>
	<table cellpadding="10">
		<tr>
			<td></td>
			<td><b>Musteri Adi</b></td>
			<td><b>Soyadi</b></td>
			<td><b>Cep no</b></td>
			<td><b>E-mail</b></td>
			<td><b>not</b></td>
		</tr>
		<?php 
		//verileri listeleme işlemi
		//id degeri buyuk olan üstte gözükecek.
			$uye_id=$_SESSION["id"];
			
		$parent = $db->prepare('SELECT * FROM uyeler WHERE parent_id=?');
		$parent->execute(array($uye_id));
		
			foreach ($parent as $key) {
				$id=$key["id"];

				$sec=$db->prepare('SELECT * FROM musteri_uye WHERE uye_id=?');
				$sec->execute(array($id));

					foreach ($sec as $keyw) {
						$musteri_id=$keyw["musteri_id"];
				

					$musteri=$db->prepare('SELECT * FROM musteriler WHERE id=?');
					$musteri->execute(array($musteri_id));
		
		
						foreach($musteri as $row)
						{



		 ?>
		<tr>


			<td><div class="bas" style="cursor:pointer;"><img class="changable" border="0" data-image="<?=$row["image_80_80"];?>" data-image2="<?=$row["image_200_200"];?>" data-image3="<?=$row["image_300_300"];?>"src="<?=$row["image_80_80"];?>"></div></td>
			<td><div style="width:100px; word-wrap:break-word;" data-div="<?=$row["ad"]; ?>"><?=$row["ad"]; ?></div></td>
			<td><div style="width:100px; word-wrap:break-word;"><?=$row["soyad"]; ?></div></td>
			<td><div style="width:150px; word-wrap:break-word;"><?=$row["cep"]; ?></div></td>
			<td><div style="width:200px; max-height:50px;  word-wrap:break-word;"><?=$row["email"]; ?></div></td>
			<td><div style="width:500px; max-height:50px; overflow:auto; word-wrap:break-word;"><?=$row["ek"]; ?></div></td>
			<td><a href='update.php?id=<?=$row["id"]; ?>'>Edit</a></td>
			<td><a href='delete.php?id=<?=$row["id"]; ?>'>delete</a></td>
		</tr>
		<?php 

					}
			
				}
			}
	
		 ?>

	</table>
	
	
	<div class="box" style="display:none">
		<div onclick="$(this).parent().hide();" class="kapat">X</div>
		<img style="margin-top:100px;" border="0"   /> 
	</div>
	
</form>
</div>
</body>
</html>
