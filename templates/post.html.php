<?php
if(!isset($_SESSION)){
	session_start();
}
	include __DIR__ .'/../admin/includes/posts_functions.php';
	include __DIR__ .'/../admin/includes/admin_functions.php';
	if(isset($_GET['id'])){
		$posts = getPostById($_GET['id']);
	}
	/* Get page id for this post */ 
	$page_id = $posts['post_id'];
	/* SESSION variables for page reference */ 
	$post_slug = $posts['post_slug'];
	$_SESSION['page_id'] = $page_id;
	$_SESSION['post_slug'] = $post_slug;
	$published_post_ids = getAllPublishedPostIds();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- head section -->
<title><?php echo htmlspecialchars_decode($posts['post_title']) ;?> | DevelopersPot</title>
	<meta name="description" content="<?php echo (isset($posts['meta_description'])? htmlspecialchars_decode($posts['meta_description']):''); ?>" />
	<?php include_once __DIR__ .'/head.html.php';?>
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
pre, pre code, samp{
	display:block;
	margin:0;
}
pre{
	font-size:1.1em;
	tab-size:1;
	overflow-x:auto;
	padding:10px 0;
	margin: 0;
}
code{
	font-family:'Courier New',Courier;
	font-size:1em;
	color:#000;
	padding:0 2px;
}
p code,li code{
	background:rgb(230,230,230);
}
.special-p{
	padding:10px;
	font-family: calibri;
    background:rgb(100,200,250);
	background:rgba(100,200,255,.4);
	border-left: 5px double red;
	border-right: 5px double red;
}
.special-p code{
	background:inherit;
}
</style>
    <?php include_once __DIR__ .'/head-resources.html.php'; ?>
	<!-- Links for google code prettify .js at bottom of page files -->
	<link rel="stylesheet" href="<?php echo BASE_URL ?>resources/css/google-code-prettify/prettify.css" media="print" onload="this.media='all'; this.onload=null;"/>	
</head>
<body>

	<header>
		<?php include __DIR__ .'/header.html.php';?>
	</header>
	<main class="group">
		<aside class="col-2-10 hide-in-mobile">
				<div>
				<h2>Topics</h2>
				<?php include __DIR__ . '/published_posts_by_topics.html.php';?>
				</div>
		</aside><!--
		--><section class='col-5-10'>
			<!-- The title will be fetched from database -->
			<h1><?php echo ucwords(htmlspecialchars_decode($posts['post_title'])) ;?></h1>
			<div class="post-acreditation">  
				<?php echo isset($posts['updated_at'])? 'Updated on '. date( 'F j, Y', strtotime($posts['updated_at'])): 'Published on '. date( 'F j, Y', strtotime($posts['created_at'])) ?>
			</div>
			<!-- Social icons -->
				<div class="social-media">
					<?php include __DIR__ .'/social-icons-links.php';?>
				</div>
			<div>
                <div class="main-article">
                <!-- The page content will be fetched from database -->
                <?php echo htmlspecialchars_decode($posts['post_body']) ;?>
                </div>
				<div class="social-media">
                <!-- Social icons -->
					<?php include __DIR__ .'/social-icons-links.php';?>
				</div>
				<div>
				<!-- Call to subscribe for notification -->
				<?php  include __DIR__.'/subscribe.html.php';?>
				</div>
				<div>
			<!--Comments sections  -->
			<?php include __DIR__ .'/../comments/comments-layout.php'; ?>
				</div>
			</div>
		</section><!--
		--><aside class='col-3-10'>
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
			
			<div>   
            
			</div>
		</aside><!--			
		--><aside class="hide-in-bigger-screens">
				<div class="published-topics">
				<h2 class="left">Browse Topics</h2>
				<?php include __DIR__ . '/published_posts_by_topics.html.php';?>
				</div>
		</aside>
	</main>
	`<script src="<?php echo BASE_URL ?>resources/js/jquery-3.4.0.min.js"></script>
	<script src="<?php echo BASE_URL ?>resources/css/google-code-prettify/prettify.js"></script>
	<script src="<?php echo BASE_URL ?>resources/js/page-control.js"></script>
	<script src="<?php echo BASE_URL ?>resources/js/subscribe-comments-replies-scripts.js"></script>	
	<script>window.onload=function(){prettyPrint()}</script>`
	<footer>
		<?php include __DIR__ .'/footer.html.php'?>
	</footer>
</body>
</html>