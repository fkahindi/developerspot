<?php  
	if(!isset($_SESSION)){
		session_start();
	}
	require_once __DIR__ . '/includes/admin_login_status.php';
	if($_SESSION['role']!== 'Admin' && $_SESSION['role']!== 'Author'){
		header('Location: ../index.php');
	}	
	include __DIR__ .'/includes/admin_functions.php';
	include __DIR__ .'/includes/posts_functions.php';
?>
<!DOCTYPE html>
<html lang="en">	
<?php include __DIR__ . '/components/head.php';?>
	<title><?php echo  $_SESSION['role'] ?> | Create Post</title>	
	<!--Fetch all posts that apply to the user  -->
	<?php $topics = getAllTopics(); ?>
</head>
<body>
	<?php include __DIR__ .'/components/navbar.php'; ?>
	<h3 class="text-center text-secondary my-3"><?php echo  $isEditingPost? 'Edit': 'Create' ?> Post</h3>
	<div class="container">		
		<div class="row my-5">
			<div class="text text-right text-success"><?php include __DIR__ .'/includes/messages.php'?></div>
			<!--Row with  columns-->
			<div class="col-md-3 bg-light border">
				<!--Column left Navigation-->
				<?php include __DIR__ .'/components/navigation.php'?>
			</div>
			<div class="col-md-9 px-5">
					<form class="needs-validation" method="post" enctype="multipart/form-data" novalidate>
						<div class="form-group">			
							<div class="text-danger"><?php echo $post_errors['db_error']?? ''?></div>
							<!--Id is required to identify the form -->
							<?php if($isEditingPost == true):?>
							<input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
							<?php endif ?> 
							<div class="form-group mb-3">
								<label class="form-label col-form-label" for="title"><b>Post Title:</b> <span class="text-danger">* <?php echo $post_errors['title']?? ''; ?></span></label>
								<input class="form-control" type="text" name="title" value="<?php echo $title; ?>" placeholder="Title" required>
								<div class="invalid-feedback">Title is required</div>
								
							</div>
							<div class="form-group mb-3">
								<label class="form-label col-form-label" for="post_main_image"><b>Image: </b> <span class="text-danger"><?php echo $image_error?? ''; ?></span></label>
								<input class="form-control" type="file" name="post_main_image" placeholder="Select image">
								<p><ul><li>Only images sizes of less than 0.5 Mb with formats .jpg, .png and .gif are allowed.</li></ul> </p>
							</div>
							<div class="form-group mb-3">
								<label class="form-label col-form-label" for="image_caption"><b>Image Caption:</b></label>
								<input class="form-control" type="text" name="image_caption" value="<?php echo $image_caption; ?>" placeholder="Type image caption">
							</div>
							<div class="form-group mb-3">
								<label class="form-label col-form-label" for="body"><b>Article Body:</b> <span class="text-danger">* <?php echo $post_errors['body']?? ''; ?></span></label>
								<textarea class="form-control" name="body" id="body" col="30" row="50" placeholder="Article body goes here..." required><?php echo $body; ?></textarea>
								<div class="invalid-feedback">Body text is required</div>
							</div>
							<div class="form-group mb-3">
								<label class="form-label col-form-label" for="meta_description"><b>Meta Description:</b></label>
								<input class="form-control" type="text" name="meta_description" value="<?php echo $meta_description; ?>" placeholder="Meta description">
							</div>
							<div class="form-group mb-3">
								<label class="form-label col-form-label" for="meta_keywords"><b>Meta Keywords:</b></label>
								<input class="form-control" type="text" name="meta_keywords" value="<?php echo $meta_keywords; ?>" placeholder="Meta keywords">
							</div>
							<div class="form-group mb-3">
								<label class="form-label col-form-label" for="topic_id"><b>Select topic</b> <span class="text-danger">* <?php echo $post_errors['topic']?? ''; ?></span></label>
								<select class="form-select" name="topic_id" required>
									<?php if($isEditingPost== true):?>
										<option value="<?php echo $topic_id; ?>" selected ><?php echo $topic_name;  ?></option>
									<?php else: ?>
										<option value="" selected ><?php echo 'Select topic'  ?></option>
									<?php endif ?>
									<?php foreach($topics as $topic):?>
										<option value="<?php echo $topic['topic_id']; ?>">
											<?php echo $topic['topic_name']; ?>
										</option>
									<?php endforeach ?>
								</select>
								<div class="invalid-feedback">Topic is required</div>
							</div>
							<!--Only Admin is supposed to publish posts -->
							<?php if($_SESSION['role']== 'Admin'):?>
							<!--Display checkbox for publishing/ unpublishing post  -->
								<?php if($published == true):?>
								<div class="form-group mb-3">
									<label class="form-check-label" for="publish">
										<b>Publish</b></label>
									<input class="form-check-input form-check-input-lg" type="checkbox" value="1" name="publish" checked="checked">&nbsp;
									
								</div>
								<?php else: ?>
								<div class="form-group mb-3">
									<label class="form-check-label" for="publish">
									<b>Publish</b></label>
									<input class="form-check-input form-check-input-lg" type="checkbox" value="0" name="publish">&nbsp;
									
								</div>
								<?php endif ?>
							<?php endif ?>							
							<!--If editing post, display the update button instead of create button -->
							<div>
								<?php if($isEditingPost === true): ?>
								<button type="submit" class="btn btn-success" name="update_post">UPDATE</button>
								<?php else: ?>
								<button type="submit" class="btn btn-success" name="create_post">Save post</button>
								<?php endif ?>
							</div>
						</div>
					</form>				
			</div>
		</div>
	</div>
	<?php include __DIR__ .'/components/footer.php'?>
	<script src="js/form-validation.js"></script>
</body>
</html>

