<?php 
session_start(); 
require_once __DIR__ .'/config.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- head section -->
	<title>About | Who we are</title>
	<meta name="description" content="Developerspot is a blogging site dedicated to sharing web development trends and skills with those who aspire to start their journey in web development or are struggling along the way. " />
	<meta name="keywords" content=""/>
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
			<h1>About Us</h1><hr>
			<div>	
				<p>Developerspot is a blogging site dedicated to highlighting web development trends and sharing knowledge and skills with other developers. We also offer website building services. If you are interested in hiring our services, feel free to reach out using the contact link above.</p>
				<p>On this blog, every post is geared to accomplishing a particular task. At the end of each post there is a comment area, where readers can share their experiences and thoughts. The sign up process is a means to manage comments in the system and your contact will in no way be shared with anyone else, not consistent with our privacy policy. Feel free to engage.</p>
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