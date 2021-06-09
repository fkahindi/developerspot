<?php 
if(!isset($_SESSION)){
	session_start();
}
require_once __DIR__ .'/config.php';
include __DIR__ .'/admin/includes/posts_functions.php';
include __DIR__ .'/admin/includes/admin_functions.php';
$published_post_ids = getAllPublishedPostIds();

?>
<!DOCTYPE html>
<html lang="en">
	<head>
        <?php require_once __DIR__ .'/templates/head.html.php'; ?>
        <link rel="canonical" href="https://www.developerspot.co.ke/blog.php">
        <title>A blogging site dedicated to building websites and web apps</title>
	    <meta name="description" content="Articles dedicated to building websites and web apps that are SEO friendly. The tutorials focuses on both server-side and front end solutions. ">
        <meta name="keywords" content="websites, app, blog, server-side, front end, php, html, javascript, css, solutions"/>
        <!-- Twitter & OG metas -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@developerspotke">
        <meta name="twitter:creator" content="@fkahindi">
        <meta property="og:url" content="<?php echo $url;?>" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="A blogging site dedicated to building websites and web apps" />
        <meta property="og:description" content="Articles dedicated to building websites and web apps that are SEO friendly. The tutorials focuses on both server-side and front end solutions." />
        <meta property="og:image" content="<?php echo BASE_URL ?>resources/images/html-doc-structure.png" />
        <meta property="fb:app_id" content="502152493814762"/>
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
        <?php include_once __DIR__ .'/templates/head-resources.html.php'; ?>
        <script type="application/ld+json">
            {
            "@context": "http://schema.org/",
            "@type": "WebSite",
            "url": "https://www.developerspot.co.ke/blog",
            "potentialAction": {
                "@type": "SearchAction",
                "target": "{search_term_string}",
                "query-input": "required name=search_term_string"
            }
            }
        </script>
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
	</head>
	<body>
        <noscript><img height="1" width="1"  class="hidden"
        src="https://www.facebook.com/tr?id=1970631019919003&ev=PageView&noscript=1"
        /></noscript>
        <!-- End Facebook Pixel Code -->
		<header class="grid-wrapper">
		<?php require_once __DIR__ . '/templates/header.html.php';?>
        <?php include __DIR__ .'/templates/social-icons-links.php';?>
		</header>
		<main class="group">
			<section class="posts-section border-not-last-child-div">
                <h1>Tutorials </h1>
                <div class="intro-paragraph">
                    <p>
                        Welcome to the blog. This site is dedicated to building websites and web apps that are SEO friendly. It focuses on both server-side and front end solutions. I have tried to be as illustrative as possible, but that's on my side, you may have your opinion. Leaving a feedback will be highly appreciated. Thanks!
                    </p>
                </div>
                <?php foreach($published_post_ids as $post_id): ?>
                
                    <?php $post = getPostById($post_id['post_id']) ?>
                    <?php $post['author'] = getPostAuthorById($post['user_id'])?>
                    
                    <div class="posts-snippets ">         
                    <?php echo (!empty($post['image'])? '<img src="'.$post['image'].'" loading="lazy" width="100" height="90"alt="'.(!empty($post['image_caption'])? $post['image_caption']:'').'" class="post-thumb-nail">':'')?>
                    <h4><a href="<?php echo BASE_URL ?>posts/<?php echo $post_id['post_id'] ?>/<?php echo $post['post_slug'] ?>"> <?php echo htmlspecialchars_decode($post['post_title']) ?></a></h4>
                    <p> <?php echo getFirstParagraphPostById($post_id['post_id']) ?>
                    <a href="<?php echo BASE_URL ?>posts/<?php echo $post_id['post_id'] ?>/<?php echo $post['post_slug'] ?>"><strong>Read more...</strong></a></p>
                    </div> 
                <?php endforeach ?>
			</section>
		</main>
        <script src="<?php echo BASE_URL ?>resources/js/jquery-3.4.0.min.js"></script>
        <script src="<?php echo BASE_URL ?>resources/js/page-control.js"></script>
        <footer class="grid-wrapper">
        <?php include __DIR__ .'/templates/social-icons-links.php';?>
        <?php include __DIR__ .'/templates/footer.html.php'?>
      </footer>
	</body>
</html>