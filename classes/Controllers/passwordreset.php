<?php
	//Prepare a select statement
	$sql = 'SELECT * FROM `members` WHERE email = :email';
		if($stmt=$pdo->prepare($sql)){
			//Bind variables to the prepared statement as parameters
			$stmt->bindParam(':email', $param_email, PDO::PARAM_STR);
			
			//Set parameters
			$param_email = $_POST['email']);
			
			//Attempt to execute the prepared statement
			if($stmt->execute()){
				if($stmt->rowCount()== 0){
					$valid = false;
					$email_err = 'No user is registered with this email address';
				}else{
					$valid = true;
					$email = $_POST['email'];
				}
			}else{
				$valid = false;
				echo 'Oops! Something went wrong';
			}
			
		}
		//If $valid is still true, no fields were left blank, email is not taken and idata can be added
		
		expDate = new DateTime()
		