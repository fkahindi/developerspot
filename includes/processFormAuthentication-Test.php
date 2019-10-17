<?php
//Initialize session
if(!isset($_SESSION)){
	session_start();
}

//include necessary the files

include __DIR__ .'/../includes/DatabaseConnection.php';
include __DIR__ . '/../classes/DatabaseTable.php';

$fullname = $username = $profile_photo = $email = $password = $confirm_password = $new_password = $old_password = $confirm_new_password ='';

$errors =[];
$valid = true;
$gen_pattern ="/^[\w]{3,}$/"; //Matches atleast characters made of alpha-numeric and underscore
$password_pattern = "/^[\w\-.]+$/"; // Matches letters, numbers, underscore, dash or dot

//This section handles user account creation

if(isset($_POST['create-account'])){
	
	//Assign variables
	$fullname = $_POST['fullname'];
	$username = $_POST['username'];
	$email = $_POST['email'];
		
	//Incase any field is left blank
	if(!empty($_POST['fullname'])){
		$fullname = filter_var($_POST['fullname'], FILTER_SANITIZE_STRING);
	}else{
		$fullname = '';
	}
	if(empty($_POST['username'])){
		$valid = false;
		$errors['username'] = 'Name cannot be blank';
	}else if(strlen($_POST['username'])<3){
		$valid = false;
		$errors['username'] = 'Username must be at least three characters';
	}else{
		$username = test_input($_POST['username']);
		$username = trim($username);
				
		//Check if name contain only aphabet, numbers and underscore
		if (!preg_match($gen_pattern,$username)){
			
			$valid = false;
			$errors['username'] = "Only alpha numeric and underscore allowed in username";  
		} 
	}
	
	if(empty($_POST['email'])){
		$valid = false;
		$errors['email'] ='Email cannot be blank';
	}else{
		$valid = true;
		//Remove spaces incase they exist
		$email = trim($_POST['email']);
		//Remove illegal characters from email
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		
		//Check if email address is well formed
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$valid = false;
			$errors['email'] = 'Invalid email address';
		}	
	}
	
	if(empty($errors)){
		try{	
			$curDate = date('Y-m-d H:i:s');			
			$created_at = new DateTime();	
			$created_at = $created_at->format('Y-m-d H:i:s');
			$token = bin2hex(random_bytes(50));
			
			$users_tempTable = new DatabaseTable($pdo, 'users_temp','email');
			$query = $users_tempTable->selectRecords($email);
					
			if(!empty($query->rowCount())){
				//If email exists check if token still valid 
				$row = $query->fetch();
								
				$createdDateTimeStamp = strtotime($row['created_at']);
				$curDateTimeStamp = strtotime($curDate);
				
				if($curDateTimeStamp - $createdDateTimeStamp <= 172800){
					//If link was sent in less than 48 hrs notify user
					echo 'A link was sent to your email in less than 48 hours ago. Check your email inbox.';
				}else {
					//Update token and date then send email link
					$fields = ['token' => $token, 'created_at' => $created_at];
					$update_usersToken = $users_tempTable->updateRecords($fields,$email);
					//require_once __DIR__ .'/subscribe-email-link.php';
					echo 'A link was sent some time back, but has been sent again';
				} 	
			}else{
				$fields = [
				'fullname' => $fullname,
				'username' => $username,
				'email' => $email,
				'token' => $token,
				'created_at' => $created_at
				];
				$insert_tempRecord = $users_tempTable ->insertRecord($fields);
				
				require_once __DIR__ .'/create-account-email-link.php';
				echo 'A link has been sent to your email address, please verify it.';
			}
		}catch(PDOException $e){
			$title ='An error has occured';
			$output = 'Database error: ' . $e->getMessage() . ' in '
			. $e->getFile() . ':' . $e->getLine();
		}				
	}else{
		include __DIR__ .'/../templates/create-account.html.php';	
	}
}

