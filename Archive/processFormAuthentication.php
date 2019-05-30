<?php
//Initialize session
session_start();

$fullname = $email = $password = $confirm_password = $new_password = $old_password ='';

$errors =[];
$valid = true;

//This section handles user sign ups (user registration)

if(isset($_POST['signup'])){
	
	
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
	
		include __DIR__ .'/../templates/signup.html.php';
				
	}else{
		try{			
			include __DIR__ .  '/../includes/DatabaseConnection.php';
			include __DIR__ .  '/../includes/DatabaseFunctions.php';
			
			$selectRecord = selectRecord($pdo,$_POST['email']);
			//$rownum =$selectRecord->rowCount();
			//echo $rownum;
			

			if($selectRecord->rowCount()==1){
				$valid = false;
				$errors['email'] = 'This email already exists';
				
				include __DIR__ .'/../templates/signup.html.php';
				
			}else{
				$valid = true;
				$email = $_POST['email'];
			}
			
			if($valid){
			$date_reg = new DateTime();	
			$date_reg = $date_reg->format('Y-m-d H:i:s');
			$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
			$insertRecord = insertRecord($pdo,$fullname, $email, $password, $date_reg );
			
			header('Location: ../templates/signupsuccessful.html.php');
			}

		}catch(PDOException $e){
			$title ='An error has occured';
			$output = 'Database error: ' . $e->getMessage() . ' in '
			. $e->getFile() . ':' . $e->getLine();
		}	
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
		
		try{
			include __DIR__ .'/../includes/DatabaseConnection.php';
			include __DIR__ .  '/../includes/DatabaseFunctions.php';
		
			$selectRecord = selectRecord($pdo,$_POST['email']);
				
			//Check if records exists in the database
			if($selectRecord->rowCount()==1){
				
				//Fetch the entire record
				$row = $selectRecord->fetch();
				
				//Assign record values to variable
				$id = $row['id'];
				$fullname = $row['fullname'];
				$email = $row['email'];
				$hashed_password = $row['password'];
				
				//Check if the password in database matches the one typed by user
				if(password_verify($password, $hashed_password)){
					//regenerate a new session id
					session_regenerate_id;
					
					//Store data in session variables
					$_SESSION['loggedin'] = true;
					$_SESSION['email'] = $email;
					$_SESSION['password']= $hashed_password;
					$_SESSION['fullname'] = $fullname;
						
					//Redirect to welcome page
					header('Location: ../templates/welcome.html.php');	
				}else{
					//Display error password
					
					$errors['password'] ='Incorrect email or password';
												
					include __DIR__ . '/../templates/login.html.php';
				}
				
			}else{
				//Display error message: the email does not exist
				$errors['email'] ='Email address does not exist';
				
				//Display login form again
				include __DIR__ . '/../templates/login.html.php';
			}	
		}catch(PDOException $e){
		$title ='An error has occured';
		$output = 'Database error: ' . $e->getMessage() . ' in '
		. $e->getFile() . ':' . $e->getLine();
		}
		
	}
	
}
	
