<?php
if(!isset($_SESSION)){
  session_start();
}
//include necessary the files
require_once __DIR__ .'/../vendor/autoload.php';
include_once __DIR__.'/process_form.php';

$headers = getallheaders();
// Get $id_token via HTTPS POST.
if(isset($_POST)){

	$id_token = $_POST['token'];

	$client = new Google_Client(['client_id' =>'1007627739117-mmn92vm3mqjimnbap1pmm2r32fq50fe4.apps.googleusercontent.com']);  // Specify the CLIENT_ID of the app that accesses the backend
	//And for online
	//$client = new Google_Client(['client_id' =>'652084536686-qpisps8dfmh5h53tsang6fh17qa0tl9u.apps.googleusercontent.com']);  // Specify the CLIENT_ID of the app that accesses the backend
	$payload = $client->verifyIdToken($id_token);
	if ($payload) {
		$gUser = array();
		$gUser['uid'] = $payload['sub'];
		$gUser['first_name'] = $payload['given_name'];
		$gUser['fullname'] = $payload['name'];
		$gUser['email'] = $payload['email'];
		$gUser['profile_photo'] = $payload['picture'];
		$gUser['oauth_provider'] = 'google';

		oauthLogin($gUser);

	} else {
		echo 'Invalid ID token';
	}

}
