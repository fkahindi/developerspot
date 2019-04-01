<?php
try{
	$pdo = new PDO('mysql:host=localhost; dbname=spex_db; charset=utf8',
	'spex_db_user_member','nfyafGrmoFTOqgu5');
	
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
}catch(PDOException $e){
	$title ='An error has occured';
	$output = 'Database error: ' . $e->getMessage() . ' in '
	. $e->getFile() . ':' . $e->getLine();
}