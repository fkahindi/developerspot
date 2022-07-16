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
	<div class="container mt-3">
		<div class="row mt-2">
			<div class="col-md-4">
				<h3  class="text-muted"><?php echo $_SESSION['fullname'] .' | '. $_SESSION['role']?> </h3>
			</div>
			<div class="col-md-8">
				<div class="text-success"><?php echo isset($_SESSION['message'])? $_SESSION['message']:''; ?></div> 
			</div>
		</div>
		<div class="row mt-2">
			<!--Row with 3 equal columns-->
			<div class="col-md-3 bg-light border">
				
				<?php include __DIR__ .'/components/navigation.php'?>
			</div>
			<div class="col-md-9">
				<!--Column right database output-->
				<div class="table-div">
					<table class="table table-striped table-condensed caption-top">
						<caption class="text-center"><h4>Admin | Subscribers</h4></caption>
						<thead>
							<tr>
								<th>SNo.</th><th>Name</th><th>Email</th><th>Date Created</th>
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
	</div>
</body>
<?php include __DIR__ .'/components/footer.php'?>
</html>