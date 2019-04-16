<?php
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