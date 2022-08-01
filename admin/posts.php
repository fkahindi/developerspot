<?php
 /* Start session if not already started */
	if(!isset($_SESSION)){
		session_start();
	}
	/* Only admins and authors can access this page, and must be logged in */
	include __DIR__ . '/includes/admin_login_status.php';
	if($_SESSION['role']!== 'Admin' && $_SESSION['role']!== 'Author'){
		header('Location: ../index.php');
	}
	/* Load necessary functions */
	include __DIR__ .'/includes/admin_functions.php';
	include __DIR__ .'/includes/posts_functions.php';
	include __DIR__ .'/../comments/includes/comments_functions_test.php';

	if (isset($_GET['page-num'])) {
				$page_num = $_GET['page-num'];
		} else {
				$page_num = 1;
		}

		$num_of_posts_per_page = 10;
		$offset = ($page_num - 1) * $num_of_posts_per_page;
		if($_SESSION['role']=='Admin'){
			$total_rows = countAllPosts();
		}else{
			$total_rows = countAllUserPosts($_SESSION['user_id']);
		}

		$total_pages = ceil($total_rows / $num_of_posts_per_page);
		$limit=" LIMIT $offset, $num_of_posts_per_page";

	$posts = getAllPosts($limit);
?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/components/head.php';?>
	<title><?php echo  $_SESSION['role']?> | Posts</title>
</head>
<body>
	<?php include __DIR__ .'/components/navbar.php'; ?>
	<div class="container-fluid">
		<?php include __DIR__ .'/components/header-bar.php'?>
		<div class="row">
			<?php include __DIR__ .'/components/navigation-bar.php'?>
			<div class="col-md-9">
				<?php if(empty($posts)): ?>
					<div class="mx-auto my-4"><h4>There are no posts to display</h4></div>

						<?php else: ?>
							<table class="table table-striped table-condensed caption-top">
								<caption><h4 class="text-center">Posts</h4></caption>
								<thead>
									<tr class="lead">
										<th>S/No.</th>
										<th>Author</th>
										<th>Post Title</th>
										<th>Comments</th>
										<th>Edit</th>
										<!--Only Admin can publish/ unpublish  and delete posts  -->
										<?php if($_SESSION['role']=='Admin'): ?>
										<th>Published?</th>
										<th>Delete</th>
										<?php endif ?>
									</tr>
								</thead>
								<tbody>
									<?php foreach($posts as $key => $post):?>
									<tr>
										<td><?php echo $page_num==1 ? ($key + 1) : ($offset + $key + 1) ?></td>
										<td><?php echo $post['author'] ?></td>
										<td>
										<a href="../posts/<?php echo $post['post_slug'] ?>">
										<?php echo $post['post_title'] ?>
										</a>
										</td>
										<td class="text-center">
											<?php $getCommentsCount = new CommentsClassTest($pdo,'comments','post_id')?>
											<a href="admin-post-comments.php?view-comments=<?php echo $post['post_id'] ?>" data-bs-toggle="tooltip" title="Click to view post comments">
												<?php echo $getCommentsCount->countAllRecords(intval($post['post_id']))?>
											</a>
										</td>
										<td>
											<p  class="mx-auto">
											<a href="create_post.php?edit-post=<?php echo $post['post_id'] ?>" class="btn btn-warning btn-sm"><i class="bi-pencil"></i> Edit</a>
											</p>
										</td>
										<!--Only Admin can publish/ unpublish posts  -->
										<?php if($_SESSION['role']== 'Admin'): ?>
										<td class="text-center">
											<?php if($post['published'] == true): ?>
												<a href="posts.php?unpublish=<?php echo $post['post_id'] ?>" class="btn btn-success"><i class="bi-check-lg"></i></a>
											<?php else:?>
												<a href="posts.php?publish=<?php echo $post['post_id'] ?>" class="btn btn-danger"><i class="bi-x-lg"></i></a>
											<?php endif ?>
										</td>
										<td>
											<p>
											<a href="posts.php?delete-post=<?php echo $post['post_id'] ?>" class="btn btn-danger btn-sm delete"><i class="bi-trash"></i> Trash</a>
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
									<a class="page-link" <?php if($page_num>1) :?> href="posts.php?page-num=<?php echo $page_num-1 ?>" <?php endif?>>Previous</a>
								</li>
								<?php for($page=1; $page<= $total_pages; $page++) :?>

									<?php if($page==1):?>
										<li class="page-item <?php if($page==$page_num) echo 'active'?>" data-id="<?php echo $page?>">
											<a class="page-link" href="posts.php?page-num=<?php echo $page ?>"><?php echo $page ?></a>
										</li>
									<?php else :?>
										<li class="page-item <?php if($page==$page_num) echo 'active'?>" data-id="<?php echo $page?>">
											<a class="page-link" href="posts.php?page-num=<?php echo $page ?>"><?php echo $page ?> </a>
										</li>
									<?php endif?>

								<?php endfor?>
								<li class="page-item <?php if($page_num==$total_pages) echo 'disabled'?>">
									<a class="page-link" <?php if($page_num<$total_pages) :?> href="posts.php?page-num=<?php echo $page_num+1?>" <?php endif?>>Next</a>
								</li>

							<?php endif ?>
						</ul>
					</nav>
				</div>

			</div>
		</div>
	</div>
	<?php include __DIR__ .'/components/footer.php'?>
</body>
<script>
	$('document').ready(function(){
			$('.delete').on('click',function(){
				var isSure = confirm("STOP! Are you sure you want to delete this post? \r\r NOTE: If you choose 'Ok', all related comments and replies will also be deleted. ");
				if(isSure){
					return true;
				}else{
					return false;
				}
			});
	});
</script>
</html>