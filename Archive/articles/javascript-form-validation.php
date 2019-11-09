<h1>Form Validation Using JavaScript</h1>
<p>Having gone through form validation using HTML5 in a previous post, it's time we move on to <span class="key">form validation using JavaScript</span>. This is still part of <em>front-end</em>  form validation, as it occurs at the client side. You should always endevour to have a multilayer form validation because when one of the layers fail, the next higher layer should be able to rise to the occasion and do a good job. In a web application, the form is the window through which users interact directly with your server, so it's important to ensure that what goes into the form is safe to be processed by your server.</p> 
<p>Validation in JavaScript is effected using <strong><em>regular expressions</em></strong> and in this tutorial we will apply the knowledge of regular expressions. Incase you are not familiar with <span class="key">regular expressions</span>, you can read my tutorial on <a href="post.html.php?id=3"> Regular Expressions in JavaScript</a>. Still, in this tutorial we will try to explain everything we are going to use.</p>
<p>First, let's have a bare bone form. You can copy the following code into your code editor.</p>
<pre class="prettyprint linenums">
&lt;! DOCTYPE html&gt;
&lt;html lang="en"&gt;
&lt;head&gt;
	&lt;meta charset="UTF-8"&gt;
	&lt;title&gt;Registration Form&lt;/title&gt;
&lt;/head&gt;
&lt;body&gt;
	&lt;form method="POST" action=""&gt;
		&lt;label for="Fullname"&gt;Full Name:&lt;/label&gt;
		&lt;input type="text" name="Fullname" placeholder="Fullname ..." id="Fullname"&gt;
		&lt;label for="username"&gt;Username:&lt;/label&gt;
		&lt;input type="text" name="username" placeholder="Username ..." id="username"&gt;
		&lt;label for="email"&gt;Email:&lt;/label&gt;
		&lt;input type="text" name="email" placeholder="Email..." id="email" &gt;
		&lt;label for ="tel"&gt;Telephone&lt;/label&gt;
		&lt;input type="text" name="tel" placeholder="Phone number..." id="tel" &gt;
		&lt;label for="password"&gt;Password&lt;/label&gt;
		&lt;input type="password" name="password" placeholder="Password..." id="password" &gt;
		&lt;label for="comment"&gt;Comment&lt;/label&gt;
		&lt;textarea name="comment" col=30 rows=5 placeholder="Type your text here..." id="comment"&gt;
		&lt;/textarea&gt;
		&lt;input type="submit" name="submit" value="Submit" id="submit"&gt;
	&lt;/form&gt;
&lt;/body&gt;
&lt;/html&gt;
</pre>
<p>In the above form, we have used six fields that will collect different type of user information. You will notice that I have not used the <code>required</code> html attribute in the input fields to enable me test the effectiveness of the regular expressions. For the same reason I have used <code>type="text"</code> attribute instead of <code>type="email"</code> and <code>type="tel"</code>. The <code>id</code> attribute for each field is important, because I will use it to select the input element from JavaScript. Instead of <code>id</code> one can also use <code>class</code>, but <code>id</code> is ideal because it is unique in the document.</p>
<p>Add the following CSS in the head section of your HTML document for styling, then refresh the browser.</p>
<pre class="prettyprint linenums">
&lt;style&gt;
	form{
		width:25%;
		margin:40px auto;
		background: rgb(230, 230, 230)
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
	}
	input[type="submit"]{
		margin:20px;
		background:rgb(50,100,230);
	}
&lt;/style&gt;
</pre>
<p>Before we go on to <span class="key">validating specific fields</span>, let's explain how we will go about it. Generally, form data is checked at the time of form submission. At submission, if any field does not pass the validation rule, the browser will respond based on how you told it to handle the error. Alternatively, each field can be validated instantly using <span class="key">event listeners</span>. In this case when the user shifts focus to another field, the data is validated and any violation is flagged instantly.</p>
<p>We are going to create a <code>script</code> that will take care of all the validation in the form. For simplicity, we will place the script below the page after the <code>&lt;/html&gt;</code> closing tag. The best practice is to create an external script file and place its reference at the same place, but that is only for scripts management purpose, it does not affect the script performance. The reason why JavaScripts should be placed at the bottom of the HTML document is to allow the page to render first, before loading scripts. This improves rendering speed and especially in mobile devices because they have smaller bandwidth. </p> 
<p>If you will place your scripts on the page as we a going to do, the code must be placed within the <code>script</code> tags as shown below.</p>
<pre class="prettyprint linenums">
&lt;/html&gt;
&lt;script&gt;
...your script go here...
&lt;/script&gt;
</pre>
<h2><span class="key">Validating a Text Field</span></h2>
<p class="special-p">We will use one of the popular regular expressions syntax that uses forwardslashes <code>/.../</code> to tell JavaScript engine that what is within the slashes is a regular expression.</p> 
<p>There is a wide range of characters that can go into a text field. However, we wouldn't like users some of whom might have evil intent, submit anything they have imagined. Leaving a text field open to any character is a gamble, and it puts other users and your server at risk of getting attacked through client-side script injection such as <em>Cross-Site Scripting (XSS)</em>.</p>
<p class="special-p"><span class="key">Cross-site scripting</span> (XSS) is a computer security vulnerability in web applications that enables an attacher to inject a client-side script into web pages viewed by others.</p>
<h3>Validating <code>Fullname</code> Field</h3>
<p>Supposed we would like to allow only text, numbers and underscore in the <code>fullname</code> field, then we could use a regular expression of the form <code>/\w/</code>. The <code>\w</code> is a special character in regular expressions representing both uppercase and lowercase letters, numbers and underscore. It can also be written as <code>/[a-zA-Z0-9_]/</code>. Both mean the same thing. Since we expect a user to give both their firstname and lastname, we should also allow a space, a dot (.) for initials and a hyphen (-) for compound names seperated by dash. Now in regular expressions a space can be represented by <code>\s</code>. The dot and hyphen can be used as they are, so long as we put them in a character set <code>[ ]</code>.</p>
<p>A regular expression for such scenario would look like this: <code>/^[\w\s.-]+$/</code>. The <code>^</code> at the beginning and <code>$</code> at the end are <span class="key">string boundary anchors</span>. It simply means that, if the characters of the  <code>Fullname</code> being evaluated do not match any of the characters listed within these two anchors, it will be rejected. The character set<code>[ ]</code> is used when one wants to evaluate a string against the characters in the set in a <em>single position</em>. To enable the regular expression evaluate a whole string, in this case <i>fullname</i> we have used the special character <code>+</code> after the character set: <code>[ ]+</code>. The plus "+" symbol means match one or more times. Without it, we would only be able to type a single character name in the field, anything else would be disallowed.  </p> 
<p>Let's put this regular expression in a code that will validate the fullname field. There are various ways we can do it, but here we will wrap the regular expression in a small function in the script, then add an inline event listener in the html form field. Below is the code.</p>
<pre class="prettyprint linenums">
&lt;script&gt;
	function validFullname(){
		var fullname = document.getElementById('fullname');
		var regexp =/^[\w\s.-]+$/;
		if(!regexp.test(fullname.value)){
			alert ('Fullname contain illegal characters');
		}
	}
