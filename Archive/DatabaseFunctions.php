<?php
function selectRecord($pdo, $email) {
	$sql = 'SELECT * FROM `members`
	WHERE `email` = :email';
	$parameters =['email'=> $email];

	$query = query($pdo, $sql, $parameters);
	return $query;
}

function selectPasswordTemp($pdo, $email, $token){
	$sql= 'SELECT * FROM `password_reset_temp`
	WHERE `email` = :email && `token` =:key';
	
	$parameters =['email'=>$email, 'key'=>$token];
	
	$query = query($pdo, $sql, $parameters);
	return $query;
}
function insertRecord($pdo, $fullname, $email, $password, $date_reg) {
	$query = 'INSERT INTO `members` (`fullname`, `email`, `password`, `date_reg`) VALUES (:fullname, :email, :password, :date_reg)';

	$parameters = [':fullname' => $fullname, ':email'=> $email, ':password'=> $password, ':date_reg'=> $date_reg];
	query($pdo, $query, $parameters);

}
function insertToken($pdo, $email, $token, $expDate){
	$sql ='INSERT INTO `password_reset_temp` (`email`, `token`, `expDate`) VALUES (:email, :token, :expDate)';
	$parameters = [':email'=> $email, ':token'=> $token, ':expDate'=>$expDate];
	query($pdo, $sql, $parameters);
	
}
function updatePassword($pdo, $new_password, $email) {
	$sql='UPDATE `members` SET `password` = :new_password
	WHERE `email` = :email';
	$parameters = [':new_password' => $new_password,
	':email' => $email];
	query($pdo, $sql, $parameters);
}

function updateImage($pdo, $photo, $email){
	$sql ='UPDATE `members` SET `photo` = :photo 
	WHERE `email` = :email';
	$parameters = [':photo' => $photo, ':email' => $email];
	query($pdo, $sql, $parameters);
}

function deleteToken($pdo, $email){
	$parameters = [':email' => $email];
	query($pdo, 'DELETE FROM `password_reset_temp`
	WHERE `email` = :email', $parameters);
}

function query($pdo, $sql, $parameters=[]){
	$query = $pdo->prepare($sql);
	$query->execute($parameters);
	return $query;
}

