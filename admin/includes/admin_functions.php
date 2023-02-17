<?php
require_once __DIR__ .'/../../../includes_devspot/DbConnection.php';

/* Admin user variable */
$user_id =0;
$isEditingUser = false;
$isSearchUser = false;
$username ='';
$role = '';
$email ='';

/* general variables */
$errors =[];

/* Topic variables */
$topic_id =0;
$isEditingTopic = false;
$topic_name = '';
$topic_intro = '';
$topic_description = '';
$topic_keywords = '';

/*-----------------------
-- Admin user actions
------------------------*/

/* if user clicks Edit user button */
if(isset($_GET['edit-user'])){
	$isEditingUser = true;
	$user_id = $_GET['edit-user'];
	$user_role = $_GET['role'];
	editUser($user_id);
}
/* if user clicks Search button */
if(isset($_POST['search_user'])){
	$isSearchUser = true;
	searchUser($_POST['search_user']);
}
/* if user clicks Update user button */
if(isset($_POST['update_user'])){
	updateUser($_POST['update_user']);
}
/*-----------------------------
--Topic actions
------------------------------*/
/* if user clicks the Create topic button */
if(isset($_POST['create_topic'])){
	createTopic($_POST);
}
/* if user clicks the Edit topic button */
if(isset($_GET['edit-topic'])){
	$isEditingTopic = true;
	$topic_id = $_GET['edit-topic'];
	editTopic($topic_id);
}
/* if user clicks the Update topic button */
if(isset($_POST['update_topic'])){
	updateTopic($_POST);
}
/* if user clicks the Delete topic button */
if(isset($_GET['delete-topic'])){
	$topic_id = $_GET['delete-topic'];
	deleteTopic($topic_id);
}

/*---------------------------------
--Admin user functions
----------------------------------
*/

/* ***************************
--Uses user_id, fetches user from database
--Sets the fields on the form
--Allows only role to be changed
**************************** */
function editUser($user_id){
	global $conn, $username, $user_id, $email;

	$sql = "SELECT * FROM `users` WHERE user_id=$user_id";
	$result = mysqli_query($conn, $sql);
	$user = mysqli_fetch_assoc($result);

	/* Set fields on the form: One field "User role" will be editable */
	$username = $user['username'];
	$email = $user['email'];
	$user_id = $user['user_id'];
}

/**********************************
*--Takes user id from the form
*--Updates user role on the database
**********************************/
function updateUser($request_values){
	global $conn, $user_id, $role, $isEditingUser, $user_errors;

	/* get id of the user to be updated */
	if(isset($_POST['user_id'])){
		$user_id = $_POST['user_id'];
	}else{
		$user_errors['user']='No user available to update.';
	}

	if(empty($_POST['role'])){
		$user_errors['user']='No role given to update';
		return;
	}else{
		$role = $_POST['role'];
	}

	/* update user role if no errors on the form */
	if(empty($user_errors)){
		/* set editing state to false */
		$isEditingUser = false;

		if($role =='Admin'){
			$query = "UPDATE `users` SET role_id=1, updated_at=now() WHERE user_id=$user_id";
		}elseif($role == 'Author'){
			$query = "UPDATE `users` SET role_id=2, updated_at=now() WHERE user_id=$user_id";
		}elseif($role == 'User'){
			$query = "UPDATE `users` SET role_id=3, updated_at=now() WHERE user_id=$user_id";
		}
		if(mysqli_query($conn, $query)){
			$_SESSION['message'] = 'User role update successful';
			header('Location: users.php');
			exit(0);
		}
	}
}
function searchUser($request_values){
	global $conn, $user_id, $username, $email, $user_errors;

	if(!empty($_POST['username']) || !empty($_POST['email'])){

		$username = $_POST['username'];
		$email = $_POST['email'];

		$query = "SELECT * FROM `users` WHERE username='$username' OR email='$email'";

		$result = mysqli_query($conn, $query);
		$user_record = mysqli_fetch_assoc($result);

		if($user_record>=1){
			$user_id =$user_record['user_id'];
			$username = $user_record['username'];
			$email = $user_record['email'];
		}else{
			$user_errors['user'] = 'User not found';
		}

	}else{
		$user_errors['user'] = 'Search user by "Username" or "Email"';
	}
}

/*******************************************
*--Returns all admin users with their roles
********************************************/
function getAdminUsers(){
	global $conn;

	$sql = "SELECT * FROM `users` WHERE role_id=1 || role_id=2";
	$result = mysqli_query($conn, $sql);
	$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$final_users = array();
	foreach($users as $user){
		$user['role'] = getUserRole($user['role_id']);
		array_push($final_users, $user);
	}
	return $final_users;
}

