<?php
if(!isset($_SESSION)){
	session_start();
}
include __DIR__ . '/includes/admin_login_status.php';
if($_SESSION['role'] !== 'Admin'){
	header('Location: ../index.php');
}
?>
<?php
include __DIR__ .'/includes/admin_functions.php';
include __DIR__ .'/includes/posts_functions.php';

/* Get all subscribers in chanks of 20 */
$subscription = getSubscribers();
?>
<!DOCTYPE html>
<html lang="en">
<title>Admin | Subscriptions</title>
<?php include __DIR__ . '/components/head.php';?>
</head>
<body>
	<?php include __DIR__ .'/components/navbar.php'; ?>
	<div class="container-fluid">
		<?php include __DIR__ .'/components/header-bar.php'?>
		<div class="row">
			<?php include __DIR__ .'/components/navigation-bar.php'?>
			<div class="col-md-9">
				<!--Column right database output-->

					<table class="table table-striped table-condensed caption-top">
						<caption class="text-center"><h4>Admin | Subscribers</h4></caption>
						<thead>
							<tr class="lead">
								<th>SNo.</th>
								<th>Name</th>
								<th>Email</th>
								<th>Date Created</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($subscription as $key => $subscriber):?>
							<tr>
								<td><?php echo $key + 1 ?></td>
								<td><?php echo $subscriber['name'] ?></td>
								<td><?php echo $subscriber['email']  ?></td>
								<td><?php echo $subscriber['created_at']  ?></td>
							</tr>
							<?php endforeach ?>
						</tbody>
					</table>

			</div>
		</div>
	</div>
</body>
<?php include __DIR__ .'/components/footer.php'?>
</html>