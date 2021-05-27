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
        <title>Developerspot blog | Building websites</title>
	    <meta name="description" content="<?php echo (isset($posts['meta_description'])? htmlspecialchars_decode($posts['meta_description']):''); ?>">
        <meta name="keywords" content=""/>
    	<?php require_once __DIR__ .'/templates/head.html.php'; ?>
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
	</head>
	<body>
		<header class="grid-wrapper">
		<?php require_once __DIR__ . '/templates/header.html.php';?>
        <?php include __DIR__ .'/templates/social-icons-links.php';?>
		</header>
		<main class="group">
			<section class="posts-section border-not-last-child-div">
                <h1>Tutorials </h1>
                
                <?php foreach($published_post_ids as $post_id): ?>
                
                    <?php $post = getPostById($post_id['post_id']) ?>
                    <?php $post['author'] = getPostAuthorById($post['user_id'])?>
                    
                    <div class="posts-snippets ">         
                    <?php echo (!empty($post['image'])? '<img src="'.$post['image'].'" loading="lazy" width="100" alt="'.(!empty($post['image_caption'])? $post['image_caption']:'').'" class="post-thumb-nail">':'')?>
                    <h4><a href="<?php echo BASE_URL ?>posts/<?php echo $post_id['post_id'] ?>/<?php echo $post['post_slug'] ?>"> <?php echo htmlspecialchars_decode($post['post_title']) ?></a></h4>
                    <p> <?php echo getFirstParagraphPostById($post_id['post_id']) ?>
                    <a href="<?php echo BASE_URL ?>posts/<?php echo $post_id['post_id'] ?>/<?php echo $post['post_slug'] ?>"><i>Read more...</i></a></p>
                    </div> 
                <?php endforeach ?>
			</section>
		</main>
        <script src="<?php echo BASE_URL ?>resources/js/jquery-3.4.0.min.js"></script>
        <script src="<?php echo BASE_URL ?>resources/js/page-control.js"></script>
		<footer class="group">
			<?php include __DIR__ .'/templates/footer.html.php'?>
		</footer>
	</body>
</html>