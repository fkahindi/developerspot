<?php require_once __DIR__ .'/../config.php';?>
<!DOCTYPE html><html lang="en">
<!-- head section -->
<head>
<style>
html,body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, embed, figure, figcaption, footer, header, hgroup, menu, nav, output, ruby, section, summary, time, mark, audio, video {
margin: 0;
padding: 0;
border: 0;
font-size: 100%;
font: inherit;
vertical-align: baseline;
}
article, aside, details, figcaption, figure,
footer, header, hgroup, menu, nav, section {
  display: block;
}
body {
	background:#fff;;
	line-height: 1.3;
    font-family:'Calibri Light', Calibri, sans-serif;
}
.banner-bar{font-family: Aladin;}
.published-topics p,.recent-posts p{
    font-family:calibri,Arial;
}
h1,h2,h3,h4{
	font-family:sans-serif,arial;
	font-weight:bolder;
	text-align:left;
	padding-top:10px;
}
a{text-decoration:none;}
figcaption{text-align:left;}
*,*::before,*::after {
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}
.group:before,.group:after{
	content:"";
	display: table;
}
.group:after{clear:both;} 
.group{
	clear:both;
	*zoom:1;
} 
.nav, .copyright,.policies{
	display:block;
	text-align:center;
}
header, footer{
	width:100%;
	padding:0;
}
header{background:#293f50;}
footer{
	background:rgb(11, 10, 10);
	background:rgba(11, 10, 10, 0.82);;
}
footer ul span{color:silver;}
footer a{
	font-variant:small-caps;
	text-decoration:none;
	color:rgb(200,200,200);
}
footer li{display:inline-table;}
.copyright{color:rgb(150,150,150);}
footer a{font-size:.8em;}
.copyright{color:rgb(150,150,150);}
.banner-bar a{color:rgb(255, 255,255);}
.login-signup a{color:rgb( 200, 200, 233);}
main{margin:0 auto;}
main p{
	line-height:1.4em;
	text-align:justify;
	padding:10px 0;
}
hr{border:thin solid rgb(240,240,240);}

.login-signup{
	display:inline-block;
	margin:0;
	width:100%;
}
.tooltip{
	position:relative;
	display:inline-block;
	top:10px;
}
h1{
	font-size:1.5em;
	color:#071418;
}
h2{
	font-size:1.3em;
	color:#071418;
}
h3{
	font-size:1.3em;
	color:rgb(5,10,50);
}
h4{
	font-size:1.2em;
}
h5{
	padding:10px;
	line-height:1.4;
}
#menu-checkbox-control, .dropdown-button{
	display:none;
}
em, i{font-style:italic;}
.main-article ul, .main-article ol{
  padding: .5em 2em;
}
.main-article ul li, .main-article ol li{
	text-indent:.0;
	padding:.3em .5em;
}
#dropdown-menu-btn,.closebtn{
	display:none;
}
@media only screen and (max-width: 600px){
	.hide-in-mobile{
		display:none;
	}
	#dropdown-menu-btn{
		display:block;
		position:absolute;
		top:0;
		width:50px;
		text-align:right;
		padding: 10px 15px;
		color:white;
		cursor:pointer;
		border: none;
	}
	#dropdown-menu-btn:hover{
		background-color: rgb( 35, 35, 60);
	}
	.dropdown-content{
		display:none;
		position: absolute;
		top:3.75em;;
		left:0;
		display: none;
		height:100%;
		width:100%;
		background: rgb( 35, 35, 60);
		box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
		z-index:2;	
	}
	.closebtn{
		position: absolute;
		top: 0;
		right: 10px;
		color:white;
		margin-left: 50px;
	}
	header{
		position:sticky;
		top:0;
		width:100%;
		height:3.75em;
	}
	.banner-bar, .log-account-section{
		display:block;
		height:30px;
		padding:0;
	}
	.banner-bar{
		width:100%;
		margin:0;
		text-align:left;
		padding-top:0.5em;
		padding-left:30%;
	}
	.log-account-section{
		width:100%;
		text-align:right;
		padding-right:15%;
	}
	.account-photo-box{
		width:25%;
		height:1.875em;
		position:absolute;
		top:0;
		right:1.875em;
		text-align:right;
		padding:5px 5px;
	}
	.login-signup{
		right:1.875em;
	}
