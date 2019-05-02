<?php
Class UserClass{
	
	public function signUp($fullname, $email, $password){
		//Prepare a select statement
		$sql = 'SELECT id FROM `members` WHERE email = :email';
			if($stmt=$pdo->prepare($sql)){
				//Bind variables to the prepared statement as parameters
				$stmt->bindParam(':email', $param_email, PDO::PARAM_STR);
				
				//Set parameters
				$param_email = $_POST['email'];
				
				//Attempt to execute the prepared statement
				if($stmt->execute()){
					if($stmt->rowCount()== 1){
						$valid = false;
						$errors['email'] = 'This email already exists';
						include __DIR__ .'/../../templates/signup.html.php';
					}else{
						$valid = true;
						$email = $_POST['email'];
					}
				}else{
					$valid = false;
					echo 'Oops! Something went wrong';
				}
				unset($stmt);
			}
			//If $valid is still true, no fields were left blank, email is not taken and idata can be added
			
		if($valid){
			//Insert record to the database
			$sql = 'INSERT INTO `members` (fullname, email, password, date_reg) 
			VALUES (:fullname, :email, :password, :date_reg)';
			
			if($stmt=$pdo->prepare($sql)){
				
				$stmt->bindParam(':fullname',$param_fullname, PDO::PARAM_STR);
				$stmt->bindParam(':email', $param_email, PDO::PARAM_STR);
				$stmt->bindParam(':password', $param_password, PDO::PARAM_STR);
				$stmt->bindParam(':date_reg', $param_date_reg, PDO::PARAM_STR);
				
				//Set parameters
				$param_fullname = $fullname;
				$param_email = $email;
				$param_password = password_hash($password, PASSWORD_DEFAULT);
				$param_date_reg = $date_reg->format('Y-m-d H:i:s');
				
				//Attempt to execute the prepared statement
				if($stmt->execute()){
					
					//Redirect to login page
					$GLOBALS['success_msg'] = 'Registration successful';
					header('Location: ../templates/signupsuccessful.html.php');
				}else{
					echo 'Something went wrong. You could not be registered';
				}
				//Close statement
				unset($stmt);
			}
		}
		
	}
	
	public function logIn($email, $password){
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
							$_SESSION['password']= $hashed_password;
							
							//Redirect to welcome page
							header('Location: ../templates/welcome.html.php');
						}else{
							//Display error password
							
							$errors['password'] ='Incorrect email or password';
														
							include __DIR__ . '/../../templates/login.html.php';
						}
					}
				}else{
					//Display error message the email does not exist
					$errors['email'] ='Email address does not exist';
					
					//Display login form again
					
					include __DIR__ . '/../../templates/login.html.php';
				}
			}else{
				echo 'Oops! Something went wrong. Please try later';
			}
		}
	
	}
	
	public function updatePassword($email, $password){
		$sql = 'SELECT * FROM `members` WHERE email = :email';
		if($stmt=$pdo->prepare($sql)){
			//Bind variables to the prepared statement as parameters
			$stmt->bindParam(':email', $param_email, PDO::PARAM_STR);
			
			//Set parameters
			$param_email = $_SESSION['email'];
			
			//Attempt to execute the prepared statement
			if($stmt->execute()){
				//Check if the email in session is in the database
				if($stmt->rowCount()==1){
					$valid = true;
					if($row=$stmt->fetch()){
						$hash_password = $row['password'];
						$old_password = $_POST['old_password'];
						if(password_verify($old_password, $hash_password) && (!empty($_SESSION['email']))){
							$valid = true;
						}else{
							$valid = false;
							$errors['old_password'] = 'Password is incorrect';
							include __DIR__ . '/../../templates/change-password.html.php';
							
						}
					}
				}else{
					$valid = false;
					$errors['email'] = 'Sorry, you need to login.';
					include __DIR__ . '/../../templates/login.html.php';
				}
			}else{
				$valid = false;
				echo 'Oops! Something went wrong';
			}
			unset($stmt);
		}
		//If $valid is still true, no fields were left blank, email is not taken and idata can be added
		if($valid){
			$sql = 'UPDATE `members` SET password = :new_password WHERE email = :email';
			if($stmt=$pdo->prepare($sql)){
				//Bind variables to the prepared statement as parameters
				$stmt->bindParam(':new_password', $new_password);
				$stmt->bindParam(':email', $email);
				
				//Set parameters
				$new_password = password_hash($_POST['new_password'],PASSWORD_DEFAULT);
				$email = $_SESSION['email'];
				
				if($stmt->execute()){
					//End the current session
					session_destroy();
					
					//Redirect to login page
					$GLOBALS['success_msg'] ='Update successful';
					header('Location: ../templates/signupsuccessful.html.php');
				}else{
					echo 'Sorry, password update was not successful';
				}
				unset($stmt);
			}
		}
		
	}
	
	public function passwordRecovery($email){
		$sql = 'SELECT * FROM `members` WHERE email = :email';
		if($stmt=$pdo->prepare($sql)){
			//Bind variables to the prepared statement as parameters
			$stmt->bindParam(':email', $param_email, PDO::PARAM_STR);
			
			//Set parameters
			$param_email = $_POST['email'];
			
			//Attempt to execute the prepared statement
			if($stmt->execute()){
				if(empty($stmt->rowCount())){
					$valid = false;
					$errors['email'] = 'This email address is not registered';
					
					include __DIR__ . '/../../templates/recover-password.html.php';
				}else{
					$valid = true;
					if($row=$stmt->fetch()){
					$email = $row['email'];
					$password = $row['password'];
					}
				}
			}else{
				$valid = false;
				echo 'Oops! Something went wrong';
			}
			unset($stmt);
		}
		//If $valid is still true, no issues with the query
		if($valid){
			$expDate = new DateTime();			
			$token = bin2hex(random_bytes(50));
			
			//Insert into Temp Table
		
			$sql = 'INSERT INTO `password_reset_temp` (email, token, expDate) VALUES (:email, :token, :expDate)';
				
			if($stmt=$pdo->prepare($sql)){
					
				//Bind variables as parameters for prepared statement
				$stmt->bindParam(':email', $param_email, PDO::PARAM_STR);
				$stmt->bindParam(':token', $param_token,PDO::PARAM_STR);
				$stmt->bindParam(':expDate', $param_expDate,PDO::PARAM_STR);
					
				//Set parameters
				$param_email = $email;
				$param_token = $token;
				$param_expDate = $expDate->format('Y-m-d H:i:s');
					
				if($stmt->execute()){
					//Send email to the user email address
						
					include __DIR__. '/../../includes/sendLink.php';
				}else{
						echo 'Something gone wrong try later';
					}
					
				unset($stmt);
			
				
			}

		}
	}
	
	public function resetPassword($token, $email, $new_password){
			if(isset($_GET['token']) && isset($_GET['email']) && isset($_GET['action'])){
			$token = $_GET['token'];
			$email = $_GET['email'];
			$curDate = date('Y-m-d H:i:s');
			$new_password = $_POST['new_password'];
		
		
		$sql = 'SELECT * FROM `password_reset_temp` WHERE key = :key && email = :email';
		
		if($stmt=$pdo->prepare($sql)){
			//Bind variables
			$stmt->bindValue(':token', $token);
			$stmt->bindValue(':email', $email);
			
			if($stmt->execute()){
				
				if(!empty($stmt->rowCount)){
					$expDateTimestamp = strtotime('expDate');
					$curDateTimestamp = strtotime($curDate);
					
					if((date_diff($expDateTimestamp, $curDateTimestamp)<=86400)){
					$valid = true;
					'DELETE FROM `password_reset_temp` WHERE email = $email';
					}else{
						echo 'The link expired';
					}
				}else{
					echo 'The link didn\'t work try again';
				}
			}
			unset $stmt;
		}

		if($valid){
			$sql = 'INSERT INTO `members` SET password = :password WHERE email = :email';
			
			if($stmt=$pdo->prepare($sql)){
				//Bind variables as parameters to prepared query
				$stmt->bindParam(':password', $param_password, PDO::PARAM_STR);
				$stmt->bindParam(':email', $param_email, PDO::PARAM_STR);
				//Set paramtets
				$param_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
				$param_email = $_GET['email'];
				
				if($stmt->execute()){
					$successMsg ='You have changed your password.';
					$loginMsg = 'Please, login using your new paassword.';
					include __DIR__ . '/../../templates/login.html.php';
				}else{
					echo 'Password was not changed, please try again';
				}
			
			}
		}
	}
}