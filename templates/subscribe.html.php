<div class="subscribe-section">
	<form  method="POST" action="" id="subscribe" >
		<div class="subscribe_error"></div>
			<input name="email" id="email" class="form-control" type="text" 
			 type="email" placeholder="Enter email" value="<?php echo(empty($email)? '': $email); ?>" maxlength="50" autocomplete="off"><input name="subscribe" type="submit" id="submit_subscribe" class="button" value="Subscribe"><br>
			<span class="errorMsg"> <?php echo(!empty($errors['email']) ? $errors['email'] : ''); ?> </span>		
	</form>
	<div id="subscribe_response"><p></p></div>
</div>
<hr>
