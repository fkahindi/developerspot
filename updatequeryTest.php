<?php
include __DIR__ . '/includes/DatabaseConnection.php';


$update = updatePassword($pdo, 'Francis Kahindi', 'fkahindi@yahoo.com');

echo 'Affected row is '.$update;

function updatePassword($pdo, $fullname, $email) {
	$sql='UPDATE `members` SET `fullname` = :fullname
	WHERE `email` = :email';
	$parameters = [':fullname' => $fullname,
	':email' => $email];
	query($pdo, $sql, $parameters);
}

function query($pdo, $sql, $parameters=[]){
	$query = $pdo->prepare($sql);
	$query->execute($parameters);
	return $query;
}