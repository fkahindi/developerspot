<form  method="POST" action="" id="contact-me-form" >	
		<div class="group-form">
			<label for="name">Name:<span class="red"> &#42;</span></label>
			<input  name="name" id="name" class="form-control" type="text" 
			value="<?php echo (empty($username)? '': $username); ?>" maxlength="50" autocomplete="off" >
			<span class="errorMsg"> <?php echo(!empty($errors['name']) ? $errors['name'] : ''); ?></span>
		</div>
		<div class="group-form">
			<label for="email"> Email:<span class="red"> &#42;</span></label>
			<input name="email" id="email" class="form-control" type="email" value="<?php echo(empty($email)? '': $email); ?>" maxlength="50" autocomplete="off" >
			<span class="errorMsg"> <?php echo(!empty($errors['email']) ? $errors['email'] : ''); ?> </span>
		</div>
		<div class="group-form">
            <label for="comment">Type your message:
			<textarea name="comment" id="comment" cols="40" rows="6" maxlength="350" placeholder="Type your message here..." ></textarea>
            </label>
		</div>
		<input name="create-account" type="submit" id="submit_btn" class="button" value="Submit">
		
	</form>