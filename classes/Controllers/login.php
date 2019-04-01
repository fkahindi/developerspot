<?php
	include __DIR__ .'/../../includes/DatabaseConnection.php';
		
	//If $valid is still true, no fields were left blank
	//Prepare a select statement
	$sql = 'SELECT id, email, password FROM `members` WHERE email = :email';
	
		if($stmt=$pdo->prepare($sql)){
			
			//Bind variables to the prepared statement as parameters
			$stmt->bindParam(':email', $param_email, PDO::PARAM_STR);
				
			//Set parameters
			$param_email = $_POST['email'];
			
			//Attempt to execute the prepared statement
			
			if($stmt->execute()){
				//check if the user already exists, if yes, check password
				if($stmt->rowCount()== 1){
					if($row = $stmt->fetch()){
						$id = $row['id'];
						$email = $row['email'];
						$hashed_password = $row['password'];
						if(password_verify($password, $hashed_password)){
							
							//password is correct, start a new session						
							session_regenerate_id();
							
							//Store data in session variables
							$_SESSION['loggedin'] = true;
							$_SESSION['email'] = $email;
							$_SESSION['password']= $harshed_password;
							
							//Redirect to welcome page
							header('Location: ../templates/welcome.html.php');
						}else{
							//Display error password
							
							$errors['password'] ='The password you entered was incorrect';
							
							//Display login form with recover password option
							$recover_password_option ='Forgot password? <a href="../templates/recoverpassword.html.php">Recover it</a>.' ;
							
							include __DIR__ . '/../../templates/login.html.php';
						}
					}
				}else{
					//Display error message the email does not exist
					$errors['email'] ='The email you entered does not exist';
					
					//Display login form again with a signup option
					$signup_option = '<a href="../templates/signup.html.php">Sign up</a>'. ' here for an account.';
					include __DIR__ . '/../../templates/login.html.php';
				}
			}else{
				echo 'Oops! Something went wrong. Please try later';
			}
		}
	
	
	
	