//This section handles account email verification
if(isset($_POST['set-account-password'])){
	$email = $_POST['email'];
	$token = $_POST['token'];
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];
			
	//If loggedin validate form
	if(empty($_POST['password'])){
		$valid = false;
		$errors['password'] = 'Password field cannot be blank';
	}else if(empty($_POST['confirm_password'])){
		$valid = false;
		$errors['confirm_password'] = 'Confirm your password';
	}else{
		$valid = true;
		$password = filter_var($password, FILTER_SANITIZE_STRING);
		$confirm_password = filter_var($confirm_password, FILTER_SANITIZE_STRING);
		$password = trim($password);
	}
	if(!preg_match($password_pattern, $password)){
		$valid = false;
		$errors['password'] ='Only alphanumeric, underscore, dash and dot are allowed.';
	}else if(strlen($password)<6){
		$valid = false;
		$errors['password'] ='Password must be at least 6 characters.';
	}else if($password !== $confirm_password){
		$valid = false;
		$errors['confirm_password'] ='Your passwords do not match';
	}else{
		$valid = true;
	}
	
	//If everything is OK and valid is true 
	if($valid){
		
		try{
			
			$curDate = date('Y-m-d H:i:s');
					
			$selectEmailToken = new DatabaseTable ($pdo, 'users_temp', 'token');
			$sql = $selectEmailToken->selectRecords($token, $email);
			
			if(!empty($sql->rowCount())){
				
				$row = $sql->fetch();
				$fullname = $row['fullname'];
				$username = $row['username'];
				$expDateTimestamp = strtotime($row['created_at']);
				$curDateTimestamp = strtotime($curDate);
				
				if(($curDateTimestamp - $expDateTimestamp)<=172800){
					$created_at = new DateTime();	
					$created_at = $created_at->format('Y-m-d H:i:s');
					$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
					$profile_photo = '/spexproject/resources/photos/profile.png';
					$fields = [
						'fullname'=> $fullname,
						'username'=> $username,
						'profile_photo'=>$profile_photo,
						'email' => $email,
						'password' => $password,
						'created_at' => $created_at
					];
					$usersTable = new DatabaseTable($pdo, 'users', 'email');
					$usersTable->insertRecord($fields);
													
					$deleteToken = new DatabaseTable($pdo,'users_temp', 'email');
					$deleteToken->deleteRecords($email);
					
					//Redirect to login page
					$_SESSION['success_msg'] ='Congratulations! Your account is set. <br> Please, login to your account.';
									
					header('Location: ../templates/login.html.php');
								
				}else{
					//$valid = false;
					echo 'The token expired';
					exit();
				}
			
			}else{
				//$valid = false;
				echo 'Token was not found, please try again';
				exit();
			}
			
		}catch(PDOException $e){
		
		$title ='An error has occured';
		$output = 'Database error: ' . $e->getMessage() . ' in '
		. $e->getFile() . ':' . $e->getLine();
		}
			
	}else{
		//Display the form again
		include __DIR__ . '/../templates/set-account-password.html.php';
	}
	
}
	
