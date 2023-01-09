<?php
if(!isset($_SESSION)){
	session_start();
}

//include necessary the files
include __DIR__ . '/../config.php';
include __DIR__ .'/../../includes_devspot/DatabaseConnection.php';
include __DIR__ . '/../classes/DatabaseTable.php';

$errors =[];
$img_error ='';
$valid = true;
$gen_pattern ="/^[\w]{3,}$/"; /* //Matches atleast characters made of alpha-numeric and underscore */
$password_pattern = "/^[\w\-.]+$/"; /* // Matches letters, numbers, underscore, dash or dot */

/* //This section handles user account creation */
function createAccount(){
	global $pdo, $errors,$valid, $gen_pattern, $form_error;

	/* //Assign variables */
	$username = $_POST['username'];
	$email = $_POST['email'];

	/* //Incase any field is left blank */
	if(empty($_POST['username'])){
		$valid = false;
		$errors['username'] = 'Name cannot be blank';
	}else if(strlen($_POST['username'])<3){
		$valid = false;
		$errors['username'] = 'Username must be at least three characters';
	}else{
		$username = test_input($_POST['username']);
		$username = trim($username);

		/* //Check if name contain only aphabet, numbers and underscore */
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
		/* //Remove spaces incase they exist */
		$email = trim($_POST['email']);
		/* //Remove illegal characters from email */
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);

		/* //Check if email address is well formed */
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$valid = false;
			$errors['email'] = 'Invalid email address';
		}
	}
	if(empty($_POST['privacy'])){
		$valid = false;
		$errors['privacy']='You need to agree with the privacy policy';
	}else{
		$valid = true;
	}
	if(empty($errors)){

		/* Check whether the email or username are already in use */
		$usersTable = new DatabaseTable($pdo, 'users', 'email','username');
		$sql = $usersTable->selectRecordsOnOrCondition($email,$username);
		if($sql->rowCount()>0){
			$valid = false;
			$row = $sql->fetch();
			if($row['username'] === $username){
				$errors['username'] = 'You cannot use '.$username;
			}
			if($row['email'] === $email){
				$errors['email'] = 'You cannot use '.$email;
			}
		}else{
			$curDate = date('Y-m-d H:i:s');
			$created_at = new DateTime();
			$created_at = $created_at->format('Y-m-d H:i:s');
			$token = bin2hex(random_bytes(20));

			$users_tempTable = new DatabaseTable($pdo, 'users_temp','email');
			$query = $users_tempTable->selectRecordsOnCondtion($email);

			if($query->rowCount()>0){
				/* If email exists check if token still valid */
				$temp_row = $query->fetch();

				$createdDateTimeStamp = strtotime($temp_row['created_at']);
				$curDateTimeStamp = strtotime($curDate);
				$span = $curDateTimeStamp - $createdDateTimeStamp;
				if($span<= 86400){
					/* If link was sent in less than 24 hrs notify user */

					$_SESSION['email_success'] = 'A link was sent to '.$temp_row['email'].' address in less than 24 hours ago. Check your email inbox.';
                    header('Location: '.BASE_URL.'thank-you.php');
				}else{
					/* Update token, date and fullname (if set) then send email link */
					$fields = ['token' => $token, 'created_at' => $created_at];
					$users_tempTable->updateRecords($fields,$email);
					require_once __DIR__ .'/create-account-email-link.php';
          header('Location: '.BASE_URL.'thank-you.php');
				}
			}else{
				$fields = [
				'username' => $username,
				'email' => $email,
				'token' => $token,
				'created_at' => $created_at
				];
				require_once __DIR__ .'/create-account-email-link.php';
				if(isset($_SESSION['email_success'])){
					$users_tempTable ->insertRecord($fields);
                    header('Location: '.BASE_URL.'thank-you.php');
				}else{
					$form_error = $email_error;
				}
			}
		}
	}else{
		$form_error = 'Form has errors';
	}
}
/* This function handles account email verification
** and enables users to set their account password
** before account can be operational
*/
function setAccountPassword(){
	global $pdo, $password_pattern,$password, $confirm_password, $profile_photo, $valid, $errors;

	$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
	$token = filter_var($_POST['token'], FILTER_UNSAFE_RAW);
	$username =filter_var($_POST['username'], FILTER_UNSAFE_RAW);
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];

	if(empty($_POST['password'])){
		$valid = false;
		$errors['password'] = 'Password cannot be blank';
	}elseif(empty($_POST['confirm_password'])){
		$valid = false;
		$errors['confirm_password'] = 'Confirm your password';
	}else{
		$valid = true;
		$password = filter_var($password, FILTER_UNSAFE_RAW);
		$confirm_password = filter_var($confirm_password, FILTER_UNSAFE_RAW);
		$password = trim($password);

		if(!preg_match($password_pattern, $password)){
			$valid = false;
			$errors['password'] ='Only alphanumeric, underscore, dash and dot are allowed.';
		}else if(strlen($password)<6){
			$valid = false;
			$errors['password'] ='Password must be at least 6 characters.';
		}else if($password !== $confirm_password){
			$valid = false;
			$errors['confirm_password'] ='Your passwords do not match';
		}
	}

	/* If everything is OK and valid is true */
	if($valid){

		try{
			$curDate = date('Y-m-d H:i:s');

			$selectEmailToken = new DatabaseTable ($pdo, 'users_temp','token', 'email');
			$sql = $selectEmailToken->selectRecordsOnAndCondition($token, $email);

			if($sql->rowCount()==1){

					$row = $sql->fetch();
					$username = $row['username'];
					$expDateTimestamp = strtotime($row['created_at']);
					$curDateTimestamp = strtotime($curDate);
					$span = $curDateTimestamp - $expDateTimestamp;

					if($span<=86400){

						$created_at = new DateTime();
						$created_at = $created_at->format('Y-m-d H:i:s');
						$password = password_hash($password, PASSWORD_DEFAULT);
						$profile_photo = BASE_URL . 'resources/photos/profile.png';
						$fields = [
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

						/* Redirect to login page */
						$_SESSION['success_msg'] ='Congratulations! Your account is set. <br> Please, login to your account.';

						header('Location:'.BASE_URL.'login');

					}else{
						echo 'The token expired';
						exit();
					}
			}else{
				echo 'Could not find token, please try again';
				exit();
			}

		}catch(PDOException $e){
			if($e->errorInfo[1]==1062){
				echo 'Email or Username already exists.';
			}else{
				throw $e;
			}
		}
	}
}

