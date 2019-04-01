<?php
	//Initialize session
	
	session_start();
	
	//check if user already loged in, if yes redirect to welcome page
	
	if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']=== true){
		header('Location: ../index.php');
		exit;
	}
	
	$errors =[];
	$valid = true;
	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		
		$email = $_POST['email'];
		$password = $_POST['password'];
		
		if(empty($_POST['email'])){
			$valid = false;
			$errors['email'] = 'You did not enter your email';
		}else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$valid = false;
				$errors['email'] = 'Invalid email';
			}else{
			$email = test_input($_POST['email']);
	
		}
		
		if(empty($_POST['password'])){
			$valid = false;
			$errors['password'] = 'You did not type a password';
		}else{
			$password =trim($_POST['password']);
		}
		if(!$valid){
			include __DIR__ . '/../templates/login.html.php';
		}else{
			include __DIR__ . '/../classes/Controllers/login.php';
		}
		
	}
	
	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	