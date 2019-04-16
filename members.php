<?php
session_start();

include __DIR__ . '/includes/loginStatus.php';

include __DIR__ .'/templates/layout.html.php';

include __DIR__ .'/includes/DatabaseConnection.php';


try{
	$title = $output='';
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


