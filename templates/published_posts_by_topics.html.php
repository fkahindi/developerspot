<div class="published-topics">
<?php $topics = getAllTopics()?>

 <?php foreach($topics as $topic): ?>
	<details><summary><ul><li> <?php echo $topic['topic_name']?></summary><ul><li>
	 <?php $topic_id = $topic['topic_id'] ?>
	 <?php $published_posts = getPublishedPostsByTopic($topic_id)?>
     
	 <?php foreach($published_posts as $pub_post):?>
		<a href="<?php echo BASE_URL ?>posts/<?php echo $pub_post['post_id'] ?>/<?php echo $pub_post['post_slug']?>"><?php echo $pub_post['post_title']?></a>
	 <?php endforeach ?></li></ul></li></ul></details>
 <?php endforeach ?>
 
 </div>