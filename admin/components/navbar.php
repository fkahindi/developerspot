<?php require_once __DIR__ .'/../../config.php'; ?>
<nav class="navbar navbar-expand-md navbar-dark bg-dark" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header navbar-left">
			<button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
		</div>
		<div class="collapse navbar-collapse" id="navbarCollapse">
			<div class="navbar-nav">
				<a  class="nav-item nav-link" href="<?php echo BASE_URL ?>index.php">Home</a>
				<a  class="nav-item nav-link" href="<?php echo BASE_URL ?>admin/dashboard.php">Dashboard</a>
				<a class="nav-item nav-link" href="<?php echo BASE_URL ?>includes/logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a>
			</div>
			<div class="nav navbar-nav navbar-right">
				<span><?php echo $_SESSION['username']?></span><br>
			</div>
		</div>
	</div>
</nav>