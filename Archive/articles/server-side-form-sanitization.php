<h1>Server-Side Form Sanitization</h1>
<!--It uses a mix of server-side PHP sanitiztion and validation functions and regular expressions to ensure form input data  is safe to be handled by the server.-->
<p>In the previous posts we looked at front-end form validation, which is done at the browser level. In this post we are going to deal with <em><span class="key">form sanitization</span></em> and <em>validation</em> on the server side. We will use a mix of <em>regular expressions</em>, PHP <em>sanitization</em> and <em>validation functions</em>. We will do all these using PHP server scripting language.</p> 
<p>To be sure we are on the same page, your computer needs to be running a local web server. Mine is a <span class="key"> WAMP server</span>. WAMP stands for Windows, Apache, MySQL and PHP stack.</p> 
<p class="special-p"><strong><span class="key">Apache</span></strong> is an <em><span class="key">HTTP server</span></em> that enables your computer to serve web pages to browsers. <strong><span class="key">MySQL</span></strong> is a <em>relational database management system</em> that integrates well with PHP in an Apache environment. <strong><span class="key">PHP (Hypertext Pre-processor)</span></strong> is a <em>server side scripting language</em> used to develop static and dynamic websites and web applications.</p> 
<p>In this case, your browsers will be running in the same computer with the web server.</p>
<p>
<ul>
<li>If you are on windows, you can install WAMP server at <a href="www.wampserver.com"> www.wampserver.com</a> .</li>
<li> If you are on a Mac, you can install MAMP at <a href="https://mamp.info">www.mamp.info</a>. MAMP stands for Mac OS X, Apache, MySQL and PHP stack.</li>
<li>If you are on Linux, you can download and install LAMP (Linux, Apache, MySQL and PHP) at <a href="https://www.linux.com">www.linux.com</a>.</li> 
<li>Whichever operating system you are using, you can install a cross-platform server stack, <a href="https://www.apachefriends.org">XAMPP server</a> that can run on Windows, Linux or Mac.</li>
</ul>
<P class="special-p">Please, follow the installation instructions carefully to successfully install your web server. You may be instructed to make some changes in certain files after each installation of a module.</p>
<p>When you are through with web server installation, the next thing you may consider is whether you are using a professional code editor. Code editors that come packaged with operating systems can get you by, but are not convenient for big projects. There are professional code editors such as: <a href="https://www.code.visualstudio.com"> Visual Studio Code</a>, <a href="https://www.notepad-plus-plus.org">Notepad++</a>, <a href="https://www.sublimetext.com">Sublime Text</a> or any other professional one. For some reasons I'm stuck with <i>Notepad++ </i> and it's doing a good job.</p>
<p>To test whether your web server installed correctly, we will use a PHP function. Copy the code below and paste it in your code editor. Then save it in the web root folder <code>htdocs</code> of the Apache folder with the name <code>phpinfo.php</code> .</p>
<pre class="prettyprint">
&lt;?php
	phpinfo();
?&gt;
</pre>
<p>Then, open any browser on your computer and type <code>localhost/phpinfo.php</code> in the address bar. If you get a screen like the one below, then your web server installed successfully.</p>
<figure> 
	<img src="../resources/images/phpinfo-screen.png" alt="php web server configuration screen" width="100%" height="100%"/>
	<figcaption class="key">PHP web server configuration screen.</figcaption>
</figure>
<p>The screen above lists all the necessary software modules and environment variables of the web server. During installation you may have been instructed to tweak certain configuration files to make make them work for you. For specific instructions, it's beyond the scope of this tutorial. </p>
<p>Let's move to <span class="key"> sanitization and validation of form input</span>. In PHP it is easier to use the in-built <span class="key"> PHP filter </span> functions to sanitize and validate data submitted through a form.</p>
<p>We are going to use a form with the following inputs.</p>
<pre class="prettyprint linenums">
&lt;! DOCTYPE html&gt;
&lt;html lang="en"&gt;
&lt;head&gt;
	&lt;meta charset="UTF-8"&gt;
	&lt;title&gt;Sanitizing, Validating Form Inputs&lt;/title&gt;
&lt;/head&gt;
&lt;body&gt;
	&lt;form method="POST" action=""&gt;
		
		&lt;input type="text" name="name"  placeholder="name ..." &gt;
		
		&lt;input type="email" name="email"  placeholder="Email..." &gt;
		
		&lt;input type="tel" name="tel" placeholder="Phone number..." &gt;
		
		&lt;input type="password" name="password" placeholder="Password..." &gt;
		
		&lt;textarea name="comment" col=30 rows=5 placeholder="Type your text here..." &gt;&lt;/textarea&gt;
		
		&lt;input type="submit" name="submit" value="Submit"&gt;
	&lt;/form&gt;
