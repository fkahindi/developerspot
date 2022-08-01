<div class="row bg-light py-4 shadow-sm sticky-top">
  <div class="col-md-4">
    <h6 class="text-dark"><?php echo $_SESSION['role'] .' | '. $_SESSION['fullname'] ?> </h6>
  </div>
  <div class="col-md-8">
    <div class="row">
      <div class="col-md-9">
        <div><?php include __DIR__ .'/../includes/messages.php'?></div>
      <div><?php include __DIR__ .'/../includes/errors.php';?></div>
      </div>
      <div class="col-md-3 text-end">
        <a class="navbar-brand text-body devpot-banner" href="<?php echo BASE_URL ?>index.php" data-bs-toggle="tooltip"  title="Click to move to home page">
          <img src="<?php echo BASE_URL ?>resources/icons/logoicon.png" width="24" alt="devpot logo">
          <span class="banana-yellow">Dev</span><span class="olive">elopers</span><span class="autum-orange">P</span><span class="deep-red">o</span><span class="khaki">t</span>
        </a>
      </div>
    </div>
  </div>
</div>