if(isset($_POST['change_password'])){
	
	//Check if user is logged in, if not redirect to login page
	include __DIR__ . '/loginStatus.php';
	
	$old_password = $_POST['old_password'];
	$new_password = $_POST['new_password'];
	$confirm_new_password = $_POST['confirm_new_password'];
	
	//If loggedin validate form
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
		
		try{
			include __DIR__ .  '/../includes/DatabaseConnection.php';
			include __DIR__ .  '/../includes/DatabaseFunctions.php';
			
			$selectRecord = selectRecord($pdo,$_SESSION['email']);
			
			if($selectRecord->rowCount()==1){
				
				$row=$selectRecord->fetch();
				
				$hashed_password = $row['password'];
				$old_password = $_POST['old_password'];
				
				if(password_verify($old_password, $hashed_password) && (!empty($_SESSION['email']))){
					
					$valid = true;
					
				}else{
					
					$valid = false;
					$errors['old_password'] = 'Password is incorrect';
					
					include __DIR__ . '/../templates/change-password.html.php';		
				}
				
			}else{
				$valid = false;
				$errors['email'] = 'Sorry, you need to login.';
				include __DIR__ . '/../templates/login.html.php';
			}
			
			if($valid){
		
				$new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
				$email = $_SESSION['email'];
				
				$update = updatePassword($pdo, $new_password, $email);
				
				session_destroy();
				
				//Redirect to login page
				$successMsg ='Update successful.';
				$loginMsg ='Please, login with your new password';
				$GLOBALS['success_msg'];
				$GLOBALS['loginMsg'];
				
				header('Location: ../templates/login.html.php');
			}
		}catch(PDOException $e){
			
			$title ='An error has occured';
			$output = 'Database error: ' . $e->getMessage() . ' in '
			. $e->getFile() . ':' . $e->getLine();
		}
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
		
		try{
			include __DIR__ .  '/../includes/DatabaseConnection.php';
			include __DIR__ .  '/../includes/DatabaseFunctions.php';
		
			$selectRecord = selectRecord($pdo, $_POST['email']);
			if(empty($selectRecord->rowCount())){
				$valid = false;
				$errors['email'] = 'This email address is not registered';
				include __DIR__ . '/../templates/recover-password.html.php';
			}else{
				$valid = true;
				if($row=$selectRecord->fetch()){
				$email = $row['email'];
				$password = $row['password'];
				}
			}
			
			if($valid){
				$expDate = new DateTime();	
				$expDate = $expDate->format('Y-m-d H:i:s');				
				$token = bin2hex(random_bytes(50));
				
				$insertToken = insertToken($pdo, $email, $token, $expDate);
				include __DIR__. '/../includes/sendLink.php';
			}
		}catch(PDOException $e){
			
			$title ='An error has occured';
			$output = 'Database error: ' . $e->getMessage() . ' in '
			. $e->getFile() . ':' . $e->getLine();
		}
		
		
	}
	
}
	
if(isset($_POST['reset_password'])){	
	$new_password = $_POST['new_password'];
	$confirm_new_password = $_POST['confirm_new_password'];
	$email = filter_input(INPUT_GET, 'email');
	$token = filter_input(INPUT_GET, 'key');
	
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
		
	if($valid){
		
		try{
			include __DIR__ .  '/../includes/DatabaseConnection.php';
			include __DIR__ .  '/../includes/DatabaseFunctions.php';
			
			if(isset($_GET['key']) && isset($_GET['email']) && isset($_GET['action'])){	
				$token = $_GET['key'];
				$email = $_GET['email'];
				$curDate = date('Y-m-d H:i:s');
				$new_password = $_POST['new_password'];
				
				$selectPasswordTemp = selectPasswordTemp($pdo, $email, $token);
				
				if(!empty($selectPasswordTemp->rowCount)){
					$expDateTimestamp = strtotime('expDate');
					$curDateTimestamp = strtotime($curDate);
					
					if((date_diff($expDateTimestamp, $curDateTimestamp)<=86400)){
						
						$valid = true;
						deleteToken($pdo, $email);
						
					}else{
						
						echo 'The token expired';
					}
				}else{
					
					echo 'The link din\'t work, please try again';
				}
				
				if($valid){
					$new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
					$email = $_GET['email'];
					$new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
			
					$update = updatePassword($pdo, $new_password, $email);
					
					session_destroy();
					
					//Redirect to login page
					$successMsg ='You have changed your password.';
					$loginMsg ='Please, login with your new password';
					$GLOBALS['successMsg'];
					$GLOBALS['loginMsg'];
					
					header('Location: ../templates/login.html.php');
							
				}else{
							echo 'Password was not changed, please try again';
				}	
			}	
		}catch(PDOException $e){
		
		$title ='An error has occured';
		$output = 'Database error: ' . $e->getMessage() . ' in '
		. $e->getFile() . ':' . $e->getLine();
		}
			
	}else{
		//Display the form again
		include __DIR__ . '/../templates/reset-password.html.php';
	}
		
}
		
	function test_input($data){
	
	$data=stripslashes($data);
	$data=htmlspecialchars($data, ENT_QUOTES);
	return $data;
	}