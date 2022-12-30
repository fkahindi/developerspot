<?php
if (!isset($_SESSION)) {
	session_start();
}
include __DIR__ . '/../admin/includes/posts_functions.php';
include __DIR__ . '/../admin/includes/admin_functions.php';
if (isset($_GET['slug'])) {
	$posts = getPostBySlug($_GET['slug']);
	if (empty($posts)) {
		header("Location:../index.php");
	}
} else {
	header("Location:../index.php");
}
/* Get page id for this post */
$page_id = $posts['post_id'];
/* SESSION variables for page reference */
$post_slug = $posts['post_slug'];
$_SESSION['page_id'] = $page_id;
$_SESSION['post_slug'] = $post_slug;
$published_post_ids = getAllPublishedPostIds();
//modify url dynamically

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- head section -->
	<?php include_once __DIR__ . '/head.html.php'; ?>
	<link rel="canonical" href="https://www.developerspot.co.ke/posts/<?= $post_slug ?>">
	<title><?php echo htmlspecialchars_decode($posts['post_title']); ?></title>
	<meta name="description" content="<?php echo (isset($posts['meta_description']) ? htmlspecialchars_decode($posts['meta_description']) : ''); ?>" />
	<meta name="keywords" content="<?php echo (isset($posts['meta_keywords']) ? htmlspecialchars_decode($posts['meta_keywords']) : ''); ?>" />
	<!-- Twitter & OG metas -->
	<meta name="twitter:card" content="summary" />
	<meta name="twitter:site" content="@developerspotke" />
	<meta name="twitter:creator" content="@fkahindi" />
	<meta property="og:url" content="<?php echo $url; ?>" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="<?php echo htmlspecialchars_decode($posts['post_title']); ?>" />
	<meta property="og:description" content="<?php echo (isset($posts['meta_description']) ? htmlspecialchars_decode($posts['meta_description']) : ''); ?>" />
	<meta property="og:image" content="<?php echo (!empty($posts['image']) ? ($posts['image']) : '') ?>" />

	<?php include_once __DIR__ . '/head-resources.html.php'; ?>
	<link rel="preload" href="<?php echo BASE_URL ?>resources/css/post.css" as="style">
	<link rel="preload" href="<?php echo BASE_URL ?>resources/css/subscribe-comments-replies.css" as="style">
	<link rel="stylesheet" href="<?php echo BASE_URL ?>resources/css/post.css" />
	<link rel="stylesheet" href="<?php echo BASE_URL ?>resources/css/subscribe-comments-replies.css" media="print" onload="this.media='all'; this.onload=null;"/>
	<!-- Links for google code prettify .js at bottom of page files: Local server -->
	<link rel="stylesheet" href="<?php echo BASE_URL ?>resources/css/google-code-prettify/prettify.css" media="print" onload="this.media='all'; this.onload=null;" />

	<!-- JSON-LD markup generated by Google Structured Data Markup Helper. -->
	 <script type="application/ld+json">
        {
    	"@context" : "http://schema.org",
    	"@type" : "Article",
    	"name" : "<?php echo ucwords(htmlspecialchars_decode($posts['post_title'])) ?>",
    	"headline": "<?php echo ucwords(htmlspecialchars_decode($posts['post_title'])) ?>",
    	"datePublished" : "<?php echo date( 'F j, Y', strtotime($posts['created_at'])) ?>",
    	"dateModified": "<?php date( 'F j, Y', strtotime($posts['updated_at'])) ?>",
    	"image" : "<?php echo ($posts['image']) ?>",
    	"articleSection" : "<?php echo htmlspecialchars_decode(getFirstParagraphPostById($posts['post_id'])) ?>",
    	"author": {
    			"@type": "Person",
    			"name": "<?php echo $post['author'] = getPostAuthorById($posts['user_id'])?>",
    			"url": "https://www.developerspot.co.ke"
    		},
    	"publisher" : {
    		"@type" : "Organization",
    		"name" : "DevelopersPot",
    		"logo": {
    		"@type": "ImageObject",
    		"url": "https://www.developerspot.co.ke/resources/icons/logicon.png"
    		}
    	}
    	}
    </script>
	<!-- Facebook Pixel Code -->
	<script src="../resources/js/facebook-pixel.js">
	</script>

</head>

<body>
	<noscript><img height="1" width="1" class="hidden" src="https://www.facebook.com/tr?id=1970631019919003&ev=PageView&noscript=1" /></noscript>
	<!-- End Facebook Pixel Code -->
	<header class="grid-wrapper">
		<?php include __DIR__ . '/header.html.php'; ?>
		<?php include __DIR__ . '/social-icons-links.php'; ?>
		<?php include __DIR__ . '/../search/search-form.php'; ?>
	</header>
	<main class="group">
		<section class="main-article">
			<!-- The title will be fetched from database -->
			<h1><?php echo ucwords(htmlspecialchars_decode($posts['post_title'])); ?></h1>
			<div class="post-acreditation">
				<?php echo isset($posts['updated_at']) ? 'Updated on ' . date('F j, Y', strtotime($posts['updated_at'])) : 'Published on ' . date('F j, Y', strtotime($posts['created_at'])) ?>
			</div>

			<div class="article-body">
				<!-- The page content will be fetched from database -->
				<?php echo htmlspecialchars_decode($posts['post_body']); ?>
			</div>
			<div>
				<!-- Call to subscribe for notification -->
				<?php include __DIR__ . '/../forms/subscribe.html.php'; ?>
			</div>
			<div>
				<!--Comments sections  -->
				<?php include __DIR__ . '/../comments/comments-layout.php'; ?>
			</div>

		</section>
	</main>
	<script src="<?php echo BASE_URL ?>resources/js/jquery-3.4.0.min.js"></script>
	<script src="<?php echo BASE_URL ?>resources/css/google-code-prettify/prettify.js"></script>
	<script src="<?php echo BASE_URL ?>resources/js/page-control.js"></script>
	<script src="<?php echo BASE_URL ?>resources/js/subscribe.js"></script>
	<script src="<?php echo BASE_URL ?>comments/js/comments-replies.js"></script>
	<script>
		window.onload = function() {
			prettyPrint()
		}
	</script>
	<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) : ?>
		<!-- Run script if user is logged in -->
		<script src="<?php echo BASE_URL ?>comments/js/comments-cookies.js">

		</script>
	<?php endif; ?>
	<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
	<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
	<!-- Online server

    <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js?skin=sons-of-obsidian"></script>
    -->

	<footer class="grid-wrapper">
		<?php include __DIR__ . '/social-icons-links.php'; ?>
		<?php include __DIR__ . '/footer.html.php' ?>
	</footer>
</body>

</html>