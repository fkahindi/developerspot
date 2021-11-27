<?php

if (!isset($_SESSION)) {
	session_start();
}
include __DIR__ . '/../includes/loginStatus.php';
include __DIR__ . '/../includes/process_form.php';
if (isset($_POST['change_password'])) {
	changePassword();
}
?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="canonical" href="https://www.developerspot.co.ke/change-password">
	<title>Change Password </title>
	<meta name="description" content="Helps user to change old password.">
	<link rel="stylesheet" href="<?php echo BASE_URL ?>resources/css/form.css">
	<link rel="stylesheet" href="<?php echo BASE_URL ?>resources/font-awesome-4.7.0/css/font-awesome.css" />
	<link rel="icon" href="<?php echo BASE_URL ?>resources/icons/logo_icon.png" sizes="16x16 32x32" type="image/x-icon" />
</head>

<body>
	<div id="reset">

		<div class="form_image">
			<div class="banner-bar">
				<h2><?php include __DIR__ . '/../resources/banner/devpot-banner.php'; ?></h2>
			</div>
			<p class="form-p">Fields marked with <span class="red"> &#42;</span> are mandatory. </p>
			<h1>Change Password</h1>
		</div>
		<form method="POST" action="">
			<div class="group-form">
				<label for="old_password">Old Password:<span class="red"> &#42;</span></label>
				<input type="password" name="old_password" id="password_1" maxlength="50" autocomplete="off" required>
				<i class="fa fa-eye" id="toggle_view1" data-id="1"></i>
				<span class="errorMsg"><?php echo (!empty($errors['old_password']) ? $errors['old_password'] : ''); ?></span>
			</div>

			<div class="group-form">
				<label for="new_password">New Password:<span class="red"> &#42;</span></label>
				<input type="password" name="new_password" id="password_2" maxlength="50" autocomplete="off" required>
				<i class="fa fa-eye" id="toggle_view2" data-id="2"></i>
				<span class="errorMsg"><?php echo (!empty($errors['new_password']) ? $errors['new_password'] : ''); ?></span>
				<ul class="form-guidelines">
					<li>Passwords must be at least <strong>6</strong> characters.</li>
					<li>May contain letters, numbers, underscore, hyphen or dot.</li>
				</ul>
			</div>

			<div class="group-form">
				<label for="confirm_new_password">Confirm New Password:<span class="red"> &#42;</span></label>
				<input type="password" name="confirm_new_password" id="password_3" maxlength="50" autocomplete="off" required>
				<i class="fa fa-eye" id="toggle_view3" data-id="3"></i>
				<span class="errorMsg"><?php echo (!empty($errors['confirm_new_password']) ? $errors['confirm_new_password'] : ''); ?></span>
			</div>

			<input type="submit" name="change_password" class="button" value="Change">
		</form>
	</div>
	<!-- visibility:hidden -->
	<script src="<?php echo BASE_URL ?>resources/js/jquery-3.4.0.min.js"></script>
	<script src="<?php echo BASE_URL ?>resources/js/show-hide-password.js"></script>
</body>

</html>