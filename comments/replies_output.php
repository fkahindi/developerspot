<div class="group">
	<?php
		//Get commentors from users and aouth tables
		$users_table = new CommentsReplies($pdo,'users','user_id');
		$getUser = $users_table->selectSingleRecord($reply['user_id']);

		$oauthTable = new CommentsReplies($pdo, 'oauth_login', 'uid');
		$oauthUser =$oauthTable->selectSingleRecord($reply['user_id']);
	?>
	<div class="replies-profile-photo">
		<img src="<?php echo $reply['authenticator']=='direct'? $getUser['profile_photo'] : $oauthUser['profile_photo'] ?>" alt="" width=30px height=30px data-pin-nopin="0"/>
	</div>
	<div class="replies-detail">
		<div class="user-info">
			<span class="username"><?php echo $reply['authenticator']=='direct'? $getUser['username'] : $oauthUser['username'] ?></span>
			<span class="created-date"><?php echo date('F j, Y ', strtotime($reply['created_at'])); ?></span>
		</div>
		<div class="reply-text">
			<?php echo $reply['body']; ?>
		</div>
	</div>
</div><br>