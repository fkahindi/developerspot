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
  <div class="container-fluid">
    <?php include __DIR__ .'/components/header-bar.php'?>
    <div class="row">
      <?php include __DIR__ .'/components/navigation-bar.php'?>
      <div class="col-md-9 px-5">
        <div class="col-md-12 mt-3">
        <h5 class="text-center text-muted"><?php echo  $isEditingUser? 'Re-assign Role to User': 'Add User to Admins & Authors' ?>  </h5>
      </div>
        <form method="post">
          <div class="form-group">
            <!-- Validate form -->
            <?php if(isset($user_errors['user'])):?>
							<div class="alert alert-danger alert-dismissible d-flex align-items-center fade show">
								<i class="bi-exclamation-octagon-fill"></i>
								<?php echo $user_errors['user']?>
							</div>
							<?php endif?>
            <!-- Attach a hidden id for user being edited-->
            <?php if($isEditingUser || $isSearchUser): ?>
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
            <select class="form-select" type="select" name="role" >
                <option selected disabled><?php echo $isEditingUser? '{ '.$user_role.' }' : 'Assign role'?> </option>
                <?php foreach($roles as $key=>$role):?>
                <option value="<?php echo $role; ?>"><?php echo $role; ?></option>
                <?php endforeach ?>
              </select></div>
            <div class="d-flex justify-content-around">
              <?php if(!$isEditingUser): ?>
               <button type="submit" class="btn btn-success mt-2" name="search_user">SEARCH</button>
              <?php endif ?>
               <button type="submit" class="btn btn-warning mt-2" name="update_user">UPDATE</button>
            </div>
          </div>
          </form>
      </div>
    </div>
  </div>
  <?php include __DIR__ .'/components/footer.php'?>
</body>