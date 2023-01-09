<?php
/* check if user already loged in, if not redirect to login page */
if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin']!= true){
		header('Location: <?php echo BASE_URL ?>login');
		exit;
}
if(!empty($_SESSION['email']) && !empty($_SESSION['user_id']) ){
	$email = $_SESSION['email'];
	$user_id = $_SESSION['user_id'];
}else{
	/* There is a problem, some session values missing credentials */
	include __DIR__ . '/logout.php';
}

