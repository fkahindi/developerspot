<ul>
	<li <?php echo (isset($thisPage) && ($thisPage=="HOME"))? 'class="current-page"':'' ?>><a href="<?php echo BASE_URL ?>index.php">HOME</a></li>
	<li <?php echo (isset($thisPage) && ($thisPage=="BLOG"))? 'class="current-page"':'' ?>><a href="<?php echo BASE_URL ?>blog.php"> BLOG</a></li>
	<li <?php echo (isset($thisPage) && ($thisPage=="ABOUT"))? 'class="current-page"':'' ?>><a href="<?php echo BASE_URL ?>about.php"> ABOUT</a></li>
	<li><a href="<?php echo BASE_URL ?>contact.php"> CONTACT</a></li>
</ul>