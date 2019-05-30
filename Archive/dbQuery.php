<?php
function query($pdo, $sql, $parameters=[]){
	$query = $pdo->prepare($sql);
	
	foreach ($parameters as $name => $value){
		$query->bindValue($name, $value);
	}
	$query->execute();
	
	return $query;
}