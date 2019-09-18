<h1>Form Validation: HTML Validation</h1>
<p>In this tutorial we are going to look at how we can validate a form before submission. Form validation is important because it's one of the ways to prevents bad guys from injecting malicious code into your server. There are three stages a form can be validated
before the contents are processed by ther server. 
<ul>
	<li>HTML validation</li>
	<li>JavaScript validation</li>
	<li>Server-side validation</li>
</ul> 
<p>The first two techniques are commonly called front-end validation, because the validation is done on the client browser before data is transmitted to the server. The third type of validation also known as back-end  validation, takes place on the server computer after the form has been submitted. </p>
<p>Form validation is not automatic, the developer has to take deliberate steps to ensure form data is safe to be handled by the server. That doesn't mean that back-end validation is less important, on the contrary it is the most important. If the first two methods fail, the server-side validation is the last resort. </p>
<p>However, relying solely on the server to validate user input can overwork the server and slow other critcal processes, especially in a busy environment. Because when server validation detects form errors, the data is sent back to the user for correction. The user then will notice that the form had errors, hence will correct them and resend the form. This process will be repeated as long as the form has invalid data. Too many of these back and forth on one task is an extra load to the server can impact server performance. For this reason, form validation should start at the browser level and scale up to the server. In this tutorial we will use the features provided by HTML5 to carry out form validation at the browser level.</p>
<p>Let's begin with creating a form with five input fields: username, email, password, telephone and textarea. You can just copy the code below into your code editer and save the file as <code>registration.html</code></p>
<pre class="prettyprint linenums">
&lt;! DOCTYPE html&gt;
&lt;html lang="en"&gt;
&lt;head>
	&lt;meta charset="UTF-8"&gt;
	&lt;title&gt;Registration Form&lt;/title&gt;
&lt;/head&gt;
&lt;body&gt;
&lt;form method="POST" action=""&gt;
	&lt;label for="username"&gt;Username:&lt;/label&gt;
	&lt;input type="text" name="username" maxlength="15" placeholder="Username ..." required&gt;
	&lt;label for="email"&gt;Email:&lt;/label&gt;
	&lt;input type="email" name="email" maxlength="20" placeholder="Email..." required&gt;
	&lt;label for ="tel"&gt;Telephone&lt;/label&gt;
	&lt;input type="tel" name="tel" maxlength="9"placeholder="Phone number..." required&gt;
	&lt;label for="password"&gt;Password&lt;/label&gt;
	&lt;input type="password" name="password" placeholder="Password..." required&gt;
	&lt;label for="comment"&gt;Comment&lt;/label&gt;
	&lt;textarea name="comment" col=30 rows=5 placeholder="Type your text here..." required&gt;&lt;/textarea&gt;
	&lt;input type="submit" name="submit" value="Submit"&gt;
