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
	<link rel="canonical" href="https://www.developerspot.co.ke/templates/contact-me-form.html.php">
	<title>Contact Me Form</title>
    <meta name="description" content="Use this form to contact developerspot.">
	<meta name="keywords" content="contact me, email, developerspot">
	<link rel="stylesheet" href="<?php echo BASE_URL ?>resources/css/form.css" >
</head>
<body>
	<div id="contact-me">
		<div class="form_image">
			<div class="banner-bar"><h2>DevelopersPot</h2></div>
			<div id="error_msg"><?php echo(!empty($form_error)? $form_error :'');?></div>
			<h1>Contact Me </h1>
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
		
	</form>
    <div class="section">
		<p class="centered"><a href="<?php echo BASE_URL ?>index.php">Take me to Home page</a></p>
	</div>
</div>
	<!-- Scripts -->
	<script src="<?php echo BASE_URL ?>resources/js/jquery-1.7.2.min.js"></script>
	<script src="<?php echo BASE_URL ?>resources/js/form_check.js"></script>
</body>
</html>
