<?php
if(isset($_POST)){
  include_once __DIR__.'/process_form.php';

  $fbUser = array();
  $fbUser['uid']  = $_POST['id'];
  $fbUser['first_name'] = $_POST['first_name'];
  $fbUser['fullname'] = $_POST['name'];
  $fbUser['email'] = $_POST['email'];
  $fbUser['profile_photo'] = $_POST['picture']['data']['url'];
  $fbUser['oauth_provider'] = 'facebook';

  fbLogin($fbUser);
}else{
  echo 'No data received';
}
