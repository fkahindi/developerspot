<! DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<style>
	.form-width{
		width:40%;
		margin:0 auto;
		padding:1em 0;
		background:LightBlue;
	}
	form{
		width:90%;
		margin:40px auto;
		
	}
	input{
		background:white;
	}
	label{
		font-weight:bold;
		background:inherit;
	}
	input, label{
		display:block;
		width:80%;
		margin-left:20px;
		padding:10px 0;
		
	}
	textarea{
		width:80%;
		margin-left:20px;
		background:white;
	}
	input[type="submit"]{
		margin:20px;
		background:#008080;
		font-size:1em;
		font-weight:bold;
		color:white;
	}
</style>
<title>Form Validation</title>
<head>
<body>	
<div class="form-width">
    <form method="POST" action="">
    	<label for="username">Username:</label>
    	<input type="text" name="username" maxlength="15" placeholder="Username ..." pattern="\w+" title="Type only letters, numbers and underscore with no space" required>
    	<label for="email">Email:</label>
    	<input type="email" name="email" maxlength="20" placeholder="Email..." pattern="[a-z0-9._%+-]+@[a-z0-9.-]+.[a-z]{2,}$" title="Type a valid email address" required>
		<label for ="tel">Telephone</label>
    	<input type="tel" name="tel" maxlength="9" placeholder="Phone number..." pattern="\+[0-9]{3}-[0-9]{9}" title="Tel format: +XXX-XXXXXXXXX" required>
    	<label for="password">Password</label>
    	<input type="password" name="password" placeholder="Password..." pattern="(?=.*d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must have at least one number and one uppercase and lowercase letter, and at least 6" required>
    	<label for="comment" >Comment</label>
    	<textarea name="comment" col=30 rows=5 placeholder="Type your text here..." required></textarea></textarea>
    	<input type="submit" name="submit" value="Submit">
    </form>
</div>
</body>
</html>