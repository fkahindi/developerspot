<?php

if (!isset($_SESSION)) {
	session_start();
}
include __DIR__ . '/../includes/loginStatus.php';
include __DIR__ . '/../includes/process_form.php';
if (isset($_POST['remove-account'])) {
	removeAccount();
}else if(isset($_POST['cancel'])){
	header('Location: '.BASE_URL.'index.php');
}
?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="canonical" href="https://www.developerspot.co.ke/remove-account">
	<title>Account Removal </title>
	<meta name="description" content="Enables a signed user remove their account from this site.">
	<link rel="stylesheet" href="<?php echo BASE_URL ?>resources/css/form.css">
	<link rel="icon" href="<?php echo BASE_URL ?>resources/icons/logo_icon.png" sizes="16x16 32x32" type="image/x-icon" />
</head>

<body>
	<div id="reset">

		<div class="form_image">
			<div class="banner-bar">
				<h2><?php include __DIR__ . '/../resources/banner/devpot-banner.php'; ?></h2>
			</div>
			<h3>Account Removal</h3>
			<div class="warning">
				<p><strong>Caution!</strong></p>
				<p>You are about to remove your account. <br/> Once you remove your account on this site, it will no longer be accessible. All posts, comments or replies associated with this account will also be removed.</p>
			</div>

		<form method="POST" action="">
			<input type="submit" name="remove-account" class="button-danger" value="Remove my Account">
			<input type="submit" name="cancel" class="button-cancel" value="Cancel">
		</form>
	</div>

</body>

</html>