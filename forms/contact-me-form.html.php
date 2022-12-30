<?php
if(!isset($_SESSION)){
	session_start();
}
include __DIR__ .'/../includes/process_form.php';
if(isset($_POST['contact-me'])){
	contactMe();
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="canonical" href="https://www.developerspot.co.ke/contact.php">
	<title>Contact Me Form</title>
    <meta name="description" content="Use this form to contact developerspot.">
	<meta name="keywords" content="contact me, email, developerspot" >
	<link rel="stylesheet" href="<?php echo BASE_URL ?>resources/css/form.css" >
	<link rel="icon" href="<?php echo BASE_URL ?>resources/icons/logo_icon.png" sizes="16x16 32x32" type="image/x-icon"/>
	<script src="https://www.google.com/recaptcha/api.js?render=6LelO4YgAAAAALww0mhkyM1VG0Mkf81PolDntSf3"></script>
</head>
<body>
	<div id="contact-me">
		<div class="form_image">
			<div class="banner-bar"><h2><?php include __DIR__ .'/../resources/banner/devpot-banner.php';?></h2></div>
			<div id="error_msg"><?php echo(!empty($form_error)? $form_error :'');?></div>
			<h3>Contact Me </h3>
			<p>Fields marked with <span class="red"> &#42;</span> are mandatory. </p>
		</div>
	<form  method="POST" action="" id="signup_form" >
		<div class="group-form">
			<label for="name">Name:<span class="red"> &#42;</span></label>
			<input  name="name" id="name" class="form-control" type="text"
			value="<?php echo (empty($name)? '': $name); ?>" maxlength="50" autocomplete="off" >
			<span class="errorMsg"> <?php echo(!empty($errors['name']) ? $errors['name'] : ''); ?></span>
		</div>
		<div class="group-form">
			<label for="contact_email"> Email:<span class="red"> &#42;</span></label>
			<input name="contact_email" id="contact_email" class="form-control" type="email" value="<?php echo(empty($contact_email)? '': $contact_email); ?>" maxlength="50" autocomplete="off" >
			<span class="errorMsg"> <?php echo(!empty($errors['contact_email']) ? $errors['contact_email'] : ''); ?> </span>
		</div>
		<div class="group-form">
            <label for="comment">Type message below:</label>
			<textarea name="comment" id="comment" cols="40" rows="8" maxlength="1000" placeholder="Type your message here..." ></textarea>

		</div>
		<input name="contact-me" type="submit" id="contact_me_btn" value="Submit">
		<input type="hidden" id="token" name="token">
		<input type="hidden" name="action" value="validate_captcha">
	</form>
    <div class="section">
		<p class="centered"><a href="<?php echo BASE_URL ?>index.php">Take me to Home page</a></p>
	</div>
	<div class="g-policy">
		<a  href="https://policies.google.com/privacy" class="g-policy-a">Privacy Policy</a> and
    <a href="https://policies.google.com/terms" class="g-policy-a">Terms of Service</a> apply
	</div>
</div>
	<!-- Scripts -->
	<script src="<?php echo BASE_URL ?>resources/js/captcha.js"></script>
	<script src="<?php echo BASE_URL ?>resources/js/jquery-3.4.0.min.js"></script>
	<script src="<?php echo BASE_URL ?>resources/js/form_check.js"></script>
</body>
</html>