/* This function handles user logins */
function login(){
	global $pdo, $valid, $errors, $form_error;

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

		$password = filter_var($password, FILTER_UNSAFE_RAW);
		$password =trim($password);
		$valid = true;
	}
	if(!$valid){
		$form_error = 'Form has errors';
	}else{

		//Select from users table
		$usersTable = new DatabaseTable($pdo,'users', 'email');

		$query = $usersTable->selectRecordsOnCondtion($email);

		//Check if records exists in the database
		if($query->rowCount()==1){

			//Fetch the entire record
			$row = $query->fetch();

			//Select from roles table using user's role_id
			$rolesTable = new DatabaseTable($pdo, 'roles', 'role_id');

			$sql = $rolesTable->selectRecordsOnCondtion($row['role_id']);
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
				//regenerate a new session id for security reasons
				session_regenerate_id();

				//Store data in session variables
				$_SESSION['loggedin'] = true;
				$_SESSION['user_id'] = $user_id;
				$_SESSION['role'] = $role;
				$_SESSION['email'] = $email;
				$_SESSION['password']= $hashed_password;
				$_SESSION['fullname'] = $fullname;
				$_SESSION['username'] = $username;
				$_SESSION['profile_photo']= $profile_photo;

				//Redirect accordingly
				if(isset($_SESSION['post_slug'])){
					header('Location:'.BASE_URL.'posts/'.$_SESSION['post_slug']);
				}else{
					header('Location:'.BASE_URL.'index.php');
				}
			}else{
				$errors['password'] ='Incorrect email or password';

			}

		}else{
			$errors['email'] ='Email address does not exist';
		}
	}
}

