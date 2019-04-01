<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sign Up</title>
	<link rel="stylesheet" href="../resources/css/form.css">
</head>
<body>
	<div id="register">
		<h2>Sign Up Form </h2>
		<form action="../includes/processform.php" method ="POST" name="signup">
		
			<div class="group-form">
				<label for="fullname">Full Name:</label>
				<input  name="fullname" id="fullname" class="form-control" type="text" 
				value="<?php echo (empty($fullname)? '': $fullname); ?>" autocomplete="off">
				<span class="errorMsg"> <?php echo(!empty($errors['fullname']) ? $errors['fullname'] : ''); ?></span>
			</div>
			
			<div class="group-form">
				<label for="email"> Email:</label>
				<input name="email" id="email" class="form-control" type="text" 
				 type="email" value="<?php echo(empty($email)? '': $email); ?>" autocomplete="off">
				<span class="errorMsg"> <?php echo(!empty($errors['email']) ? $errors['email'] : ''); ?> </span>
			</div>

			<div class="group-form">
				<label for="password">Password:</label>
				<input name="password" id="password" class="form-control" type="password" autocomplete="off">
				<span class="errorMsg" ><?php echo(!empty($errors['password']) ? $errors['password'] : ''); ?></span>
			</div>
			
			<div class="group-form">
			<label for="confirm_password">Confirm Password:</label>
			<input name="confirm_password" id="confirm_password" class="form-control" type="password" autocomplete="off">
			<span class="errorMsg"><?php echo(!empty($errors['confirm_password']) ? $errors['confirm_password'] : ''); ?>	</span>
			</div>
			<input name="sumbit"  type="submit" class="button" value="Sign Up">
			<p>Aready have an account? <a href="login.html.php">Login here</a>.</p>

		</form>
	</div>
</body>
</html>