x<?php
   require("PHPMailerAutoload.php"); // path to the PHPMailerAutoload.php file.

 
   $mail = new PHPMailer();
   $mail->IsSMTP();
   $mail->Mailer = "smtp";
   $mail->Host = "smtp-mail.outlook.com";
   $mail->Port = "587";

   $mail->SMTPAuth = true;
   $mail->SMTPSecure = 'tls';
   $mail->Username = "nina-roeckelein@hotmail.de";
   $mail->Password = "351dfc2d43";
    
   $mail->From     = "nina-roeckelein@hotmail.de";
   $mail->FromName = "absendername";
   $mail->AddAddress("nina-roeckelein@hotmail.de", "empfaengername");
   $mail->AddReplyTo("nina-roeckelein@hotmail.de", "absendername");
 
   $mail->Subject  = "Hi!";
   $mail->Body     = "Hi! How are you?";
   $mail->WordWrap = 50;  
 
   if(!$mail->Send()) {
		echo 'Message was not sent.';
		echo 'Mailer error: ' . $mail->ErrorInfo;
		exit;
   } else {
		echo 'Message has been sent.';
   }
?>
