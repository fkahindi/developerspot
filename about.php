<?php 
session_start(); 
require_once __DIR__ .'/config.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- head section -->
	<title>Developerspot is more than a blogging site, it is a blogging app</title>
	<meta name="description" content="It's not just a blogging site but a blogging app, complete with an admin module for managing articles, authors and users. It has an embedded comment-reply system on all articles." />
	<meta name="keywords" content="blog, blogging, blogging app, site, article, comments, reply"/>
	<!-- Twitter & OG metas -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@developerspotke">
    <meta name="twitter:creator" content="@fkahindi">
    <meta property="og:url" content="<?php echo $url;?>" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Developerspot is more than a blogging site, it is a blogging app"/>
    <meta property="og:description" content="It's not just a blogging site but a blogging app, complete with an admin module for managing articles, authors and users. It has an embedded comment-reply system on all articles." />
    <meta property="og:image" content="<?php echo BASE_URL ?>resources/icons/logoicon.png" />
    <meta property="fb:app_id" content="502152493814762"/>
	<?php include_once __DIR__ .'/templates/head.html.php'; ?>
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
	.main-article {
	margin: 1em auto;
	padding: 1em 0.5em;
	background-color: transparent; }
	@media (max-width: 768px) {
		.main-article {
		width: 90%; } }
	@media (max-width: 599px) {
		.main-article {
		width: 100%;
		margin: 0 auto;
		padding: 0.5em; } }
	@media (min-width: 769px) {
		.main-article {
		width: 70%; } }
	@media (min-width: 992px) {
		.main-article {
		width: 60%; } }

	</style>	 
    <?php include_once __DIR__ .'/templates/head-resources.html.php'; ?>
</head>
	
<body>
	<header class="grid-wrapper">
	<?php require_once __DIR__ . '/templates/header.html.php';?>
	<?php include __DIR__ .'/templates/social-icons-links.php';?>
	</header>
	<main class="group">
		<section class="main-article">
			<h1>About</h1><hr>
			<div>	
				<p>Developerspot is more than a blogging site, it is a blogging app, complete with an admin module for articles, authors and user management. It also has an embedded comment-reply system on all articles, enabling feedback, sharing of thoughts and experiences from readers. </p>
				<p>On this blog, every article is geared towards accomplishing a particular task. Account creation is just a means to enable association of comments and replies to individuals and in no way will your contact be shared with anyone else, not consistent with the privacy policy. Feel free to engage.</p>
				<p>I'm available for website building projects, if you would like my services, reach out to me using the contact above.</p>
			</div>
			
		</section>	
	</main>
	<script src="<?php echo BASE_URL ?>resources/js/jquery-3.4.0.min.js"></script>
	<script src="<?php echo BASE_URL ?>resources/js/page-control.js"></script>
	<footer class="group">
		<?php include __DIR__ .'/templates/footer.html.php'?>
	</footer>
</body>
</html>