<?php
include __DIR__ .'/../../includes/DatabaseConnection.php';

$sql = 'SELECT * FROM `articles`';

$result = $pdo->query($sql);

while($row = $result->fetch()){
	$title= $row['title'];
	$content= $row['content'];
}

echo $title;
echo $content;