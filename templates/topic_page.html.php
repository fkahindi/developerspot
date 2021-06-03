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
		<title><?=$menu_topic['topic_name'] ?> | For Web Development</title>
	    <meta name="description" content="<?php echo (isset($menu_topic['topic_description'])? htmlspecialchars_decode($menu_topic['topic_description']):''); ?>">
		<meta name="keywords" content="<?php echo (isset($menu_topic['topic_keywords'])? htmlspecialchars_decode($menu_topic['topic_keywords']):''); ?>" />
    	<!-- Twitter & OG metas -->
		<meta name="twitter:card" content="summary">
		<meta name="twitter:site" content="@developerspotke">
		<meta name="twitter:creator" content="@fkahindi">
		<meta property="og:url"                content="<?php echo $url;?>" />
		<meta property="og:type"               content="article" />
		<meta property="og:title"              content="<?=$menu_topic['topic_name'] ?>" />
		<meta property="og:description"        content="<?php echo (isset($menu_topic['topic_description'])? htmlspecialchars_decode($menu_topic['topic_description']):''); ?>" />
		<meta property="og:image"              content="" />
		<meta property="fb:app_id"				content="502152493814762"/>
 
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
		<script>
			!function(f,b,e,v,n,t,s)
			{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
			n.callMethod.apply(n,arguments):n.queue.push(arguments)};
			if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
			n.queue=[];t=b.createElement(e);t.async=!0;
			t.src=v;s=b.getElementsByTagName(e)[0];
			s.parentNode.insertBefore(t,s)}(window, document,'script',
			'https://connect.facebook.net/en_US/fbevents.js');
			fbq('init', '1970631019919003');
			fbq('track', 'PageView');
		</script>
		<noscript><img height="1" width="1" style="display:none"
		src="https://www.facebook.com/tr?id=1970631019919003&ev=PageView&noscript=1"
		/></noscript>
		<!-- End Facebook Pixel Code -->
	</head>
	<body>
		<header class="grid-wrapper">
		<?php require_once __DIR__ . '/header.html.php';?>
		<?php include __DIR__ .'/social-icons-links.php';?>
		</header>
		<main class="group">
			<section class="posts-section border-not-last-child-div">
				<h1><?=$menu_topic['topic_name'] ?></h1>
				<p><?=$menu_topic['topic_intro'] ?></p><hr>
				<?php $topic_id = $menu_topic['topic_id'] ?>
				<?php $published_posts = getPublishedPostsByTopic($topic_id)?>

				<?php foreach($published_posts as $pub_post):?>
				<?php $pub_post['author'] = getPostAuthorById($pub_post['user_id'])?>
				<div class="posts-snippets">
				<?php echo (!empty($pub_post['image'])? '<img src="'.$pub_post['image'].'" loading="lazy" width="100" height="90" alt="'.(!empty($pub_post['image_caption'])? $pub_post['image_caption']:'').'" class="post-thumb-nail">':'')?>
				<h4><a href="<?php echo BASE_URL ?>posts/<?php echo $pub_post['post_id'] ?>/<?php echo $pub_post['post_slug']?>"><?php echo $pub_post['post_title']?></a></h4>
				
					<span class="post-acreditation">  
					<?php echo isset($pub_post['updated_at'])? 'Updated on '. date( 'F j, Y', strtotime($pub_post['updated_at'])): 'Published on '. date( 'F j, Y', strtotime($pub_post['created_at'])) ?></span>
				
				
					<?php echo getFirstParagraphPostById($pub_post['post_id']) ?>
					<a href="<?php echo BASE_URL ?>posts/<?php echo $pub_post['post_id'] ?>/<?php echo $pub_post['post_slug'] ?>">Read more...</a>
				</div>
				<?php endforeach ?>
			</section>	
		</main>
        <script src="<?php echo BASE_URL ?>resources/js/jquery-3.4.0.min.js"></script>
        <script src="<?php echo BASE_URL ?>resources/js/page-control.js"></script>
		<script>
      /* Facabook */
        document.getElementById('shareBtn').onclick = function() {
          FB.ui({
            display: 'popup',
            method: 'share',
            href="<?php echo $url;?>",
          }, function(response){});
        }
      </script>
		<footer class="grid-wrapper">
        <?php include __DIR__ .'/social-icons-links.php';?>
        <?php include __DIR__ .'/footer.html.php'?>
      </footer>
	</body>
</html>