<?php

	
	//check if user already loged in, if yes redirect to welcome page
		
	$errors =[];
	$valid = true;
	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		
		$email = $_POST['email'];
				
		if(empty($_POST['email'])){
			$valid = false;
			$errors['email'] = 'You did not enter your email';
			
		}else{
			filter_var($email, FILTER_SANITIZE_EMAIL);
		
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
					$valid = false;
					$errors['email'] = 'Invalid email';
				}else{
					$valid = true;
					$email = $_POST['email'];	
				}
		}		
		if(!$valid){
			include __DIR__ . '/../templates/recoverpassword.html.php';
		}else{
			include __DIR__ .  '/../includes/DatabaseConnection.php';
			include __DIR__ . '/../classes/Controllers/passwordrecover.php';
		}
		
	}
	