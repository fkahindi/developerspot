<?php 
if(!isset($_SESSION)){
	session_start();
}
include __DIR__ . '/includes/admin_login_status.php';
	
if($_SESSION['role'] !== 'Admin'){
	header('Location: ../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">	
<?php include __DIR__ . '/components/head.php';?>
<title>Admin | Dashboard</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<?php include __DIR__ .'/components/navbar.php'; ?>
	<div class="container">
		<?php //include __DIR__ . '/components/menu.php';?>
		<div class="row text-center">
			<div class=" col-12 text-secondary my-4"><h3><?php echo $_SESSION['role']; ?> Dashboard</h3></div>
		</div>
		<div class="row justify-content-between">
			<div class="col-md-3 bg-light border">				
				<?php include __DIR__ .'/components/navigation.php'?>				
			</div>
			<div class="col-md-8">
				<div class="row justify-content-around">
					<div class="col-sm-6 col-xxl-4 text-center my-3">
						<div class="card" style="max-width:300px">
							<div class="card-header bg-dark text-light">Create Posts</div>
							<div><i class="bi-pencil-square text-muted display-3"></i></div>
							<div class="card-body">
								<h5 class="card-title">Create Posts</h5>
								<p class="card-text">Admins and authors can create new posts.</p>
								<a class="btn btn-success text-light" href="create_post.php">Create New Post</a>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-xxl-4 text-center my-3">
						<div class="card" style="max-width:300px">
							<div class="card-header bg-dark text-light">Create Topics</div>
							<div><i class="bi-pencil-square text-muted display-3"></i></div>
							<div class="card-body">
								<h5 class="card-title">Create Topics</h5>
								<p class="card-text">Admin can create new topics for posts.</p>
								<a class="btn btn-success text-light" href="create_topic.php">Create New Topic</a>
							</div>
						</div>
					</div>
				
				
					<div class="col-sm-6 col-xxl-4 text-center my-3">
						<div class="card" style="max-width:300px">
							<div class="card-header">Posts</div>
							<div><i class="bi-journal-text display-3"></i></div>
							<div class="card-body">
								<h5 class="card-title text-muted">Posts</h5>
								<p class="card-text">You can view posts, edit or if necessary delete them.</p>
								<a class="btn btn-warning" href="posts.php">Manage posts</a>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-xxl-4 text-center my-3">
						<div class="card" style="max-width:300px">
							<div class="card-header">Topics</div>
							<div><i class="bi-file-ruled display-3"></i></div>
							<div class="card-body">
								<h5 class="card-title text-muted">Topics</h5>
								<p class="card-text">View topics, edit and if necessary delete.</p>
								<a class="btn btn-warning" href="topics.php">Manage topics</a>
							</div>
						</div>
					</div>
				
					
			
					<div class="col-sm-6 col-xxl-4 text-center my-3">
						<div class="card" style="max-width:300px">
							<div class="card-header">Users</div>
							<div><i class="bi-people-fill display-3"></i></div>
							<div class="card-body">
								<h5 class="card-title text-muted">Users</h5>
								<p class="card-text">View current admins and authors, assign or change roles of users.</p>
								<a class="btn btn-info" href="users.php">Manage users</a>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-xxl-4 text-center my-3">
						<div class="card" style="max-width:300px">
							<div class="card-header">Subscribers</div>
							<div><i class="bi-envelope-check display-3"></i></div>
							<div class="card-body">
								<h5 class="card-title text-muted">Subscribers</h5>
								<p class="card-text">View site visitors subscribed to this website.</p>
								<a class="btn btn-info" href="subscribers.php">View subscribers</a>
							</div>
						</div>
					</div>
				</div>
			</div>			
		</div>
	</div>
	<?php include __DIR__ .'/components/footer.php'?>
</body>
<!-- For local only -->
<!-- <script src="js/jquery-3.4.0.min.js"></script> -->


<!-- <script src="js/tooltip-call.js"></script> -->
</html>