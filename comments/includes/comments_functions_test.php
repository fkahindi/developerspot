<?php
require_once __DIR__ .'/../../../includes_devspot/DatabaseConnection.php';
require_once __DIR__ .'/../classes/CommentsClassTest.php';

//Receives values from jQuery for posting comments
if(isset($_POST['submit_comment']) && $_POST['body']!=="" && !empty($_POST['user_id'])){
	$user_id = $_POST['user_id'];
	$page_id = $_POST['page_id'];
	$body = htmlspecialchars($_POST['body']);

  $fields = [
    'user_id' =>$user_id,
    'post_id' => $page_id,
    'body' => $body
  ];
  $comments_table = new CommentsClassTest($pdo, 'comments','comment_id');
  $comments_table->insertRecord($fields);

  $last_id = $pdo->lastInsertId();

  $comment= $comments_table->selectSingleRecord($last_id);

	include __DIR__ . '/../comments_output.php';
}

//Receives values from jQuery for posting replies
if(isset($_POST['post_reply']) && $_POST['reply_text']!=="" && !empty($_POST['user_id'])){

	$comment_id = $_POST['comment_id'];
	$user_id = $_POST['user_id'];
	$reply_text = htmlspecialchars($_POST['reply_text']);

  $fields =[
    'comment_id'=>$comment_id,
    'user_id'=>$user_id,
    'reply_text'=>$reply_text
  ];
  $reply_table = new CommentsClassTest($pdo,'replies','reply_id');

	$reply_table->insertRecord($fields);
  $last_id = $pdo->lastInsertId();

  $reply = $reply_table->selectSingleRecord($last_id);

  include __DIR__ . '/../replies_output.php';

}

if(isset($_POST['load_more'])){

	$page_id = $_POST['page_id'];
	$limit = $_POST['limit'];

	$get_comments = new CommentsClassTest($pdo, 'comments','page_id', 'published');
  $comments = $get_comments->getAllPublishedRecords($page_id,1,$limit);

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
	$toggle_comment = new CommentsClassTest($pdo, 'comments','comment_id','published');

 $toggledComment = $toggle_comment->toggleRecord($comment_id, $published);


  $_SESSION['message'] = $message;
		header('Location: admin-post-comments.php?view-comments='.$post_id);
		exit(0);

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
	$toogle_reply = new CommentsClassTest($pdo, 'replies','reply_id','published');
  $toggledReply = $toogle_reply->ToggleRecord($reply_id,$published);

	$_SESSION['message'] = $message;
	header('Location: admin-comment-replies.php?view-replies='.$comment_id);
	exit(0);

}

//If user clickd delete-comment button
if(isset($_GET['delete-comment'])){
	$comment_id = $_GET['delete-comment'];
	$post_id = $_GET['page_id'];

  $deletedComment = $comments_table->deleteRecords($comment_id);

	$_SESSION['message'] = 'Comment with related replies deleted successfully.';
	header('Location: admin-post-comments.php?view-comments='.$post_id);
	exit(0);

}

//If user clickd delete-reply button
if(isset($_GET['delete-reply'])){
	$reply_id = $_GET['delete-reply'];
	$comment_id = $_GET['comment_id'];

  $deletedReply = $reply_table->deleteRecords($reply_id);

	$_SESSION['message'] = 'Reply deleted successfully.';
	header('Location: admin-comment-replies.php?view-replies='.$comment_id);
	exit(0);

}



