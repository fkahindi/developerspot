<?php 
session_start(); 
require_once __DIR__ .'/config.php';
include __DIR__ .'/admin/includes/posts_functions.php';
include __DIR__ .'/admin/includes/admin_functions.php';
	$published_post_ids = getThreeLatestPublishedPostIds();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- head section -->
<title>Developerspot: Frontend and Server side web development </title> 
	<meta name="description" content="A blogging site dedicated to front-end and back-end  technologies for web development. Provides informative and practical tutorials to unlock the potential of any upcoming web developer." />
	
	<?php include_once __DIR__ .'/templates/head.html.php'; ?>
	<!--// head section -->
	
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
.paragraph-snippet{
	font-family:'Hind Vadodara',sans-serif;
	font-size:90%;
	line-height:1.4;
	padding:5px;
	border:0 solid;
	box-shadow:0 5px 5px grey; 
}

</style>
 <?php include_once __DIR__ .'/templates/head-resources.html.php'; ?>
	<body>
		<header>
		<?php require_once __DIR__ . '/templates/header.html.php';?>
		  
		</header>
		<main class="group">
			<aside class="col-2-10 hide-in-mobile">
				<div class="published-topics">
				<h2>Topics</h2>
					
				<?php include __DIR__ . '/templates/published_posts_by_topics.html.php';?>										
				</div>
			</aside><!--
			--><section class="col-5-10">
				<h1 class="align-center">Web Develoment Tutorials</h1><hr>
				<div class="social-media">
					<?php include __DIR__ .'/templates/social-icons-links.php';?>
				</div>
				<?php foreach($published_post_ids as $post_id): ?>
				<?php $post = getPostById($post_id['post_id']) ?>
				<?php $post['author'] = getPostAuthorById($post['user_id'])?>
				<div>
					<h3><a href="templates/post.html.php?id=<?php echo $post_id['post_id'] ?>&title=<?php echo $post['post_slug'] ?>"> <?php echo htmlspecialchars_decode($post['post_title']) ?></a></h3>
				</div>
				<div class="post-acreditation">
					<span>  
					<?php echo isset($post['updated_at'])? 'Updated on '. date( 'F j, Y', strtotime($post['updated_at'])): 'Published on '. date( 'F j, Y', strtotime($post['created_at'])) ?></span>, By <?php echo $post['author'];?>
				</div>
				<div class="post-main-image">
				<figure>
				<a href="templates/post.html.php?id=<?php echo $post_id['post_id'] ?>&title=<?php echo $post['post_slug'] ?>">
				<?php echo (!empty($post['image'])? '<img src="'.$post['image'].'" loading="lazy" alt="'.(!empty($post['image_caption'])? $post['image_caption']:'').'" class="article-index-image">':'')?></a>
					<figcaption><?php echo (!empty($post['image_caption'])? $post['image_caption']:'' ); ?></figcaption>
				</figure>
				</div>
				<div class="paragraph-snippet">
					<?php echo getFirstParagraphPostById($post_id['post_id']) ?>
					<a href="templates/post.html.php?id=<?php echo $post_id['post_id'] ?>&title=<?php echo $post['post_slug'] ?>">Read more...</a>
				</div><br>
				<?php endforeach; ?>
			</section><!--			
			--><aside class="col-3-10">
				<!-- Sidebar content goes here-->
				<div class="recent-posts">
				<h2 class="left">Recent posts</h2>
				<?php $recent_posts = getMostRecentPosts(); ?>
				<?php foreach($recent_posts as $latest_post): ?>
				<p><a href="templates/post.html.php?id=<?php echo $latest_post['post_id'] ?>&title=<?php echo $latest_post['post_slug']?>"> <?php echo $latest_post['post_title'] ?></a></p>
				<?php endforeach; ?>
                    <div class="contact-me">
                      <?php include __DIR__ . '/templates/contact-me.html.php'?>
                    </div>
				</div>
			</aside><!--			
			--><aside class="hide-in-bigger-screens">
				<div>
				<h2 class="left">Browse Topics</h2>
					<?php include __DIR__ . '/templates/published_posts_by_topics.html.php';?>				
				</div>
			</aside>
		</main>
		<script src="<?php echo BASE_URL ?>resources/js/jquery-3.4.0.min.js"></script>
		<script src="<?php echo BASE_URL ?>resources/js/page-control.js"></script>
		<footer>
			<?php include __DIR__ .'/templates/footer.html.php'?>
		</footer>
	</body>
</html>