&lt;/form&gt;
&lt;/body&gt;
&lt;/html&gt;
</pre>
<p>Before we explain the attributes used in the input fields let's style the form with some css to make it look decent. Copy the following styles into the head section of the <code> registration.html </code> html document and save the changes.</p>
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
<p>If you refresh the browser page this time, the form will look better. Now let's explain the attributes used in the form. The <code> placeholder="" </code> helps to lead the user where to type the values. For example <code> placeholder="<em> Username... </em>" </code> tells the user where username should be type. When the user starts typing in the field the placeholder text disappears. That is one of the difference between <code> placeholder </code> attribute and <code> value="" </code> attribute which developers sometimes used with text inputs to mimick placeholder in older browsers. With value attribute the user has to delete the text place there and type the real value, otherwise, the original text will be treated as if it is the user who typed it and will be submitted with the form.  <code> placeholder </code> attribute was introduced to save such situiations. Older browsers prior HTML5, However, do not support the placeholder attribute and will not display it. Using labels, therefore, becomes necessary if the form will used with older browsers. For browsers that support HTML5, placeholders can be used in place of labels. </p>
<p>The <code> maxlength="" </code> is a way of limiting the number of characters that can be typed in that field. For example <code> maxlength="10" </code> will allow only ten characters in the field. This way the user cannot exceed the number of characters expected by form owner. Two things to take note of, though: One, <code> maxlength </code> does not give feedback to the user on the number of characters expected. Two, if the length is not chosen carefully, it may restrict users unnecessarily and annoy them. In a business setting that can impact the business negatively. </p>
<p>The <code> type="" </code> attribute is very important in HTML5 because the value you specify will be validated by the browser before submission occures. For example <code> type = "email" </code> will  only accept valid email addresses in that field. In the case of type <code> type = "telephone" </code>, only numbers and the (+) symbol for country code will be accepted, just like the older <code> type = "password" </code> will hide the real characters.</p> <p>If you apply the <code> required </code> attribute on any input in the form, that field becomes mandatory and cannot be left blank, otherwise the form will not submit. Different browsers have their own way of highlighting required fields if left blank. Deliberately mess around with these attributes and see how your form responds. </p>
<p>HTML5 introduced the <code> pattern </code> attribute. With  <code> pattern </code> atttibute complex HTML validation techniques can be achieved using what is called <em> regular expressions </em>. Regular expressions are special difined patterns of characters that must be matched against what is typed in the field. The <code> pattern </code> attribute can be used with <code> text </code>, <code> tel </code>, <code> date </code>, <code> email </code>, <code> password </code>, <code> url </code> and <code> search </code> input types.</p>
<h2>HTML5 Form Validation Using Regular Expressions</h2>
<p>We are going to update the form with the <code> pattern </code> attribute for each input we have used. The <code> pattern </code> attribute will enable us to evaluate the input value using a <em> regular expression</em> for a match. So, in essence you define a rule on the type of characters that should be allowed in the input, without which the field will be deemed invalid. If you are not familiar with regular expressions you can check <a href="post.html.php?id=3"> Regular Expressions in JavaScript</a> or <a href="post.html.php?id=4"> Regular Expressions in PHP</a> because we will still use them in JavaScript and PHP. As for now we are going to use the ones that suit our purpose and explain what they stand for. </p>
<p>Further, a global <code>title</code> attribute can be used along with the <code> pattern </code> attribute which will pop up to guide the user what is expected of them when filling the field.</p>

<h3>Example 1</h3>
<pre class="prettyprint linenums">
&lt;form method="POST" action=""&gt;
	&lt;label for="username"&gt;Username:&lt;/label&gt;
	&lt;input type="text" placeholder="Username ..." pattern="\w+" title="Type only letters, numbers and underscore with no space" required&gt;
	&lt;input type="submit" name="submit" value="Submit"&gt;
&lt;/form&gt;
</pre>
<p>The pattern above allows one or more alphanumeric character (a-z0-9) and underscore. The <code> \w </code> stands for a-z0-9 including underscore (_). The backslash <code> "\" </code> is telling the browser that "w" is a special characther and should not be treated literally. The <code> + </code> allows at least one of the characters mentioned in the field. The pattern could have been expressed as <code> pattern="[a-z0-9_]+" </code> and it would mean the same as above. The number of characters in the field can also be restricted by using using braces <code> {} </code>. <code> "\w{3,}" </code> allows three or more characters, "\w{3,7}" restricts between three and seven characters and  <code> "\w{,7}" </code> allows at most seven characters in the field. Try the form with different characters and limitations and see how it responds at submission.</p>

<p>Let's try to validate a telephone field. Telephone number convention vary from country to country but we expect a country code that starts with a <code> + </code> symbol. If the country code is a three-digit number, we can take care of that by starting the expression with <code> "\+[0-9]{3}" </code>. We have used character class defined by <code>[ ]</code> for the digit range 0-9. This expression can be translated to mean the field must start with "+"  then followed by exactly any three digits between 0 and 9. Next, we want a hyphen "-" to connect the country code and the telephone number of nine digits. So, the complete expression will look like the one in example 2 below:</p>
<h3>Example 2</h3>
<pre class="prettyprint linenums">
&lt;form method="POST" action=""&gt;
	&lt;label for ="tel"&gt;Telephone&lt;/label&gt;
	&lt;input type="text" name="tel" placeholder="Phone number..." pattern="\+[0-9]{3}-[0-9]{9}" title="Tel format: +XXX-XXXXXXXXX" required&gt;
	&lt;input type="submit" name="submit" value="Submit"&gt;
	&lt;/form&gt;
