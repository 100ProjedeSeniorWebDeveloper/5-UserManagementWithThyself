<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<title></title>
	<style>
		.user{
			border:1px solid #ccc;
			 padding:10px;
			 width:300px;	
			 float:left;
			 margin-left:50px;
			margin-right:50px;
			  }
		.user input{margin-top:5px;}
		#forms{
			margin-left: auto;
			margin-right: auto;
			height:225px;
			width:900px;
			margin-top:200px;
					}
	</style>
</head>
<body>
<div id="forms">
	<div class="user">
		<form action="giris_yap.php" method="post">
		<h3>GİRİŞ YAP</h3>
			<table>
				<tr>
					<td>email:</td>
					<td><input type="text" name="email"></td>
				</tr>
				<tr>
					<td>Şifre</td>
					<td><input type="password" name="password"></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit"></td>
				</tr>
			</table>
		</form>
	</div>
	<div class="user">
		<form action="kayit_ol.php" method="post">
			<h3>Kayıt Ol</h3>
			<table>
				<tr>
					<td>E-mail:</td>
					<td><input type="text" name="email"></td>
				</tr>
				<tr>
					<td>Şifre:</td>
					<td><input type="password" name="password"></td>
				</tr>
				<tr>
					<td>Şifre Tekrar:</td>
					<td><input type="password" name="password2"></td>
				</tr>
				
				<tr>
					<td></td>
					<td><input type="submit"></td>
				</tr>
			</table>
		</form>
	</div>
</div>
</body>
</html>