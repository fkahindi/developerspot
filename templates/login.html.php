<?php
if(!isset($_SESSION)){
	session_start();
} 
include_once __DIR__ . '/../includes/process_form.php';
if(isset($_POST['login'])){
	login();
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="canonical" href="https://www.developerspot.co.ke/login">
	<title>Log in Form</title>
    <meta name="description" content="Use email and password to login to developerspot system.">
	<meta name="keywords" content="login, email address, password, developerspot">
	<link rel="stylesheet" href="<?php echo BASE_URL ?>resources/css/form.css">
</head>
<body>
	<h4 class="successMsg"><?php echo(!empty($_SESSION['success_msg'])? $_SESSION['success_msg']:'');?></h4>
		
	<div id="login">
		<h5 class="errorMsg"><?php echo(isset($form_error)? $form_error: '');?></h5>
		<div class="form_image">
			<div class="banner-bar"><h2>DevelopersPot</h2></div>
			<h1>Login</h1>
		</div>
		<form method="POST" action="">
			<label for="email">Email address:</label>
			 <input type="text" name="email" value="<?php echo (!empty($email)? $email:'');?>" autocomplete="off"> <span class="errorMsg"><?php echo (!empty($errors['email'])? $errors['email'] :'');?></span>
			
			<label for="password">Password: <span class="right-align"> </span></label>
			 <input type="password" name="password" autocomplete="off" >
			<span class="errorMsg"><?php echo (!empty($errors['password'])? $errors['password'] :'');?></span>
					
			<input type="submit" name="login" class="button" value="Log in"> 
            <div class="g-signin2" data-onsuccess="onSignIn"></div>
			<?php echo(!empty($signup_option)? $signup_option : '');?>	
		</form>
	</div>
	<div class="section">
		<p class="centered"><a href="<?php echo BASE_URL ?>recover-password">Forgot password</a> | <a href="<?php echo BASE_URL ?>create-account"> Create an account</a></p>
	</div>
</body>
</html>