&lt;/body&gt;
&lt;/html&gt;
</pre>
<p>Although we have not used the <code>required</code> html attribute, all fields will be treated as required except the <i>comment</i> field. That means all required fields must be filled before data can be submitted for processing. However, the comment textarea in this case can be left blank.</p> 
<p>Create a new folder in the web folder, <i>htdocs</i> and name it <code>form-security</code>. Save the above code in the folder <i>form-security</i> you have just created with the name <code>php-sanitized-form.php</code></p>
<p>Then add the following CSS in the head section of the HTML document and save the changes.</p>
<pre class="prettyprint linenums">
&lt;style&gt;
	form{
		width:25%;
		margin:40px auto;
	}
	input{
		display:block;
		width:80%;
		margin:10px 20px;
		padding:10px 0;
	}
	textarea{
		width:80%;
		margin-left:20px;
	}
	input[type="submit"]{
		margin:20px;
		padding:20px;
	}
&lt;/style&gt;
</pre>
<h2>Sanitizing Form Data</h2>
<p>When form data is received at the server, the first thing to do is to sanitize it. Sanitization removes all illegal characters that can be used by attackers to compromise server security. </p>
<p>We are  going to add some PHP code to the form code above, as appropriate. The first change we will make is to use <code>&lt; ?php echo htmlspecialchars ($_SERVER['PHP_SELF']); ?&gt;</code> as the value of the <code> action </code> attribute of the form. So, the form openning tag should look like this:
<pre class="prettyprint">
&lt;form method = "POST" action ="&lt;?php echo htmlspecialchars($_SERVER['PHP_SELF']);?&gt;"&gt;
</pre>
<p>What we want is, when the form is submitted the data is processed on the same page instead of jumping to another page. That way any errors encountered will be displayed on the same page.</p>
<h4>$_SERVER["PHP_SELF"] Variable</h4>
<p><code>$_SERVER[]</code> is one of the <em><span class="key">super global variables</span></em>. It is used to hold information about headers, paths and scripts. A super global variable can access global variables from anywhere in the PHP script. It is also accessible from within the page it is defined and from other pages. </p>
<p class="key">The <code>PHP_SELF</code> is a variable that returns the current script being executed. Therefore, <code>$_SERVER["PHP_SELF"]</code> submits the form to the page itself instead of a different page.</p>
<p class="special-p">The <code><span class="key">htmlspecialchars</span>()</code> is a function that converts special characters into <span class="key">HTML entities </span> so that <code> &lt;</code> and <code>&gt;</code> are converted into entities <code>&amp;lt;</code> and <code>&amp;gt;</code> respectively. This prevents attackers from exploiting the form by inserting HTML or JavaScript code through the form such as the case of <i>cross-site-scripting</i> attacks. </p>
<p>Next we create a PHP code to handle sanitization. Copy the following code and paste it above the HTML code in the <code>php-sanitized-form.php</code> document.</p>
<pre class="prettyprint linenums">
&lt;?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	//Set empty variables
	$name=$email=$tel=$password=$comment="";
	
	//Collect input values into variables 
	$name = $_POST["name"];
	$email = $_POST["email"];
	$tel = $_POST["tel"];
	$password = $_POST["password"];
	$comment = $_POST["comment"];
	$errors = [ ];
		
	//First check that the mandatory fields are not empty
	if(empty($_POST["name"])){
		$errors["name"] = "Name can't be empty";
	}
	if(empty($_POST["email"])){
		$errors["email"] = "Email can't be empty";
	}
	if(empty($_POST["tel"])){
		$errors["tel"] = "Tel field can't be blank";
	}
	if(empty($_POST["password"])){
		$errors["password"] = "Password cannot be blank";
	}
	
	//Since variables are not empty, 
	//remove any illegal characters by sanitizing inputs
	$name = filter_var($name, FILTER_SANITIZE_STRING);
	$email = filter_var($email, FILTER_SANITIZE_EMAIL);
	$tel = filter_var($tel, FILTER_SANITIZE_NUMBER_INT);
	$password = filter_var($password, FILTER_SANITIZE_STRING);
}
?&gt;
</pre>
<p>The first thing we will do is to catch the form input data into appropriate variables. Then ensure that the <em>required</em> fields are not blank. In case there is any blank field, we capture the error and push it to the <code>$errors</code> array variable with an appropriate message. If all fields are filled as required, we sanitize the data.</p>
<h3>Sanitizing Functions</h3>
<p><strong><span class="key">Sanitizing functions</span></strong> are designed to strip tags and special characters off the string being evaluated. Tags and special characters can be used by malicious people to exploit your form. These functions, which are part of the core PHP, ensure data is safe to be handled by the server.</p>
<p>Sanitizaion may result into strings with whitespaces. We will use <code>trim()</code> function to remove whitespaces in <code>email</code> and <code>password</code> because there shouldn't have any spaces. </p>
<pre class="prettyprint linenums">
$email = trim($email);
$password = trim($password);
</pre>
<h3>Validating Data</h3>
<p>Validation ensures that the data submitted is accurate and appropriate as expected. Validation follows sanitization. We will use PHP built-in <span class="key">validation functions</span> and regular expressions to achieve this. But first, let's define some rules that will constitute valid data for us. </p>
<ol>
	<li>The <code> names</code> should start with alphabet letter(s) but can have numbers, space, dot, hyphen or underscore and must be 3 or more characters. </li>
	<li>Let <code> tel</code> field should accept a maximum of 12 digits including an optional 3-digit country code.</li>
	<li>The <code> password</code> should consist of 8 or more characters with at least one uppercase letter, one lowercase and at least one digit.  </li>
	
