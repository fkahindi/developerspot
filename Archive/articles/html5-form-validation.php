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
<p>However, relying solely on the server to validate user input can overwork the server and slow other critcal processes, especially in a busy environment. Because when server validation detects form errors, the data is sent back to the user for correction. The user then will notice that the form had errors, hence will correct them and resend the form. This process will be repeated as long as the form has invalid data. Too many of these back and forth on one task is an extra load to the server and can impact server performance. For this reason, form validation should start at the browser level and scale up to the server.</p> 
<p>In this tutorial we will use the features provided by HTML5 to carry out form validation at the browser level. Let's begin with creating a form with five input fields: <em>username</em>, <em>email</em>, <em>password</em>, <em>telephone</em> and <em>textarea</em>. You can just copy the code below into your code editer and save the file as <code>registration.html</code></p>
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
<p>Before explaining the attributes used in the input fields, let's style the form with some css to make it look a little bit decent. Copy the following styles into the head section of the <code> registration.html </code> html document and save the changes.</p>
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
<p>If you refresh the browser page this time, the form will look better.</p> 
<h3>HTML Form Attributes</h3>
<p>Now let's explain the attributes used in the form.</p>
<h4> The <code> placeholder </code> Attribute</h4>
<p>The <code> placeholder="" </code> helps the user to know where to type the values. For example <code> placeholder="<em>Username</em>" </code> tells the user where username should be typed. When the user starts typing in the field the placeholder text clears up. That is one of the differences between <code> placeholder </code> attribute and <code> value="" </code> attribute which developers sometimes back used with text inputs to mimick a placeholder in older browsers.</p> 
<h4>The <code> value </code> Attribute</h4>
<p>The <code> value="" </code> attribute labels the input. For example a <em>submit</em> input button must have a  <code> value </code> attribute which is text to shohw the user the purpose of the button. It can take the values <code> value="<em>Submit</em>" </code>, <code> value="<em>Send</em>" </code>, etc.</p>  
<p>If <code> value </code> is used with text input fields, the user has to delete the text placed in the field and type the real value, otherwise, the value attribute text will be submitted with the form.  To avoid such inconviniences the <code> placeholder </code> attribute was invented. Older browsers prior HTML5, however, do not support the placeholder attribute and will not display it. To make the form usable in those browsers, naming fields with labels is necessary. For browsers that support HTML5, placeholders can be used in place of labels. </p>
<h4>The <code> maxlength </code> Attribute</h4>
<p>A <code> maxlength="" </code> value limits the number of characters that can be typed in that field. For example <code> maxlength="10" </code> will allow only ten characters in the field. This way the user cannot exceed the number of characters expected by form owner.</p> 
<p>Two things to take note of, though: One, <code> maxlength </code> does not give feedback to the user on the number of characters expected. Two, if the length is not chosen carefully, it may restrict users unnecessarily and upset them. In a business setting that can impact the business negatively. </p>
<h4>The <code> type </code> Attribute</h4>
<p>The <code> type="" </code> attribute in HTML5 has been expanded  to include several other values that signify specific data items. For example <code> type="email" </code> will  only accept valid email addresses. In the case of <code> type="telephone" </code>, only numbers and the (+) symbol for country code will be accepted, just like the <code> type="password" </code> will hide the real characters being typed and <code> type="url" </code> will only accept valid web addresses. So, you can see that using this attribute, you can let the browser validate for example emails, urls and telephone numbers.</p> 
<h4>The <code> required </code> Attribute</h4>
<p>If you apply the <code> required </code> attribute on any input in the form, that field becomes mandatory and cannot be left blank. If you try to submit the form while one of the required fields is not filled, the browser will refer you back to the field. Different browsers have their own way of highlighting required fields if left blank.</p> 
<p>Deliberately mess around with these attributes and see how your form will respond, before we turn to <em>pattern</em> attribute.</p>
<h4>The <code> pattern </code> Attribute</h4>
<p>With  <code> pattern </code> atttibute introduced in HTML5, complex HTML validation techniques can be achieved using what is called <em> regular expressions </em>. Regular expressions are special difined pattern of characters that must be matched against what is typed in the field. The <code> pattern </code> attribute can be used with <code> text </code>, <code> tel </code>, <code> date </code>, <code> email </code>, <code> password </code>, <code> url </code> and <code> search </code> input types.</p>
<h2>HTML5 Form Validation Using Regular Expressions</h2>
<p>We are going to update our earlier form with the <code> pattern </code> attribute in each input we have used. The <code> pattern </code> attribute will enable us to evaluate the input value using a <em> regular expression</em> for a match. So, in essence you define a rule on the type of characters that should be allowed in the input, without which the value in the field will be deemed invalid. If you are not familiar with regular expressions you can check <a href="post.html.php?id=3"> Regular Expressions in JavaScript</a> or <a href="post.html.php?id=4"> Regular Expressions in PHP</a> elsewhere on this site. As for now we are going to use the ones that suit our purpose and explain what they stand mean. </p>
<p>Further, a global <code>title</code> attribute can be used along with the <code> pattern </code> attribute which will pop up to guide the user what is expected of them when filling the field.</p>

