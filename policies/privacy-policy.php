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
	font-family: 'Carrois Gothic SC', sans-serif;
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
<h1>Privacy Policy</h1><p>Last updated: March 02, 2020</p><p>This Privacy Policy describes Our policies and procedures on the collection, use and disclosure of Your information when You use the Service and tells You about Your privacy rights and how the law protects You.</p><p>We use Your Personal data to provide and improve the Service. By using the Service, You agree to the collection and use of information in accordance with this Privacy Policy. This Privacy Policy is maintained by the <a href="https://www.freeprivacypolicy.com/free-privacy-policy-generator">Free Privacy Policy Generator</a></p><h1>Interpretation and Definitions</h1><h2>Interpretation</h2><p>The words of which the initial letter is capitalized have meanings defined under the following conditions.</p><p>The following definitions shall have the same meaning regardless of whether they appear in singular or in plural.</p>
<h2>Definitions</h2>
<p>For the purposes of this Privacy Policy:</p>
<ul> 
<li> <strong>You</strong> means the individual accessing or using the Service, or the company, or other legal entity on behalf of which such individual is accessing or using the Service, as applicable.</li> 
<li>
<strong>Company</strong> (referred to as either "the Company", "We", "Us" or "Our" in this Agreement) refers to Developers Pot.
</li> 
<li><strong>Affiliate</strong> means an entity that controls, is controlled by or is under common control with a party, where "control" means ownership of 50% or more of the shares, equity interest or other securities entitled to vote for election of directors or other managing authority.</li>
<li><strong>Account</strong> means a unique account created for You to access our Service or parts of our Service.</li>
<li><strong>Website</strong> refers to DevelopersPot, accessible from <a href="https://www.developerspot.co.ke">https://www.developerspot.co.ke</a></li>
<li><strong>Service</strong> refers to the Website.</li> <li>
<strong>Country</strong> refers to: KENYA</li> 
<li>
<strong>Service Provider</strong> means any natural or legal person who processes the data on behalf of the Company. It refers to third-party companies or individuals employed by the Company to facilitate the Service, to provide the Service on behalf of the Company, to perform services related to the Service or to assist the Company in analyzing how the Service is used.</li>
<li><strong>Third-party Social Media Service</strong> refers to any website or any social network website through which a User can log in or create an account to use the Service.</li><li> 
<strong>Personal Data</strong> is any information that relates to an identified or identifiable individual. </li>
<li><strong>Cookies</strong> are small files that are placed on Your computer, mobile device or any other device by a website, containing the details of Your browsing history on that website among its many uses.</li><li><strong>Usage Data</strong> refers to data collected automatically, either generated by the use of the Service or from the Service infrastructure itself (for example, the duration of a page visit).</li> </ul><h1>Collecting and Using Your Personal Data</h1><h2>Types of Data Collected</h2><h3>Personal Data</h3>
<p>While using Our Service, We may ask You to provide Us with certain personally identifiable information that can be used to contact or identify You. Personally identifiable information may include, but is not limited to:</p><ul> <li>Email address</li> <li>First name and last name</li> <li>Usage Data</li></ul><h3>Usage Data</h3><p>Usage Data is collected automatically when using the Service.</p><p>Usage Data may include information such as Your Device's Internet Protocol address (e.g. IP address), browser type, browser version, the pages of our Service that You visit, the time and date of Your visit, the time spent on those pages, unique device identifiers and other diagnostic data.</p><p>When You access the Service by or through a mobile device, We may collect certain information automatically, including, but not limited to, the type of mobile device You use, Your mobile device unique ID, the IP address of Your mobile device, Your mobile operating system, the type of mobile Internet browser You use, unique device identifiers and other diagnostic data.</p><p>We may also collect information that Your browser sends whenever You visit our Service or when You access the Service by or through a mobile device.</p> <h3>Tracking Technologies and Cookies</h3><p>We use Cookies and similar tracking technologies to track the activity on Our Service and store certain information. Tracking technologies used are beacons, tags, and scripts to collect and track information and to improve and analyze Our Service.</p><br> <p>You can instruct Your browser to refuse all Cookies or to indicate when a Cookie is being sent. However, if You do not accept Cookies, You may not be able to use some parts of our Service.</p><p>Cookies can be "Persistent" or "Session" Cookies. Persistent Cookies remain on your personal computer or mobile device when You go offline, while Session Cookies are deleted as soon as You close your web browser.</p> <p>We use both session and persistent Cookies for the purposes set out below:</p>
<ul><li> <p><strong>Necessary / Essential Cookies</strong></li> 
<p><strong>Type: Session Cookies</strong></p>
<p><strong>Administered by: Us</strong></p>
<p><strong>Purpose:</strong> These Cookies are essential to provide You with services available through the Website and to enable You to use some of its features. They help to authenticate users and prevent fraudulent use of user accounts. Without these Cookies, the services that You have asked for cannot be provided, and We only use these Cookies to provide You with those services.</p>
<li><p><strong>Cookies Policy / Notice Acceptance Cookies</strong></p></li>
<p><strong>Type: Persistent Cookies</strong></p>
<p><strong>Administered by: Us</strong></p><br><p>Purpose: These Cookies identify if users have accepted the use of cookies on the Website.</p>
<li><p><strong>Functionality Cookies</strong></p></li> <p><strong>Type: Persistent Cookies</strong></p>
<p><strong>Administered by: Us</strong></p><p><strong>Purpose:</strong> These Cookies allow us to remember choices You make when You use the Website, such as remembering your login details or language preference. The purpose of these Cookies is to provide You with a more personal experience and to avoid You having to re-enter your preferences every time You use the Website.</p>  </ul><p>For more information about the cookies we use and your choices regarding cookies, please visit our<a href="cookie-policy.php"> Cookies Policy.</a></p><h2>Use of Your Personal Data</h2><p>The Company may use Personal Data for the following purposes:</p><ul> <li><strong>To provide and maintain our Service</strong>, including to monitor the usage of our Service.</li> <li><strong>To manage Your Account:</strong> to manage Your registration as a user of the Service. The Personal Data You provide can give You access to different functionalities of the Service that are available to You as a registered user.</li> <li><strong>For the performance of a contract:</strong> the development, compliance and undertaking of the purchase contract for the products, items or services You have purchased or of any other contract with Us through the Service.</li> <li><strong>To contact You:</strong> To contact You by email, telephone calls, SMS, or other equivalent forms of electronic communication, such as a mobile application's push notifications regarding updates or informative communications related to the functionalities, products or contracted services, including the security updates, when necessary or reasonable for their implementation.</li> <li><strong>To provide You</strong> with news, special offers and general information about other goods, services and events which we offer that are similar to those that you have already purchased or enquired about unless You have opted not to receive such information.</li> <li><strong>To manage Your requests:</strong> To attend and manage Your requests to Us.</li></ul><p>We may share your personal information in the following situations:</p><ul><li><strong>With Service Providers:</strong> We may share Your personal information with Service Providers to monitor and analyze the use of our Service, to show advertisements to You to help support and maintain Our Service, to contact You, to advertise on third party websites to You after You visited our Service or for payment processing.</li> <li><strong>For Business transfers:</strong> We may share or transfer Your personal information in connection with, or during negotiations of, any merger, sale of Company assets, financing, or acquisition of all or a portion of our business to another company.</li> <li><strong>With Affiliates:</strong> We may share Your information with Our affiliates, in which case we will require those affiliates to honor this Privacy Policy. Affiliates include Our parent company and any other subsidiaries, joint venture partners or other companies that We control or that are under common control with Us.</li><li><strong>With Business partners:</strong> We may share Your information with Our business partners to offer You certain products, services or promotions.</li><li><strong>With other users:</strong> when You share personal information or otherwise interact in the public areas with other users, such information may be viewed by all users and may be publicly distributed outside. If You interact with other users or register through a Third-Party Social Media Service, Your contacts on the Third-Party Social Media Service may see You name, profile, pictures and description of Your activity. Similarly, other users will be able to view descriptions of Your activity, communicate with You and view Your profile.</li></ul><h2>Retention of Your Personal Data</h2><p>The Company will retain Your Personal Data only for as long as is necessary for the purposes set out in this Privacy Policy. We will retain and use Your Personal Data to the extent necessary to comply with our legal obligations (for example, if we are required to retain your data to comply with applicable laws), resolve disputes, and enforce our legal agreements and policies.</p><p>The Company will also retain Usage Data for internal analysis purposes. Usage Data is generally retained for a shorter period of time, except when this data is used to strengthen the security or to improve the functionality of Our Service, or We are legally obligated to retain this data for longer time periods.</p><h2>Transfer of Your Personal Data</h2><p>Your information, including Personal Data, is processed at the Company's operating offices and in any other places where the parties involved in the processing are located. It means that this information may be transferred to — and maintained on — computers located outside of Your state, province, country or other governmental jurisdiction where the data protection laws may differ than those from Your jurisdiction.</p><p>Your consent to this Privacy Policy followed by Your submission of such information represents Your agreement to that transfer.</p><p>The Company will take all steps reasonably necessary to ensure that Your data is treated securely and in accordance with this Privacy Policy and no transfer of Your Personal Data will take place to an organization or a country unless there are adequate controls in place including the security of Your data and other personal information.</p><h2>Disclosure of Your Personal Data</h2><h3>Business Transactions</h3><p>If the Company is involved in a merger, acquisition or asset sale, Your Personal Data may be transferred. We will provide notice before Your Personal Data is transferred and becomes subject to a different Privacy Policy.</p><h3>Law enforcement</h3><p>Under certain circumstances, the Company may be required to disclose Your Personal Data if required to do so by law or in response to valid requests by public authorities (e.g. a court or a government agency).</p><h3>Other legal requirements</h3><p>The Company may disclose Your Personal Data in the good faith belief that such action is necessary to:</p><ul><li>Comply with a legal obligation</li><li>Protect and defend the rights or property of the Company</li> <li>Prevent or investigate possible wrongdoing in connection with the Service</li><li>Protect the personal safety of Users of the Service or the public</li><li>Protect against legal liability</li></ul><h2>Security of Your Personal Data</h2><p>The security of Your Personal Data is important to Us, but remember that no method of transmission over the Internet, or method of electronic storage is 100% secure. While We strive to use commercially acceptable means to protect Your Personal Data, We cannot guarantee its absolute security.</p> <h1>Children's Privacy</h1><p>Our Service does not address anyone under the age of 13. We do not knowingly collect personally identifiable information from anyone under the age of 13. If You are a parent or guardian and You are aware that Your child has provided Us with Personal Data, please contact Us. If We become aware that We have collected Personal Data from anyone under the age of 13 without verification of parental consent, We take steps to remove that information from Our servers.</p><p>We also may limit how We collect, use, and store some of the information of Users between 13 and 18 years old. In some cases, this means We will be unable to provide certain functionality of the Service to these users.</p><p>If We need to rely on consent as a legal basis for processing Your information and Your country requires consent from a parent, We may require Your parent's consent before We collect and use that information.</p><h1>Links to Other Websites</h1><p>Our Service may contain links to other websites that are not operated by Us. If You click on a third party link, You will be directed to that third party's site. We strongly advise You to review the Privacy Policy of every site You visit.</p><p>We have no control over and assume no responsibility for the content, privacy policies or practices of any third party sites or services.</p><h1>Changes to this Privacy Policy</h1><p>We may update our Privacy Policy from time to time. We will notify You of any changes by posting the new Privacy Policy on this page.</p><p>We will let You know via email and/or a prominent notice on Our Service, prior to the change becoming effective and update the "Last updated" date at the top of this Privacy Policy.</p><p>You are advised to review this Privacy Policy periodically for any changes. Changes to this Privacy Policy are effective when they are posted on this page.</p><h1>Contact Us</h1><p>If you have any questions about this Privacy Policy, You can contact us:</p><ul><li>By email: <a href="mailto:info@developerspot.co.ke">info@developerspot.co.ke</a></li>
<li>Tel: +254733941442</li> </ul></section></main></body></html>