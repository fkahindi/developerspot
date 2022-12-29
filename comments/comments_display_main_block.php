<?php
if(!isset($_SESSION)){
	session_start();
}
?>
<?php if(!empty($comments)): ?>
	<div class="comments-area" id="comments-area">
	<!-- Comments display area -->
		<?php foreach($comments as $comment): ?>
		<div class="comments-section group" >
			<div class="hide-comment-id">
				<?php echo $comment['comment_id']; ?>
				<?php $numOfReplies = new CommentsReplies($pdo,'replies','comment_id','published');?>
				<?php $num_replies=$numOfReplies->countPublishedRecords($comment['comment_id'],1) ; ?>
			</div>
			<div class="profile-photo">
			<?php
				//Get commentors from users and aouth tables
				$usersTable = new CommentsReplies($pdo,'users','user_id');
				$getUser=$usersTable->selectSingleRecord($comment['user_id']);

				$oauthTable = new CommentsReplies($pdo, 'oauth_login', 'uid');
				$oauthUser =$oauthTable->selectSingleRecord($comment['user_id']);

			?>
				<img src="<?php echo $comment['authenticator']=='direct'?  $getUser['profile_photo']: $oauthUser['profile_photo'] ?>" alt="User photo" width=30px height=30px>
			</div>
			<div class="comments-detail">
				<div class="user-info">
					<span class="username"><?php echo $comment['authenticator']=='direct'? $getUser['username']:$oauthUser['username'] ?></span>
					<span class="created-date"><?php echo date('F j, Y  \a\t H:i', strtotime($comment['created_at'])); ?></span>
				</div>
				<div class="comment-text">
					<?php echo $comment['body']; ?>
				</div>
					<!--If user is logged in, provide a link to display reply textbox -->

					<a href="#" data-id="<?php echo $comment['comment_id']; ?>" id="reply_btn_<?php echo $comment['comment_id']; ?>" class="reply-btn">Reply</a>

					<?php if($num_replies>0):?>
					<a href="#" data-id="<?php echo $comment['comment_id']; ?>" id="reply_thread_<?php echo $comment['comment_id']; ?>" class="reply-thread">&#9660;</a><span><?php echo $num_replies; ?> Replies</span>
					<?php endif; ?>
						<!-- Reply form -->
					<div class="reply">
						<?php include __DIR__ .'/reply_form.php';?>
					</div>

				<div class="group replies_container_<?php echo $comment['comment_id']; ?>" >
					<div class="replies_by_ajax">
						<!--Display reply by AJAX here -->
					</div>
					<!-- Get all replies by comment_id and display them below -->
					<?php $getReplies = new CommentsReplies($pdo,'replies','comment_id','published');?>
					<?php $replies = $getReplies->getAllPublishedRecords($comment['comment_id'],1) ?>
					<?php if(!empty($replies)): ?>
						<?php foreach($replies as $reply): ?>
							<!--Reply -->
							<div class="group">
								<div class="replies-profile-photo">
									<?php
										//Get users from users and oauth tables
										$getUser=$usersTable->selectSingleRecord($reply['user_id']);
										$oauthUser=$oauthTable->selectSingleRecord($reply['user_id']);
									?>
									<img src="<?php echo $reply['authenticator']=='direct'? $getUser['profile_photo'] : $oauthUser['profile_photo'] ?>" alt="User photo" width=30px height=30px>
								</div>
								<div class="replies-detail">
									<div class="user-info">
										<span class="username"><?php echo $reply['authenticator']=='direct'? $getUser['username'] : $oauthUser['username'] ?></span>
										<span class="created-date"><?php echo date('F j, Y \a\t H:i', strtotime($reply['created_at'])); ?></span>
									</div>
									<div class="reply-text">
										<?php echo $reply['body']; ?>
									</div>
								</div>
							</div><br>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php endforeach; ?>
		<!--Display form comments using AJAX below here -->
	</div>
	<?php endif ?>