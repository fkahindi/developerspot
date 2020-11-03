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

</style>	 
    <?php include_once __DIR__ .'/templates/head-resources.html.php'; ?>
	</head>
	</head>
	<body>
		<header>
		<?php require_once __DIR__ . '/templates/header.html.php';?>
		</header>
		<main class="group">
			<aside class="col-2-10 hide-in-mobile">
				
			</aside><!--
			--><section class="col-5-10">
				<h1>About Us</h1><hr>
				<div>	
					<p><em>Developing something that others find useful is great. But even greater is when what you are passionate about is helping others to be great.</em></p>
					<p>Developerspot is a blogging site dedicated to sharing web development trends and skills with those who aspire to start their journey in web development or are struggling along the way. On this blog we highlight technical areas that many take for granted but are challenging to the upcoming developers.</p>
					<p>The comment system at the end of each post is a means to interact, share experiences and solve real problems. Creating a developers ecosystem where the experienced and novice form a symbiotic relationship for the betterment of the community is hard, but we encourage it. Signing up is being part of the ecosystem.</p>
				</div>
				
			</section><!--			
			--><aside class="col-3-10">
				<!-- Sidebar content goes here-->
				
				</div>
			</aside><!--			
			--><aside class="hide-in-bigger-screens">
				
			</aside>	
		</main>
		<script src="<?php echo BASE_URL ?>resources/js/jquery-3.4.0.min.js"></script>
		<script src="<?php echo BASE_URL ?>resources/js/page-control.js"></script>
		<footer class="group">
			<?php include __DIR__ .'/templates/footer.html.php'?>
		</footer>
	</body>
</html>