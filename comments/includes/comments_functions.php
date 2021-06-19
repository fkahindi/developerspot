<?php
require_once __DIR__ .'/../../../includes_devspot/DatabaseConnection.php';
require_once __DIR__ .'/../classes/CommentsClass.php';

/* //Receives values from jQuery for posting comments */	
if(isset($_POST['submit_comment']) && $_POST['body']!==""){
	$user_id = $_POST['user_id']; 
	$page_id = $_POST['page_id'];
	$body = htmlspecialchars($_POST['body']);
	
	$sql = "INSERT INTO `comments` (user_id, post_id, body, created_at) VALUES (:user_id, :page_id, :body, now())";
	
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(':user_id', $user_id);
	$stmt->bindValue(':page_id', $page_id);
	$stmt->bindValue(':body', $body);
		
	$stmt->execute();

	$last_id = $pdo->lastInsertId();
	
	$query = "SELECT * FROM comments WHERE comment_id = :last_id";

	$row = $pdo->prepare($query);
	$row->bindValue(':last_id', $last_id);
	$row->execute();
	
	$comment=$row->fetch();
	
	include __DIR__ . '/../comments_output.php';			
}

/* //Receives values from jQuery for posting replies */
if(isset($_POST['post_reply']) && $_POST['reply_text']!==""){
	
	$comment_id = $_POST['comment_id']; 
	$user_id = $_POST['user_id'];
	$reply_text = htmlspecialchars($_POST['reply_text']);
			
	$sql = "INSERT INTO `replies` (user_id, comment_id, body, created_at, updated_at) VALUES (:user_id, :comment_id, :reply_text, now(), null)";

	$query=$pdo->prepare($sql);
	$query->bindValue(':user_id',$user_id);
	$query->bindValue(':comment_id',$comment_id);
	$query->bindValue(':reply_text',$reply_text);
	
	$query->execute();
	$insert_id = $pdo->lastInsertId();
	
	if($insert_id){
		$query = "SELECT * FROM replies WHERE reply_id = :insert_id";

		$reply_row = $pdo->prepare($query);
		$reply_row->bindValue(':insert_id', $insert_id);
		
		$reply_row->execute();
		$reply=$reply_row->fetch();
			
		include __DIR__ . '/../replies_output.php';
		
	}	
}

if(isset($_POST['load_more'])){
	
	$page_id = $_POST['page_id'];
	$limit = $_POST['limit'];
	$getComments = new CommentsClass($pdo);
	$comments = $getComments->getAllPostComments($page_id, $limit);
	include __DIR__ .'/../comments_display_main_block.php';
}
