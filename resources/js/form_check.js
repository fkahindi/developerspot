$("document").ready(function(){
	'use strict';
	var username_state = false;
	var email_state = false;
    var name_state = false;
	var privacy_state = false;
	$("#username").on("blur", function(){
		var illegalChars = /\W/; /* Allow at least letters, numbers, and underscores */
		var username = $("#username").val();
		
		if(username === ""){
			return;
		}else if(username.match(illegalChars)){
			username_state = false;
			$("#username").parent().removeClass();
			$("#username").parent().addClass("form_error");
			$("#username").siblings("span").text("Sorry...Only letters, number or underscore allowed, no spaces.");
		}else if(username.length<3){
			username_state = false;
			$("#username").parent().removeClass();
			$("#username").parent().addClass("form_error");
			$("#username").siblings("span").text("Sorry...Username should be three letters or more");
		}else{
			$.ajax({
			url: "/spexproject/includes/create_account_preprocess.php",
			type: "post",
			data: {
				"username_check" : 1,
				"username" : username,
			},
			success: function(response){
					if (response === "taken" ) {
						username_state = false;
						$("#username").parent().removeClass();
						$("#username").parent().addClass("form_error");
						$("#username").siblings("span").text("Sorry... You cannot use: "+username);
					}else if(response ==='not_taken') {
						username_state = true;
						$("#username").parent().removeClass();
						$("#username").parent().addClass("form_success");
						$("#username").siblings("span").text("");
					}				
				}
			});
		}
		
	});		
  $("#email").on("blur", function(){
 	var email = $("#email").val();
	var emailFilter = /^[^@]+@[^@.]+\.[^@]*\w\w$/ ; /* //Check if it's valid mail address */
	var illegalChars = /[\(\)<>\,\;\:\\\"\[\]]/ ; /* // Check for illegal characters */
 	if (email === "") {
 		return;
 	}else if(!emailFilter.test(email)){
		email_state = false;
		$("#email").parent().removeClass();
		$("#email").parent().addClass("form_error");
		$("#email").siblings("span").text("Please, Enter valid email address");
	}else if(email.match(illegalChars)){
		email_state = false;
		$("#email").parent().removeClass();
		$("#email").parent().addClass("form_error");
		$("#email").siblings("span").text("Sorry... Email address contain illegal characters");
	}else{
		$.ajax({
		url: "/spexproject/includes/create_account_preprocess.php",
		type: "post",
		data: {
			"email_check" : 1,
			"email" : email,
		},
		success: function(response){
				if (response === "taken" ) {
					email_state = false;
					$("#email").parent().removeClass();
					$("#email").parent().addClass("form_error");
					$("#email").siblings("span").text("Sorry... You cannot use " +email);
				}else if (response === "not_taken") {
					email_state = true;
					$("#email").parent().removeClass();
					$("#email").parent().addClass("form_success");
					$("#email").siblings("span").text("");
				}			
			}
		});
	}
 		
 }); 
 $("#privacy-checkbox").on("change",function(){
		if($(this).is(":checked")){
			privacy_state = true;
			
		}else{
			privacy_state = false;
		}
	});
 
 $("#submit_btn").on("click", function(e){
	 
 	if(username_state === false || email_state === false || privacy_state === false)
	{	
		e.preventDefault();
		var username = $("#username").val();
		var email = $("#email").val(); 
				
		$("#error_msg").text("Fix the errors in the form first");
				
		if(username === ""){
			$("#username").parent().removeClass();
			$("#username").parent().addClass("form_error");
			$("#username").siblings("span").text("Username is required");
		}
		if(email === ""){
			$("#email").parent().removeClass();
			$("#email").parent().addClass("form_error");
			$("#email").siblings("span").text("Email is required");
		}
        
        if(privacy_state === false){
            $("#privacy-checkbox").parent().removeClass();
			$("#privacy-checkbox").parent().addClass("errorMsg");
			$("#privacy-checkbox").siblings("p").append();
			return;
        }
	}else{
		$("#error_msg").text("");
		$("#username").siblings("span").text("");
		$("#email").siblings("span").text("");
        $("#privacy-checkbox").parent().removeClass("errorMsg");
		$("#privacy-checkbox").siblings("p").text("");
		return true;
	}
 });
 /* Cripts for contact me form */
 $("#name").on("blur", function(){
    var name = $("#name").val();
    if(name === ""){
        return;
    }else if(!testTextField(name)){
        name_state = false;
        $("#name").parent().removeClass();
        $("#name").parent().addClass("form_error");
        $("#name").siblings("span").text("Remove illegal symbols in name");
    }else{
        name_state = true;
        $("#name").parent().removeClass();
        $("#name").parent().addClass("form_success");
        $("#name").siblings("span").text("");
    }
 });
 $("#contact_email").on("blur", function(){
    var contactEmail = $("#contact_email").val();
    if(contactEmail === ""){
        return;
    }else if(testEmailField(contactEmail)=== "invalidEmail"){
        email_state = false;
        $("#contact_email").parent().removeClass();
        $("#contact_email").parent().addClass("form_error");
        $("#contact_email").siblings("span").text("Invalid email");
    }else if(testEmailField(contactEmail)=== "illegalEmail"){
        email_state = false;
        $("#contact_email").parent().removeClass();
        $("#contact_email").parent().addClass("form_error");
        $("#contact_email").siblings("span").text("Email contain illegal characters");
    }else if(testEmailField(contactEmail)=== "emailOK"){
        email_state = true;
        $("#contact_email").parent().removeClass();
        $("#contact_email").parent().addClass("form_success");
        $("#contact_email").siblings("span").text("");
    }
 });
 $("#contact_me_btn").on("click", function(e){
    if(name_state === false || email_state === false)
	{	
		e.preventDefault();
		var name = $("#name").val();
		var contactEmail = $("#contact_email").val(); 
				
		$("#error_msg").text("Fix the errors in the form first");
				
		if(name === ""){
			$("#name").parent().removeClass();
			$("#name").parent().addClass("form_error");
			$("#name").siblings("span").text("Name is required");
		}
		if(contactEmail === ""){
			$("#contact_email").parent().removeClass();
			$("#contact_email").parent().addClass("form_error");
			$("#contact_email").siblings("span").text("Email is required");
		}
	}else{	
		$("#error_msg").text("");
		$("#name").siblings("span").text("");
		$("#contact_email").siblings("span").text("");
		return true;				            
	}
 });
 
    function testEmailField(emailField){
        var emailFilter = /^[^@]+@[^@.]+\.[^@]*\w\w$/ ; /* Check if it's valid mail address */
        var illegalChars = /[\(\)<>\,\;\:\\\"\[\]]/ ; /* Check for illegal characters */
        
        if(!emailFilter.test(emailField)){
            return "invalidEmail";
        }else if(emailField.match(illegalChars)){
            return "illegalEmail";
        }else{
            return "emailOK";
        }
    }
    function testTextField(textField){
        var legalChars = /^[\w\s.-]+$/; /* Letters, numbers, space, peroid, hyphen and underscore */
        var textOk = false;
        if(textField.match(legalChars)){
			textOk = true;
			return textOk;
        }else{
            textOk = false;
            return textOk
        }
    }
});

/* For online server, run the following command on the terminal to get minified, compressed and mangled file:
 "terser form_check.js --compress --mangle --output form_check.min.js"
*/