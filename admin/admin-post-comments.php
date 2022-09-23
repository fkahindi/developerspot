<?php
 /* Start session if not already started */
	if(!isset($_SESSION)){
		session_start();
	}
	/* Only admins and authors can access this page, and must be logged in */
	include __DIR__ . '/../admin/includes/admin_login_status.php';
	if($_SESSION['role']!== 'Admin' && $_SESSION['role']!== 'Author'){
		header('Location: ../index.php');
	}
	/* Load necessary functions */
	require __DIR__ .'/../comments/includes/comments_functions.php';

	//Fetch all posts that apply to the user
    $page_id = $_GET['view-comments'];

    $postComments = new CommentsReplies($pdo,'comments','post_id');

		//Create pagination for comments
		$totalPostComments = new CommentsReplies($pdo,'comments','post_id');
		if (isset($_GET['comment_page_num'])) {
				$page_num = $_GET['comment_page_num'];
		} else {
				$page_num = 1;
		}
		$num_of_comments_per_page = 6;
		$offset = ($page_num - 1) * $num_of_comments_per_page;
		$total_rows = $totalPostComments->countAllRecords($page_id);
		$total_pages = ceil($total_rows / $num_of_comments_per_page);
		$limit=" LIMIT $offset, $num_of_comments_per_page";

		$comments=$postComments->getAllRecords($page_id, $limit);
?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/components/head.php';?>
	<title><?php echo  $_SESSION['role']?> | Comments</title>
</head>
<body>
	<?php include __DIR__ .'/components/navbar.php'; ?>
	<div class="container-fluid">
		<?php include __DIR__ .'/components/header-bar.php'?>
		<div class="row">
			<?php include __DIR__ .'/components/navigation-bar.php'?>
			<div class="col-md-9">
				<?php if(empty($comments)): ?>
				<div class="mx-auto my-4"><h4>There are no comments to display</h4></div>
					<!--Column right database output-->
				<?php else: ?>
						<table class="table table-striped table-condensed caption-top">
							<caption>
								<h4 class="text-center">
									Post Comments from --
									<?php
										$get_post = new CommentsReplies($pdo,'posts','post_id');
									 	$post_title=$get_post->selectSingleRecord($page_id);
										echo $post_title['post_title'];
									?>
									--
								</h4>
							</caption>
							<thead>
								<tr class="lead">
									<th>S/No.</th>
									<th>Commenter</th>
									<th>Comment Body</th>
									<th>Replies</th>
									<!--Only Admin can publish/ unpublish posts  -->
									<?php if($_SESSION['role']=='Admin'): ?>
									<th>Published?</th>
                  <th>Delete</th>
									<?php endif ?>
								</tr>
							</thead>
							<tbody>
								<?php foreach($comments as $key => $comment):?>
								<tr>
									<td><?php echo $page_num==1 ? ($key + 1) : ($offset + $key + 1) ?></td>
									<td>
                    <?php
                      $comment_author = new CommentsReplies($pdo,'users','user_id');
                      $row = $comment_author->selectSingleRecord($comment['user_id']);
											echo $row['username'];
                    ?>
                  </td>
									<td>
									  <?php echo $comment['body'] ?>
									</td>
									<td class="text-center">
										<?php $getRepliesCount = new CommentsReplies($pdo,'replies','comment_id')?>
										<a href="admin-comment-replies.php?view-replies=<?php echo $comment['comment_id'] ?>" data-bs-toggle="tooltip"  title="Click to view replies">
										 <?php echo $getRepliesCount->countAllRecords($comment['comment_id']) ?>
										</a>
									</td>
									<!--Only Admin can publish/ unpublish posts  -->
									<?php if($_SESSION['role']== 'Admin'): ?>
									<td class="text-center">
										<?php if($comment['published'] == true): ?>
											<a href="admin-post-comments.php?unpublish-comment=<?php echo $comment['comment_id'] ?>&page_id=<?php echo $page_id?>" class="btn btn-success"><i class="bi-check-lg"></i> </a>
										<?php else:?>
											<a href="admin-post-comments.php?publish-comment=<?php echo $comment['comment_id'] ?>&page_id=<?php echo $page_id?>" class="btn btn-danger"><i class="bi-x-lg"></i></a>
										<?php endif ?>
									</td>
                  <td>
										<p>
										<a href="admin-post-comments.php?delete-comment=<?php echo $comment['comment_id'] ?>&page_id=<?php echo $page_id?>" class="btn btn-danger delete" data-bs-toggle="modal" data-bs-target="#confirm-dialog"><i class="bi-trash"></i></a>
										</p>
									</td>
									<?php endif ?>
								</tr>
								<?php endforeach ?>
							</tbody>
						</table>
				<?php endif ?>
				<div>
					<nav>
						<ul class="pagination justify-content-center">
							<?php if($total_pages>1) :?>

								<li class="page-item  <?php if($page_num==1) echo 'disabled'?>">
									<a class="page-link" <?php if($page_num>1) :?> href="admin-post-comments.php?view-comments=<?php echo $page_id ?>&comment_page_num=<?php echo $page_num-1?>" <?php endif?>>Previous</a>
								</li>
								<?php for($page=1; $page<= $total_pages; $page++) :?>

									<?php if($page==1):?>
										<li class="page-item <?php if($page==$page_num) echo 'active'?>" data-id="<?php echo $page?>">
											<a class="page-link" href="admin-post-comments.php?view-comments=<?php echo $page_id ?>&comment_page_num=<?php echo $page?>"><?php echo $page ?></a>
										</li>
									<?php else :?>
									<li class="page-item <?php if($page==$page_num) echo 'active'?>" data-id="<?php echo $page?>">
										<a class="page-link" href="admin-post-comments.php?view-comments=<?php echo $page_id ?>&comment_page_num=<?php echo $page?>"><?php echo $page ?> </a>
									</li>
									<?php endif?>

								<?php endfor?>
								<li class="page-item <?php if($page_num==$total_pages) echo 'disabled'?>">
									<a class="page-link" <?php if($page_num<$total_pages) :?> href="admin-post-comments.php?view-comments=<?php echo $page_id ?>&comment_page_num=<?php echo $page_num+1?>" <?php endif?>>Next</a>
								</li>

							<?php endif ?>
						</ul>
					</nav>
				</div>
			</div>
		</div>
		<!-- Confirm modal -->
		<?php
			$dialog_title = "Confirm Comment Delete!";
			$main_text = "<b>STOP! Are you sure you want to delete this comment?</b>";
			$sub_text = "<b>NOTE:</b> All associated replies to this comment will also be deleted.";
			include __DIR__ .'/components/confirm-dialog.php';
		?>
		<!-- End of confirm modal -->
	</div>
	<?php include __DIR__ .'/components/footer.php'?>
	<script src="js/confirm-dialog.js"></script>
</body>
</html>