<h3>Example 1</h3>
<pre class="prettyprint linenums">
&lt;form method="POST" action=""&gt;
	&lt;label for="username"&gt;Username:&lt;/label&gt;
	&lt;input type="text" placeholder="Username ..." pattern="\w+" title="Type only letters, numbers and underscore with no space" required&gt;
	&lt;input type="submit" name="submit" value="Submit"&gt;
&lt;/form&gt;
</pre>
<p>The pattern above allows one or more alphanumeric character (a-zA-Z0-9) and the underscore. The <code> \w </code> stands for both lowercase and uppercase alphabet letter, numerals 0-9 and the underscore (_). The backslash <code> "\" </code> is telling the browser that "w" is a special characther and should not be treated literally. Also note that the "w" used here is lowercase. Uppercase "W" negates (a-zA-Z0-9).</p> 
<p>The <code> + </code> expects at least one of the characters mentioned to be typed in the field. This pattern could also have been expressed as <code> pattern="[a-z0-9_]+" </code> and it would mean the same as above. One can also restrict the number of characters to be typed in the field by using using braces <code> {} </code> such as <code> "\w{3,}" </code> which allows three or more characters. The pattern "\w{3,7}" restricts between three and seven characters and  <code> "\w{,7}" </code> allows at most seven characters in the field.</p> 
<p>Try the form with different character patterns and limitations and see how it responds at submission.</p>
<h3>Example 2</h3>
<p>Let's try to validate a telephone field. Telephone number formats vary from country to country but we expect a country code that starts with a <code> + </code> symbol. If the country code is a three-digit number, we can take care of that by starting the expression with <code> "\+[0-9]{3}" </code>. We have used character class defined by <code>[ ]</code> for the digit range 0-9. This expression can be translated to mean the field must start with "+"  then followed by exactly any three digits between 0 and 9.</p> 
<p>We could achieve exactly the same effect by using named character class pattern as <code> "\+\d{3}" </code>. The "\d" stands for digits 0-9.</p> 
<p>Next, we want a hyphen "-" to connect the country code and the telephone number of nine digits. So, the complete expression will look like the one below:</p>
<pre class="prettyprint linenums">
&lt;form method="POST" action=""&gt;
	&lt;label for ="tel"&gt;Telephone&lt;/label&gt;
	&lt;input type="text" name="tel" placeholder="Phone number..." pattern="\+[0-9]{3}-[0-9]{9}" title="Tel format: +XXX-XXXXXXXXX" required&gt;
	&lt;input type="submit" name="submit" value="Submit"&gt;
	&lt;/form&gt;
</pre>
<p>Notice that we have used type="text" attribute instead of "tel" just to illustrate how an expression can change a text field to accept only numbers and the " + " symbol. If there are no requirements on the number of digits and how they should be grouped you can just use <code> type="tel" </code> and it will suffice.</p> 
<p class="special-p"><strong>Note:</strong> When dealing with telephone numbers for a global audience caution should be exercised as some countries use different telephone number formats. That's why type="tel" attribute is ideal for such cases.</p>
<h3>Example 3</h3>
<p>Suppose we want to validate an email address using a pattern than the <code> type="email" </code>. We must take care of the mandatory characters that make an email valid and must be in their correct positions. For example there must be an "@" and it must not be starting the email address. Further, there must be a dot "." and it should not be ending the email address. After the last dot "." there must be at least two letters. That's the pattern of most email addresses. And by convention we use lowercase characters for email address.</p> 
<p>Taking those considerations we can build an expression like the one below.</P>

