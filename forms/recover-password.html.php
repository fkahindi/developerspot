<?php 
include __DIR__ .'/../includes/process_form.php'; 
if(isset($_POST['recover_password'])){
	recoverPassword();	
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="canonical" href="https://www.developerspot.co.ke/recover-password">
	<title>Recover Password </title>
    <meta name="description" content="Helps user recover forgotten password.">
	<link rel="stylesheet" href="<?php echo BASE_URL ?>resources/css/form.css">
	<link rel="icon" href="<?php echo BASE_URL ?>resources/icons/logo_icon.png" sizes="16x16 32x32" type="image/x-icon"/>
</head>
<body>
	<div id="recover">
		<div class="form_image">
			<div class="banner-bar"><h2><?php include __DIR__ .'/../resources/banner/devpot-banner.php';?></h2></div>
			<div id="error_msg"><?php echo(!empty($email_error)? $email_error :'');?></div>
			<p class="form-p">We will send you instructions to recover your password.</p>
			<h1>Recover Password</h1>
		</div>
		<form method="POST" action="">
			<label for="email">Enter your email address:</label>
			 <input type="email" value="<?php echo(empty($email)? '': $email); ?>" name="email" maxlength="50" autocomplete="off"> <span class="errorMsg">
			 <?php echo (!empty($errors['email'])? $errors['email'] :'');?></span>
			 
			<input type="submit" name="recover_password" class="button" value="Submit"> 
		</form>
	</div>
    <div class="section">
		<p class="centered"><a href="<?php echo BASE_URL ?>login">Let me try again</a></p>
	</div>
</body>
</html>