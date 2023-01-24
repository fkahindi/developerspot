<?php
session_start();
require_once __DIR__ .'/config.php';
$thisPage = "ABOUT";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- head section -->
	<?php include_once __DIR__ .'/templates/head.html.php'; ?>
	<link rel="canonical" href="https://www.developerspot.co.ke/about.php">
	<title>About Developerspot - blogging app</title>
	<meta name="description" content="It's not just a blogging site but a blogging app, complete with an admin module for managing articles, authors and users. It has an embedded comment-reply system on all articles." />
	<meta name="keywords" content="blog, blogging, blogging app, site, article, comments, reply"/>
	<!-- Twitter & OG metas -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@developerspotke">
    <meta name="twitter:creator" content="@fkahindi">
    <meta name="twitter:image" content="<?php echo BASE_URL ?>resources/icons/logoicon.png">
    <meta property="og:url" content="<?php echo $url;?>" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="About Developerspot - blogging app"/>
    <meta property="og:description" content="It's not just a blogging site but a blogging app, complete with an admin module for managing articles, authors and users. It has an embedded comment-reply system on all articles." />
    <meta property="og:image" content="<?php echo BASE_URL ?>resources/icons/logoicon.png" />
    <meta property="fb:app_id" content="502152493814762"/>
		<link rel="preload" href="<?php echo BASE_URL ?>resources/css/about.css" as="style">
		<link rel="stylesheet" href="<?php echo BASE_URL ?>resources/css/about.css" />
    <?php include_once __DIR__ .'/templates/head-resources.html.php'; ?>


        <!-- Facebook Pixel Code -->
        <script src="resources/js/facebook-pixel.js"></script>

</head>
<body>
	<noscript><img height="1" width="1"  class="hidden"
        src="https://www.facebook.com/tr?id=1970631019919003&ev=PageView&noscript=1"
     /></noscript>
    <!-- End Facebook Pixel Code -->
	<header class="grid-wrapper">
	<?php require_once __DIR__ . '/templates/header.html.php';?>
	<?php include __DIR__ . '/search/search-form.php'; ?>
	</header>
	<main class="group">
		<section class="main-article">
			<h1>About</h1><hr>
			<div>
				<p>Developerspot is the implementation of an idea of a blogging app, complete with an admin section for articles, authors and user management. It also has an embedded comment-reply system on all articles, enabling feedback, sharing of thoughts and experiences from readers. </p>
				<p>On this blog, every article is geared towards accomplishing a particular task. Account creation is just a means to enable association of comments and replies to individuals and in no way will your contact be shared with anyone else, not consistent with the privacy policy. Feel free to engage.</p>
				<p>For website building projects, you can reach out to me using the contact above. If you are a developer and want to contribute to the code, I have made the entire codebase available on github at, <a href="https://github.com/fkahindi/developerspot">https://github.com/fkahindi/developerspot</a>. You are free to fork.</p>
			</div>

		</section>
	</main>
	<script src="<?php echo BASE_URL ?>resources/js/jquery-3.4.0.min.js"></script>
	<script src="<?php echo BASE_URL ?>resources/js/page-control.js"></script>
	<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    <script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
	<footer class="grid-wrapper">
		<?php include __DIR__ .'/templates/social-icons-links.php';?>
        <?php include __DIR__ .'/templates/footer.html.php'?>
	</footer>
</body>
</html>