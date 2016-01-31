<!DOCTYPE html>
<html>
<head>
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
	<title>SEARCH</title>
<meta charset="utf-8">
	
<script>				

         
	
	    $(function(){


	    	$('.changable').mouseover(function  () {
						$(this).attr('src',$(this).data('image2'))
					})
					$('.changable').mouseleave(function  () {
						$(this).attr('src',$(this).data('image'));
					})
					
	
	    $('td img').click(function  () {
	    	$('.box img').attr('src',$(this).data('image3'));
	    	$('.box').show();
	    })
		
	});
</script>

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

</head>
<body>
<div>
	<form action="" method="post">
		<table style="margin-left:auto; margin-right:auto; margin-top:30px; margin-bottom:20px;">
			<tr>
				<td><label for="search">Arama Yap : </label></td>
				<td><input style="width:300px;" type="text" name="search" id="search"></td>
				<td><input type="submit" value="ARA"></td>
			</tr>
		</table>
	</form>
</div>
</body>
</html>

<?php 
include("db.php");

if(!empty($_POST["search"]))
{
$key=$_POST["search"];
$keyw=explode(" ",$key);


	if(isset($keyw[1])=="")
	{
	
	$search = $db->prepare("SELECT * FROM musteriler WHERE ad LIKE ? or soyad LIKE ? or cep LIKE ? or email LIKE ? or ek LIKE ?");
	$search->execute(array('%'.$keyw[0].'%','%'.$keyw[0].'%','%'.$keyw[0].'%','%'.$keyw[0].'%','%'.$keyw[0].'%'));
	
	}else{
	
	$search = $db->prepare("SELECT * FROM musteriler WHERE ad LIKE ? and soyad LIKE ? or cep LIKE ? or email LIKE ? or ek LIKE ?");
	$search->execute(array('%'.$keyw[0].'%','%'.$keyw[1].'%','%'.$keyw[0].'%','%'.$keyw[0].'%','%'.$keyw[0].'%'));
	
	}

	if($search)
	{
		?>
				<table cellpadding="10" style="border:1px solid #ccc">
					<tr>
						<td style="border:1px solid #ccc"><div style="width:100px; color:red;">Resim</div></td>
						<td style="border:1px solid #ccc"><div style="width:100px; color:red;">Musteri Adi</div></td>
						<td style="border:1px solid #ccc"><div style="width:100px; color:red;">Soyadi</div></td>
						<td style="border:1px solid #ccc"><div style="width:150px; color:red;">Cep no</div></td>
						<td style="border:1px solid #ccc"><div style="width:150px; color:red;">E-mail</div></td>
						<td style="border:1px solid #ccc"><div style="width:610px; color:red;">not</div></td>
					</tr>
				</table>

<?php
		foreach ($search as $row) {
?>

			<table cellpadding="10" style="border:1px solid #ccc">
				
				<tr>
					<td><div class="bas" style="cursor:pointer;"><img class="changable" border="0" data-image="<?=$row["image_80_80"];?>" data-image2="<?=$row["image_200_200"];?>" data-image3="<?=$row["image_300_300"];?>"src="<?=$row["image_80_80"];?>"></div></td>
					<td style="border:1px solid #ccc"><div style="width:100px; word-wrap:break-word;"><?=$row["ad"]; ?></div></td>
					<td style="border:1px solid #ccc"><div style="width:100px; word-wrap:break-word;"><?=$row["soyad"]; ?></div></td>
					<td style="border:1px solid #ccc"><div style="width:150px; word-wrap:break-word;"><?=$row["cep"]; ?></div></td>
					<td style="border:1px solid #ccc"><div style="width:150px; max-height:50px;  word-wrap:break-word;"><?=$row["email"]; ?></div></td>
					<td style="border:1px solid #ccc"><div style="width:500px; max-height:50px; overflow:auto; word-wrap:break-word;"><?=$row["ek"]; ?></div></td>
					<td style="border:1px solid #ccc"><a href='update.php?id=<?=$row["id"]; ?>'>Edit</a></td>
					<td style="border:1px solid #ccc"><a href='delete.php?id=<?=$row["id"]; ?>'>delete</a></td>
				</tr>

			</table>
	
<?php
		}
	}	
}

 ?>
 <div class="box" style="display:none">
		<div onclick="$(this).parent().hide();" class="kapat">X</div>
		<img border="0"   /> 	
	</div>