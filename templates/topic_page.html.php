<?php 
session_start(); 
include __DIR__ .'/../admin/includes/posts_functions.php';
include __DIR__ .'/../admin/includes/admin_functions.php';
	
	$menu_topic = getTopicByName($_GET['name']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<style>
html,body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed,
figure, figcaption, footer, header, hgroup,
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
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
.paragraph-snippet{
	font-family:'Hind Vadodara',sans-serif;
	font-size:90%; 
}
.published-topics p,.recent-posts p{
    font-family:calibri,Arial;
}
h1,h2,h3,h4{
	font-family:sans-serif,arial;
	font-weight:bolder;
	text-align:left;
	padding-top:1em;
}
a{text-decoration:none;}
figcaption{text-align:left;}
*,*::before,*::after {
	box-sizing: border-box;
}
.nav, .copyright,.policies{
	display:block;
	text-align:center;
}
header, footer{width:100%;}
header, footer{padding:0;}
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
main{margin:0 auto;}
section{
	padding:10px;
	text-align:justify;
}
aside{
	padding:10px;
	text-align:left;
}
.contact-me{
    margin:3em auto;
    padding:20px;
    background:#E5E4E2;
}
.contact-me img{
    float:right;
    margin:10px;
    border-radius:50%;
}
.contact-me p{
    font-family:arial;
    font-size:1.2em;
}
.contact-me button{
    cursor:pointer;
}
hr{border:thin solid rgb(240,240,240);}
.group:before,.group:after{
	content:"";
	display: table;
}
.group:after{clear:both;} 
.group{
	clear:both;
	*zoom:1;
} 
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
main p{
	text-align:justify;
	padding:10px 0;
}
h1,h3,h4{
	text-align:left;
	padding-top:10px;
}
h2{
	padding-top:10px;
}
.paragraph-snippet{
	font-size:90%;
	line-height:1.4;
	padding:5px;
	border:0 solid;
	box-shadow:0 5px 5px grey; 
}
.post-acreditation{
	padding-bottom:10px;
}
.published-topics ul{
	list-style:none;
	text-align:left;
}
.published-topics p,.recent-posts p{
	padding:0;
	text-align:left;
}
 .dropdown-menu-btn{
	display:none;
}
em, i{font-style:italic;}
footer a{font-size:.8em;}
.banner-bar a{color:rgb(255, 255,255);}
.login-signup a{color:rgb( 200, 200, 233);}
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
main ul, ol{
	text-indent: 10px;
	padding-left: 1.875em;
}
main ul{
	list-style:disc;
}
.published-topics ul li{
	font-size:.9em;
	color:rgb(5,10,50);
}
.published-topics ul ul li,.recent-posts p{
	font-size:.9em;
}
.recent-posts a,.published-topics a{
	color:#616D7E;
}
.post-acreditation{
	color:gray;
	font-size:0.725em;
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
aside ul, aside ol{
	text-indent: 0;
	padding: 0;
}
.contact-me{
    margin:1.5em auto;
}
main p{
	text-align:left;
	padding:10px;
}
.post-main-image{
	width:60%;
	margin:10px auto;
}
.article-index-image{
	height:9.375em;
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
.post-acreditation{
	font-size:0.725em;
}
}
@media only screen and (min-width:601px) and (max-width:768px){
	.hide-in-mobile{
		display:none;
	}
	header{
		height:4.375em;
		margin:0;
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
	.post-main-image{
		width:60%;
	}
	.article-index-image{
		height:12.5em;
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
	aside{
		text-align:left;
		padding-left:10px;
	}
	aside ul, aside ol{
		text-indent: 0;
		padding: 0;
	}
    .contact-me{
    margin:1.5em auto;
    }
	main p, li{
		font-size:1.1em;
	}
	.login-signup{
		font-size:.9em;
	}	
}
@media only screen and (min-width:769px) and (max-width:992px){
	.col-5-10{
		display: inline-block;
		vertical-align: top;
		float:left;
	}
    .col-2-10,.col-3-10{
        float:right;
        display:block;
    }
	.col-2-10{width:35%;}
	.col-3-10{width:35%;}
	.col-5-10{width:65%;}
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
	aside{
		padding-left:1.25em;
		text-align:left;
	}
	aside ul, aside ol{
		text-indent: 0;
		padding:0;
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
	aside ul, aside ol{
		text-indent: 0;
		padding: 0;
	}
	.article-index-image{
		height:12.5em;
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
	<!-- head section -->
	<meta name="description" content="<?php echo (isset($posts['meta_description'])? htmlspecialchars_decode($posts['meta_description']):''); ?>" />
	<?php require_once __DIR__ .'/head.html.php'; ?>
	
	<title><?=$menu_topic['topic_name'] ?></title> 
	</head>
	<body>
		<header>
		<?php require_once __DIR__ . '/header.html.php';?>
		</header>
		<main class="group">
			<aside class="col-2-10 hide-in-mobile">
				<div class="published-topics">
				<h2 class="left">Topics</h2>
					
				<?php include __DIR__ . '/published_posts_by_topics.html.php';?>					
					
				</div>
			</aside><!--
			--><section class="col-5-10">
				<h1><?=$menu_topic['topic_name'] ?></h1><hr>
				<?php $topic_id = $menu_topic['topic_id'] ?>
				<?php $published_posts = getPublishedPostsByTopic($topic_id)?>
				<?php foreach($published_posts as $pub_post):?>
				<?php $pub_post['author'] = getPostAuthorById($pub_post['user_id'])?>
				<h3><a href="<?php echo BASE_URL ?>templates/post.html.php?id=<?php echo $pub_post['post_id'] ?>&title=<?php echo $pub_post['post_slug']?>"><?php echo $pub_post['post_title']?></a></h3>
				<div class="post-acreditation">
					<span>  
					<?php echo isset($pub_post['updated_at'])? 'Updated on '. date( 'F j, Y', strtotime($pub_post['updated_at'])): 'Published on '. date( 'F j, Y', strtotime($pub_post['created_at'])) ?>, By <?php echo $pub_post['author'];?></span>
				</div>
					
				<div class="paragraph-snippet">
					<?php echo getFirstParagraphPostById($pub_post['post_id']) ?>
					<a href="<?php echo BASE_URL ?>templates/post.html.php?id=<?php echo $pub_post['post_id'] ?>&title=<?php echo $pub_post['post_slug'] ?>">Read more...</a>
				</div><br>
				<?php endforeach ?>
				
			</section><!--			
			--><aside class="col-3-10">
				<!-- Sidebar content goes here-->
			<div class="recent-posts">
			<!-- Sidebar items go here -->
				<h2 class="left">Recent posts</h2>
				<?php $recent_posts = getMostRecentPosts(); ?>
				<?php foreach($recent_posts as $latest_post): ?>
				<p><a href="post.html.php?id=<?php echo $latest_post['post_id'] ?>&title=<?php echo $latest_post['post_slug']?>"> <?php echo $latest_post['post_title'] ?></a></p>
				<?php endforeach; ?>
                <div class="contact-me">
                    <?php include __DIR__ . '/contact-me.html.php'?>
                </div>
			</div>
			</aside><!--			
			--><aside class="hide-in-bigger-screens">
				<div class="published-topics">
				<h2 class="left">Browse Topics</h2>
					<?php include __DIR__ . '/published_posts_by_topics.html.php';?>				
				</div>
			</aside>	
		</main>
		<script src="<?php echo BASE_URL ?>resources/js/jquery-3.4.0.min.js"></script>
		<script src="<?php echo BASE_URL ?>resources/js/page-control.js"></script>
		<footer class="group">
			<?php include __DIR__ .'/footer.html.php'?>
		</footer>
		
	</body>
</html>