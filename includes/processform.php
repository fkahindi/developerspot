<?php 

$fullname = $email = $password = $confirm_password ='';

	
	//Assume data is valid
	$valid = true;
	$errors = [];
	
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
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

function test_input($data){
	
	$data=stripslashes($data);
	$data=htmlspecialchars($data, ENT_QUOTES);
	return $data;
}