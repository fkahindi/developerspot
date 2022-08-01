<?php
if(!isset($_SESSION)){
	session_start();
}
include __DIR__ . '/includes/admin_login_status.php';

if($_SESSION['role'] !== 'Admin' && $_SESSION['role'] !== 'Author'){
	header('Location: ../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/components/head.php';?>
<title>Admin | Dashboard</title>
</head>
<body>
	<?php include __DIR__ .'/components/navbar.php'; ?>
	<div class="container-fluid">
		<?php include __DIR__ .'/components/header-bar.php'?>
		<div class="row justify-content-between">
			<?php include __DIR__ .'/components/navigation-bar.php'?>
			<div class="col-md-8">
				<div class="row justify-content-around">
					<div class="col-sm-6 col-xxl-4 text-center my-3">
						<div class="card" style="max-width:300px">
							<div class="card-header">Write New Posts</div>
							<div><i class="bi-pencil-square text-muted display-3"></i></div>
							<div class="card-body">
								<h5 class="card-title">Write Posts</h5>
								<p class="card-text">Admins and authors can write new posts.</p>
								<a class="btn btn-success text-light" href="create_post.php">Write New Post</a>
							</div>
						</div>
					</div>

					<?php if($_SESSION['role']== 'Admin'):?>
						<div class="col-sm-6 col-xxl-4 text-center my-3">
							<div class="card" style="max-width:300px">
								<div class="card-header">Create New Topics</div>
								<div><i class="bi-pen-fill text-muted display-3"></i></div>
								<div class="card-body">
									<h5 class="card-title">Create Topics</h5>
									<p class="card-text">Admin only can create new topics for posts.</p>
									<a class="btn btn-success text-light" href="create_topic.php">Create New Topic</a>
								</div>
							</div>
						</div>

						<div class="col-sm-6 col-xxl-4 text-center my-3">
							<div class="card" style="max-width:300px">
								<div class="card-header">Assign User Roles</div>
								<div><i class="bi-person-check display-3"></i></div>
								<div class="card-body">
									<h5 class="card-title text-muted">User Roles</h5>
									<p class="card-text">Search, Edit Authors and Admins roles.</p>
									<a class="btn btn-danger" href="assign_roles.php">Assign User Roles</a>
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
									<a class="btn btn-warning" href="posts.php">Manage Posts</a>
								</div>
							</div>
						</div>

						<div class="col-sm-6 col-xxl-4 text-center my-3">
							<div class="card" style="max-width:300px">
								<div class="card-header">Topics</div>
								<div><i class="bi-file-richtext display-3"></i></div>
								<div class="card-body">
									<h5 class="card-title text-muted">Topics</h5>
									<p class="card-text">View topics, edit and if necessary delete.</p>
									<a class="btn btn-warning" href="topics.php">Manage Topics</a>
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
									<a class="btn btn-info" href="users.php">Manage Users</a>
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
									<a class="btn btn-info" href="subscribers.php">View Subscribers</a>
								</div>
							</div>
						</div>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>
	<?php include __DIR__ .'/components/footer.php'?>
</body>
</html>