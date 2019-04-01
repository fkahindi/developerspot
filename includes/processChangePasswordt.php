<?php
	//Initialize session
	
	session_start();
	
	//check if user already loged in, if yes redirect to welcome page
	
	if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin']!== true){
		header('Location: ../templates/login.html.php');
		exit;
	}
	
	$errors =[];
	$valid = true;
	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		
		$old_password = $_POST['old_password'];
		$new_password = $_POST['new_password'];
		$confirm_new_password = $_POST['confirm_new_password'];
		
		if(empty($_POST['old_password'])){
			$valid = false;
			$errors['old_password'] = 'You must enter your old password';
		}else if(empty(new_password)){
			$valid = false;
			$errors['new_password'] = 'Enter the new password';
		}else if(empty(confirm_new_password)){
			$valid = false;
			$errors['confirm_new_password'] = 'Confirm your new password';
		}else if($_POST['new_password'] !== $_POST['confirm_new_password']){
			$valid = false;
			$errors['confirm_new_password'] ='Your new password did not match';
		}else{
			$valid = true;
			$old_password = trim()'old_password';
			$new_password = trim($_POST['new_password']);
			$confirm_new_password = trim('confirm_new_password');
		}
				
		if(!$valid){
			include __DIR__ . '/../templates/passwordreset.html.php';
		}else{
			include __DIR__ . '/../classes/Controllers/passwordreset.php';
		}
		
	}
	
	