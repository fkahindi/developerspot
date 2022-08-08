<?php
if(!isset($_SESSION)){
	session_start();
}
$users_table = new CommentsReplies($pdo,'users','user_id');
$getUser = $users_table->selectSingleRecord($comment['user_id']);
?>
<div class="comments-section group" >
	<div class="hide-comment-id"><?php echo $comment['comment_id']; ?></div>
	<div class="profile-photo"> <img src="<?php echo $getUser['profile_photo']; ?>" alt="" width=30px height=30px data-pin-nopin="0"/></div>
	<div class="comments-detail ">
		<div class="user-info">
			<span class="username"><?php echo $getUser['username']; ?></span>
			<span class="created-date"><?php echo date('F j, Y ', strtotime($comment['created_at'])); ?></span>
		</div>
		<div class="comment-text"><?php echo $comment['body']; ?></div>
	</div>
</div>
