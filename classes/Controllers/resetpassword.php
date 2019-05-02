<?php
if(isset($_GET['key']) && isset($_GET['email']) && isset($_GET['action'])){
	$token = $_GET['key'];
	$email = $_GET['email'];
	$curDate = date('Y-m-d H:i:s');
	$new_password = $_POST['new_password'];
	
	
	$sql = 'SELECT * FROM `password_reset_temp` WHERE email = :email && token = :key';
	
	if($stmt=$pdo->prepare($sql)){
		//Bind variables
		$stmt->bindValue(':key', $token);
		$stmt->bindValue(':email', $email);
		
		if($stmt->execute()){
			
			if(!empty($stmt->rowCount)){
				$expDateTimestamp = strtotime('expDate');
				$curDateTimestamp = strtotime($curDate);
				
				if((date_diff($expDateTimestamp, $curDateTimestamp)<=86400)){
				$valid = true;
				'DELETE FROM `password_reset_temp` WHERE email = $email';
				}else{
					echo 'The token expired';
				}
			}else{
				echo 'The link didn\'t work, please try again';
			}
		}else{
		echo 'Email or token did not match';	
	
	}
	
	}
	

	if($valid){
		$sql = 'UPDATE `members` SET password = :new_password WHERE email = :email';
		
		if($stmt=$pdo->prepare($sql)){
			//Bind variables as parameters to prepared query
			$stmt->bindParam(':new_password', $param_new_password, PDO::PARAM_STR);
			$stmt->bindParam(':email', $param_email, PDO::PARAM_STR);
			//Set paramtets
			$param_new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
			$param_email = $_GET['email'];
			
			if($stmt->execute()){
				$successMsg ='You have changed your password.';
				$loginMsg = 'Please, login using your new paassword.';
				include __DIR__ . '../templates/signin.html.php';
			}else{
				echo 'Password was not changed, please try again';
			}
		
		}
	}
}else{
	echo 'Required parameters were not set';
}