// This section handles user logins
if(isset($_POST['login'])){
	if(isset($_SESSION['page_id'])&& isset($_SESSION['post_slug'])){
		$page_id = $_SESSION['page_id'];
		$page_slug = $_SESSION['post_slug'];
	}
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	if(empty($email)){
		$valid = false;
		$errors['email'] = 'You did not enter your email';
	}else{
		//Remove illegal characters from email
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$valid = false;
			$errors['email'] = 'Invalid email';
		}else{
			$valid = true;
		}
	} 
	if(empty($_POST['password'])){
		$valid = false;
		$errors['password'] = 'You did not type a password';
	}else{
		$valid = true;
		$password =trim($_POST['password']);
	}
	if(!$valid){
		include __DIR__ . '/../templates/login.html.php';
	}else{
		try{
			//Select from users table			
			$usersTable = new DatabaseTable($pdo,'users', 'email');
			
			$query = $usersTable->selectRecords($email,$username);
			
			//Check if records exists in the database
			if($query->rowCount()==1){
				
				//Fetch the entire record
				$row = $query->fetch();
				
				//Select from roles table using user's role_id
				$rolesTable = new DatabaseTable($pdo, 'roles', 'role_id');
				
				$sql = $rolesTable->selectRecords($row['role_id']);
				$record = $sql->fetch();
				
				//Assign records values to variables
				$user_id = $row['user_id'];
				$role = $record['role'];
				$fullname = $row['fullname'];
				$username = $row['username'];
				$profile_photo = $row['profile_photo'];
				$email = $row['email'];
				$hashed_password = $row['password'];
				
				//Check if the password in database matches the one typed by user
				if(password_verify($password, $hashed_password)){
					//regenerate a new session id
					session_regenerate_id;
					
					//Store data in session variables
					$_SESSION['loggedin'] = true;
					$_SESSION['user_id'] = $user_id;
					$_SESSION['role'] = $role;
					$_SESSION['email'] = $email;
					$_SESSION['password']= $hashed_password;
					$_SESSION['fullname'] = $fullname;
					$_SESSION['username'] = $username;
					$_SESSION['profile_photo']= $profile_photo;
					$_SESSION['page_id'] = $page_id;
					$_SESSION['post_slug'] = $page_slug;
						
					//Redirect accordingly
					if(isset($_SESSION['page_id'])){
						header('Location: ../templates/post.html.php?id='.$_SESSION['page_id'].'&title='.$_SESSION['post_slug']);
					}else{
						header('Location: ../templates/welcome.html.php');
					}					
				}else{
					//Display password error 
					
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

//This section handles subscriber changing their password
if(isset($_POST['change_password'])){

	$old_password = $_POST['old_password'];
	$new_password = $_POST['new_password'];
	$confirm_new_password = $_POST['confirm_new_password'];
		
	//If loggedin validate form
	if(empty($_POST['old_password'])){
		$valid = false;
		$errors['old_password'] = 'You must enter your old password';
	}else if(empty($_POST['new_password'])){
		$valid = false;
		$errors['new_password'] = 'Enter the new password';
	}else if(empty($_POST['confirm_new_password'])){
		$valid = false;
		$errors['confirm_new_password'] = 'Confirm your new password';
	}else{
		$old_password = filter_var($old_password, FILTER_SANITIZE_STRING);
		$new_password = filter_var($new_password, FILTER_SANITIZE_STRING);
		$confirm_new_password = filter_var($confirm_new_password, FILTER_SANITIZE_STRING);
		$new_password = trim($new_password);
	}
	if(!preg_match($password_pattern, $new_password)){
		$valid = false;
		$errors['new_password'] ='Only apha-numeric, underscore, dash and dot are allowed.';
	}else if(strlen($new_password)<6){
		$valid = false;
		$errors['new_password'] ='Password must be atleast 6 characters.';
	}else if($new_password == $old_password){
		$valid = false;
		$errors['new_password'] ='New password cannot be same as old password.';
	}else if($new_password !== $confirm_new_password){
		$valid = false;
		$errors['confirm_new_password'] ='Your new password did not match';
	}else{
		$valid = true;
	}
		
	if(!$valid){
		include __DIR__ . '/../templates/change-password.html.php';
	}else{
		
		try{
			$usersTable = new DatabaseTable($pdo,'users', 'email');
			$query = $usersTable->selectRecords($_SESSION['email'],$_SESSION['username']);
			
			if($query->rowCount()==1){
				
				$row=$query->fetch();
				
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
		
				$new_password = password_hash($new_password, PASSWORD_DEFAULT);
				$email = $_SESSION['email'];
				
				$fields =['password'=> $new_password];
				
				$sql=$usersTable->updateRecords($fields,$email);
				
				//session_destroy();
			
				//Set a variables to display on the login form
				$_SESSION['success_msg'] = 'Update successful. <br> Please, login with your new password';
				
				//Redirect to login page
				header('Location: ../templates/login.html.php');			
			}
		}catch(PDOException $e){
			
			$title ='An error has occured';
			$output = 'Database error: ' . $e->getMessage() . ' in '
			. $e->getFile() . ':' . $e->getLine();
		}
	}
}

//This section starts the process of forgotten password recovery
if(isset($_POST['recover_password'])){
	
	$email = $_POST['email'];
			
	if(empty($_POST['email'])){
		$valid = false;
		$errors['email'] = 'Enter your email address';
		
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
			$usersTable = new DatabaseTable($pdo, 'users', 'email');
			
			$query = $usersTable->selectRecords($_POST['email'],$username);
			
			if(empty($query->rowCount())){
				$valid = false;
				$errors['email'] = 'This email address does not exist';
				include __DIR__ . '/../templates/recover-password.html.php';
			}else{
				$valid = true;
				if($row=$query->fetch()){
				$email = $row['email'];
				}
			}
			
			if($valid){
				$expDate = new DateTime();	
				$expDate = $expDate->format('Y-m-d H:i:s');				
				$token = bin2hex(random_bytes(50));
				
				$fields =[
					'email' => $email,
					'token' => $token,
					'expDate' => $expDate
				];
				$password_resetTable =  new DatabaseTable($pdo, 'password_reset_temp');
				$password_resetTable->insertRecord($fields);
				
				include __DIR__. '/../includes/reset-password-link.php';
			}
		}catch(PDOException $e){
			
			$title ='An error has occured';
			$output = 'Database error: ' . $e->getMessage() . ' in '
			. $e->getFile() . ':' . $e->getLine();
		}
		
		
	}
	
}

//This section allows the user to reset their password affter successful recovery
if(isset($_POST['reset_password'])){	

	$email = $_POST['email'];
	$token = $_POST['token'];
	
	if(empty($_POST['new_password'])){
		$valid = false;
		$errors['new_password'] = 'Password cannot be blank.';
	}else if(empty($_POST['confirm_new_password'])){
		$valid = false;
		$errors['confirm_new_password'] = 'Confirm your new password';
	}else{
		$valid = true;
		$new_password = filter_var($_POST['new_password'], FILTER_SANITIZE_STRING);
		$new_password = trim($_POST['new_password']);
		$confirm_new_password = filter_var($_POST['confirm_new_password'], FILTER_SANITIZE_STRING);
		$confirm_new_password = trim($_POST['confirm_new_password']);
	}
			
	if(!preg_match($password_pattern,$new_password)){
		$valid = false;
		$errors['new_password'] ='Only alpha-numeric, underscore, dash and dot are allowed.';
	}else if(strlen($new_password)<6){
		$valid = false;
		$errors['new_password'] ='Password must be atleast 6 characters.';
	}else if($confirm_new_password !== $new_password){
		$valid = false;
		$errors['confirm_new_password'] ='Your passwords did not match';
	}
		
	//If everything is OK and valid is true 
	if($valid){
		
		try{
			
			$curDate = date('Y-m-d H:i:s');
					
			$selectEmailToken = new DatabaseTable ($pdo, 'password_reset_temp', 'token');
			$sql = $selectEmailToken->selectRecords($token, $email);
			
			if(!empty($sql->rowCount())){
				
				$row = $sql->fetch();
				$expDateTimestamp = strtotime($row['expDate']);
				$curDateTimestamp = strtotime($curDate);
				
				if(($curDateTimestamp - $expDateTimestamp)<=86400){
														
					$deleteToken = new DatabaseTable($pdo,'password_reset_temp', 'email');
					$deleteToken->deleteRecords($email);
					
					$new_password = password_hash($new_password, PASSWORD_DEFAULT);
					$_SESSION['email'] = $_POST['email'];
					
					$updatePassword = new DatabaseTable($pdo, 'users', 'email');
					
					$fields = ['password'=> $new_password];
					
					$updatePassword->updateRecords($fields,$_SESSION['email']);
					
					//session_destroy();
					
					//Redirect to login page
					$_SESSION['success_msg'] ='You have changed your password. <br> Please, login with your new password';
									
					header('Location: ../templates/login.html.php');
								
				}else{
					//$valid = false;
					echo 'The token expired';
					exit();
				}
			
			}else{
				//$valid = false;
				echo 'Token was not found, please try again';
				exit();
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

//This section helps user to upload profile image of their account
if(isset($_POST['image-upload'])){
	require __DIR__ . '/loginStatus.php';
	
	$target_dir = '../resources/photos/';
	$target_file = $target_dir . basename($_FILES['fileToUpload']['name']);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
	
	try{	
		//Check if an image has been selected
	
		if(!empty(getimagesize($_FILES['fileToUpload']['tmp_name']))){
			
			// Check file size
			if($_FILES['fileToUpload']['size']>500000){
				$uploadOk = 0;
				$errors['fileToUpload'] = 'Sorry, image is too large';

				include __DIR__ . '/../templates/imageupload.html.php';
				
				// Allow only .jpg, .png and .gif file formats
			}else if($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'gif'){
				$uploadOk = 0;
				$errors['fileToUpload'] = 'Sorry, only JPG, PNG or GIF files are allowed';
				
				include __DIR__ . '/../templates/imageupload.html.php';
			}else{
				$uploadOk = 1;
			
			}
			
		}else{
			$uploadOk = 0;
			$errors['fileToUpload'] =  'No image was selected.';	
			
			include __DIR__ . '/../templates/imageupload.html.php';
		}
		
		//If everything is ok, try to upload the file
		if($uploadOk == 1){
			
			//Get the user name id to use in the file name
			$email = $_SESSION['email'];
			$username= $_SESSION['username'];
			
			try{
				$usersTable = new DatabaseTable($pdo, 'users', 'email');
				$query = $usersTable->selectRecords($email, $username);
				
				if($query->rowCount()>0){
					$row = $query->fetch();
					
					//Set the session photo path again	
					$id = $row['user_id'];
				}
				
			}catch(PDOException $e){
					$title ='An error has occured';
					$output = 'Database error: ' . $e->getMessage() . ' in '
					. $e->getFile() . ':' . $e->getLine();
			}
			
			//Prepare file by renaming the image file with account session name
			if(!empty($_SESSION['fullname'])){
				$fullname_arr = explode(' ',$_SESSION['fullname']);
				$name = implode($fullname_arr);
			}else{
				$name = $_SESSION['username'];
			}
			
						
			//Split the original file name and take the extension name
			$file_pieces = explode('.',$_FILES['fileToUpload']['name']);
			$extension = $file_pieces[1];
			
			//To ensure filename uniqueness combine name with user id, add sufix -0 and the extension name
			$target_file = strtolower($name .'-0'. $id .'.'.$extension);
			
			if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'],'../resources/photos/'.$target_file)){
				$file_path = '/spexproject/resources/photos/'.$target_file;
											
				try{
					//Update profile_photo file path in the database
					$fields = ['profile_photo' => $file_path];
					
					$usersTable->updateRecords($fields,$email);
					
					//Fetch the records again to place the image photo in session
					$query = $usersTable->selectRecords($email, $username);
					if($query->rowCount()== 1){
						$row = $query->fetch();
						
						//Set the session photo path again	
						$_SESSION['profile_photo'] = $row['profile_photo'];
					}			
					
					echo 'Your photo has been updated. You may need to refresh the page for it to reflect. <br>';
					echo '<a href="../index.php">Continue</a>';
										
				}catch(PDOException $e){
					$title ='An error has occured';
					$output = 'Database error: ' . $e->getMessage() . ' in '
					. $e->getFile() . ':' . $e->getLine();
				}
				
			}else{
				echo 'Sorry, there was an error uploading your file.';
			}		
		}
	}catch(Exception $e){
		echo 'Caught Exception: ' . $e->getMessage();
	}
}
		
	function test_input($data){
	
	$data = stripslashes($data);
	$data = htmlspecialchars($data, ENT_QUOTES);
	return $data;
	}