</ol>
<p class="special-p">The <code>tel</code> need not be validated after sanitization, since we have used <code>tel</code> html attribute. But, your app should be prepared to handle telephone number of varying formats. <code>tel</code> html attribute handles the "+", "-" and spaces very well. It also strips special characters. However, if the form is used with an old browser, the <code>tel</code> attribute wont be recognized, which means using a regular expression is a good idea.</p> 
<p>The three conditions outlined above will require regular expressions. To meet the first condition, we will use the pattern below.</p>
<pre class="prettyprint">
$text_pattern = "/^(?:[a-zA-Z])[\w\s.-]{2,}$/";
</pre>
<p>Let's explain what the pattern mean. The <code>(?:[a-zA-Z])</code> matches a mandatory lower or uppercase characters, the <code>\w</code> matches wordly characters, numbers and underscore. <code>\s</code> matches whitespace, <code>.</code> matches a period and <code>-</code> matches a hyphen. The <code>{2,}</code> means at least two characters, so that when combined with the first group it becomes, three or more characters. The name must start with a letter.</p>
<p>The second condition can be achieved using the pattern below.</p>
<pre class="prettyprint">
$tel_pattern = "/^(\+\d{1,3})?[0]?[\d]{9}$/";
</pre>
<p>This pattern means: the country code <code>(\+\d{1,3})</code> is optional and can be between 1 and 3 characters, with the "+" symbol. The <code>[0]?</code>  makes a leading zero of the telephone number optional. Normally, it's omitted when a country code is used. The <code>[\d]{9}</code> matches exactly nine mandatory digits.</p>
<p>The third condition can be achieved using the pattern below.</p>
<pre class="prettyprint">
$password_pattern = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[^\W_]{8,}$/";
</pre>
<p>Let's explain this really quick. <code>(?=.*\d)</code> matches at least one digit, <code>(?=.*[a-z])</code> matches at least one lowercase character and <code>(?=.*[A-Z])</code> matches at least one uppercase character. The <code>[^\W_]</code> negates all non-wordly characters and underscore, which means all symbols are disallowed. <code>{8,}</code> means the password must be at least eight charachers. </p>
<h3>Sanitizing Textarea Field</h3>
<p>Before we put down the code, let's see how we will sanitize the comment field. If you've been following my previous posts on <em>front-end</em> form validation techniques, I observed that <code><span class="key">sanitizing textarea field</span></code> at the browser level is tricky. Idealy, we should allow the user to type anything in the comments area, but still ensure that the text is safe to be processed at the server. Fortunately, the PHP <code>htmlspecialchars()</code> function we have already explained in the previous sections ensures that all characters typed in the comment box will be safe for server processing. </p> 
<p>The field is sanitized as shown below.</p>
<pre class="prettyprint">
$comment = htmlspecialchars($comment);
</pre>
<p>We will update our PHP code by including the regular expression patterns we have outlined above. We will also rearrange the code with <code>if...else...</code> statements to incorporate the validations above. The complete PHP code should now look like the one below. </p>
<pre class="prettyprint linenums">
&lt;?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	//Set empty variables
	$name=$email=$tel=$password=$comment="";
	
	//Collect input values into variables 
	$name = $_POST["name"];
	$email = $_POST["email"];
	$tel = $_POST["tel"];
	$password = $_POST["password"];
	$comment = $_POST["comment"];
	$errors = [ ];
	$valid = true;
	
	//Regular expressions
	$text_pattern = "/^(?:[a-zA-Z])[\w\s.-]{2,}$/";
	$tel_pattern = "/^(\+\d{1,3})?[0]?[\d]{9}$/";
	$password_pattern = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[^\W_]{8,}$/";
		
	//First check that the mandatory fields are not empty
	//Then sanitize and validate
	if(empty($_POST["name"])){
		$errors["name"] = "Name can't be empty";
		$valid = false;
	}else{
		$name = filter_var($name, FILTER_SANITIZE_STRING);
		//Validate name field
		if(!preg_match($text_pattern, $name)){
			$valid = false;
			$errors["name"] = "Name rejected.";
		}
	}
	if(empty($_POST["email"])){
		$errors["email"] = "Email can't be empty";
		$valid = false;
	}else{
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		//Validate email field
		$emaiil = trim($email);
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$valid = false;
			$errors["email"] = "Invalid email";
		}
	}
	if(empty($_POST["tel"])){
		$errors["tel"] = "Tel field can't be blank";
		$valid = false;
	}else{
		$tel = filter_var($tel, FILTER_SANITIZE_NUMBER_INT);
		if(!preg_match($tel_pattern, $tel)){
			$valid = false;
			$errors["tel"] = "Telephone number not valid";
		}
	}
	if(empty($_POST["password"])){
		$errors["password"] = "Password cannot be blank";
		$valid = false;
	}else{
		$password = filter_var($password, FILTER_SANITIZE_STRING);
		//$password = trim($password);
		if(!preg_match($password_pattern, $password)){
			$errors["password"] = "Password invalid.";
			$valid = false;
		}
	}
	$comment = htmlspecialchars($comment);
	
	if($valid){
						
		// output the sanitized and validated data
		echo 'Name: '.$name .'&lt;br&gt;';
		echo 'Email: '.$email .'&lt;br&gt;';
		echo 'Tel Number: '.$tel .'&lt;br&gt;';
		echo 'Password: '.$password .'&lt;br&gt;';
		echo 'This is the comment: &lt;br&gt; " '.$comment.' "';
		//Clear fields after successful submission
		$name=$email=$tel=$password=$comment="";
	}	
}
?&gt;
</pre>
<p>Next we want the errors to appear on the form. So, we will add an HTML <code>span</code> tag below each input field to hold the PHP variable <code>errors</code>. All fields will be similar to the one for the <code>name</code> filed below.</p> 
<pre class="prettyprint">
&lt;span class="error"&gt;&lt;?php echo (!empty($errors["name"])? $errors["name"]:'') ?&gt;&lt;/span&gt;
</pre>
<p>This PHP code is using a Ternary operator <code>?:</code>, which is a short version of <code>if...else...</code>statement. The <code>class="error"</code> in the span tag will enable us change the appearance of the error message in the CSS section.</p> 
<p>Add the following class at the end of the styles in the CSS section. </p>
<pre class="prettyprint linenums">
.error{
	color:red;
	font-weight:bold;
}
</pre>
<p>After you have made all the suggested changes and saved, the complete form validation document should be like the one below. </p>
<pre class="prettyprint linenums">
&lt;?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	//Set empty variables
	$name=$email=$tel=$password=$comment="";
	
	//Collect input values into variables 
	$name = $_POST["name"];
	$email = $_POST["email"];
	$tel = $_POST["tel"];
	$password = $_POST["password"];
	$comment = $_POST["comment"];
	$errors = [ ];
	$valid = true;
	
	//Regular expressions
	$text_pattern = "/^(?:[a-zA-Z])[\w\s.-]{2,}$/";
	$tel_pattern = "/^(\+\d{1,3})?[0]?[\d]{9}$/";
	$password_pattern = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[^\W_]{8,}$/";
		
	//First check that the mandatory fields are not empty
	//Then sanitize and validate
	if(empty($_POST["name"])){
		$errors["name"] = "Name can't be empty";
		$valid = false;
	}else{
		$name = filter_var($name, FILTER_SANITIZE_STRING);
		//Validate name field
		if(!preg_match($text_pattern, $name)){
			$valid = false;
			$errors["name"] = "Name rejected.";
		}
	}
	if(empty($_POST["email"])){
		$errors["email"] = "Email can't be empty";
		$valid = false;
	}else{
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		
		//Validate email field
		$emaiil = trim($email);
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$valid = false;
			$errors["email"] = "Invalid email";
		}
	}
	if(empty($_POST["tel"])){
		$errors["tel"] = "Tel field can't be blank";
		$valid = false;
	}else{
		$tel = filter_var($tel, FILTER_SANITIZE_NUMBER_INT);
		if(!preg_match($tel_pattern, $tel)){
			$valid = false;
			$errors["tel"] = "Telephone number not valid";
		}
	}
	if(empty($_POST["password"])){
		$errors["password"] = "Password cannot be blank";
		$valid = false;
	}else{
		$password = filter_var($password, FILTER_SANITIZE_STRING);
		//$password = trim($password);
		if(!preg_match($password_pattern, $password)){
			$errors["password"] = "Password invalid.";
			$valid = false;
		}
	}
	$comment = htmlspecialchars($comment);
	if($valid){
						
		// output the sanitized and validated data
		echo 'Name: '.$name .'&lt;br&gt;';
		echo 'Email: '.$email .'&lt;br&gt;';
		echo 'Tel Number: '.$tel .'&lt;br&gt;';
		echo 'Password: '.$password .'&lt;br&gt;';
		echo 'This is the comment: &lt;br&gt; " '.$comment.' "';
		//Clear fields after successful submission
		$name=$email=$tel=$password=$comment="";
	}	
}
?&gt;

