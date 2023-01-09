<?php
if (!isset($_SESSION)) {
	session_start();

}
header("Referrer-Policy: no-referrer-when-downgrade");//localhost testing
header("Access-Control-Allow-Origin: same-origin-allow-popups");
header("Access-Control-Allow-Origin: https://localhost/");
header("Access-Control-Allow-Headers: HASH, Content-Type");
header("Access-Control-Allow-Methods: POST");
header("Content-Security-Policy-Report-Only: default-src 'none';form-action 'self'; style-src 'self' 'unsafe-inline' https://connect.facebook.net/; img-src 'self'; font-src 'self'; script-src 'self' 'unsafe-eval' 'unsafe-inline'  https://connect.facebook.net/; frame-ancestors 'self' https://web.facebook.com/;frame-src https://web.facebook.com/  https://www.facebook.com/;  connect-src 'self'  https://z-p3-graph.facebook.com/ https://graph.facebook.com https://web.facebook.com/ https://www.facebook.com/; ");
header("Set-Cookie: cross-site-cookie=whatever; SameSite=None; Secure");

$uri = $_SERVER['REQUEST_URI'];

$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

include_once __DIR__ . '/../includes/process_form.php';

if($url == BASE_URL.'login'){
  $thisPage='signin';
}elseif($url == BASE_URL.'create-account'){
  $thisPage='signup';
}else{
  header('Location: errors/404.html');
}

if (isset($_POST['login'])) {
	login();
}
if(isset($_POST['create-account'])){
	createAccount();
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Francis Kahindi" />
    <meta http-equiv="Content-Security-Policy" content="" />
    <link rel="canonical" href="https://www.developerspot.co.ke/<?php echo $thisPage?? '' ?>">
    <title><?php echo $thisPage?? '' ?></title>
    <meta name="description" content="Use email and password to login to developerspot system.">
    <meta name="keywords" content="login, email address, password, developerspot">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>resources/css/form.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>resources/font-awesome-4.7.0/css/font-awesome.css" />
    <link rel="icon" href="<?php echo BASE_URL ?>resources/icons/logoicon.png" sizes="16x16 32x32" type="image/x-icon" />
    <script src="<?php echo BASE_URL ?>resources/js/jquery-3.4.0.min.js"></script>
    <!-- online -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->

  </head>
  <body>
    <div id="sign-option">
       <div class="banner-bar">
        <h2><?php include __DIR__ . '/../resources/banner/devpot-banner.php'; ?></h2>
      </div>

      <div class="sign-options-btns">
        <a href="<?php echo BASE_URL ?>login">
        <button <?php echo (isset($thisPage) && $thisPage === "signin")? 'class="current-button"':''?> >  Sign in</button></a><a href="<?php echo BASE_URL ?>create-account"><button <?php echo (isset($thisPage) && $thisPage === "signup")? 'class="current-button"':''?> > Free Sign Up</button></a>
      </div>

      <?php if($thisPage === 'signin'): ?>
        <div>
          <h5 class="successMsg"><?php echo (!empty($_SESSION['success_msg']) ? $_SESSION['success_msg'] : ''); ?></h5>
          <h5 class="errorMsg"><?php echo (isset($form_error) ? $form_error : ''); ?></h5>
        </div>
        <?php //include __DIR__ .'/../includes/google-login.php';?>

       <!-- Google client -->
        <!-- <script src="https://accounts.google.com/gsi/client" async defer></script> -->

        <!-- Facebook login button-->
        <div class="oauth-login-btn">
          <button id="login-button" class="fb btn"><i class="fa fa-facebook"></i> Login with Facebook</button>
        </div>
        <!-- Google login button -->
        <div class="oauth-login-btn">
          <!-- <div id="g_id_onload"
              data-client_id="1007627739117-mmn92vm3mqjimnbap1pmm2r32fq50fe4.apps.googleusercontent.com"
              data-context="signin"
              data-ux_mode="popup"
              data-login_uri="https://localhost/spexproject/login"
              data-auto_prompt="false">
          </div>

          <div class="g_id_signin"
              data-type="standard"
              data-shape="rectangular"
              data-theme="outline"
              data-text="signin_with"
              data-size="large"
              data-logo_alignment="left">
          </div> -->
        </div>
        <form method="POST" action="">
          <fieldset>
            <legend>Or Use Email</legend>

            <div class="group-form">
              <label for="email">Email address:</label>
              <input type="email" name="email" value="<?php echo (!empty($email) ? $email : ''); ?>" placeholder="Enter email address..." autocomplete="off">
              <span class="errorMsg"><?php echo (!empty($errors['email']) ? $errors['email'] : ''); ?></span>
            </div>
            <div class="group-form">
              <label for="password">Password: <span class="right-align"> </span></label>
              <input type="password" name="password" placeholder="Enter password..." autocomplete="off" id="password_1" data-id="1">
              <i class="fa fa-eye" id="toggle_view1" data-id="1"></i>
              <span class="errorMsg"><?php echo (!empty($errors['password']) ? $errors['password'] : ''); ?></span>
            </div>
            <input type="submit" name="login" class="button" value="Sign in">
          </fieldset>
        </form>
        <div class="section">
          <p class="centered"> <a href="<?php echo BASE_URL ?>recover-password">Forgot password</a> </p>
        </div>
         <!-- Scripts for login -->
        <script src="<?php echo BASE_URL ?>resources/js/show-hide-password.js"></script>
        <script src="<?php echo BASE_URL ?>resources/js/facebook-oauth.min.js"></script>
      <?php endif ?>

      <?php if($thisPage === 'signup'): ?>
        <!-- Singup form  html -->
        <div>
          <h5 class="errorMsg"><?php echo (isset($form_error) ? $form_error : ''); ?></h5>
          <p>Fields marked with <span class="red"> &#42;</span> are mandatory. </p>
        </div>

        <form  method="POST" action="" id="signup_form" >
          <div class="group-form">
            <label for="username">Username:<span class="red"> &#42;</span></label>
            <input  name="username" id="username" class="form-control" type="text"
            value="<?php echo (empty($username)? '': $username); ?>" maxlength="50" placeholder="Create username..." autocomplete="off" >
            <span class="errorMsg"> <?php echo(!empty($errors['username']) ? $errors['username'] : ''); ?></span>
          </div>
          <div class="group-form">
            <label for="email"> Email:<span class="red"> &#42;</span></label>
            <input name="email" id="email" class="form-control" type="email" value="<?php echo(empty($email)? '': $email); ?>" maxlength="50" placeholder="Enter email address..." autocomplete="off" >
            <span class="errorMsg"> <?php echo(!empty($errors['email']) ? $errors['email'] : ''); ?> </span>
          </div>
          <div class="group-form">
            <label for="privacy">
            <input type="checkbox" name="privacy" value="privacy" id="privacy-checkbox"><span class="red"> &#42;</span> Yes, I have read and agree with the <a target="blank" href="<?php echo BASE_URL ?>policies/privacy-policy.php">privacy policy</a></label>
            <span class="errorMsg"> <?php echo(!empty($errors['privacy']) ? $errors['privacy'] : ''); ?> </span>
          </div>
          <input name="create-account" type="submit" id="submit_btn" class="button" value="Create Account">
        </form>
        <div class="section">
          <p class="centered">Already have an account? <a href="<?php echo BASE_URL ?>login">Sign in </a>.</p>
        </div>
        <!-- Scripts for sign up -->
        <script src="<?php echo BASE_URL ?>resources/js/form_check.min.js"></script>
      <?php endif ?>
    </div>

  </body>
</html>

