<?php
if(!isset($_SESSION)){
	session_start();
}
require __DIR__ .'/includes/comments_functions.php';
?>
<!--**Display the following div container if there is session loggedin**-->
<div class="comments-container" id="comments-container">

	<!--Display comment box -->
	<div class="comment">
		<h3>Leave a comment</h3>
		<?php include __DIR__ .'/comments_form.php';?>
	</div>
	<div>
		<h5><?php
		/* Display total comments so far for every user */
		$publishedComments = new CommentsReplies($pdo,'comments','post_id','published');
		 $total_comments = $publishedComments->countPublishedRecords($page_id,1);
		 echo $total_comments;
		?>&nbsp;Comment(s)
		</h5><hr>
		<?php
			include __DIR__ .'/comments_pagination.php';
			/* Retrieve comments for this post */
			$comments = $publishedComments->getAllPublishedRecords($page_id,1,$limit);
			include __DIR__ .'/comments_display_main_block.php';
		?>
	</div>
	<?php if($total_comments>$no_of_comments_per_view):?>
	<span class="comments-per-view" data-id="<?php echo $no_of_comments_per_view; ?>"></span>
	<div data-id="<?php echo $page_id; ?>" id="pagination" class="pagination">
		<span id="num-of-pages" data-id ="<?php echo $number_of_pages ?>">
		<a href="#" data-id="<?php echo ($page_no -1); ?>"
		class="load-prev" >Load prev... &nbsp; &nbsp;</a>
		<a href="#" data-id="<?php echo ($page_no +1); ?>"
		class="more-comments" >Load more...</a>
		</span>
	</div>
	<?php endif; ?>
</div>