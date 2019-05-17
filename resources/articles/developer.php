<?php
session_start();

include __DIR__ . '/../../includes/loginStatus.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include __DIR__ .'/../../templates/head.html.php';?>
</head>
<body>
	<header>
		<?php include __DIR__ .'/../../templates/header.html.php';?>
	</header>
	<main class="group">
		<section class='col-3-5'>
			<?php ''; ?>
			
		</section><!--
		--><aside class='col-2-5'>
			
		</aside>
	
	</main>
	<footer>
		<div class="group">
			<span class="float-right">
				<?php include  __DIR__ .'/../../templates/nav.html.php'; ?>	
			</span>
			<span class="float-left">&copy;<?php date_default_timezone_set("Africa/Nairobi");echo date('Y');?>&nbsp;Spex.co.ke</span>
		</div>
		
	</footer>
</body>
</html>
