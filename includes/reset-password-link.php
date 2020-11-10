<?php
$output='<p>Dear user,</p>';
$output.='<p>Please click the following link to reset your password.</p>';
$output.='<p>------------------------------------------------</p>';
/* ** FOR ONLINE SERVER **

	$output.='<p><a href="https://www.developerspot.co.ke/templates/reset-password.html.php?
key='.$token.'&email='.$email.'&action=subscribe" target="_blank">

** */

/* For Local Server */
$output.='<p><a href="localhost/spexproject/templates/reset-password.html.php?
key='.$token.'&email='.$email.'&action=reset" target="_blank">
Recover my password</a></p>';		
$output.='<p>------------------------------------------------</p>';
$output.='The link will expire after 1 hour for security reasons.</p>';
$output.='<p>If you did not request this forgotten password email, no action 
is needed, your password will not be reset. However, you may need to log into 
your account and change your security password as someone may be trying to guess it.</p>';   	
$output.='<p>Thanks,</p>';
$output.='<p>Developerspot Team</p>';
$body = $output; 
$subject = "Password Recovery";
$email_to = $email;
$fromserver = "noreply@developerspot.co.ke"; 
require __DIR__ .'/../../includes_devspot/EmailCredentials.php';
require __DIR__ .'/../PHPMailer/PHPMailerAutoload.php';
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host = 'smtp.gmail.com'; /* // Enter your host here */
$mail->SMTPAuth = true;
$mail->Username = EMAIL; /* // Enter your email here */
$mail->Password = PASS; /* //Enter your password here */
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->IsHTML(true);
$mail->From = EMAIL;
$mail->FromName = "Developerspot";
$mail->Sender = $fromserver; /* // indicates ReturnPath header */
$mail->Subject = $subject;
$mail->Body = $body;
$mail->AddAddress($email_to);
if(!$mail->Send()){
	$email_error = ' <div class="errorMsg"> Message could not be sent. Mailer Error: '. $mail->ErrorInfo .'</div>';
}else{
	header('Location: ../templates/mail-send.html.php');
	}
 