<?php
session_start();

 ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Password Reset</title>
	<link rel="stylesheet" href="../resources/css/form.css">
</head>
<body>
	<h3> </h3>
	<p>Please fill out this form to reset your password.</p>
	<div id="reset">
	<h2>Reset Password</h2>
	
		<form method="POST" name ="reset-password" action="/spexproject/includes/processFormAuthentication.php">
		
			<input type="hidden" name="action" value="reset">
			
			<label for="new_password">New Password:</label>
			 <input type="password" name="new_password" autocomplete="off">
			<span class="errorMsg"><?php echo (!empty($errors['new_password'])? $errors['new_password'] :'');?></span>
			
			<label for="confirm_new_password">Confirm New Password:</label>
			 <input type="password" name="confirm_new_password" autocomplete="off">
			<span class="errorMsg"><?php echo (!empty($errors['confirm_new_password'])? $errors['confirm_new_password'] :'');?></span>
			
			<input type="hidden" name="email" value="<?php echo $email; ?>">
					
			<input type="submit" name="reset_password" class="button" value="Reset Password"> 
		</form>
	</div>
</body>
</html>