<pre class="prettyprint linenums">
&lt;form method="POST" action=""&gt;
	E-mail: &lt;input type="text" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+.[a-z]{2,}$" title="Type a valid email address."&gt; 
&lt;/form&gt;
</pre>

<p class="special-p">Note: I have changed the input type from email to text to be able to test the validation properly.</p> 
<p>If you picked something from the emmediate example above it won't be hard to interpret the pattern above.</p>
<p>The pattern above means that the email address can begin with one or more <em> alphanumeric characters (a-z or 0-9)</em>, one or more <em>. _ % + -</em> characters, followed by a mandatory <em>@</em>. After the <em>@</em> one or more alphanumeric characters including a dot "." or hyphen "-" can follow. Finally, a mandatory dot(.) followed by at least two alphabet characters.</p> 
<p>The "$" symbol is used to mark the end of the matching pattern. Here, it means that the last two or more alphabet characters after the last dot should end the email address. Any other non-alphabet character after that will cause the email address to be invalid. The email in this case must be typed in lowercase letters and only the characters listed can be used in the email.</p> 
<p>A pattern like this can be designed to filter emails of certain characteristic where the general type="email" would not work.</p>
<h3>Example 4</h3>
<p>Next, we are going to build an expression to validate passwords. Many establishements that store sensitive information devise password policies that try to make it hard crack. Forcing users to use passwords that have a combination of uppercase and lowercase letters, numbers and symbols. This trend truly results in strong passwords that are harder to crack, but this practice has proved to be counter productive. Instead, many firms nowadays prefer to use strong encrypting algorithms at the back-end where the passwords are at a higher risk of being stolen than at the front-end.</p> 
<p>In that case, it's not a good idea to restict users too much to the point where they may feel being panalized for using the form. Nevertheless, moderate requirements will not harm. Let's consider the pattern below:</p>
<pre class="prettyprint linenums">
&lt;form method="POST" action=""&gt;
	Password: &lt;input type="password" name="pw" pattern="(?=.*d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must have at least one number and one uppercase and lowercase letter, and at least 6"&gt;
&lt;/form&gt;
</pre>
<P>The pattern above restricts the password to have at least one digit, at least one lowercase letter, at least one uppercase letter and the total number of characters must be at least six. This time we have used regular expression special characters <code>( )</code> and <code> ?= </code>.</p> 
<p>The " <strong>( )</strong> " is called <em> capturing patenthesis</em>. It matches what is inside the parenthesis and remembers the match. The " <strong>?= </strong>" is called <em>positive look ahead</em> expession and matches what is listed on its left if it is followed by what is listed on its right. The "<strong>.* </strong>" are two special characters where the dot " <strong>.</strong> " in this case stands for <em>any single character except new line</em> and the "<strong>*</strong> " stands for <em> match 0 or more times</em> the immediate character on its left.</p>
<p>To explore more on regular expressions, I would recommend you to read <a href="post.html.php?id=3"> Regular Expressions in JavaScript</a> tutorial.</p>
<p>Well, with all the attributes explained, let's now see how the entire code looks like.</p>
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
    	&lt;input type="tel" name="tel" maxlength="9" placeholder="Phone number..." pattern="\+[0-9]{3}-[0-9]{9}" title="Tel format: +XXX-XXXXXXXXX" required&gt;
    	&lt;label for="password"&gt;Password&lt;/label&gt;
    	&lt;input type="password" name="password" placeholder="Password..." pattern="(?=.*d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must have at least one number and one uppercase and lowercase letter, and at least 6" required&gt;
    	&lt;label for="comment" &gt;Comment&lt;/label&gt;
    	&lt;textarea name="comment" col=30 rows=5 placeholder="Type your text here..." required&gt;&lt;/textarea&gt;
    	&lt;input type="submit" name="submit" value="Submit"&gt;
    &lt;/form&gt;
&lt;/body&gt;
&lt;/html&gt;
</pre>
<p class="special-p">Notice that the <code>required</code> attribute is still there because we consider these fields as important that they must be filled. When the user clicks <code>submit</code> button, the browser will first checks if any of these fields are not blank.</p>
<h2>Conclusion</h2>
<p>That covers form validation in HTML5. Having acquired the fundamentals start using these principles as you design your forms. It helps in reducing, if not eliminating the risk of someone compromising your server security. I wish you the best time in coding!</p>