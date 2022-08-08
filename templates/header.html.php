<!-- Banner bar follows-->
<div class="banner-bar flex-wrapper">
	<a href="<?php echo BASE_URL ?>index.php" class="banner"><?php include __DIR__ .'/../resources/banner/devpot-banner.php';?></a>
</div>
<!--Navigation bar follows-->
<div class="nav-bar flex-wrapper">
	<div id="dropdown-menu-btn">&#9776;</div>
	<div id="closebtn">&times;</div>
	<nav class="nav-content">
	<?php require_once __DIR__ .'/nav.html.php'; ?>
	</nav>
</div>
	<!--Login bar follows -->
<div class="log-account-section">
	<div class="flex-wrapper">
		<div class="login-signup">
			<?php echo (!isset($_SESSION['loggedin']) || $_SESSION['loggedin']=== false)?
			'<a class="login" href="'.BASE_URL .'login">Login </a>&nbsp;'
			: '' ?>
			<?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true):?>
			<div class="flex-container">
				<div class="account-photo-box tooltip ">
					<span> <img src="<?php echo $_SESSION['profile_photo'] ?>" alt="" width="30px" height="30px" data-pin-nopin="1" class="image-photo"></span></label>
					<div class="tooltip-text">
						<p><strong>Account:</strong></p>
						<p><?php echo $_SESSION['fullname'] ?></p>
						<p><?php echo $_SESSION['email'] ?></p>
					</div>
				</div>
				<div class="settings">
					<label for="profile-checkbox-control" id="tooltip">
					<span class="settings-char-icon" title="Account settings"> &#133;</span>
					<input type="checkbox" id="profile-checkbox-control">
					<div class="account-display-settings">
						<ul>
							<li><a href="<?php echo BASE_URL ?>includes/logout.php">Sign out </a></li>
							<li><a href="<?php echo BASE_URL ?>imageupload">Add Profile Photo</a></li>
							<li><a href="<?php echo BASE_URL ?>change-password">Change Password </a></li>
							<?php if($_SESSION['role'] == 'Admin'):?>
								<li><a href="<?php echo BASE_URL ?>admin/dashboard.php">Admin Area </a></li>
							<?php elseif($_SESSION['role'] == 'Author'): ?>
								<li><a href="<?php echo BASE_URL ?>admin/dashboard.php">Admin Posts </a></li>
							<?php endif; ?>
						</ul>
					</div>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>