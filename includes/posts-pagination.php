<?php
include __DIR__ .'/../admin/includes/posts_functions.php';
include __DIR__ .'/../admin/includes/admin_functions.php';
if(isset($_POST['page_num'])){
    $page_num = $_POST['page_num'];
}else{
    $page_num = 1;
}
    $num_of_posts_per_page = 6;
    $offset = ($page_num - 1) * $num_of_posts_per_page;
    $total_rows = countPublishedPosts();
    $total_pages = ceil($total_rows/$num_of_posts_per_page);

    $published_post_ids = getBatchPublishedPostIds($num_of_posts_per_page,$offset);
?>

<?php foreach($published_post_ids as $post_id): ?>
                
    <?php $post = getPostById($post_id['post_id']) ?>
    <?php $post['author'] = getPostAuthorById($post['user_id'])?>
    
    <div class="posts-snippets">         
    <?php echo (!empty($post['image'])? '<img src="'.$post['image'].'" loading="lazy" width="100" height="90"alt="'.(!empty($post['image_caption'])? $post['image_caption']:'').'" class="post-thumb-nail">':'')?>
    <h4><a href="<?php echo BASE_URL ?>posts/<?php echo $post_id['post_id'] ?>/<?php echo $post['post_slug'] ?>"> <?php echo htmlspecialchars_decode($post['post_title']) ?></a></h4>
    <p> <?php echo getFirstParagraphPostById($post_id['post_id']) ?>
    <a href="<?php echo BASE_URL ?>posts/<?php echo $post_id['post_id'] ?>/<?php echo $post['post_slug'] ?>"><strong>Read more...</strong></a></p>
    </div> 
<?php endforeach ?>