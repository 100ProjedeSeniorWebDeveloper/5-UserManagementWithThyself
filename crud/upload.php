<?php

 if($_FILES['image']['type']=="image/jpeg" || $_FILES['image']['type']== "image/png" || $_FILES['image']['type'] == "image/jpg"){
 	if(!file_exists('image'))
 	{
 		mkdir('image');
 	}
$dizin = 'image/';
$u_image = $dizin . md5(microtime()). basename($_FILES['image']['name']);
 
 
move_uploaded_file($_FILES['image']['tmp_name'], $u_image);


$image = $u_image;
header('Content-Type: image/jpeg');
$image_size = getimagesize($image);
$image_width = $image_size[0];
$image_height = $image_size[1];
//************* 80px*80px ********//
$new_width = 80;
$new_height = 80;

$name_80_80=$dizin . md5(microtime()). basename($_FILES['image']['name']);

$new_image = imagecreatetruecolor($new_width, $new_height);
$old_image = imagecreatefromjpeg($image);

imagecopyresampled($new_image, $old_image, 0, 0, 0, 0, $new_width, $new_height, $image_width, $image_height);
imagejpeg($new_image,$name_80_80);
//*********** 200px*200px ***********//
$new_width = 200;
$new_height = 200;

$new_image = imagecreatetruecolor($new_width, $new_height);
$old_image = imagecreatefromjpeg($image);

$name_200_200=$dizin . md5(microtime()). basename($_FILES['image']['name']);

imagecopyresampled($new_image, $old_image, 0, 0, 0, 0, $new_width, $new_height, $image_width, $image_height);
imagejpeg($new_image,$name_200_200);
/************300px*300px*********/
$new_width = 300;
$new_height = 300;

$new_image = imagecreatetruecolor($new_width, $new_height);
$old_image = imagecreatefromjpeg($image);

$name_300_300=$dizin . md5(microtime()). basename($_FILES['image']['name']);

imagecopyresampled($new_image, $old_image, 0, 0, 0, 0, $new_width, $new_height, $image_width, $image_height);
imagejpeg($new_image,$name_300_300);

unlink($u_image);
}else
{
	echo "yükleme işlemi basarısız";
}
?>