function fbLogin($user_data){
global $pdo, $form_error;

	if(!empty($user_data)){

		$uid = $user_data['uid'];
		$oauth_provider = $user_data['oauth_provider'];
		$email = $user_data['email'];
		$username = $user_data['first_name'];
		$name = $user_data['fullname'];
		$profile_photo = $user_data['profile_photo'];

		//Check if user already exists
		$oauth_table = new DatabaseTable($pdo, 'oauth_login', 'uid');

		$sql = $oauth_table->selectRecordsOnCondtion($uid);

		$curr_date = new DateTime();

		if($sql->rowCount()==1){
			//user already exists, so update record
			$updated_at = $curr_date->format('Y-m-d H:i:s');
			$fields = ['oauth_provider'=>$oauth_provider,'email'=>$email,'username'=>$username,'fullname'=>$name, 'profile_photo'=>$profile_photo, 'updated_at'=>$updated_at];
			$oauth_table->updateRecords($fields,$uid);
		}else {
			//insert new user
			$created_at = $curr_date->format('Y-m-d H:i:s');
			$fields = ['uid'=>$uid,'oauth_provider'=>$oauth_provider,'email'=>$email,'username'=>$username,'fullname'=>$name, 'profile_photo'=>$profile_photo, 'created_at'=>$created_at];
			$oauth_table->insertRecord($fields);
		}

    //Select from roles table using user's role_id
    $rolesTable = new DatabaseTable($pdo, 'roles', 'role_id');

    $sql = $rolesTable->selectRecordsOnCondtion(3);
    $record = $sql->fetch();

		$_SESSION['loggedin'] = true;
		$_SESSION['user_id'] = $uid;
		$_SESSION['role'] = $record['role'];
		$_SESSION['email'] = $email;
		$_SESSION['username'] = $username;
		$_SESSION['fullname'] = $name;
		$_SESSION['profile_photo']= $profile_photo;
    $_SESSION['oauth_provider'] = $oauth_provider;

   	//Respond to AJAX call
		echo 'success';
	}else{
		echo 'No user data found! ';
	}
}

//This function handles password change by user
function changePassword(){
	global $pdo, $password_pattern, $valid, $errors;

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
		$old_password = filter_var($old_password, FILTER_UNSAFE_RAW);
		$new_password = filter_var($new_password, FILTER_UNSAFE_RAW);
		$confirm_new_password = filter_var($confirm_new_password, FILTER_UNSAFE_RAW);
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
	if($valid){

		$usersTable = new DatabaseTable($pdo,'users', 'email','username');
		$query = $usersTable->selectRecordsOnAndCondition($_SESSION['email'],$_SESSION['username']);

		if($query->rowCount()==1){

			$row=$query->fetch();

			$hashed_password = $row['password'];
			$old_password = $_POST['old_password'];

			if(password_verify($old_password, $hashed_password) && (!empty($_SESSION['email']))){

				$new_password = password_hash($new_password, PASSWORD_DEFAULT);
				$email = $_SESSION['email'];

				$fields =['password'=> $new_password];

				$usersTable->updateRecords($fields,$email);

				//Set a variables to display on the login form
				$_SESSION['success_msg'] = 'Update successful. <br> Please, login with your new password';

				//Redirect to login page
				header('Location: '.BASE_URL.'login');

			}else{
				$valid = false;
				$errors['old_password'] = 'Password is incorrect';
			}
		}else{
			$valid = false;
			$errors['email'] = 'Sorry, you need to login.';
		}
	}
}

