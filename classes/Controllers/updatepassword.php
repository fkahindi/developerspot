<?php
	//Prepare a select statement
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
					header('Location: ../templates/login.html.php');
				}else{
					echo 'Sorry, password update was not successful';
				}
				unset($stmt);
			}
		}	