<?php
session_start();

include __DIR__ . '/../includes/loginStatus.php';
 ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Password Reset</title>
	<link rel="stylesheet" href="../resources/css/form.css">
</head>
<body>
	<h4 class="errorMsg"><?php echo $_SESSION['fullname']; ?>, you are about to change your password. </h4>
	<p>Please, fill out this form to reset your password.</p>
	<div id="reset">
	<h2>Reset Password</h2>
	
		<form method="POST" action="../includes/processFormAuthentication-Test.php">
			<label for="old_password">Old Password:</label>
			 <input type="password" name="old_password" autocomplete="off">
			<span class="errorMsg"><?php echo (!empty($errors['old_password'])? $errors['old_password'] :'');?></span>
						 
			<label for="new_password">New Password:</label>
			 <input type="password" name="new_password" autocomplete="off">
			<span class="errorMsg"><?php echo (!empty($errors['new_password'])? $errors['new_password'] :'');?></span>
			
			<label for="confirm_new_password">Confirm New Password:</label>
			 <input type="password" name="confirm_new_password" autocomplete="off">
			<span class="errorMsg"><?php echo (!empty($errors['confirm_new_password'])? $errors['confirm_new_password'] :'');?></span>
					
			<input type="submit" name="change_password" class="button" value="Change"> 
		</form>
	</div>
</body>
</html>