/* This function begins the process of recovering forgotten password */
function recoverPassword(){
	global $pdo, $valid, $errors, $email_error;
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
	if($valid){

		$usersTable = new DatabaseTable($pdo, 'users', 'email');

		$query = $usersTable->selectRecordsOnCondtion($email);

		if($query->rowCount() == 0){
			$valid = false;
			$errors['email'] = 'This email address does not exist';
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
			include __DIR__ . '/reset-password-link.php';
			if(isset($_SESSION['email_success'])){
				$password_resetTable->insertRecord($fields);
				header('Location: '.BASE_URL.'thank-you.php');
			}
		}
	}
}

/* This function allows the user to reset their password after successful recovery */
function resetPassword(){
	global $pdo, $password_pattern;
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
		$new_password = filter_var($_POST['new_password'], FILTER_UNSAFE_RAW);
		$new_password = trim($new_password);
		$confirm_new_password = filter_var($_POST['confirm_new_password'], FILTER_UNSAFE_RAW);
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

		$curDate = date('Y-m-d H:i:s');

		$selectEmailToken = new DatabaseTable ($pdo, 'password_reset_temp', 'token','email');
		$sql = $selectEmailToken->selectRecordsOnAndCondition($token, $email);

		if(!empty($sql->rowCount())){

			$row = $sql->fetch();
			$expDateTimestamp = strtotime($row['expDate']);
			$curDateTimestamp = strtotime($curDate);

			if(($curDateTimestamp - $expDateTimestamp)<=3600){

				$deleteToken = new DatabaseTable($pdo,'password_reset_temp', 'email');
				$deleteToken->deleteRecords($email);

				$new_password = password_hash($new_password, PASSWORD_DEFAULT);
				$_SESSION['email'] = $_POST['email'];

				$updatePassword = new DatabaseTable($pdo, 'users', 'email');

				$fields = ['password'=> $new_password];

				$updatePassword->updateRecords($fields,$_SESSION['email']);

				/* Redirect to login page */
				$_SESSION['success_msg'] ='You have changed your password. <br> Please, login with your new password';

				header('Location: '.BASE_URL.'login');

			}else{
				echo 'The token expired';
				exit();
			}

		}else{
			echo 'Token was not found, please try recover password again.';
			exit();
		}
	}
}

