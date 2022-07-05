<?php 
if(!isset($_SESSION)){
	session_start();
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Email | Message Success</title>
	<link rel="stylesheet" href="../resources/css/thank-you.css">
</head>
<body>
	<?php if(!empty($_SESSION['email_success'])):?>
		<div class="card">
			<div class="success"><?php echo $_SESSION['email_success']; ?></div>
			<p> <a href="../login"> Continue</a> ...</p>
			<?php unset($_SESSION['email_success']);?>
		</div>
	<?php else: ?>
	<?php echo ''; endif; ?>	

	<?php if(!empty($_SESSION['message_success'])):?>
		<div class="card">
			<p class="success"><?php echo($_SESSION['message_success']) ?> </p>
			<p> <a href="index.php"> Continue</a> ...</p>
			<?php unset($_SESSION['message_success']);?>
		</div>
	<?php else: ?>
	<?php echo ''; endif; ?>
	
</body>
</html>