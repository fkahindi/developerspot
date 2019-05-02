<?php
include __DIR__ .'/includes/DatabaseConnection.php';

selectRecord($pdo, ['email' => 'fkahindi@yahoo.com']);

echo $query;

function selectRecord($pdo, $fields){
	
	$query = 'SELECT * FROM `members`';
	
	foreach ($fields as $key=>$value){
		$query .= '`'.$key. '` =:' . $key. ',';
	}
	
	$query .= rtrim($query, ',');
	
	$query .= 'WHERE `email` = :$key';
	
	query($pdo, $query, $fields);
	
}

function query($pdo, $sql, $fields=[]){
	$query = $pdo->prepare($sql);
	$query->execute($fields);
	return $query;
}