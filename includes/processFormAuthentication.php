<?php
	//Initialize session
	session_start();
	
	$fullname = $email = $password = $confirm_password = $new_password = $old_password ='';
	
	$errors =[];
	$valid = true;
	
	//This section handles user sign ups (user registration)
	
	if(isset($_POST['signup'])){
		
		//Check if the user is already logged in. If yes redirect to index page
		
		$fullname =test_input($_POST['fullname']);
		$email =test_input($_POST['email']);
		$password =test_input($_POST['password']);
		$confirm_password =test_input($_POST['confirm_password']);
		$date_reg = new DateTime();
		

		//Incase any field is left blank
		if(empty($_POST['fullname'])){
			$valid = false;
			$errors['fullname'] = 'Name cannot be blank';
		}else{
			$fullname = test_input($_POST['fullname']);
			
			//Check if name contain only aphabet and whitespaces
			if (!preg_match("/^[a-zA-Z ]*$/",$fullname)) {
			$errors['fullname'] = "Only letters and white space allowed in names";  
			} 
		}
		
		if(empty($_POST['email'])){
			$valid = false;
			$errors['email'] ='Email cannot be blank';
		}else{
			$email=trim($_POST['email']);
			$email = test_input($_POST['email']);
			
			//Check if email address is well formed
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$valid = false;
				$errors['email'] = 'Invalid email address';
			}	
		}

		if(empty($_POST['password'])){
			$valid = false;
			$errors['password'] ='Enter Password';
		}
		if(empty($_POST['confirm_password'])){
			$valid = false;
			$errors['confirm_password'] ='Confirm Password';
		}
		if($_POST['password'] != $_POST['confirm_password']){
			$valid = false;
			$errors['confirm_password'] = 'Passwords did not match';
		}
		if(!empty($errors)){
			$successMsg = 'Congratulations! You are now registered with us.';
			$loginMsg = 'Please, login to continue.';
			
			include __DIR__ .'/../templates/signup.html.php';
					
		}else{
			include __DIR__ .  '/../includes/DatabaseConnection.php';
			
			include __DIR__ .'/../classes/Controllers/signup.php';
					
		}
}
	
	// This section handles logins
	if(isset($_POST['login'])){
		
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
			include __DIR__ .'/../includes/DatabaseConnection.php';
			include __DIR__ . '/../classes/Controllers/login.php';
		}
		
	}
	
	if(isset($_POST['change_password'])){
		
		//Check if user is logged in, if not redirect to login page
		include __DIR__ . '/loginStatus.php';
		
		$old_password = $_POST['old_password'];
		$new_password = $_POST['new_password'];
		$confirm_new_password = $_POST['confirm_new_password'];
		
		if(empty($_POST['old_password'])){
			$valid = false;
			$errors['old_password'] = 'You must enter your old password';
		}else if(empty($new_password)){
			$valid = false;
			$errors['new_password'] = 'Enter the new password';
		}else if(empty($confirm_new_password)){
			$valid = false;
			$errors['confirm_new_password'] = 'Confirm your new password';
		}else if($_POST['new_password'] !== $_POST['confirm_new_password']){
			$valid = false;
			$errors['confirm_new_password'] ='Your new password did not match';
		}else{
			$valid = true;
			$old_password = trim('old_password');
			$new_password = trim($_POST['new_password']);
			$confirm_new_password = trim('confirm_new_password');
		}
				
		if(!$valid){
			include __DIR__ . '/../templates/change-password.html.php';
		}else{
			include __DIR__ .  '/../includes/DatabaseConnection.php';
			
			include __DIR__ . '/../classes/Controllers/updatepassword.php';
		}
		
	}
	
	if(isset($_POST['recover_password'])){
		
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
						
				}
		}		
		if(!$valid){
			//Display the form again
			include __DIR__ . '/../templates/recover-password.html.php';
			
		}else{
			require __DIR__ .  '/../includes/DatabaseConnection.php';
			
			include __DIR__ . '/../classes/Controllers/passwordrecovery.php';
		}
		
	}
	
	if(isset($_POST['reset-password'])){
		$new_password = $_POST['new_password'];
		$confirm_new_password = $_POST['confirm_new_password'];
		
		if(empty($_POST['new_password'])){
			$valid = false;
			$errors['new_password'] = 'Type your new password';
		}else if(empty($_POST['confirm_new_password'])){
			$valid = false;
			$errors['confirm_new_password'] = 'Confirm your new password';
		}else if($_POST['new_password'] != $_POST['confirm_new_password']){
			$valid =false;
			$errors['confirm_new_password'] = 'Passwords did not match'; 
		}else{
			$valid = true;
			$new_password = trim($_POST['new_password']);
			
		}
		
		if(!$valid){
			echo 'Password reset was not successful, try again later';
		}else{
			require __DIR__ .  '/../includes/DatabaseConnection.php';
			
			include __DIR__ . '/../classes/Controllers/resetpassword.php';
		}
		
	}
	function test_input($data){
	
	$data=stripslashes($data);
	$data=htmlspecialchars($data, ENT_QUOTES);
	return $data;
	}