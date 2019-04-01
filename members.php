<?php
include 'includes/DatabaseConnection.php';
try{
	$sql= 'SELECT * FROM `members`';
	$result=$pdo->query($sql);
	
	
	$title ='Members List';
	
	ob_start();
	
	include __DIR__ .'/templates/members.html.php';
	
	$output = ob_get_clean();
}
catch(PDOException $e){
	$title ='An error has occured';
	$output = 'Database error: ' . $e->getMessage() . '
	in ' .$e->getFile() . ':' . $e->getLine();
}
include __DIR__ .'/templates/layout.html.php';

