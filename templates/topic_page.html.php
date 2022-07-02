<?php 
if(!isset($_SESSION)){
	session_start();
}
include __DIR__ .'/../admin/includes/posts_functions.php';
include __DIR__ .'/../admin/includes/admin_functions.php';
if(isset($_GET['name'])){
	$menu_topic = getTopicByName($_GET['name']);
	if(empty($menu_topic)){
		header("Location:../index.php");
	}
}else{
	header("Location:../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php require_once __DIR__ .'/head.html.php'; ?>
		<link rel="canonical" href="https://www.developerspot.co.ke/topic/<?=$menu_topic['topic_name'] ?>">
		<title><?=$menu_topic['topic_name'] ?> for Web Development</title>
	    <meta name="description" content="<?php echo (isset($menu_topic['topic_description'])? htmlspecialchars_decode($menu_topic['topic_description']):''); ?>">
		<meta name="keywords" content="<?php echo (isset($menu_topic['topic_keywords'])? htmlspecialchars_decode($menu_topic['topic_keywords']):''); ?>" />
    	<!-- Twitter & OG metas -->
		<meta name="twitter:card" content="summary">
		<meta name="twitter:site" content="@developerspotke">
		<meta name="twitter:creator" content="@fkahindi">
		<meta property="og:url" content="<?php echo $url;?>" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="<?=$menu_topic['topic_name'] ?> for Web Development" />
		<meta property="og:description" content="<?php echo (isset($menu_topic['topic_description'])? htmlspecialchars_decode($menu_topic['topic_description']):''); ?>" />
		<meta property="og:image" content="" />
		<meta property="fb:app_id" content="502152493814762"/>

        <?php include_once __DIR__ .'/head-resources.html.php'; ?>
		<script type="application/ld+json">
			{
			"@context": "http://schema.org/",
			"@type": "WebSite",
			"url": "https://www.developerspot.co.ke/topic/<?=$menu_topic['topic_name'] ?>",
			"potentialAction": {
				"@type": "SearchAction",
				"target": "{search_term_string}",
				"query-input": "required name=search_term_string"
			}
			}
		</script>
		<!-- Facebook Pixel Code -->
		<script src="../resources/js/facebook-pixel.js"></script>
	</head>
	<body>
		<noscript><img height="1" width="1"  class="hidden"
		src="https://www.facebook.com/tr?id=1970631019919003&ev=PageView&noscript=1"
		/></noscript>
		<!-- End Facebook Pixel Code -->
		<header class="grid-wrapper">
			<?php require_once __DIR__ . '/header.html.php';?>
			<?php include __DIR__ .'/social-icons-links.php';?>
			<?php include __DIR__ .'/../search/search-form.php';?>
		</header>
		<main class="group">
			<section class="posts-section border-not-last-child-div">
				<h1><?=$menu_topic['topic_name'] ?></h1>
				<div class="intro-paragraph">
				<p><?=$menu_topic['topic_intro'] ?></p>
				</div>
				<?php $topic_id = $menu_topic['topic_id'] ?>
				<?php $published_posts = getPublishedPostsByTopic($topic_id)?>

				<?php foreach($published_posts as $pub_post):?>
				<?php $pub_post['author'] = getPostAuthorById($pub_post['user_id'])?>
				<div class="posts-snippets">
				<?php echo (!empty($pub_post['image'])? '<img src="'.$pub_post['image'].'" loading="lazy" width="100" height="90" alt="'.(!empty($pub_post['image_caption'])? $pub_post['image_caption']:'').'" class="post-thumb-nail">':'')?>
				<h4><a href="<?php echo BASE_URL ?>posts/<?php echo $pub_post['post_slug']?>"><?php echo $pub_post['post_title']?></a></h4>
				
					<span class="post-acreditation">  
					<?php echo isset($pub_post['updated_at'])? 'Updated on '. date( 'F j, Y', strtotime($pub_post['updated_at'])): 'Published on '. date( 'F j, Y', strtotime($pub_post['created_at'])) ?></span>
				
				
					<?php echo getFirstParagraphPostById($pub_post['post_id']) ?>
					<a href="<?php echo BASE_URL ?>posts/<?php echo $pub_post['post_slug'] ?>">Read more...</a>
				</div>
				<?php endforeach ?>
			</section>	
		</main>
        <script src="<?php echo BASE_URL ?>resources/js/jquery-3.4.0.min.js"></script>
        <script src="<?php echo BASE_URL ?>resources/js/page-control.js"></script>
		<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    	<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js" ></script>
		<footer class="grid-wrapper">
        <?php include __DIR__ .'/social-icons-links.php';?>
        <?php include __DIR__ .'/footer.html.php'?>
      </footer>
	</body>
</html>