</pre>
<p>Notice that we have used type="text" attribute instead of "tel" just to illustrate how an expression can change a text field to accept only numbers and the " + " symbol. If there are no requirement on groups of digits seperator, you can just use <code> type="tel" </code> and it will suffice.</p> <p>When dealing with telephone numbers for global audience caution should be exercised because some countries use different telephone number formats. That's why type="tel" attribute is ideal.</p>
<p>Suppose we want to validate an email address using a pattern than the type="email". There are mandatory characters that make an email valid and they must be in the correct sequence. For example there must be an "@" and it should not be starting the email address. There must also be a dot "." and it should not be ending the email address. After the last dot "." there must be at least two letters. And by convention lowercase characters are used with email address.</p> 
<p>Taking those considerations we can build an expression like the one in example 3 below. If you picked something from the emmediate example above it won't be hard to interpret the pattern below.</P>
<h3>Example 3</h3>
<pre class="prettyprint linenums">
&lt;form method="POST" action=""&gt;
	E-mail: &lt;input type="text" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+.[a-z]{2,}$" title="Type a valid email address."&gt; 
&lt;/form&gt;
</pre>
<p>Note: I have changed the input type from email to text to be able to test the validation properly.</p> 
<p>The pattern above means that the email address can begin with one or more <em> alphanumeric characters (a-z or 0-9)</em>, one or more <em>. _ % + -</em> characters, followed by a mandatory <em>@</em>. After the <em>@</em> one or more alphanumeric characters including a dot "." and hyphen "-" can follow. Finally, a mandatory dot(.) followed by at least two alphabet characters. The "$" symbol is used to mark the end of the matching pattern. Here, it means that the last two or more alphabet characters after the last dot should end the email address. Any other non-alphabet character after that will cause the email address to be rejected. The email in this case must be typed in lowercase letters and only the characters listed can be used in the email. One can use a pattern like this to filter emails of certain characteristic rather than using the general type="email" that allows any valid email address.</p>
<p>Next, let's build an expression to validate passwords. Many establishements that store sensitive information devise password policies try to make the passwords hard to be quessed by those who don't own them. Making it mandatory for user to form passwords that must have a mixture of uppercase, lowercase, numbers and symbols truly results in strong passwords and harder to crack, but this practice has proved to be counter productive. Instead, many companies nowadays prefer to use strong encryption algorithms at the back-end where the passwords are at a higher risk of being stolen than at the front-end. Hence, it's not a good idea to restict users too much to a point they may feel being panalized for using the form. Nevertheless, let's consider the pattern below:</p>
<h3>Example 4</h3>
<pre class="prettyprint linenums">
&lt;form method="POST" action=""&gt;
	Password: &lt;input type="password" name="pw" pattern="(?=.*d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must have at least one number and one uppercase and lowercase letter, and at least 6"&gt;
&lt;/form&gt;
</pre>
<P>The pattern above restricts the password to have at least one digit, at least one lowercase letter, at least one uppercase letter and the total number of characters must be at least six.</p>
<p>Well, with all the attributes explained,let's now see how the entire form looks like.</p>
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
&lt;/style&gt;
&lt;title&gt;Registration Form&lt;/title&gt;
&lt;/head&gt;
&lt;body&gt;	
    &lt;form method="POST" action=""&gt;
    	&lt;label for="username"&gt;Username:&lt;/label&gt;
    	&lt;input type="text" name="username" maxlength="15" placeholder="Username ..." pattern="\w+" title="Type only letters, numbers and underscore with no space" required&gt;
    	&lt;label for="email"&gt;Email:&lt;/label&gt;
    	&lt;input type="email" name="email" maxlength="20" placeholder="Email..." pattern="[a-z0-9._%+-]+@[a-z0-9.-]+.[a-z]{2,}$" title="Type a valid email address" required&gt;
    	&lt;label for ="tel"&gt;Telephone&lt;/label&gt;
    	&lt;input type="tel" name="tel" maxlength="9"placeholder="Phone number..." required&gt;
    	&lt;label for="password"&gt;Password&lt;/label&gt;
    	&lt;input type="password" name="password" placeholder="Password..." pattern="(?=.*d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must have at least one number and one uppercase and lowercase letter, and at least 6" required&gt;
    	&lt;label for="comment" &gt;Comment&lt;/label&gt;
    	&lt;textarea name="comment" col=30 rows=5 placeholder="Type your text here..." required&gt;&lt;/textarea&gt;
    	&lt;input type="submit" name="submit" value="Submit"&gt;
    &lt;/form&gt;
&lt;/body&gt;
&lt;/html&gt;
</pre>
<p>Notice that the <code>required</code> attribute is still there because when the user clicks <code>submit</code> button, the browser first checks the required fields are not blank.</p>
<h2>Conclusion</h2>
<p>That covers form validation in HTML5. Having acquired those fundamentals proceed to form validation in JavaScript which provides more flexibility than HTML5.</p>