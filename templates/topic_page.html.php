<?php 
session_start(); 
include __DIR__ .'/../admin/includes/posts_functions.php';
include __DIR__ .'/../admin/includes/admin_functions.php';
	
	$menu_topic = getTopicByName($_GET['name']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- head section -->
    <title><?=$menu_topic['topic_name'] ?> | For Web Development</title>
	<meta name="description" content="<?php echo (isset($posts['meta_description'])? htmlspecialchars_decode($posts['meta_description']):''); ?>" />
	<?php require_once __DIR__ .'/head.html.php'; ?>
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

</style>	 
    <?php include_once __DIR__ .'/head-resources.html.php'; ?>
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
				<?php $recent_posts = getMostRecentPosts(3); ?>
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