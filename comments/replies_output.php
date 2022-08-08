<div class="group">
	<div class="replies-profile-photo">
		<?php
			$users_table = new CommentsReplies($pdo,'users','user_id');
			$getUser = $users_table->selectSingleRecord($reply['user_id']);
		?>
		<img src="<?php echo $getUser['profile_photo']; ?>" alt="" width=30px height=30px data-pin-nopin="0"/>
	</div>
	<div class="replies-detail">
		<div class="user-info">
			<span class="username"><?php echo $getUser['username']; ?></span>
			<span class="created-date"><?php echo date('F j, Y ', strtotime($reply['created_at'])); ?></span>
		</div>
		<div class="reply-text">
			<?php echo $reply['body']; ?>
		</div>
	</div>
</div><br>