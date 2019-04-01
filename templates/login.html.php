<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" href="../resources/css/form.css">
</head>
<body>
	<h3 class="successMsg"><?php echo(!empty($successMsg)? $successMsg :'');?></h3>
	<p><?php echo(!empty($loginMsg)? $loginMsg :''); ?></p>
	<div id="login">
	<h2>Login</h2>
	
		<form method="POST" action="../includes/processLogin.php">
			<label for="email">Email:</label>
			 <input type="text" name="email" value="<?php echo (!empty($email)? $email:'');?>"autocomplete="off"> <span class="errorMsg"><?php echo (!empty($errors['email'])? $errors['email'] :'');?></span>
			<label for="password">Password:</label>
			 <input type="password" name="password" autocomplete="off">
			<span class="errorMsg"><?php echo (!empty($errors['password'])? $errors['password'] :'');?></span>
					
			<input type="submit" name="submit" class="button" value="Login"> 
			<?php echo(!empty($signup_option)? $signup_option : '');?>
			<?php echo(!empty($recover_password_option)? $recover_password_option : '');?>
			
		</form>
	</div>
</body>
</html>