function getUserRole($role_id){
	global $conn;

	$query = "SELECT role FROM `roles` WHERE role_id=$role_id";
	$result = mysqli_query($conn, $query);

	if($result){
		$role = mysqli_fetch_assoc($result);
		return $role['role'];
	}else{
		return null;
	}
}
/*******************************************
*--Returns first 20 subscribers
********************************************/
function getSubscribers(){
	global $conn;
	$sql ="SELECT * FROM `subscribers` WHERE subscribed=1 LIMIT 20";
	$result = mysqli_query($conn, $sql);
	if($result){
		$subscribers = mysqli_fetch_all($result, MYSQLI_ASSOC);
		return $subscribers;
	}else{
		return null;
	}
}
/**************************************
*-Escapes from submitted values
*-to prevent mysql injection
*************************************/
function esc(string $value){
	global $conn;

	$val = trim($value);
	$val = mysqli_real_escape_string($conn, $val);
	return $val;
}

/******************************************
*-Recieve a string like "sunny sand beaches" and
*-returns "sunny-sand-beaches"
******************************************/
function makeSlug(string $string){
	$string = strtolower($string);
	$slug = preg_replace('/[^A-za-z,0-9-]+/', '-',$string);
	return $slug;
}

/*----------------------------------
--Topic functions
-----------------------------------*/

/* Get all topics from database */

function getAllTopics(){
	global $conn;

	$sql = "SELECT * FROM `topics`";
	$result = mysqli_query($conn, $sql);
	$topics = mysqli_fetch_all($result, MYSQLI_ASSOC);

	return $topics;
}

function createTopic($request_values){
	global $conn, $topic_errors, $topic_name, $topic_intro,$topic_description,$topic_keywords;

	$topic_name = esc($request_values['topic_name']);
	$topic_intro =esc($request_values['topic_intro']);
	$topic_description =esc($request_values['topic_description']);
	$topic_keywords =esc($request_values['topic_keywords']);

	/* Validate form  */
	if(empty($topic_name)){
		$topic_errors['topic']='Topic name required.';
	}else{
		/* create slug */
		$topic_slug = makeSlug($topic_name);
		/* To ensure that no topic is saved twice */
		$topic_check_query = "SELECT  * FROM `topics` WHERE topic_slug='$topic_slug' LIMIT 1";
		$result = mysqli_query($conn, $topic_check_query);
		if(mysqli_num_rows($result)>0){
			$topic_errors['db_error']='Topic already exists !!';
		}
	}

	/* Register topic if no errors */
	if(!$topic_errors){

		$query = "INSERT INTO `topics`(topic_name, topic_slug, topic_intro, topic_description,topic_keywords) VALUES ('$topic_name', '$topic_slug','$topic_intro','$topic_description','$topic_keywords')";

		if(mysqli_query($conn, $query)){
			$_SESSION['message'] = 'Topic created successfully.';
			header('Location: topics.php');
			exit(0);
		}else{
			$topic_errors['db_error']='There was a problem creating topic.'. ' '.$conn->error;
		}

	}
}

/***********************************
*-Fetches a topic from database
*-Sets it on the form for editing
***********************************/
function editTopic($topic_id){
	global $conn, $topic_name,$topic_intro, $topic_description, $topic_keywords, $topic_id;

	$sql = "SELECT * FROM `topics` WHERE topic_id=$topic_id LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$topic = mysqli_fetch_assoc($result);

	/* Set topic_name to be updated on the form */
	$topic_name = $topic['topic_name'];
	$topic_intro = $topic['topic_intro'];
	$topic_description = $topic['topic_description'];
	$topic_keywords = $topic['topic_keywords'];
}

function updateTopic($request_values){
	global $conn, $topic_name,$topic_errors, $topic_intro, $topic_description, $topic_keywords, $topic_id;

	$topic_id = esc($request_values['topic_id']);
	$topic_name = esc($request_values['topic_name']);
	$topic_intro = esc($request_values['topic_intro']);
	$topic_description = esc($request_values['topic_description']);
	$topic_keywords = esc($request_values['topic_keywords']);
	/* Create slug */
	$topic_slug = makeSlug($topic_name);

	/* Validate form */
	if(empty($topic_name)){
		$topic_errors['topic'] ='Topic name is required.';
	}

	/* Register topic if there are no errors */
	if(!$topic_errors){

		$query = "UPDATE `topics` SET topic_name='$topic_name', topic_slug='$topic_slug', topic_intro='$topic_intro',topic_description='$topic_description',topic_keywords='$topic_keywords' WHERE topic_id=$topic_id";

		if(mysqli_query($conn, $query)){
			$_SESSION['message'] = 'Topic update successful.';
			header('Location:topics.php');
			exit(0);
		}else{
			$topic_errors['topic'] ='There was a problem updating topic.'. ' '.$conn->error;
		}
	}
}

/* Delete topic */
function deleteTopic($topic_id){
	global $conn, $errors;

	$sql = "DELETE FROM `topics` WHERE topic_id=$topic_id";

	if(mysqli_query($conn, $sql)){
		$_SESSION['message'] = 'Topic delete successful.';
		header('Location: topics.php');
		exit(0);
	}else{
		$errors = 'Topic could not be updated. '.$conn->error;
	}
}