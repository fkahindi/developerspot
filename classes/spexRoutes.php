<?php
public function getAuthentication() {
$membersTable = new \Frameworks\DatabaseTable($pdo,'members', 'email');
return new \Frameworks\Authentication($authorsTable,
'email', 'password');
}