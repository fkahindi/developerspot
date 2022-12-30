<?php
if(!isset($_SESSION)){
	session_start();
}
include __DIR__ . '/includes/admin_login_status.php';

if($_SESSION['role'] !== 'Admin'){
	header('Location: ../index.php');
}
include __DIR__ .'/includes/admin_functions.php';
include __DIR__ .'/includes/posts_functions.php';
include __DIR__ .'/includes/errors.php';

/* Get all admin and author users */
$admins = getAdminUsers();
$roles = ['Admin', 'Author', 'User'];
?>
<!DOCTYPE html>
<html lang="en">
<title>Admin | Edit User</title>
<?php include __DIR__ . '/components/head.php';?>
</head>
<body>
	<?php include __DIR__ .'/components/navbar.php'; ?>
	<div class="container-fluid">
		<?php include __DIR__ .'/components/header-bar.php'?>
		<div class="row">
			<?php include __DIR__ .'/components/navigation-bar.php'?>
			<div class="col-md-9">
				<table class="table table-striped table-condensed caption-top">
					<caption><h4 class="text-center">Admins and Authors</h4></caption>
					<thead>
						<tr class="lead">
							<th>SNo.</th><th>User</th><th>Role</th><th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($admins as $key => $user):?>
						<tr class="align-items-center">
							<td><?php echo $key + 1 ?></td>
							<td><?php echo $user['username'] .' , '.$user['email'] ?></td>
							<td><?php echo $user['role'] ?></td>
							<td>
							<p>
							<a href="assign_roles.php?edit-user=<?php echo $user['user_id'] ?>" class="btn btn-warning btn-sm"><i class="bi-pencil"></i> Assign Role </a>
							</p>
							</td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<?php include __DIR__ .'/components/footer.php'?>
</body>
</html>