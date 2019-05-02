<?php
	$pdo = new PDO('mysql:host=localhost; dbname=spex_db; charset=utf8',
	'spex_db_user_member','AQD8Z0jHlUJypnKf');
	
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	