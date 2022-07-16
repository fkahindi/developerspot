<div class="btn-group-justify">
  <div class="col-* mt-3"><a class="btn btn-info" href="dashboard.php">Dashboard</a></div>  
  <div class="col-* mt-3"><a class="btn btn-info" href="posts.php">Posts</a></div>
  <?php if($_SESSION['role']== 'Admin'):?>
    <div class="col-* mt-3"><a class="btn btn-info" href="users.php">Users</a></div>
    <div class="col-* mt-3"><a class="btn btn-info" href="subscribers.php">Subscribers</a></div>
    <div class="col-* mt-3 mb-3"><a class="btn btn-info" href="topics.php">Topics</a></div>
  <?php endif ?>
</div>
