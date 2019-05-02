<?php
	
		
	//If $valid is still true, no fields were left blank
	//Prepare a select statement
	$sql = 'SELECT id, fullname, email, password FROM `members` WHERE email = :email';
	
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
						$fullname = $row['fullname'];
						$email = $row['email'];
						$hashed_password = $row['password'];
						if(password_verify($password, $hashed_password)){
							
							//password is correct, start a new session						
							session_regenerate_id();
							
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
	
	
	
	