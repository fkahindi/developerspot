
<?php 
//Setting a cookie
function cookie(){
if(!isset($_COOKIE['visits'])){
	$_COOKIE['visits']=0;
}
	$visits = $_COOKIE['visits']+1;
	setcookie('visits',$visits, time()+3600*24);// 1 day cookie
	if($visits){
		echo "This is visit number $visits, Welcome again!";
	}else{
		echo "Welcome to our website, Login or Sign Up for an account";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="Francis Kahindi">
	<title>Spex Management Solutions: Consulting</title>
	<link rel="stylesheet" href="../css/main.css">
	<link rel="stylesheet" href="../css/form.css">
	<link rel="icon" href="../icons/logoicon.png" sizes="16x16 32x32" type="image/x-icon">
	<script type="text/javascript" src="../js/dates.js"></script>
</head>
<body>
	<header>
		<div class="group">
			<div class="login-bar">
				<a href="resources/pages/loginForm.php">Login </a> <span>&#124;</span>
				<a href="#">Sign up</a> 
			</div><!--
		
			--><div class="banner">
				<img src="../images/spexbanner.png" alt="Spex Banner" width="60%" height="60%">
			</div>
		</div>
		<div class="dropdown">
			<button class="dropdown-button">|||</button>
			<nav class="dropdown-content">
				<?php include "../../templates/nav.html.php" ?>	
		
			</nav>
		</div>
	</header>
	<main class="group">
		<section class='col-3-5'>
		<?php 
				//Define variables and set values to empty
				$name=$email=$website=$comment=$gender=" ";
				$nameErr=$emailErr=$websiteErr=$genderErr=" ";
				
				if($_SERVER["REQUEST_METHOD"]=="POST"){
					if(empty($_POST["name"])){
						$nameErr= "Name is required";
					}else{
						$name=test_input($_POST["name"]);
						 // check if name only contains letters and whitespace 
						if(!preg_match("/^[a-zA-Z ]*$/",$name)){
							$nameErr ="Only letters and white space allowed";
						}
					}
					if(empty($_POST["email"])){
						$emailErr="Email is required";
					}else{
						$email=test_input($_POST["email"]);
						 // check if e-mail address is well-formed 
						if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
							$emailErr = "Invalid email format";
						}
					}
					if(empty($_POST["website"])){
						$website =" ";
					}else{
						$website=test_input($_POST["website"]);
						 // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
						 if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)){
							 $websiteErr = "Invalid URL";
							 }
					}
					if(empty($_POST["comment"])){
						$comment = " ";
					}else{
						$comment=test_input($_POST["comment"]);
					}
					if(empty($_POST["gender"])){
						$genderErr = "Gender is required";
					}else{
						$gender=test_input($_POST["gender"]);
					}
					
				}
				function test_input($data){
					$data=trim($data);
					$data=stripslashes($data);
					$data=htmlspecialchars($data);
					return $data;
				}
			?>
			<h2><?php cookie()?></h2>
			
			<p><span class="error">* required field</span></p> 
				<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
					Name: <input type="text"name="name" value="<?php echo$name;?>">
					<span class="error"> * <?phpecho$nameErr;?></span>
					<br><br>
					E-mail: <input type="text"name="email"value="<?php echo$email;?>">
					*<span class="error"> * <?php echo$email; ?></span>
					<br><br>
					Website: <input type="text"name="website"value="<?php echo$website;?>"> 
					<span class="error"><?php echo$websiteErr;?></span>
					<br><br>
					Comment:<br> <textarea name="comment" rows="5"cols="35"> <?php echo$comment;?> 
					</textarea><br>
					<br><br>
					Gender: <br>
					<input type="radio" name="gender" <?php if(isset($gender) && $gender=="female") echo"checked";?> value="female">Female<br> 
					<input type="radio"name="gender" <?php if(isset($gender) && $gender=="male") echo"checked";?> value="male">Male<br>
					<input type="radio"name="gender" <?php if(isset($gender) && $gender=="other") echo"checked";?> 	value="other">Other
					<span class="error">* <?php echo$gender;?></span>
					<br><br>
					<input type="submit" name="submit" value="Submit">
				</form>
				<?php 
				echo "<h2>Your Input:</h2>"; 
				echo $name; 
				echo "<br>"; 
				echo $email; 
				echo "<br>"; 
				echo $website; 
				echo "<br>"; 
				echo $comment; 
				echo "<br>"; 
				echo $gender;  
				?>
			
		</section><!--
		--><aside class='col-2-5'>
			<h2>Analytics</h2>
			
		</aside>
	
	</main>
	<footer>
		<div class="group">
			<span class="float-right">
				<?php include "../../templates/nav.html.php" ?>		
			</span>
			<span class="float-left">&copy;<?php date_default_timezone_set("Africa/Nairobi"); echo date("Y");?>&nbsp;Spexdata.com</span>
		</div>
		
	</footer>
</body>
</html>