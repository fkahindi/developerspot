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
	<title><?php echo  $_SESSION['role'] ?> | Topics</title>
			
	<!--Fetch all posts that apply to the user  -->
	<?php $topics = getAllTopics(); ?>
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
			<!--Row with 3 equal columns-->
			<div class="col-md-3 bg-light border">				
				<?php include __DIR__ .'/components/navigation.php'?>
			</div>
			<div class="col-md-9">
				<?php if(empty($topics)): ?>
				<div class="mx-auto my-4"><h4>There no topics in database</h4></div>
				<!--Column right database output-->
				<?php else: ?>	
					<table class="table table-striped table-condensed caption-top">
						<caption><h3 class="text-center">Topics</h3></caption>
						<thead>
							<tr class="bg-dark text-light text-uppercase">
								<th>SNo.</th>
								<th>Topic</th>
								<th colspan="2" class="text-center">Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($topics as $key => $topic):?>
							<tr>
								<td class="text-center"><?php echo $key + 1 ?></td>
								<td><?php echo $topic['topic_name'] ?></td>
										
								<td>
									<p>
									<a href="create_topic.php?edit-topic=<?php echo $topic['topic_id'] ?>" class="btn btn-warning"><span class="bi-pencil"></span> Edit</a>
									</p>
								</td>
								<td>
									<p>
									<a href="topics.php?delete-topic=<?php echo $topic['topic_id'] ?>" id="delete-<?php echo $key + 1 ?>" class="btn btn-danger delete"><span class="bi-trash"></span> Trash</a>
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
	<script src="js/jquery-3.4.0.min.js"></script>
	<script>
				
$('document').ready(function(){
	$('.delete').on('click',function(){
		var isSure = confirm("Are you sure you want to delete post?");
		if(isSure){
			return true;
		}else{
			return false;
		}
	});
});
</script>
</body>
<!-- For local only -->
<!-- <script src="js/jquery-3.4.0.min.js"></script> 
<script src="js/bootstrap.min.js"></script>

<script src="js/tooltip-call.js"></script> -->

</html>