&lt;/script&gt;
</pre>
<p>In the above code we have declared a variable <i>fullname</i> and assigned it to a selector <code>document.getElementById ('fullname')</code> that selects the fullname input in the form using the unique id <i>fullname</i>. Then to get the input value of the user, we have used <code>fullname.value</code> in the <code>regexp.test()</code> method. To make it simple, we have used an alert message to notify the user, incase of invalid characters.</p>
<p>Now to make the validation work, we are going to add an event listener <code>onblur=""</code> in the form fullname input tag, then assign it to a <code>validFullname()</code> function. When the field loses focus the event listner will call this function, which in turn will run the regular expression to validate what has been typed in. An alert message will be fired to the user incase of invalid input.</p>
<pre class="prettyprint linenums">
&lt;label for="Fullname"&gt;Full Name:&lt;/label&gt;
&lt;input type="text" name="Fullname" placeholder="Fullname ..." 
	id="Fullname" onblur="validFullname()"&gt;
</pre>
<h3>Validating <code><span class="key">Username</span></code> Field</h3>
<p>Let's also validate the <code>username</code> field. A username is supposed to be unique. In that regard, we don't expect it to contain spaces. We also don't want users to use any symbols in their usernames except text, underscore and numbers. That means <code>/\w/</code> can suit this situation.</p> 
<p>In the quest to encourage usage of meaningful usernames, we also wouldn't like usernames to start with a number or underscore. In other words we want usernames to start with one of these characters <code>[a-zA-Z]</code>. Further, we would like to restrict the length of a username to be at least three but not more than fifteen characters, <code>{2,14}</code>. When we put all these elements together and using a non-capturing group, we come up with the regular expression <code>/^(?:[a-zA-Z])[\w]{2,14}$/</code> (explanation comes later). Its function then will be:</p>
<pre class="prettyprint linenums">
function validUsername(){
	var username = document.getElementById('username');
	var regexp =/^(?:[a-zA-Z])[\w]{2,14}$/;
	if(!regexp.test(username.value)){
		alert ('Username must at least begin with a letter 
		and can consist of letters, numbers and underscore 
		and contain between 3 and 15 characters.');
	}
}
</pre>
<p>Let's explain the regular expression.  The <code>[a-zA-Z]</code> stands for any lowercase or uppercase letter. The <i>username</i> must start with one of these characters. We have placed the character set in parenthesis <code>( )</code>, which makes it a <span class="key">capturing group</span> (matches and remembers) but have used <code>?:</code> to reverse that and made it a non-capturing group. Note that the whole <code>(?:[a-zA-Z])</code> represent a single lowercase or uppercase character that a username should start with. This ensures that a number or any non-alphabet character starting a username will be rejected.</p> 
<p>Lastly, we have used <code>[\w]{2,14}</code> where <code>[\w]</code>  represents any alphanumeric character or underscore "_" as we have already explained in a previous section above. The <code>{2,14}</code> is a quantifier that restricts the number of characters the set <code>[\w]</code> will match from 2 to 14. When we add this set to the first group in the parenthesis the lenght allowed for a username is from 3 to 15 characters.</p>
<p>The script code should now look like the one below.</p>
<pre class="prettyprint linenums">
&lt;script&gt;
function validFullname(){
	var fullname = document.getElementById('fullname');
	var regexp =/^[\w\s.-]+$/;
	if(!regexp.test(fullname.value)){
		alert ('Fullname contain illegal characters');
	}
}

function validUsername(){
	var username = document.getElementById('username');
	var regexp =/^(?:[a-zA-Z])[\w]{2,14}$/;
	if(!regexp.test(username.value)){
		alert ('Username must at least begin with a letter 
		and can consist of letters, numbers and underscore 
		and contain between 3 and 15 characters.');
	}
}
&lt;/script&gt;
</pre>
<p>Go ahead and add the event listener on the username input as shown below and test the regular expression.</p>
<pre class="prettyprint linenums">
&lt;label for="username"&gt;Username:&lt;/label&gt;
&lt;input type="text" name="username" placeholder="Username ..." 
id="username" onblur="validUsername()"&gt;
</pre>
<h3>Validating <code><span class="key">Email</span></code> Field</h3>
<p>Let's move to <code>email</code> validation. The HTML5 <code>type="email"</code> attribute does a good job in filtering valid emails. The only issue is when a user visits your site with an old browser that does not understand the email attribute. That user will be able to type anything and submit to your server. That's risky. We should be able to create our own JavaScript validation to mitigate such risk.</p>
<p>A valid email address has a specific structure. It must have one <code>&#64;</code>, that is not starting the email address, followed by wordly characters representing the domain name such as <code>gmail</code>. Then after the domain name, there must be a dot <code>(.)</code> that should be followed by atleast two wordly characters representing domain extension name such as <code>.com</code>. We also need to allow country specific domain extensions and subdomains with several dots such as <code>devpot.coding.co.ke</code>, without forgeting email addresses such as <code>jack.davis&#64;devpot.co.ke</code>.</p> 
<p>You can see that this regular expression has alot of specifications to meet because we wouldn't want a genuine email locked out. Let's build a regular expresson to meet these requirements.</p>
<P>We will start with <code>/^...$/</code> which represent the start and ending of a match of the email address. The characters of the entire email address  must match the pattern we will put in the place of <code>...</code>. The first section of an email address before the <code>&#64;</code> can begin with any wordly character or a dot (.), hyphen (-) or underscore (_). This requirement can be captured in an expression like this <code>/^[-.\w]+$/</code>. All the special characters we have used in this expression have already been explained above.</p> 
<p>Next there is the mandatory <code>&#64;</code> that we need to add to the expression. Doing so, gives us <code>/^[-.\w]+&#64;$/</code>.</p>
<p>The <code>&#64;</code> must be followed by another set of wordly characters including a hyphen (-), as we see in some email addresses. This section then can be represented by <code>[\w-]+</code>. Immediately after that, we add the mandatory dot (.), but since the dot is a special character in regular expressions, we will escape it with a backslash, <code>\.</code>. The character set and the dot can repeat one or more times, so we put both in a capturing group <code>( )</code> giving us <code>([\w-]+\.)+</code> sub-expression. When we combine the two sections into the regular expression, it gives us <code>/^[-.\w]+&#64;([\w-]+\.)+$/</code> If we stop here, email addresses ending with a dot will be accepted. We can't allow that.</p>
<p>After the dot "." we need a set of wordly characters and maybe hyphen "-". These characters must not be less than two. A domain extension of one character so far does not exist, or does it? We can be generous to allow a maximum of fifteen characters for this section. So we create a sub-expression of the form <code>[\w-]{2,15}</code>. If you think your users will have emails ending with more than fifteen characters after the last dot, you can adjust that number. There is no harm with that since all those characters are safe to use.</p>
<p>Our full regular expression now is: <code>/^[-.\w]+&#64;([\w-]+\.)+[\w-]{2,15}$/</code>. You can see that building and interpreting regular expressions piecemeal helps in understanding them. Now add the following function below the previous two: </p>
<pre class="prettyprint linenums">
function validEmail(){
	var email = document.getElementById('email');
	var regexp =/^[-.\w]+&#64;([\w-]+\.)+[\w-]{2,15}$/;
	if(!regexp.test(email.value)){
		alert ('Type a valid email address');
	}
}
</pre>
<p>Then add the event listener on the email input as shown below.</p>
<pre class="prettyprint linenums">
&lt;label for="email"&gt;Email:&lt;/label&gt;
&lt;input type="text" name="email" placeholder="Email ..." 
id="email" onblur="validEmail()"&gt;
</pre>
<p>Now test the field with various email formations, even the ones which a wrongly formed. It may not be perfect but we are sure no illigal characters will pass through that field.</p>
<p class="special-p">You may have noticed that in some places we have used the dot (<code>.</code>) without a slash and at other times with a backslash (<code>\.</code>). The dot (<code>.</code>) is a special character in regular expressions, that stand for any character except a <i>new line</i>. To use it in a literal meaning, you must escape it with a backslash (<code>\.</code>). However, when it is used in a character set like this, <code>[.]</code>, you need not escape it, because in the set, it assumes its literal meaning; just a (<code>.</code>).</p>
<h3>Validating <code><span class="key">Telephone</span></code> Field</h3>
<p>Phone numbers came in different formats depending on the country or region you live in. If you are not sure what format your users will use, instead of incoveniencing them, just use the expression <code>/\d+/</code> and that field will only allow digits. Many telephone formats consists of 10 digits and if a country code is involved they add up to thirteen but a leading zero can be dropped. To limit the number of digits to ten, use <code>/^\d{10}$/</code> expression.</p> 
<p>If you want to allow an optional three-digit country code with a plus "+" symbol, then use <code>\+\d{3}</code>. The plus "+" is escaped so that it can be treated as regular character and not a special character as we have been using it.</p> 
<p>If you want to make the country code optional, then you can use <code>?</code> special character. The  <code>?</code> stand for 0 or 1 time, meaning the user has an option to type a country code or not. To make the "+" and the country code go together all the time, enclose them in a capturing group: <code>(\+\d{3})?</code>. This sub-expression should start the regular expression. </p> 
<p>So finally, the regular expresssion is: <code>/^(\+\d{3})?[\d]{10}$/</code>. Add the following function at the end of your script. </p>
<pre class="prettyprint linenums">
function validTel(){
	var tel = document.getElementById('tel');
	var regexp =/^(\+\d{3})?[\d]{10}$/;
		if(!regexp.test(tel.value)){
			alert ('Type a valid telephone number');
		}
	}
</pre>
<p>Also add the event listener <code>onblur="validTel()</code> in the Tel input field in the form.You can tell your users the format you expect from them using the placeholder attribute or label.</p>
<p class="special-p">Remember <code>\d</code> is equivalent to <code>[0-9]</code>. The two can be used interchangeably.</p>
<p>Still on telephone numbers, we want to try other formats. suppose we want to accept telephone numbers of the format <code>+XX XXXX XXXX</code> or <code>+XX-XXXX-XXXX</code> or <code>+XX.XXXX.XXXX</code>. We want to build a regular expression that will accept the three formats without a hitch.</p> 
<p>Let's start building the regular expression step by step. We begin with  the extreme ends of the expression, <code>/^...$/</code>. We have already explained the use of "^" and "$" at the extreme ends. We will make the country code and "+" symbol optional,so we use the expression: <code>/^(\+[\d]{2})?$/</code>. The country code will consist of exactly the "+" and two digits. The user can opt not to type it and it will still be acceptable.</p> 
<p>Then, the spaces, dashes and dots should be optional because we don't know which one the user will choose. So, we use <code>[ .-]?</code> sub-expression. Adding this to the regular expression, we get, <code>/^(+[\d]{2})?[ .-]?$/</code>.</p> 
<p>We now need a four-digit character that is mandatory. We represent that with, <code>[\d]{4}</code> expression. Then we reuse the optional space-dot-dash set <code>[ .-]?</code>. Then repeat the four-digit set <code>[\d]{4}</code>, and our regular expression is complete. Collecting these pieces and adding them to the regular expression, we get our final expression as <code>/^(\+[\d]{2})?[ .-]?[\d]{4}[ .-]?[\d]{4}$/</code> </p>
<p>Paste this regular expression, replacing the one we had earlier in the <code>validTel()</code> function and test it.</p>
<pre class="prettyprint linenums">
function validTel(){
	var tel = document.getElementById('tel');
	var regexp =/^(\+[\d]{2})?[ -.]?[\d]{4}[ -.]?[\d]{4}$/;
		if(!regexp.test(tel.value)){
			alert ('Type a valid telephone number');
		}
	}
</pre>
<p>Using the same logic, you can create regular expressions to validate other telephone number formats.</p>
<h3>Validating <code><span class="key">Password</span></code> Field</h3>
<p>When it comes to passwords, the more variety of characters users are allowed to use the stronger the passwords they can form. However, we won't allow certain characters that attackers may take advantage of and run harmful commands on our server. As far as that one goes, we can list all the characters we want to allow. Normally we expect a password to consist of wordly characters: letters, numbers  or underscore. With those characters we have been using <code>/[\w]+/</code>. We want to allow other characters outside this set which we deem safe to use.</p> 
<p>The quantifier, "+" we have used in the above expression does not properly set the length of a password. As it is, it allows a password with one or many characters. We need to use another quantifier to set the minimum number of characters we want to allow. Lt's say 6, then we would write it as <code>/[\w]{6,}/</code>.</p> 
<p>If we also wanted to allow specific symbols, say dot ".", hyphen "-", asterisk "*" and hash "#", we can add them directly to the character set. But be careful! The hyphen "-" also signifies a range character in the set and so when it comes between certain characters such as <code>.-*</code>can result in unexpected behaviour including stopping the whole script. To avoid that it should be placed at the extreme end or escaped. Therefore, we can add these characters in the set like this: <code>/[\w.#*-]{6,}/</code> or like this <code>/[\w.\-*#]{6,}/</code>.</p> 
<p>But, we are not yet through. If we let the regular expression remain as it is, it will match the characters we have restricted it to, but also has the liberty to allow any other character available out there. That's not our objective. To prevent such occurance we need to bind the expression with the string boundary anchors; <code>^</code> and <code>$</code> . If we include these two characters, the regular expression should now be <code>/^[\w.#*-]{6,}$/</code>.</p> 
<p>Now the regular expression is properly set, it will only match the characters in the set and not allow anything else. You will then need to notify your users appropriately, what characters they are allowed to use.</p> 
<p>Let's test this regular expression by adding a function to handle it. Don't forget to put the event listener <code>onblur="validPassword()"</code> on the password input.</p>
<pre class="prettyprint linenums">
function validPassword(){
	var password = document.getElementById('password');
	var regexp =/^[\w.\-*#]{6,}$/;
		if(!regexp.test(password.value)){
			alert ("Use letters, numbers, underscore, dot, dash, asterisk or hash. Characters must be more than six.");
		}
	}
</pre>
<p>The regular expression above, however, has a slight weakness. It allows passwords even when they consist of a repeated character such as "pppppp". Of course that is a weak password. To avoid that some opt for strinent requirements, such as requiring a password to consist of at least a number, a lowercase letter, an uppercase letter and at least a symbol. But you also need to exercise caution in doing that, putting more stringent measures can incovenience your users than helping them. Weigh the options.</p>
<p>For the sake of this tutorial though, We are going to build a regular expression that will take into account the strict requirements we have outlined above. To do that we will need another special character combination we have not used before called <em>look ahead assertions</em>. When we write an expression like <code>a(?=b)</code>, we mean <i>'match "a" only if it is followed by "b" '</i>. That's referred to as look ahead.</p> 
<p>We have already said that the dot <code>.</code> is a special character that matches any character except a new line. So when we write a regular expression as <code>/.{6,}/</code>, it means match any six or more characters except new line. If this regular expression is used to validate passwords, the user can type any character they have on their keyboard and will be accepted, so long as they are six or more. </p>
<p>Now if we write <code>(?=.*\d)</code> it means <i>assert that there is at least one digit</i>, <code>(?=.*[a-z])</code>:<i>assert that there is at least a lowercase letter</i> and <code>(?=.*[A-Z])</code>: <i>assert that there is at least an uppercase letter</i>. If we combine these pieces we get a regular expression <code>(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}</code>. Now this regular expression mean that a password can consist of any six characters or more, but it must also include at least one digit, at least one lowercase letter and at least one uppercase letter.</p>
<p>If you are not comfortable with using "any character" you can restrict users to wordly characters by using <code>\w</code> or even disallow  the underscore that is part of <code>\w</code> with <code>[^\W_]</code>. When the caret "^" is the first character in a character set,<code>[^...]</code> it negates all the characters listed in the set. Using uppercase <code>\W</code> means all non-wordly characters. <code>\W</code> itself is equivalent to <code>[^a-zA-Z0-9_]</code> which is opposite of <code>\w</code>.</p>
<p>We can therefore, modify the earlier expression to <code>(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[^\W_]{6,}</code>, which means we want a password with at least six wordly characters except underscore consisting of at least one number, at least one lowercase and at least one uppercase letters. No symbol or underscore is allowed here. Then we put the string boundary anchors at the extreme ends to correctly set it. Our final regular expression is now  <code>/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[^\W_]{6,}$/</code> </p>
<p>Replace the regular expression in the <code>validPassword()</code> function with this new one and test it. </p>
<pre class="prettyprint linenums">
function validPassword(){
	var password = document.getElementById('password');
	var regexp =/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[^\W_]{6,}$/;
		if(!regexp.test(password.value)){
			alert ("Use letters, numbers, underscore, dot, dash, asterisk or hash. Characters must be more than six.");
		}
	}
</pre>
<p>Now what remains to be validated on the form is the textarea. Unfortunately, we can't restrict users in a textarea. Nevertheless, there are server-side functions that are designed to sanitize text and change harmful characters to entities that can safely be handled.</p>
<h3>Embellishing The Form</h3>
<p>You might have realised that the alert message triggered by invalid data can be irritating sometimes. The best way to deal with that is to create an error variable that will display error messages beneath the input. Further, we can make the input change color when an error has occured. </p>
<p>Another thing you might have noticed is that if you set focus on an input and click elsewhere, even if you did not type anything, an error alert is fired. One would expect that if nothing changed in the field there should be nothing to warrant a validation call. But the event <code><span class="key">onblur</span></code> occurs when the input loses focus and is oblivious of whether there was a change or not.</p> 
<p>Another event listener that does the same job but behaves differently is  <code> <span class="key">nochange</span></code>. It only occurs when something changed in the input. That is what we would want. So we are going to change <code>onblur</code> to <code> onchange</code>. We will also return the <code>email</code> and <code> tel</code> type attributes to the inputs and designate the required fields. The form code should now look like the one below. </p> 
<pre class="prettyprint linenums">
&lt;form method="POST" action=""&gt;
	&lt;label for="Fullname"&gt;Full Name:&lt;/label&gt;
	&lt;input type="text" name="Fullname" placeholder="Fullname ..." id="Fullname" onchange="validFullname()"&gt;
	&lt;label for="username"&gt;Username:&lt;/label&gt;
	&lt;input type="text" name="username" placeholder="Username ..." id="username" 	
		onchange="validUsername()" required&gt;
	&lt;label for="email"&gt;Email:&lt;/label&gt;
	&lt;input type="email" name="email" placeholder="Email..." id="email" 
		onchange="validEmail()" required&gt;
	&lt;label for ="tel"&gt;Telephone&lt;/label&gt;
	&lt;input type="tel" name="tel" placeholder="Phone number..." id="tel" 
		onchange="validTel()" required&gt;
	&lt;label for="password"&gt;Password&lt;/label&gt;
	&lt;input type="password" name="password" placeholder="Password..." id="password"
		onchange="validPassword()" required&gt;
	&lt;label for="comment"&gt;Comment&lt;/label&gt;
	&lt;textarea name="comment" col=30 rows=5 placeholder="Type your text here..." id="comment"&gt;
	&lt;/textarea&gt;
	&lt;input type="submit" name="submit" value="Submit" id="submit"&gt;
&lt;/form&gt;
</pre>
<p>We need to create a common class "errorMessage" beneath each input and style the text color in our CSS. To get the specific input error message we will use ids appropriate for each input. The form should now look like the one below.</p>
<pre class="prettyprint linenums">
&lt;form method="POST" action=""&gt;
&lt;div&gt;
	&lt;label for="Fullname"&gt;Full Name:&lt;/label&gt;
	&lt;input type="text" name="Fullname" placeholder="Fullname ..." id="Fullname" onchange="validFullname()"&gt;
	&lt;span class="errorMessage" id="fullnameError"&gt;&lt;/span&gt;
&lt;/div&gt;

&lt;div&gt;
	&lt;label for="username"&gt;Username:&lt;/label&gt;
	&lt;input type="text" name="username" placeholder="Username ..." id="username" 	
		onchange="validUsername()" required&gt;
	&lt;span class="errorMessage" id="usernameError"&gt;&lt;/span&gt;
&lt;/div&gt;

&lt;div&gt;
	&lt;label for="email"&gt;Email:&lt;/label&gt;
	&lt;input type="email" name="email" placeholder="Email..." id="email" 
		onchange="validEmail()" required&gt;
	&lt;span class="errorMessage" id="emailError"&gt;&lt;/span&gt;
&lt;/div&gt;
	
&lt;div&gt;
	&lt;label for ="tel"&gt;Telephone&lt;/label&gt;
	&lt;input type="tel" name="tel" placeholder="XX&#8211;XXXX&#8211;XXXX OR +XX&#8226;XXXX&#8226;XXXX" id="tel" 
		onchange="validTel()" required&gt;
	&lt;span class="errorMessage" id="telError"&gt;&lt;/span&gt;
&lt;/div&gt;
	
&lt;div&gt;
	&lt;label for="password"&gt;Password&lt;/label&gt;
	&lt;input type="password" name="password" placeholder="Password..." id="password"
		onchange="validPassword()" required&gt;
	&lt;span class="errorMessage" id="passwordError"&gt;&lt;/span&gt;
&lt;/div&gt;
	
	&lt;label for="comment"&gt;Comment&lt;/label&gt;
	&lt;textarea name="comment" col=30 rows=5 
	placeholder="Type your text here..." id="comment"&gt;
	&lt;/textarea&gt;
	
	&lt;input type="submit" name="submit" value="Submit" id="submit"&gt;
&lt;/form&gt;
</pre>
<p>Add the following class in the styles.</p>
<pre class="prettyprint linenums">
.error-message{
	color:red;
	font-weight:bold;
	margin-left:20px;
}
</pre>
<p>We need to extend the script so that when there is an error, the error message will be displayed under the input field and at the same time the background of the field change color. We are going to use <code> document.getElementById(). innerHTML</code> <span class="key">DOM element selector</span> to access and display error messages within the span tags. The <code> class="errorMessage"</code> has been styled to change the error message to red.</p> 
<p>We are also going to use <code>document.getElementById(). style.backgroundColor</code>DOM element selector to change the background color of the input with an error. We also want when the error is corrected, the error message and background color of the input is cleared. After doing all that the script should look like the one below.</p>
<pre class="prettyprint linenums">
&lt;script&gt;
	function validFullname(){
		var fullname = document.getElementById('fullname');
		var regexp =/^[\w\s.-]+$/;
		if(!regexp.test(fullname.value)){
			document.getElementById("fullnameError").innerHTML ="Fullname contain illegal characters";
			document.getElementById("fullname").style.backgroundColor="yellow";
		}else{
			document.getElementById("fullnameError").innerHTML ="";
			document.getElementById("fullname").style.backgroundColor="";
		}
	}
	function validUsername(){
		var username = document.getElementById('username');
		var regexp =/^(?:[a-zA-Z])[\w]{2,14}$/;
		if(!regexp.test(username.value)){
			document.getElementById("usernameError").innerHTML = "Username must 
			between 3 and 15 characters and must begin with a letter. Only letters, 
			numbers and underscore are allowed.";
			document.getElementById("username").style.backgroundColor="yellow";
		}else{
			document.getElementById("usernameError").innerHTML = "";
			document.getElementById("username").style.backgroundColor="";
		}
	}
	function validEmail(){
	var email = document.getElementById('email');
	var regexp =/^[-.\w]+@([\w-]+\.)+[\w-]{2,15}$/;
		if(!regexp.test(email.value)){
			document.getElementById("emailError").innerHTML = "Type a valid email address";
			document.getElementById("email").style.backgroundColor="yellow";
		}else{
			document.getElementById("emailError").innerHTML = "";
			document.getElementById("email").style.backgroundColor="";
		}
	}
	function validTel(){
	var tel = document.getElementById('tel');
	var regexp =/^(\+[\d]{2})?[-. ]?[\d]{4}[-. ]?[\d]{4}$/;
		if(!regexp.test(tel.value)){
			document.getElementById("telError").innerHTML = "Type a valid telephone number";
			document.getElementById("tel").style.backgroundColor="yellow";
		}else{
			document.getElementById("telError").innerHTML ="";
			document.getElementById("tel").style.backgroundColor="";
		}
	}
	function validPassword(){
	var password = document.getElementById('password');
	var regexp =/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[^\W_]{6,}$/;
		if(!regexp.test(password.value)){
			document.getElementById("passwordError").innerHTML = "Use letters, 
			numbers, underscore, dot, dash, asterisk or hash. 
			Characters must more than six.";
			document.getElementById("password").style.backgroundColor="yellow";
		}else{
			document.getElementById("passwordError").innerHTML ="";
			document.getElementById("password").style.backgroundColor="";
		}
	}
&lt;/script&gt;
</pre>
<p>You will notice that some of the error messages should actually be instructions to the user on how to fill in the form. If they are extracted and embedded under the appropriate input fields and styled with smaller font size, users will be properly guided, hence make less errors. Then the appropriate error messages would be short and precise. I leave that to you, tweak the form the way you want.</P>
<p>At form submission we want to check whether all the required fields have been filled, if not handle the error. We are going to add <code>onsubmit="formSubmit()"</code> event listener on the form tag, that will be calling a function <code>formSubmit()</code> every time the form is submitted. Immediately below the form tag add an empty <code>div</code> element with an id <code>formError</code> to display a general error message if the form has errors at submission. See the affected area below. </p>
<pre class="prettyprint linenums">
&lt;form method="POST" action="" onsubmit="formSubmit()"&gt;
	&lt;div id="formError"&gt;&lt;/div&gt;
	&lt;div&gt;
		&lt;label for="fullname"&gt;Fullname:&lt;/label&gt;
		&lt;input type="text" name="fullname" placeholder="Fullname..." id="fullname" onchange="validFullname()"&gt;
		&lt;span class="error-message" id="fullnameError"&gt;&lt;/span&gt;
	&lt;/div&gt;
	...
</pre>	
<p>The id <code>formError</code> will share the styles with <code>error-message</code> class, so include it as shown below.</p>
<pre class="prettyprint linenums">
#formError, .error-message{
		margin-left:20px;
		color:red;
		font-weight:bold;
	}
</pre>
<p>We are also going to modify our script abit and add the <code>formSubmit()</code> function. Because we are going to use the variables assigned to each input field, we will move them to the top of the script so that they can be available to all the functions.</p>
<p>The moved variables and the formSubmit() should now look like this:</p>
<pre class="prettyprint linenums">
&lt;script&gt;
	var fullname = document.getElementById('fullname');
	var username = document.getElementById('username');
	var email = document.getElementById('email');
	var tel = document.getElementById('tel');
	var password = document.getElementById('password');
	var errorStatus = true;
	function validFullname(){
		var regexp =/^[\w\s.-]+$/;
		if(!regexp.test(fullname.value)){
			document.getElementById("fullnameError").innerHTML ="Fullname contain illegal characters";
			document.getElementById("fullname").style.backgroundColor="yellow";
		}else{
			document.getElementById("fullnameError").innerHTML ="";
			document.getElementById("fullname").style.backgroundColor="";
		}
	}
	...
	function formSubmit(){
		errorStatus = false;
		if(username.value=="" || email.value=="" || tel.value=="" || password.value==""){
			event.preventDefault();
			document.getElementById("formError").innerHTML = "Fix errors in the form first."
		}
		if(username.value==""){
			document.getElementById("usernameError").innerHTML ="Username cannot be blank";
			document.getElementById("username").style.backgroundColor="yellow";
			errorStatus = true;
		}else{
			errorStatus = false;
		}
		if(email.value==""){
			document.getElementById("emailError").innerHTML ="Email is required";
			document.getElementById("email").style.backgroundColor="yellow";
			errorStatus = true;
		}else{
			errorStatus = false;
		}
		if(tel.value==""){
			document.getElementById("telError").innerHTML ="Telephone cannot be blank";
			document.getElementById("tel").style.backgroundColor="yellow";
			errorStatus = true;
		}else{
			errorStatus = false;
		}
		if(password.value==""){
			document.getElementById("passwordError").innerHTML ="Password cannot be blank";
			document.getElementById("password").style.backgroundColor="yellow";
			errorStatus = true;
		}else{
			errorStatus = false;
		}
		if(errorStatus=true){
			return false;
		}else{
			return true
		}
	}
&lt;/script&gt;
</pre>
<p>The entire file we have been working on is given below.</p>
<pre class="prettyprint linenums">
&lt;! DOCTYPE html&gt;
&lt;html lang="en"&gt;
&lt;head&gt;
	&lt;meta charset="UTF-8"&gt;
	&lt;style&gt;
	form{
		width:25%;
		margin:40px auto;
		background: rgb(230, 230, 230)
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
	}
	input[type="submit"]{
		margin:20px;
		background:rgb(50,100,230);
	}
	#formError, .error-message{
		margin-left:20px;
		color:red;
		font-weight:bold;
	}
	
&lt;/style&gt;
	&lt;title>Registration Form&lt;/title&gt;
&lt;/head&gt;
&lt;body&gt;
	&lt;form method="POST" action="" onsubmit="formSubmit()"&gt;
	&lt;div id="formError"&gt;&lt;/div&gt;
	&lt;div&gt;
		&lt;label for="fullname">Fullname:&lt;/label&gt;
		&lt;input type="text" name="fullname" placeholder="Fullname..." id="fullname" onchange="validFullname()"&gt;
		&lt;span class="error-message" id="fullnameError"&gt;&lt;/span&gt;
	&lt;/div&gt;
	&lt;div&gt;
		&lt;label for="username"&gt;Username:&lt;/label&gt;
		&lt;input type="text" name="username" placeholder="Username..." id="username" onchange="validUsername()"&gt;
		&lt;span class="error-message" id="usernameError"&gt;&lt;/span&gt;
	&lt;/div&gt;
	&lt;div&gt;
		&lt;label for="email"&gt;Email:&lt;/label&gt;
		&lt;input type="text" name="email" placeholder="Email..." id="email" onchange="validEmail()"&gt;
		&lt;span class="error-message" id="emailError"&gt;&lt;/span&gt;
	&lt;/div&gt;
	&lt;div&gt;
		&lt;label for ="tel">Telephone&lt;/label&gt;
		&lt;input type="text" name="tel" placeholder="+XX-XXXX-XXXX OR +XX.XXXX.XXXX" id="tel" onchange="validTel()"&gt;
		&lt;span class="error-message" id="telError"&gt;&lt;/span&gt;
	&lt;/div&gt;
		&lt;label for="password">Password&lt;/label&gt;
		&lt;input type="password" name="password" placeholder="Password..." id="password" onchange="validPassword()"&gt;
		&lt;span class="error-message" id="passwordError"&gt;&lt;/span&gt;
	&lt;/div&gt;
		&lt;label for="comment">Comment&lt;/label&gt;
		&lt;textarea name="comment" col=30 rows=5 placeholder="Type your text here..." id="comment"&gt;
		&lt;/textarea&gt;
		&lt;input type="submit" name="submit" value="Submit" id="submit"&gt;
	&lt;/form&gt;
	&lt;script&gt;
	var fullname = document.getElementById('fullname');
	var username = document.getElementById('username');
	var email = document.getElementById('email');
	var tel = document.getElementById('tel');
	var password = document.getElementById('password');
	var errorStatus = true;
	function validFullname(){
		var regexp =/^[\w\s.-]+$/;
		if(!regexp.test(fullname.value)){
			document.getElementById("fullnameError").innerHTML ="Fullname contain illegal characters";
			document.getElementById("fullname").style.backgroundColor="yellow";
		}else{
			document.getElementById("fullnameError").innerHTML ="";
			document.getElementById("fullname").style.backgroundColor="";
		}
	}
	function validUsername(){
		var regexp =/^(?:[a-zA-Z])[\w]{2,14}$/;
		if(!regexp.test(username.value)){
			document.getElementById("usernameError").innerHTML = "Username must between 3 and 15 characters and must begin with a letter. Only letters, numbers and underscore are allowed.";
			document.getElementById("username").style.backgroundColor="yellow";
		}else{
			document.getElementById("usernameError").innerHTML = "";
			document.getElementById("username").style.backgroundColor="";
		}
	}
	function validEmail(){
	var regexp =/^[-.\w]+@([\w-]+\.)+[\w-]{2,15}$/;
		if(!regexp.test(email.value)){
			document.getElementById("emailError").innerHTML = "Type a valid email address";
			document.getElementById("email").style.backgroundColor="yellow";
		}else{
			document.getElementById("emailError").innerHTML = "";
			document.getElementById("email").style.backgroundColor="";
		}
	}
	function validTel(){
	var regexp =/^(\+[\d]{2})?[-. ]?[\d]{4}[-. ]?[\d]{4}$/;
		if(!regexp.test(tel.value)){
			document.getElementById("telError").innerHTML = "Type a valid telephone number";
			document.getElementById("tel").style.backgroundColor="yellow";
		}else{
			document.getElementById("telError").innerHTML ="";
			document.getElementById("tel").style.backgroundColor="";
		}
	}
	function validPassword(){
	var regexp =/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[^\W_]{6,}$/;
		if(!regexp.test(password.value)){
			document.getElementById("passwordError").innerHTML = "Use letters, numbers, underscore, dot, dash, asterisk or hash. Characters must more than six.";
			document.getElementById("password").style.backgroundColor="yellow";
		}else{
			document.getElementById("passwordError").innerHTML ="";
			document.getElementById("password").style.backgroundColor="";
		}
	}
	function formSubmit(){
		errorStatus = false;
		if(username.value=="" || email.value=="" || tel.value=="" || password.value==""){
			event.preventDefault();
			document.getElementById("formError").innerHTML = "Fix errors in the form first."
		}
		if(username.value==""){
			document.getElementById("usernameError").innerHTML ="Username cannot be blank";
			document.getElementById("username").style.backgroundColor="yellow";
			errorStatus = true;
		}else{
			errorStatus = false;
		}
		if(email.value==""){
			document.getElementById("emailError").innerHTML ="Email is required";
			document.getElementById("email").style.backgroundColor="yellow";
			errorStatus = true;
		}else{
			errorStatus = false;
		}
		if(tel.value==""){
			document.getElementById("telError").innerHTML ="Telephone cannot be blank";
			document.getElementById("tel").style.backgroundColor="yellow";
			errorStatus = true;
		}else{
			errorStatus = false;
		}
		if(password.value==""){
			document.getElementById("passwordError").innerHTML ="Password cannot be blank";
			document.getElementById("password").style.backgroundColor="yellow";
			errorStatus = true;
		}else{
			errorStatus = false;
		}
		if(errorStatus=true){
			return false;
		}else{
			return true;
		}
	}
&lt;/script&gt;
&lt;/body&gt;
&lt;/html&gt;
</pre>
<h2>Conclusion</h2>
<p>That marks the end of front-end form validation. Once you have tested that your scripts are working well, you can add any HTML5 form validation that you might have disabled for testing purposes. HTML  and JavaScript validation rules must be consistent otherwise they may conflict and confuse users. This is just one of the steps to securing your form. You must also ensure that the server-side software properly sanitizes and validates form data. </p>