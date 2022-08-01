<?php
	if(!isset($_SESSION)){
		session_start();
	}
	include __DIR__ . '/includes/admin_login_status.php';
	if($_SESSION['role']!== 'Admin' && $_SESSION['role']!== 'Author'){
		header('Location: ../index.php');
	}

	include __DIR__ .'/includes/admin_functions.php';
	include __DIR__ .'/includes/posts_functions.php';

?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<?php include __DIR__ . '/components/head.php';?>
	<title><?php echo  $_SESSION['role'] ?> | Create Topic</title>
	<!--Fetch all posts that apply to the user  -->
	<?php $topics = getAllTopics(); ?>
  </head>
  <body>
    <?php include __DIR__ .'/components/navbar.php'; ?>

    <div class="container-fluid">
      <?php include __DIR__ .'/components/header-bar.php'?>
      <div class="row">
        <?php include __DIR__ .'/components/navigation-bar.php'?>
        <div class="col-md-9 px-5">
          <div class="col-md-12 mt-3">
            <h5 class="text-center text-muted"><?php echo $isEditingTopic? 'Edit':'Create'?> Topic</h5>
          </div>
          <form class="needs-validation" method="post" novalidate>
            <div class="form-group">
              <!-- Validate errors on form-->
              <?php if(isset($topic_errors['db_error'])):?>
							<div class="alert alert-danger alert-dismissible d-flex align-items-center fade show">
								<i class="bi-exclamation-octagon-fill"></i>
								<?php echo $topic_errors['db_error']?>
							</div>
							<?php endif?>
              <!--Id is required to identify the form -->
              <?php if($isEditingTopic === true):?>
              <input type="hidden" name="topic_id" value="<?php echo $_GET['edit-topic']; ?>">
              <?php endif ?>
              <div class="form-group mb-3">
                <label class="form-label col-form-label" for="topic_name"><b>Topic: </b> <span class="text-danger"> * <?php echo $topic_errors['topic']?? '' ?></span></label>
                <input class="form-control" type="text" name="topic_name" value="<?php echo $topic_name; ?>" placeholder="Topic" required>
                <div class="invalid-feedback">Topic is required</div>
              </div>
              <div class="form-group mb-3">
                <label class="form-label col-form-label" for="topic_intro"><b>Topic Introduction:</b></label>
                <textarea name="topic_intro" col="30" row="50" class="form-control" placeholder="Insert introductory paragraph here..."><?php echo $topic_intro; ?></textarea>
              </div>
              <div class="form-group mb-3">
                <label class="form-label col-form-label" for="topic_description"><b>Meta Description:</b></label>
                <input class="form-control" type="text" name="topic_description" value="<?php echo $topic_description; ?>" placeholder="Topic">
              </div>
              <div class="form-group mb-3">
                <label class="form-label col-form-label" for="topic_keywords"><b>Meta Keywords:</b></label>
                <input class="form-control" type="text" name="topic_keywords" value="<?php echo $topic_keywords; ?>" placeholder="Topic">
              </div>
              <!--If editing topic, display the update button instead of create button -->
              <div class="mb-3">
                <?php if($isEditingTopic === true): ?>
                <button type="submit" class="btn btn-md btn-warning" name="update_topic">UPDATE</button>
                <?php else: ?>
                <button type="submit" class="btn btn-md btn-success" name="create_topic">Save post</button>
                <?php endif ?>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php include __DIR__ .'/components/footer.php'?>
    <script src="../js/form-validation.js"></script>
  </body>
</html>