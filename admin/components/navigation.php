<div class="btn-group-justify" id="mynav">

    <div class="col-*">
      <a class="btn text-dark" href="dashboard.php">
        <i class="bi-speedometer display-6"> </i>
        <span class="lead text-secondary"> Dashboard</span>
      </a>
    </div>

  <div class="col-*">
    <a class="btn text-dark" href="posts.php">
      <i class="bi-journal-text display-6"> </i>
      <span class="lead text-secondary"> Posts</span>
    </a>
  </div>
  <?php if($_SESSION['role']== 'Admin'):?>
    <div class="col-*">
      <a class="btn text-dark" href="topics.php">
        <i class="bi-file-richtext display-6"> </i>
        <span class="lead text-secondary"> Topics</span>
      </a>
    </div>
    <div class="col-*">
      <a class="btn text-dark" href="users.php">
        <i class="bi-people display-6 "> </i>
        <span class="lead text-secondary"> Users</span>
      </a>
    </div>
    <div class="col-*">
      <a class="btn text-dark" href="subscribers.php">
        <i class="bi-envelope display-6"> </i>
        <span class="lead text-secondary"> Subscribers</span>
      </a>
    </div>
  <?php endif ?>
</div>
