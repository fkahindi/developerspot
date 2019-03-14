<?phpdeclare(strict_types=1;)
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="Francis Kahindi">
	<title>Spex Management Solutions: Consulting</title>
	<link rel="stylesheet" href="resources/css/main.css">
	<link rel="stylesheet" href="resources/css/form.css">
	<link rel="icon" href="resources/icons/logoicon.png" sizes="16x16 32x32" type="image/x-icon">
	<script type="text/javascript" src="resources/js/dates.js"></script>
</head>
<body>
	<header>
		<div class="group">
			<div class="login-bar">
				<a href="resources/pages/loginForm.php">Login </a> <span>&#124;</span>
				<a href="#">Sign up</a> 
			</div><!--
		
			--><div class="banner">
				<img src="resources/images/spexbanner.png" alt="Spex Banner" width="60%" height="60%">
			</div>
		</div>
		<div class="dropdown">
			<button class="dropdown-button">|||</button>
			<nav class="dropdown-content">
				<ul> 
					<li><a href="#">Home</a></li> <span>&#124;</span>
					<li><a href="#"> About</a></li> <span>&#124;</span>
					<li><a href="#"> Data Science</a></li> <span>&#124;</span>
					<li><a href="#"> Developer</a></li> <span>&#124;</span>
					<li><a href="#"> Contact Us</a></li>
				</ul>	
		
			</nav>
		</div>
	</header>
	<main class="group">
		<section class='col-3-5'>
			<h1>Welcome</h1>
	
		</section><!--
		--><aside class='col-2-5'>
			<?phpdeclare(strict_types=1;)
				//Echo session variables set in session.php file
				echo "Favourite color is ".$_SESSION["favcolor"];
				echo "Favourite pet is ".$_SESSION["favpet"];  
			?>
		</aside>
	
	</main>
	<footer>
		<div class="group">
			<span class="float-right">
				<ul> 
					<li><a href="#">| Home |</a></li>
					<li><a href="#"> About |</a></li>
					<li><a href="#"> Data Science |</a></li>
					<li><a href="#"> Developer|</a></li>
				</ul>	
			</span>
			<span class="float-left">&copy;<?php date_default_timezone_set("Africa/Nairobi");echo date('Y');?>&nbsp;Spexdata.com</span>
		</div>
		
	</footer>
</body>
</html>