[class*="col-"]{
	width:100%
	}
section, aside{
    width:100%;
}
section, aside{
	padding:5px;
}
aside{
	text-align:left;
}

main p{
	text-align:left;
	padding:10px;
}
footer{
	text-align:center;
}
footer span{
	float:none;
}
.banner-bar{
	font-size:1.4em;
}
.login-signup{
	font-size:.9em;
}
main p{
	font-size:1.1em;
}
}
@media only screen and (min-width:601px) and (max-width:768px) {
	.hide-in-mobile{
		display:none;
	}
	header{
		height:4.375em;
	}
	.banner-bar,.nav-bar,.log-account-section{
		display:block;
		margin:0;
		padding:0;
	}
	.banner-bar{
		float:left;
		width:23%;
		padding-top:.6em; 
		padding-left:1em;
	}
	.nav-bar{
		float:left;
		width:59%;
		padding-top:1.25em;
	}
	.log-account-section{
		float:right;
		width:18%;
		text-align:right;
		padding-top:.5em;
	}
	[class*="col-"]{
		width:100%
	}
	main{
		width:90%
	}
	.login-signup{
		position:absolute;
		right:1.5625em;
		z-index:1;
		padding:10px 5px;
	}
	.account-photo-box{
			float:right;
	}
	.account-photo-box{
		width:30%;
		height:2.1875em;
		position:absolute;
		top:5px;
		right:1.5625em;
		z-index:0;
	}
	.account-photo-box{
		display:inline-block;
		margin-right:0;
		padding:5px;
		text-align:right;
	}
	nav{
		text-align:center;
		margin: 0;
		padding: 5px 0;
	}
	nav ul{
		text-align:center;
	}
	nav li{
		display:inline-block;
		padding:0;
	}
	nav ul li a{
		padding:8px 2px;
		font-size:70%;
	}
	main p, li{
		font-size:1.1em;
	}
	.login-signup{
		font-size:.9em;
	}	
}
@media only screen and (min-width:769px) and (max-width:992px){
	.col-2-10,.col-3-10,.col-5-10{
		display: inline-block;
		vertical-align: top;
		float:left;
	}
	.col-2-10{width:20%;}
	.col-3-10{width:20%;}
	.col-5-10{width:60%;}
	header{
		height:4.375em;
		margin:0;
	}
	.banner-bar, .nav-bar, .log-account-section{
		display:block;
		margin:0;
		padding:0;
	}
	.banner-bar{
		float:left;
		width:25%;
		padding-top:.2em; 
		padding-left:1em;
	}
	.nav-bar{
		float:left;
		width:55%;
		padding-top:1.65em;
	}
	.log-account-section{
		float:right;
		width:20%;
		text-align:right;
		padding-top:.4em;
	}
	main{
		width:100%;
	}
	section,aside{
		display:inline-block;
	}
	.hide-in-bigger-screens{
		display:none;
	}
	.article-index-image{
		height:12.5em;
	}
	footer{
		padding:5px;
	}
	.nav, .copyright, .policies{
		margin:0;
		padding:0;
	}
	.nav{
		width:35%;
		float:right;
	}
	.copyright{
		width:25%;
		float:left;
	}
	.policies{
		float:right;
		text-align:center;
		width:40%;
	}
	.login-signup{
		position:absolute;
		right:1.875em;
		z-index:1;
		padding:10px 5px;
	}
	.login-signup{
		padding-top:10px;
	}
	.account-photo-box{
		width:25%;
		height:2.1875em;
		position:absolute;
		top:5px;
		right:1.875em;
		z-index:0;
	}
	nav{
		margin:0 ;
		text-align:left;
		padding-top:0;
		padding-bottom:5px;
		font-size:1.3em;
	}
	nav ul{
		text-align:center;
	}
	nav li{
		display:inline-block;
		padding:0;
	}
	nav ul li a{
		font-size:80%;
		padding:8px 2px;
	}
	section{
		padding:0 3%;
	}
	.login-signup{
		font-size:1.1em;
	}
	main p, li{
		font-size:1em;
	}
}
@media only screen and (min-width:993px) and (max-width:1200px){
	.col-2-10,.col-3-10,.col-5-10{
	display: inline-block;
	vertical-align: top;
	float:left;
	}
	.col-2-10{width:20%;}
	.col-3-10{width:30%;}
	.col-5-10{width:50%;}
	.hide-in-bigger-screens{
		display:none;
	}
	main{
		width:95%;
		padding:5px;
		margin: 0 auto;
	}
	header{
		height:6.25em;
		margin:0;
	}
	.banner-bar, .nav-bar, .log-account-section{
		display:block;
		margin:0;
		padding:0;
	}
	.banner-bar{
		float:left;
		width:20%;
		padding-top:.2em; 
		padding-left:1em;
	}
	.nav-bar{
		float:left;
		width:50%;
		padding-top:2em;
	}
	.log-account-section{
		float:right;
		width:30%;
		text-align:right;
		padding-top:.4em;
	}
	section,aside{
		display:inline-block;
	}
	section{
		padding:0 10px;
	}
	aside{
		padding-left:10px;
		text-align:left;
	}
	.nav, .copyright, .policies{
		margin:0;
		padding:10px 0;
	}
	.nav{
		width:35%;
		float:right;
	}
	.copyright{
		width:25%;
		float:left;
	}
	.policies{
		float:right;
		text-align:center;
		width:40%;
	}
	.login-signup{
		position:absolute;
		right:2.1875em;
		z-index:1;
		padding:10px 5px;
	}
	.login-signup{
		padding-top:10px;
	}
	.account-photo-box{
		width:20%;
		height:2.1875em;
		position:absolute;
		top:5px;
		right:2.1875em;
		z-index:0;
	}
	.account-photo-box{
		display:inline-block;
		float:right;
		margin-right:0;
		padding:5px;
		text-align:right;
	}
	nav{
		margin:0 ;
		text-align:left;
		padding-top:10px;
		padding-bottom:5px;
		font-size:90%;
	}
	nav ul{
		text-align:center;
	}
	nav li{
		display:inline-block;
	}
	nav ul li a{
		padding:10px 2px;
	}
	.login-signup{
		font-size:1.2em;
	}
	main p, li{
		font-size:1.2em;
	}
}
@media only screen and (min-width:1201px){
	.col-2-10,.col-3-10,.col-5-10{
	display: inline-block;
	vertical-align: top;
	float:left;
}
.col-2-10{width:20%;}
.col-3-10{width:30%;}
.col-5-10{width:50%;}
.hide-in-bigger-screens{
	display:none;
}
header{
	height:7.5em;
	margin:0;
}
.banner-bar, .nav-bar, .log-account-section{
	display:block;
	margin:0;
	padding:0;
}
.banner-bar{
	float:left;
	width:25%;
	padding-top:.2em; 
	padding-left:1.5em;
}
.nav-bar{
	float:left;
	width:55%;
	padding-top:2.5em;
}
.log-account-section{
	float:right;
	width:20%;
	text-align:right;
	padding-top:.5em;
}
main{
	width:90%;
	margin: 0 auto;
}
section{
	padding:0 20px;
}
aside{
	padding-left:0;
	text-align:left;
}
.article-index-image{
	height:18.75em;
}
.nav, .copyright, .policies{
	display:block;
	margin:0;
	padding-top:10px;
}
.nav{
	width:35%;
	float:right;
}
.copyright{
	width:25%;
	float:left;
}
.policies{
	float:right;
	text-align:center;
	width:40%;
}
.login-signup{
	position:absolute;
	right:2.5em;
	z-index:1;
	padding:10px 5px;
}
.login-signup{
	padding-top:10px;
}
.account-photo-box{
	width:18%;
	height:2.1875em;
	position:absolute;
	top:5px;
	right:2.5em;
	z-index:0;
}
.account-photo-box{
	display:inline-block;
	float:right;
	margin-right:0;
	padding:5px;
	text-align:right;
}
nav{
	margin:0 auto;
	text-align:left;
	padding-top:10px;
	padding-bottom:10px;
}
nav ul{
	text-align:center;
}
nav li{
	display:inline-block;
}
.login-signup{
	font-size:1.2em;
}
main p, main li{
	font-size:1.3em;
}
}
</style>
<link rel="stylesheet" type="text/css" href="../resources/css/main.css">
<meta charset="UTF-8">
</head>
<body>
<header>
	<?php include __DIR__ .'/../templates/header.html.php';?>
		<title>Privacy policy</title> 
