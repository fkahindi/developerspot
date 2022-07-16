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
	include __DIR__ .'/../comments/includes/comments_functions.php';
?>
<!DOCTYPE html>
<html lang="en">	
<?php include __DIR__ . '/components/head.php';?>
	<title><?php echo  $_SESSION['role']?> | Posts</title>
	
	<!--Fetch all posts that apply to the user  -->
	<?php $posts = getAllPosts(); ?>
</head>
<body>
	<?php include __DIR__ .'/components/navbar.php'; ?>
	<div class="container mt-3">
		<div class="row mt-2">
			<div class="col-md-4">
				<h3 class="text-muted"><?php echo $_SESSION['fullname'] .' | '. $_SESSION['role']?> </h3>
			</div>
			<div class="col-md-8">
				<div class="text-success"><?php include __DIR__ .'/includes/messages.php'?></div>
				<div class="text-danger"><?php include __DIR__ .'/includes/errors.php';?></div>
			</div>	
		</div>
		<div class="row mt-2">		
			<div class="col-md-3 bg-light border">
				<?php include __DIR__ .'/components/navigation.php'?>
			</div>
			<div class="col-md-9">
				<?php if(empty($posts)): ?>
				<div class="mx-auto my-4"><h4>There are no posts to display</h4></div>
					<!--Column right database output-->
				<?php else: ?>	
						<table class="table table-sm table-striped caption-top">
							<caption><h3 class="text-center">Posts</h3></caption>
							<thead>
								<tr class="bg-dark text-light">
									<th>SNo.</th>
									<th>Author</th>
									<th>Title</th>
									<th>Comments</th>
									<!--Only Admin can publish/ unpublish posts  -->
									<?php if($_SESSION['role']=='Admin'): ?>
									<th>Un/Publish</th>
									<?php endif ?>
									<th>Edit</th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($posts as $key => $post):?>
								<tr>
									<td><?php echo $post['post_id'] ?></td>
									<td><?php echo $post['author'] ?></td>
									<td>
									<a href="../posts/<?php echo $post['post_slug'] ?>">
									<?php echo $post['post_title'] ?>
									</a>
									</td>
									<td><?php
										$getComments = new CommentsClass($pdo);
										echo $getComments->getCommentCountByPostId($post['post_id']);
									?>
									</td>		
									<!--Only Admin can publish/ unpublish posts  -->
									<?php if($_SESSION['role']== 'Admin'): ?>
									<td>
										<?php if($post['published'] == true): ?>  
											<a href="posts.php?unpublish=<?php echo $post['post_id'] ?>" class="btn btn-success"><i class="bi-eye"></i></a>
										<?php else:?>
											<a href="posts.php?publish=<?php echo $post['post_id'] ?>" class="btn btn-danger"><i class="bi-eye-slash"></i></a>
										<?php endif ?>
									</td>
									<?php endif ?>
									<td>
										<p  class="mx-auto">
										<a href="create_post.php?edit-post=<?php echo $post['post_id'] ?>" class="btn btn-warning btn-sm"><i class="bi-pencil"></i> Edit</a>
										</p>
									</td>
									<td>
										<p>
										<a href="posts.php?delete-post=<?php echo $post['post_id'] ?>" class="btn btn-danger btn-sm delete"><i class="bi-trash"></i> Trash</a>
										</p>
									</td>
								</tr>
								<?php endforeach ?>
							</tbody>
						</table>
				<?php endif ?>
			</div>
		</div>
	</div>	
	<?php include __DIR__ .'/components/footer.php'?>
</body>
<script src="js/jquery-3.4.0.min.js"></script> 
<script>
	$('document').ready(function(){
		$('.delete').on('click',function(){
			var isSure = confirm("Are you sure you want to delete post? \rAll related comments and replies will also be deleted.");
			if(isSure){
				return true;
			}else{
				return false;
			}
		});
	});
</script>
</html>