	<div class="group">
		<div class="replies-profile-photo">
			<?php $getUser = new CommentsClass($pdo); ?>
			<img src="<?php echo $getUser->getUserById($reply['user_id'])['profile_photo']; ?>" alt="" width=30px height=30px data-pin-nopin="0"/>
		</div>
		<div class="replies-detail">
			<div class="user-info">
				<span class="username"><?php echo $getUser->getUserById($reply['user_id'])['username']; ?></span>
				<span class="created-date"><?php echo date('F j, Y ', strtotime($reply['created_at'])); ?></span>
			</div>
			<div class="reply-text">
				<?php echo $reply['body']; ?>
			</div>
		</div>
	</div><br>