</header>
<main class="group">
<section class="col-9-10 main-article">
<h1>Cookie policy</h1> <p>This cookie policy (&quot;Policy&quot;) describes what cookies are and how Website Operator (&quot;Website Operator&quot;, &quot;we&quot;, &quot;us&quot; or &quot;our&quot;) uses them on the <a href="http://developerspot.co.ke">developerspot.co.ke</a> website and any of its products or services (collectively, &quot;Website&quot; or &quot;Services&quot;).</p> <p>You should read this Policy so you can understand what type of cookies we use, the information we collect using cookies and how that information is used. It also describes the choices available to you regarding accepting or declining the use of cookies.</p> <h2>What are cookies?</h2> <p>Cookies are small pieces of data stored in text files that are saved on your computer or other devices when websites are loaded in a browser. They are widely used to remember you and your preferences, either for a single visit (through a &quot;session cookie&quot;) or for multiple repeat visits (using a &quot;persistent cookie&quot;).</p> <p>Session cookies are temporary cookies that are used during the course of your visit to the Website, and they expire when you close the web browser.</p> <p>Persistent cookies are used to remember your preferences within our Website and remain on your desktop or mobile device even after you close your browser or restart your computer. They ensure a consistent and efficient experience for you while visiting our Website or using our Services.</p> <p>Cookies may be set by the Website (&quot;first-party cookies&quot;), or by third parties, such as those who serve content or provide advertising or analytics services on the website (&quot;third party cookies&quot;). These third parties can recognize you when you visit our website and also when you visit certain other websites.</p> <h2>What are your cookie options?</h2> <p>If you don't like the idea of cookies or certain types of cookies, you can change your browser's settings to delete cookies that have already been set and to not accept new cookies. To learn more about how to do this or to learn more about cookies, visit <a target="_blank" href="<a href="https://www.internetcookies.org">internetcookies.org</a></p> <h2>Changes and amendments</h2> <p>We reserve the right to modify this Policy relating to the Website or Services at any time, effective upon posting of an updated version of this Policy on the Website. When we do we will revise the updated date at the bottom of this page. Continued use of the Website after any such changes shall constitute your consent to such changes. Policy was created with <a style="color:inherit" target="_blank" title="Generate cookie policy" href="https://www.websitepolicies.com/cookie-policy-generator">WebsitePolicies</a>.</p> <h2>Acceptance of this policy</h2> <p>You acknowledge that you have read this Policy and agree to all its terms and conditions. By using the Website or its Services you agree to be bound by this Policy. If you do not agree to abide by the terms of this Policy, you are not authorized to use or access the Website and its Services.</p> <h2>Contacting us</h2> <p>If you would like to contact us to understand more about this Policy or wish to contact us concerning any matter relating to our use of cookies, you may send an email to: <a href="mailto:info@developerspot.co.ke">info@developerspot.co.ke</a></section></main></body></html>