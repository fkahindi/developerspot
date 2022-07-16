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
	<div class="container mt-3">
		<div class="row mt-2">
			<div class="col-md-4">
				<h3 class="text-muted">Admin | <?php echo $_SESSION['fullname']?></h3>
			</div>
			<div class="col-md-8">
				<div class="text-success"><?php echo isset($_SESSION['message'])? $_SESSION['message']:''; ?></div> 
				<div class="text-danger"><?php include __DIR__ .'/includes/errors.php'; ?></div>
			</div>
		</div>		
		<div class="row mt-2">
			<!--Row with 3 equal columns-->
			<div class="col-md-3 bg-light border">				
				<?php include __DIR__ .'/components/navigation.php'?>
			</div>
			<div class="col-md-9">
				<div class="row">
					<div class="col-* mb-3 px-md-5 py-5">
						<h4 class="text-muted">Search users</h4>
						<form method="post" action="users.php">					
						<!-- Attach a hidden id for user being edited-->
						<?php if($isEditingUser === true || $isSearchUser === true): ?>
						<input type="hidden" value="<?php echo $user_id;?>" name="user_id">
						<?php endif ?>
																
						<div class="form-group mb-3">
						<label class="form-label col-form-label" for="username"><b>Username:</b></label>
						<input class="form-control" type="text" value="<?php echo $username; ?>" name="username" placeholder="Username" id="username"></div>
						<div class="form-group mb-3">
						<label class="form-label col-form-label" for="email"><b>Email address:</b></label>
						<input class="form-control" type="email" value="<?php echo $email; ?>" name="email" placeholder="Email" id="email"></div>
						<div class="form-group mb-3">
						<label class="form-label col-form-label" for="role"><b>User role:</b></label>
						<select class="form-select" type="select" name="role" placeholder="Assign role">
								<option value="" selected disabled>Assign role</option>						
								<?php foreach($roles as $key=>$role):?>
								<option value="<?php echo $role; ?>"><?php echo $role; ?></option>
								<?php endforeach ?>
							</select></div>
						<div class="d-flex justify-content-around">
								<button type="submit" class="btn btn-success mt-2" name="update_user">UPDATE</button>
								<button type="submit" class="btn btn-success mt-2" name="search_user">SEARCH</button>
						</div>		
						</form>
					
					</div>
					<div class="col-* border">
						<h4 class="text-center text-muted my-3">Current Admins | Authors</h4>
															
						<table class="table table-sm table-striped">						
							<thead class="table-dark">
								<tr>
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
									<a href="users.php?edit-user=<?php echo $user['user_id'] ?>" class="btn btn-warning btn-sm"><i class="bi-pencil"></i> Edit </a>
									</p>
									</td>								
								</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
		</div>
	</div>
	<?php include __DIR__ .'/components/footer.php'?>
</body>
<!-- For local only -->
<!-- script src="js/jquery-3.4.0.min.js"></script> 
<script src="js/bootstrap.min.js"></script>

<script src="js/tooltip-call.js"></script> -->
</html>