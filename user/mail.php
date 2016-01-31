<?php
   	include ("../crud/db.php");
    require("class.phpmailer.php");
    require("class.smtp.php");

    $mail = new PHPMailer();

    // ---------- adjust these lines ---------------------------------------
    $mail->Username = ""; // your GMail user name
    $mail->Password = ""; //your GMail password
    $mail->AddAddress($email); // recipients email
    $mail->FromName = "5-UserManagementWithThyself"; // readable name

    $mail->Subject = "E-Mail Onay";


    $mail->Body    = "https://localhost/5-UserManagementWithThyself/user/aktivasyon.php?kod=".$sifre; 
    //-----------------------------------------------------------------------

    $mail->Host = "ssl://smtp.gmail.com"; // GMail
    $mail->Port = 465;
    $mail->IsSMTP(); // use SMTP
    $mail->SMTPAuth = true; // turn on SMTP authentication
    $mail->From = $mail->Username;
    if(!$mail->Send())
        echo "Mailer Error: " . $mail->ErrorInfo;

?>