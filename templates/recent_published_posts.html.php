<?php $recent_posts = getMostRecentPosts(3); ?>

<?php foreach($recent_posts as $latest_post): ?>
    <p><a href="<?php echo BASE_URL ?>posts/<?php echo $latest_post['post_id'] ?>/<?php echo $latest_post['post_slug']?>"> <?php echo $latest_post['post_title'] ?></a></p>
<?php endforeach; ?>