<?php
global $form_error;
$body = $comment; 
$subject = "Inquiry from ".$contact_email;
 
$email_to = "fkahindi@developerspot.co.ke";
$fromserver = "noreply@developerspot.co.ke"; 
require __DIR__ .'/../../includes_devspot/EmailCredentials.php';
require __DIR__ .'/../PHPMailer/PHPMailerAutoload.php';
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host = 'smtp.gmail.com'; /*  Enter your host here */
$mail->SMTPAuth = true;
$mail->Username = EMAIL; /*  Enter your email here */
$mail->Password = PASS; /* Enter your password here */
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->IsHTML(true);
$mail->From = $contact_email;
$mail->FromName = $name;
$mail->Sender = $fromserver; /* indicates ReturnPath header */
$mail->Subject = $subject;
$mail->Body = $body .'<br> From '.$name .'<br> '.$contact_email;
$mail->AddAddress($email_to);
if(!$mail->Send()){
	$form_error = 'Oops! Sending error has occured.'. $mail->ErrorInfo;
}else{
   $_SESSION['message_success'] = "Thank you for reaching out to me. Depending on what you are enquiring I will get back to you.";
    header('Location: '.BASE_URL.'thank-you.php');
}