<?php
if($_SESSION['role'] == 'Admin'){
	header('Location: dashboard.php');
}else{
	header('Location: ../index.php');
}
?>