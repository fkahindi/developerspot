<?php
if (!isset($_SESSION)) {
	session_start();
}
if (isset($_GET['email']) && isset($_GET['key'])) {

	$email = $_GET['email'];
	$token = $_GET['key'];
	$username = $_GET['username'];
}

if (!empty($email) && !empty($token)) {
	require __DIR__ . '/../includes/process_form.php';

	if (isset($_POST['set-account-password'])) {
		setAccountPassword();
	}
?>
	<!doctype html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="canonical" href="https://www.developerspot.co.ke/templates/set-account-password.html.php">
		<title>Set Account Password</title>
		<meta name="description" content="Sets password for the account being created.">
		<link rel="stylesheet" href="<?php echo BASE_URL ?>resources/css/form.css" />
		<link rel="stylesheet" href="<?php echo BASE_URL ?>resources/font-awesome-4.7.0/css/font-awesome.css" />
		<link rel="icon" href="<?php echo BASE_URL ?>resources/icons/logo_icon.png" sizes="16x16 32x32" type="image/x-icon" />
	</head>

	<body>
		<div id="error_msg"></div>
		<div id="reset">
			<div class="form_image">
				<div class="banner-bar">
					<h2><?php include __DIR__ . '/../resources/banner/devpot-banner.php'; ?></h2>
				</div>
				<p class="form-p">Fields marked with <span class="red"> &#42;</span> are mandatory</p>
				<h1>Set Account Password</h1>
			</div>
			<form method="POST" name="set-password" action="">
				<input type="hidden" name="action" value="set">
				<div class="group-form">
					<label for="password">Password:<span class="red"> &#42;</span></label>
					<input type="password" id="password_1" data-id="1" name="password" value="<?php echo (empty($password) ? '' : $password); ?>" maxlength="50" autocomplete="off">
					<i class="fa fa-eye" id="toggle_view1" data-id="1"></i>
					<span class="errorMsg"><?php echo (!empty($errors['password']) ? $errors['password'] : ''); ?></span>
					<ul class="form-guidelines">
						<li>Passwords must be at least <strong>6</strong> characters.</li>
						<li>May contain letters, numbers, underscore, hyphen or dot.</li>
					</ul>
				</div>
				<div class="group-form">
					<label for="confirm_password">Confirm Password:<span class="red"> &#42;</span></label>
					<input type="password" id="password_2" data-id="2" name="confirm_password" value="<?php echo (empty($confirm_password) ? '' : $confirm_password); ?>" maxlength="51" autocomplete="off">
					<i class="fa fa-eye" id="toggle_view2" data-id="2"></i>
					<span class="errorMsg"><?php echo (!empty($errors['confirm_password']) ? $errors['confirm_password'] : ''); ?></span>
				</div>
				<input type="hidden" name="email" value="<?php echo $email; ?>">
				<input type="hidden" name="token" value="<?php echo $token; ?>">
				<input type="hidden" name="username" value="<?php echo $username; ?>">

				<input type="submit" name="set-account-password" id="submit_btn" class="button" value="Set Password">
			</form>
		</div>
		<script src="<?php echo BASE_URL ?>resources/js/show-hide-password.js"></script>
	</body>

	</html>
<?php
} else {
	echo 'Token was not found.';
}
?>