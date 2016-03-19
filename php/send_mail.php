<?php
   require("../PHPmailer/PHPMailerAutoload.php"); // path to the PHPMailerAutoload.php file.

 
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
   $mail->FromName = "Ferienschule";
   $mail->AddAddress($email, "$firstname $lastname");
   $mail->AddReplyTo("nina-roeckelein@hotmail.de", "Ferienschule");
 
   $mail->Subject  = "Anmeldung zur Ferienschule";
   $mail->Body     = $mail_text;
   $mail->WordWrap = 50;  
 
   if(!$mail->Send()) {
		echo 'Message was not sent.';
		echo 'Mailer error: ' . $mail->ErrorInfo;
		exit;
   } else {
		echo 'Message has been sent.';
   }
?>