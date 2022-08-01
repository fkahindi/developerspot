<?php
require_once __DIR__ .'/../../../includes_devspot/DatabaseConnection.php';
require_once __DIR__ .'/../classes/CommentsClass.php';

//Receives values from jQuery for posting comments
if(isset($_POST['submit_comment']) && $_POST['body']!=="" && !empty($_POST['user_id'])){
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

//Receives values from jQuery for posting replies
if(isset($_POST['post_reply']) && $_POST['reply_text']!=="" && !empty($_POST['user_id'])){

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
	$comments = $getComments->getPublishedCommentsByPost($page_id, $limit);
	include __DIR__ .'/../comments_display_main_block.php';
}

//If user clicks Publish/ Unpublish comment button
if(isset($_GET['publish-comment']) || isset($_GET['unpublish-comment'])){
	$message ='';
	$post_id = $_GET['page_id'];
	if(isset($_GET['publish-comment'])){
		$published = 1;
		$message = 'Comment published successfully.';
		$comment_id = $_GET['publish-comment'];
	}elseif(isset($_GET['unpublish-comment'])){
		$published = 0;
		$message = 'Comment successfully unpublished.';
		$comment_id = $_GET['unpublish-comment'];
	}
	togglePublishComment($post_id, $published, $message);
}
//If user clicks Publish/ Unpublish reply button
if(isset($_GET['publish-reply']) || isset($_GET['unpublish-reply'])){
	$message ='';
	$comment_id = $_GET['comment_id'];
	if(isset($_GET['publish-reply'])){
		$published = 1;
		$message = 'Reply published successfully.';
		$reply_id = $_GET['publish-reply'];
	}elseif(isset($_GET['unpublish-reply'])){
		$published = 0;
		$message = 'Reply successfully unpublished.';
		$reply_id = $_GET['unpublish-reply'];
	}
	togglePublishReply($reply_id, $published, $message);
}

//If user clickd delete-comment button
if(isset($_GET['delete-comment'])){
	$comment_id = $_GET['delete-comment'];
	$post_id = $_GET['page_id'];

	deleteComment($comment_id, $post_id);
}

//If user clickd delete-reply button
if(isset($_GET['delete-reply'])){
	$reply_id = $_GET['delete-reply'];
	$comment_id = $_GET['comment_id'];

	deleteReply($reply_id, $comment_id);
}

/* Publish/ unpublish comments */
function togglePublishComment($post_id, $published, $message){
	global $conn, $comment_id, $post_id;

	$sql = "UPDATE `comments` SET published =$published WHERE comment_id=$comment_id";
	if(mysqli_query($conn, $sql)){
		$_SESSION['message'] = $message;
		header('Location: admin-post-comments.php?view-comments='.$post_id);
		exit(0);
	}
}

/* //Delete comment  */
function deleteComment($comment_id, $post_id){
	global $conn, $errors;

	$sql = "DELETE FROM `comments` WHERE comment_id = $comment_id";
	if(mysqli_query($conn, $sql)){

		$_SESSION['message'] = 'Comment with related replies deleted successfully.';
		header('Location: admin-post-comments.php?view-comments='.$post_id);
			exit(0);
	}else{
		array_push($errors, 'Delete failed! <br><strong>Description:</strong><br> '. $conn->error);
	}
}

/* Publish/ unpublish reply */
function togglePublishReply($reply_id, $published, $message){
	global $conn, $reply_id, $comment_id;

	$sql = "UPDATE `replies` SET published =$published WHERE reply_id=$reply_id";
	if(mysqli_query($conn, $sql)){
		$_SESSION['message'] = $message;
		header('Location: admin-comment-replies.php?view-replies='.$comment_id);
		exit(0);
	}
}

/* //Delete reply  */
function deleteReply($reply_id, $comment_id){
	global $conn, $errors;

	$sql = "DELETE FROM `replies` WHERE reply_id = $reply_id";
	if(mysqli_query($conn, $sql)){

		$_SESSION['message'] = 'Reply deleted successfully.';
		header('Location: admin-comment-replies.php?view-replies='.$comment_id);
			exit(0);
	}else{
		array_push($errors, 'Delete failed! <br><strong>Description:</strong><br> '. $conn->error);
	}
}