/* //This function helps user to upload profile image of their account */
function imageUpload(){
	include __DIR__ . '/../classes/ImageUpLoad.php';
	global $pdo,$img_error;
	if(isset($_SESSION['page_id'])&& isset($_SESSION['post_slug'])){
		$page_id = $_SESSION['page_id'];
		$page_slug = $_SESSION['post_slug'];
	}

	//Prepare image file variable
	$received_name = $_FILES['fileToUpload'];
	$target_file = '../resources/photos/'.basename($received_name['name']);
	$image_max_size=500000;
	$allowed_types = ['jpg','jpeg','png','gif','webp'];
    $image_up_load = new ImageUpLoad($received_name,$target_file);
	$image_up_load->checkImageType($allowed_types);
	$image_up_load->imageSize($image_max_size);
	$img_error = $image_up_load->errors;

	//If everything is ok, try to upload the file
	if(!$img_error){
		//Get the user name id to use in the file name
		$email = $_SESSION['email'];
		$username = $_SESSION['username'];

		$usersTable = new DatabaseTable($pdo, 'users', 'email');
		$query = $usersTable->selectRecordsOnCondtion($email);

		if($query->rowCount()>0){
			$row = $query->fetch();

			//Set the session photo path again
			$id = $row['user_id'];
		}

		//Prepare file by renaming the image file with account session name
		if(!empty($_SESSION['fullname'])){
			$fullname_arr = explode(' ',$_SESSION['fullname']);
			$name = implode($fullname_arr);
		}else{
			$name = $_SESSION['username'];
		}

		///Split the original file name and take the extension name
		$file_pieces = explode('.',$received_name['name']);
		$extension = $file_pieces[1];

		//To ensure filename uniqueness combine name with user id, add sufix -0 and the extension name
		$new_file_name = strtolower($name .'-0'. $id .'.'.$extension);

		//Rename target file and move image to photos folder
		$target_file = '../resources/photos/'.$new_file_name;
		$image_up_load->moveFile($target_file);
		$img_error = $image_up_load->errors;
		 if(!$img_error){
			$file_path = BASE_URL  .'resources/photos/'.$new_file_name;

			//Update profile_photo file path in the database
			$fields = ['profile_photo' => $file_path];

			$usersTable->updateRecords($fields,$email);

			//Fetch the records again to place the image photo in session
			$query = $usersTable->selectRecordsOnCondtion($email);
			if($query->rowCount()== 1){
				$row = $query->fetch();

				//Set the session photo path again
				$_SESSION['profile_photo'] = $row['profile_photo'];
			}
			//Redirect accordingly
			if(isset($_SESSION['page_id'])){
				header('Location: '.BASE_URL.'posts/'.$_SESSION['post_slug']);
			}else{
				header('Location: '.BASE_URL.'index.php');
			}
		}
	}
}
function contactMe(){
	global $errors, $valid, $token;
	$name = filter_var($_POST['name'], FILTER_UNSAFE_RAW);
	$contact_email = $_POST['contact_email'];
	$comment = $_POST['comment'];

	# BEGIN reCaptcha v3 validation
	$url ="https://www.google.com/recaptcha/api/siteverify";
	$data = [
		'secret' => "PUT SITE SECRET HERE",
		'response' => $_POST['token'],
		'remoteip' => $_SERVER['REMOTE_ADDR']
	];
	$options = array(
		'http' => array(
			'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			'method'  => 'POST',
			'content' => http_build_query($data)
		)
	);
	# Creates and returns stream context with options supplied in options preset
	$context  = stream_context_create($options);
	# file_get_contents() is the preferred way to read the contents of a file into a string
	$response = file_get_contents($url, false, $context);
	# Takes a JSON encoded string and converts it into a PHP variable
	$res = json_decode($response, true);
	# END setting reCaptcha v3 validation data

	if($res['success']==true && $res['score']>=0.5){
		if(empty($_POST['name'])){
        $valid = false;
        $errors['name'] = 'Please, provide your name';
    }else{
        $valid = true;
    }
    if(empty($_POST['contact_email'])){
        $valid = false;
        $errors['contact_email'] = 'Enter your contact email';
    }else{
        $contact_email = filter_var($contact_email, FILTER_SANITIZE_EMAIL);
        if(!filter_var($contact_email, FILTER_VALIDATE_EMAIL)){
            $valid = false;
            $errors['contact_email'] = 'Invalid email';
        }else{
            $valid = true;
        }
    }

    if($valid){
        $comment = htmlspecialchars($comment, ENT_QUOTES);
        include __DIR__ .'/contact-me-email-link.php';
    }
	}else{
		$form_error ="Security token has expired";
	}

}
function removeAccount(){
	global $pdo;
	$user_id = $_SESSION['user_id'];
	$email = $_SESSION['email'];

	//Instantiate users and oauth table objects
	$users_table = new DatabaseTable($pdo, 'users', 'user_id', 'email');
	$oauth_table = new DatabaseTable($pdo, 'oauth_login', 'uid', 'email');

	//Select records from users table if there's a matche
	$sql = $users_table->selectRecordsOnAndCondition($user_id, $email);
	//Select records from oauth table if there's a matche
	$query = $oauth_table->selectRecordsOnAndCondition($user_id, $email);

	if($sql->rowCount()==1){
		//delete record if exists in users table
		$sql = $users_table->deleteRecords($user_id);
		session_destroy();
		header('Location:'.BASE_URL.'confirm-account-removal.php');
	}else if($query->rowCount()==1){
		//delete record if exists in oauth table
		$query = $oauth_table->deleteRecords($user_id);
		session_destroy();
		header('Location:'.BASE_URL.'confirm-account-removal.php');
	}else{
		echo 'Your credentials do not match any record';
	}

}
function test_input($data){
$data = stripslashes($data);
$data = htmlspecialchars($data, ENT_QUOTES);
return $data;
}