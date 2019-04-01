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
				if($stmt->rowCount()== 0){
					$valid = false;
					$errors['email'] = 'No user is registered with this email address';
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
			$expDate = new DateTime();
			$key = md5(2418*2+$email);
			$addkey = substr(md5(uniqid(rand(),1)),3,10);
			$key = $key . $addkey;
			
			//Insert into Temp Table
		
			$sql = 'INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`) VALUES (:email, :key, :expDate)';
			
			if($stmt=$pdo->excute($sql)){
				
				$stmt=bindParam(':email', $param_email, PDO::PARAM_STR);
				$stmt=bindParam(':key', $param_key,PDO::PARAM_STR);
				$stmt=bindParam('expDate', $param_expDate,PDO::PARAM_STR);
				
				//Set parameters
				$param_email = $email;
				$param_key = $key;
				$param_expDate = $expDate->format('Y-m-d H:i:s');
				
				if($stmt->execute()){
					include __DIR__. '/../../includes/phpmailer.php';
				}else{
					echo 'Something gone wrong try later';
				}
				unset($stmt);
			}
			
		}
		
		
		
	
		