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
	    <meta name="description" content="<?php echo (isset($posts['meta_description'])? htmlspecialchars_decode($posts['meta_description']):''); ?>">
	    <title><?=$menu_topic['topic_name'] ?> | For Web Development</title>
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
        <?php include_once __DIR__ .'/head-resources.html.php'; ?>
	</head>
	<body>
		<header>
		<?php require_once __DIR__ . '/header.html.php';?>
		</header>
		<main class="group">
			<section class="main-article">
				<h1><?=$menu_topic['topic_name'] ?></h1>
				<?php $topic_id = $menu_topic['topic_id'] ?>
				<?php $published_posts = getPublishedPostsByTopic($topic_id)?>

				<?php foreach($published_posts as $pub_post):?>
				<?php $pub_post['author'] = getPostAuthorById($pub_post['user_id'])?>
				<?php echo (!empty($pub_post['image'])? '<img src="'.$pub_post['image'].'" loading="lazy" width="100" alt="'.(!empty($pub_post['image_caption'])? $pub_post['image_caption']:'').'" class="post-thumb-nail">':'')?>
				<h3><a href="<?php echo BASE_URL ?>posts/<?php echo $pub_post['post_id'] ?>/<?php echo $pub_post['post_slug']?>"><?php echo $pub_post['post_title']?></a></h3>
				<div class="post-acreditation">
					By <?php echo $pub_post['author'];?><span>  
					<?php echo isset($pub_post['updated_at'])? 'Updated on '. date( 'F j, Y', strtotime($pub_post['updated_at'])): 'Published on '. date( 'F j, Y', strtotime($pub_post['created_at'])) ?></span>
				</div>
				<div class="">
					<?php echo getFirstParagraphPostById($pub_post['post_id']) ?>
					<a href="<?php echo BASE_URL ?>posts/<?php echo $pub_post['post_id'] ?>/<?php echo $pub_post['post_slug'] ?>">Read more...</a>
				</div>
				<?php endforeach ?>
			</section>	
		</main>
        <script src="<?php echo BASE_URL ?>resources/js/jquery-3.4.0.min.js"></script>
        <script src="<?php echo BASE_URL ?>resources/js/page-control.js"></script>
		<footer class="group">
			<?php include __DIR__ .'/footer.html.php'?>
		</footer>
	</body>
</html>