<div class="reply">	
	<form method="post" class="reply-form" id="comment_reply_from_<?php echo $comment['comment_id']?>" data_id="<?php echo $comment['comment_id']?>">
		<textarea name="reply" id="reply_textarea_<?php echo $comment['comment_id']; ?>" cols="30" rows="4" maxlenth="70" placeholder="Type your reply..." ></textarea>
		<input type="hidden" name="user_id" class="reply_form_user_id" value="<?php echo $_SESSION['user_id'] ?>">
		<input type="submit" id="post_reply_<?php echo $comment['comment_id']; ?>" name="submit" value="Post" >
	</form>
</div>