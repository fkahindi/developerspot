<?php

 ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Recover Password </title>
	<link rel="stylesheet" href="../resources/css/form.css">
</head>
<body>
	<p>Please fill out this form to recover your password.</p>
	<div id="recover">
	<h2>Recover Password</h2>
	
		<form method="POST" action="../includes/processFormAuthentication-Test.php">
			<label for="email">Enter your email:</label>
			 <input type="email" name="email" autocomplete="off"> <span class="errorMsg">
			 <?php echo (!empty($errors['email'])? $errors['email'] :'');?></span>
			 
			<input type="submit" name="recover_password" class="button" value="Submit"> 
		</form>
	</div>
</body>
</html>