<?php
class userValidation{
		
	public function userRegistration($email, $password){
		include __DIR__ .'/../../includes/DatabaseConnection.php';
		try{
			
			$query = 'SELECT * FROM `members` WHERE `email` = :email';
			$stmt = $pdo->prepare($query);
			$stmt->bindValue(':email', $email);
			$stmt->execute();
			
			$count = $stmt->rowCount();
			if($count == 0){
				//insert the new record when match not found
				$sql='INSERT INTO `members`(firstname, lastname, email, password, date_reg)VALUES(:fname, :lname, :email, :password, :date_reg)';
				
				
				$stmt = $pdo->prepare($sql);
				$stmt->bindValue(':fname', $_POST['firstname']);
				$stmt->bindValue(':lname', $_POST['lastname']);
				$stmt->bindValue(':email', $_POST['lastname']);
				$stmt->bindValue(':password', $_POST['password']);
				
				
				$stmt->execute();
				
				$newCount=$stmt->rowCount();
				
				if($newCount == 1){
					$user = $pdo->lastInsertId();
					
					return true;
				}else{
					
					return false;
				}
			}else{
				echo 'Email already exits';
				
				return false;
			}
		}catch(PDOException $e){
			//echo 'Connection failed: '. $e->getMesssage();
		}
	}
	
	//Logic and validation for user login page
	public function userLogin($email, $password){
		try{
			$sql ='SELECT * FROM `members` WHERE `email` = :email AND `password` = :password';
			$stmt = $pdo->prepare($sql);
			
			$stmt->bindValue(':email', $_POST['password']);
			$stmt->bindValue(':password', password_verify($_POST['password'], 'members.[0][password]'));
			$stmt->execute();
			
			$count=$stmt->rowCount();
			$data=$stmt->fetch(PDO::FETCH_OBJ);
			
			if($count == 1){
				session_start();
				session_regenerate_id();
				$_SESSION['email'] = $password;
				$_SESSION['password']=$member[0][$this->paasowrd];
				return true;
			}else{
				return false;
			}
		}catch(PDOException $e){
			echo 'Connection failed: '. $e->getMesssage();
		}
	}
}