&lt;! DOCTYPE html&gt;
&lt;html lang="en"&gt;
&lt;head&gt;
	&lt;meta charset="UTF-8"&gt;
	&lt;title&gt;Registration Form&lt;/title&gt;
	&lt;style&gt;
	form{
		width:25%;
		margin:40px auto;
	}
	input{
		display:block;
		width:80%;
		margin:10px 20px;
		padding:10px 0;
	}
	textarea{
		width:80%;
		margin-left:20px;
	}
	input[type="submit"]{
		margin:20px;
		padding:20px;
		background:rgb(0,69,87);
	}
	.error{
		color:red;
		font-weight:bold;
	}
&lt;/style&gt;
&lt;/head&gt;
&lt;body&gt;
	&lt;form method="POST" action="&lt;?php echo htmlspecialchars($_SERVER['PHP_SELF']);?&gt;"&gt;
		
		&lt;input type="text" name="name"  placeholder="Name ..." value="&lt;?php echo (empty($name)? '': $name) ?&gt;"&gt;
		&lt;span class="error"&gt;&lt;?php echo (!empty($errors["name"])? $errors["name"]:'') ?&gt;&lt;/span&gt;
		
		&lt;input type="email" name="email" placeholder="Email..." value="&lt;?php echo (empty($email)? '': $email) ?&gt;" &gt;
		&lt;span class="error"&gt;&lt;?php echo (!empty($errors["email"])? $errors["email"]:'') ?&gt;&lt;/span&gt;
		
		&lt;input type="tel" name="tel" placeholder="Phone number..." value="&lt;?php echo (empty($tel)? '': $tel) ?&gt;"&gt;
		&lt;span class="error"&gt;&lt;?php echo (!empty($errors["tel"])? $errors["tel"]:'') ?&gt;&lt;/span&gt;
		
		&lt;input type="password" name="password" placeholder="Password..." value="&lt;?php echo (empty($password)? '': $password) ?&gt;"&gt;
		&lt;span class="error"&gt;&lt;?php echo (!empty($errors["password"])? $errors["password"]:'') ?&gt;&lt;/span&gt;
		
		&lt;textarea name="comment" col=30 rows=5 placeholder="Type your text here..." &gt;&lt;/textarea&gt;
		
		&lt;input type="submit" name="submit" value="Submit"&gt;
	&lt;/form&gt;
&lt;/body&gt;
&lt;/html&gt;
</pre>
<p>Remember, the logic of the flow control can be changed, and still achieve the same goal. The above code is my development choice, if you want to use it in a production environment, you may need to improve it. Test the form as if you are a hacker and identify any vulnerability. </p>
<p class="special-p">Server-side form validation is the point of last resort. If it fails here, everything has failed. </p>
<h2>Conclusion</h2>
<p>In the previous two posts <a href="post.html.php?id=1"> <em>HTML5 form validation</em> </a> and <a href="post.html.php?id=3"><em>Form validation in JavaScript</em></a>, we highlighted the importance of designing forms that implement security measures from the browser level. This means that form validation process should start at the browser level (<em>front-end</em>) to the server level (<em>back-end</em>). Validation rules need to be consistent throughout all <em>validation levels</em> to prevent conflicts, as the form transits from the browser to the server. I hope you will have a good start as you imbibe these concepts in your form design.</p> 
<p>If this post has been of help to you, leave a comment below. You can also share it on social media with your friends. Happy coding!</p>