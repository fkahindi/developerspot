<?php
	//Prepare a select statement
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