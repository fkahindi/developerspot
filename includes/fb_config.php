<?php
if(!isset($_SESSION)){
  session_start();
}

//include_once __DIR__ .'/process_form.php';
//initialize facebook sdk
require_once __DIR__ .'/../vendor/autoload.php';

$fb = new \Facebook\Facebook([
  'app_id' => 'APP_ID',
  'app_secret' => 'APP_SECRET',
  'default_graph_version' => 'v2.10',
]);


$helper = $fb->getRedirectLoginHelper();

try {
  $accessToken = $helper->getAccessToken();

} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  //exit;
}


try {
  if (isset($_SESSION['facebook_access_token'])) {
    $accessToken = $_SESSION['facebook_access_token'];
  } else {
    $accessToken = $helper->getAccessToken();
  }
} catch(Facebook\Exceptions\facebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
 //exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  //exit;
}

if (isset($accessToken)) {

  if (isset($_SESSION['facebook_access_token'])) {
    $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
  } else {
    // getting short-lived access token
    $_SESSION['facebook_access_token'] = (string) $accessToken;

    // OAuth 2.0 client handler
    $oAuth2Client = $fb->getOAuth2Client();

    // Exchanges a short-lived access token for a long-lived one
    $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);

    $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;

    // setting default access token to be used in script
    $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
  }
    // redirect the user to the profile page if it has "code" GET variable
  if (isset($_GET['code']) && isset($_SESSION['facebook_access_token']) ) {
    header('Location: https://localhost/spexproject/index.php');
    //online
    //header('Location: https://www.developerspot.co.ke/index.php');

  }
    // getting basic info about user
  try {
    $graphResponse = $fb->get('/me?fields=name,email');
    $fbUser = $graphResponse->getGraphUser();

    // Getting user's profile data
    $fbUserData = array();
    $fbUserData['uid']  = !empty($fbUser['id'])?$fbUser['id']:'';
    $fbUserData['username'] = !empty($fbUser['name'])?$fbUser['first_name']:'';
    $fbUserData['fullname'] = !empty($fbUser['name'])?$fbUser['name']:'';
    $fbUserData['email']      = !empty($fbUser['email'])?$fbUser['email']:'';
    $fbUserData['profile_photo']    = !empty($fbUser['picture']['data']['url'])?$fbUser['picture']['data']['url']:'';
    $fbUserData['oauth_provider'] = 'facebook';

    fbLogin($fbUserData);

  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    session_destroy();
    // redirecting user back to app login page
    header("Location: ./");
    exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }
}else{
  $fb_permissions = ['email'];
  $facebook_login_url = $helper->getLoginUrl('https://localhost/spexproject/login',$fb_permissions);
  //online
  //$facebook_login_url = $helper->getLoginUrl('https://www.developerspot.co.ke/login',$fb_permissions);

  $facebook_login_url='<a href="'.$facebook_login_url.'"><button class="fb btn"><i class="fa fa-facebook"></i> Login with Facebook</button> </a>';

}