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

	$topics = getAllTopics();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<?php include __DIR__ . '/components/head.php';?>
	<title><?php echo  $_SESSION['role'] ?> | Topics</title>
</head>
<body>
	<?php include __DIR__ .'/components/navbar.php'; ?>
	<div class="container-fluid">
		<?php include __DIR__ .'/components/header-bar.php'?>
		<div class="row">
			<?php include __DIR__ .'/components/navigation-bar.php'?>
			<div class="col-md-9">
				<?php if(empty($topics)): ?>
				<div class="mx-auto my-4"><h4>There no topics in database</h4></div>
				<!--Column right database output-->
				<?php else: ?>
					<table class="table table-striped table-condensed caption-top">
						<caption><h4 class="text-center">Topics</h4></caption>
						<thead>
							<tr class="lead">
								<th>SNo.</th>
								<th>Topic</th>
								<th>Edit</th>
								<th>Delete</th>
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
	<script>
		$('document').ready(function(){
			$('.delete').on('click',function(){
				var isSure = confirm("STOP! Are you sure you want to delete this topic? ");
				if(isSure){
					return true;
				}else{
					return false;
				}
			});
		});
	</script>
</body>
</html>