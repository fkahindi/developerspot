<?php
include_once __DIR__ . '/../../config.php';
require_once __DIR__ .'/../../../includes_devspot/DbConnection.php';
include __DIR__ . '/../../classes/ImageUpLoad.php';

/* //Post variables */
$post_id ='';
$isEditingPost = false;
$published = 0;
$title ='';
$image_file ='';
$post_slug = '';
$body = '';
$image_caption ='';
$meta_description = '';
$meta_keywords = '';
$sound ='';
$feature_image = '';
$post_topic ='';
$topic_id ='';

/*---------------
--Post Functions
-----------------*/
/* Count all published posts */
function countPublishedPosts(){
	global $conn;
	$total_pub_posts ="SELECT COUNT(*) FROM `posts` WHERE published =1";
	$result = mysqli_query($conn,$total_pub_posts);
	if($result){
		return $total_rows = mysqli_fetch_array($result)[0];
	}else{
		return null;
	}
	
}
/* Get number of published posts in the posts table */
function getAllPublishedPostIds(){
	global $conn;
	
	$sql ="SELECT post_id FROM `posts` WHERE published =1 ORDER BY created_at DESC";
	$result = mysqli_query($conn, $sql);
	if($result){
		$published_post_id = mysqli_fetch_all($result, MYSQLI_ASSOC);
		return $published_post_id;
	}else{
		return null;
	}	
}
/* Get specified published post ids from post table beginning with the recent ones*/
function getBatchPublishedPostIds($limit,$offset){
	global $conn;
	
	$sql ="SELECT post_id FROM `posts` WHERE published =1 ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
	$result = mysqli_query($conn, $sql);
	if($result){
		$published_post_id = mysqli_fetch_all($result, MYSQLI_ASSOC);
		return $published_post_id;
	}else{
		return null;
	}	
}

/* Retrieve published topics using post_id of published posts */
function getPublishedTopics($published_post_id){
	global $conn;
	$sql ="SELECT * FROM topics WHERE topic_id= 
	(SELECT topic_id FROM post_topic WHERE post_id=$published_post_id) LIMIT 1";
	$result = mysqli_query($conn, $sql);
	if($result){
		$published_topic = mysqli_fetch_assoc($result);
		return  $published_topic;
	}else{
		echo 'No topics';
	}
}
/* Retrieve published posts categorised by topic using topic_id */
function getPublishedPostsByTopic($topic_id) {
	global $conn;
	$sql = "SELECT * FROM posts ps 
			WHERE ps.published=1 AND ps.post_id IN 
			(SELECT pt.post_id FROM post_topic pt 
				WHERE pt.topic_id=$topic_id GROUP BY pt.post_id 
				HAVING COUNT(1) = 1)";
				
	$result = mysqli_query($conn, $sql);
	
	/* fetch all posts as an associative array called $posts */
	$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$final_posts = array();
	foreach($posts as $post) {
		$post['topic'] = getPublishedTopics($post['post_id']); 
		array_push($final_posts, $post);
	}
	return $final_posts;
}
/* Get topic by name provided on menu links */
function getTopicByName($topic_name){
	global $conn;
	$sql = "SELECT * FROM topics WHERE topic_name = '$topic_name' LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$menu_topic = mysqli_fetch_assoc($result);
	return $menu_topic;
}

/* Get specified number of posts starting with the most recent */
function getMostRecentPosts($limit){
	global $conn;
	$sql = "SELECT * FROM `posts` WHERE published=1 ORDER BY created_at DESC LIMIT $limit";
	$result = mysqli_query($conn, $sql);
	if($result){
		$recent_posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
		return  $recent_posts;
	}else{
		echo 'No recent posts';
	}
}
/* Get posts for admins and authors based on the user logged in */
function getAllPosts(){
	global $conn, $_SESSION;
	
	/* --Admins can view all posts but Authors will view only the posts they authored-- */
	if($_SESSION['role'] == 'Admin'){
		
		$sql = "SELECT * FROM `posts` ORDER BY post_id DESC";
		$select = mysqli_query($conn, $sql);
	}elseif($_SESSION['role'] == 'Author'){
		
		$user_id = $_SESSION['user_id'];
		$sql = "SELECT * FROM `posts` WHERE user_id=$user_id";
		$select = mysqli_query($conn, $sql);
	}
	
	$posts = mysqli_fetch_all($select, MYSQLI_ASSOC);
	
	$all_posts = array();
	
	foreach($posts as $key => $post){
		$post['author'] = getPostAuthorById($post['user_id']);
		array_push($all_posts, $post);
	}
	return $all_posts;
}
/* Retrive a single post by supplied post slug */
function getPostBySlug($post_slug)
{
	global $conn;
	$sql = "SELECT * FROM `posts` WHERE post_slug='$post_slug' LIMIT 1";
	$result = mysqli_query($conn, $sql);

	$post = mysqli_fetch_assoc($result);

	return $post;
}
/* Retrive a single post by supplied post id */
function getPostById($post_id){
	global $conn;
	$sql = "SELECT * FROM `posts` WHERE post_id=$post_id LIMIT 1";
	$result = mysqli_query($conn, $sql);
	
	$post = mysqli_fetch_assoc($result);
	
	return $post;
}
/* Get username/ author of each post */
function getPostAuthorById($user_id){
	global $conn;
	$sql ="SELECT username FROM `users` WHERE user_id=$user_id";
	
	$result = mysqli_query($conn, $sql);
	if($result){
		
		$author = mysqli_fetch_assoc($result);
		return $author['username'];
	}else{
		return null;
	}
}
/* Select first 300 characters of post contents */
function getFirstParagraphPostById($post_id){
	global $conn;
	$sql ="SELECT SUBSTR(post_body, 1, 300) AS post_body FROM `posts` WHERE post_id=$post_id";

	$result = mysqli_query($conn, $sql);

	if($result){
		$paragraph = mysqli_fetch_assoc($result);
		
		return htmlspecialchars_decode($paragraph['post_body'].'...');	
	}else{
		return null;
	}
}

/*-----------------------
	--Post Actions--
------------------------*/
/* If user clicks Save post button */
if(isset($_POST['create_post'])){
	createPost($_POST);
} 
/* If user clicks Edit post */
if(isset($_GET['edit-post'])){
	$isEditingPost = true;
	$post_id = $_GET['edit-post'];
	editPost($post_id);
}
/* If user clicks Update post button */
if(isset($_POST['update_post'])){
	updatePost($_POST);
}
/* //If user click Delete button */
if(isset($_GET['delete-post'])){
	$post_id = $_GET['delete-post'];
	deletePost($post_id);
}

/*-----------------------
	--Post Functions--
-------------------------*/
function createPost($request_values){
	global $conn, $errors, $title, $topic_id, $body,$meta_description, $meta_keywords, $published,$image_path, $image_caption, $sound;
	
	$title = htmlspecialchars(esc($request_values['title']));
	$meta_description = htmlspecialchars(esc($request_values['meta_description']));
	$meta_keywords = htmlspecialchars(esc($request_values['meta_keywords']));
	$image_caption = htmlspecialchars(esc($request_values['image_caption']));
	$body = htmlspecialchars(esc($request_values['body']));
	$topic_id = $request_values['topic_id'];
	$user_id = $_SESSION['user_id'];
	
	/* //Validate form, if $title and $body are not empty create metaphone words */
	if(empty($title)){
		array_push($errors, "Post title is required");
	}else{
		$words = explode(' ', $title);
		foreach($words as $word){
			$sound .= metaphone($word).' ';
		}
	}
	if(empty($body)){
		array_push($errors, "Post body is required");
	}else{
		$words = explode(' ', $body);
		foreach($words as $word){
			$sound .= metaphone($word).' ';
		}
	}
	if(empty($topic_id)){
		array_push($errors, "Post topic is required");
	}else{
		$topic_id = $_POST['topic_id'];
	}
	if(isset($_POST['publish'])){
		$published = $_POST['publish'];
	}
	if(isset($_POST['meta_description'])){
		$meta_description = $_POST['meta_description'];
	}
	if(isset($_POST['meta_keywords'])){
		$meta_keywords = $_POST['meta_keywords'];
	}
	if(isset($_POST['image_caption'])){
		$image_caption = $_POST['image_caption'];
	}
	/* Create slug by replacing spaces in title with hyphens */
	$post_slug = makeSlug($title);

	/* Prepare image  */
	include __DIR__ .'/load_image.php';
		
	if(!$errors){
		/* Upload image */
		$result = $image_up_load->moveFile($target_file);
		$errors = $image_up_load->errors;
		if(!$errors && $result !== false){
			$image_path = BASE_URL.'resources/images/'.basename($received_name['name']);
		}else{
			$image_path = null;
		} 

		/* Make sure no file is saved twice */
		$post_check ="SELECT * FROM `posts` WHERE post_slug='$post_slug' LIMIT 1";
		
		$result = mysqli_query($conn, $post_check);
			
		if(mysqli_num_rows($result)>0){ /* another post with the name exists */
			$errors = 'A post with that name already exists';
		}
	
		/* If no errors in the form, insert posts */	
		if(!$errors){
			$query = "INSERT INTO `posts` (`user_id`, `post_title`, `post_slug`, `post_body`, `meta_description`, `meta_keywords`, `published`, `image`, `image_caption`, `created_at`, `metaphoned`) VALUES ($user_id, '$title', '$post_slug', '$body','$meta_description','$meta_keywords', $published, '$image_path','$image_caption', now(), '$sound')";
			
			$result = mysqli_query($conn, $query);
			if($result){ /* if post created successful */
			
				$inserted_id = mysqli_insert_id($conn);
				/* Create a relationship between post and topic */
				$sql ="INSERT INTO `post_topic` (topic_id, post_id) VALUES ($topic_id, $inserted_id)";
				
				mysqli_query($conn, $sql);
				
				$_SESSION['message']='Post created successfully.';
				header('Location: posts.php');
				exit(0);
			}else{
				$errors = 'Insert record was not successful. <br><strong>Description:</strong><br>'. $conn->error;
			}		
		} 
    }
}

function editPost($role_id){
	global $conn, $title, $body,$meta_description, $meta_keywords,$published,$image_file, $image_caption, $topic_name, $topic_id;
	$sql = "SELECT * FROM `posts` WHERE post_id = $role_id LIMIT 1";
	
	$result = mysqli_query($conn, $sql);
	$post = mysqli_fetch_assoc($result);
	/* //Set form values to be updated on form */
	$title = $post['post_title'];
	$image_file = $post['image'];
	$body = $post['post_body'];
	$meta_description = $post['meta_description'];
	$meta_keywords = $post['meta_keywords'];
	$image_caption =$post['image_caption'];
	$published = $post['published'];
	$topic_name = getPublishedTopics($post['post_id'])['topic_name'];
	$topic_id = getPublishedTopics($post['post_id'])['topic_id'];
}
function updatePost($request_values){
	global $conn, $title, $post_slug, $body, $meta_description,$image_caption, $published, $isEditingPost, $post_id, $topic_id, $sound, $errors;
	$isEditingPost = true; 
	$title = htmlspecialchars(esc($request_values['title']));
	$body = htmlspecialchars(esc($request_values['body']));
	$meta_description = htmlspecialchars(esc($request_values['meta_description']));
	$meta_keywords = htmlspecialchars(esc($request_values['meta_keywords']));
	$image_caption = htmlspecialchars(esc($request_values['image_caption']));
	$post_id = esc($request_values['post_id']);
	if(isset($request_values['topic_id'])){
		$topic_id = esc($request_values['topic_id']);
	}
	if(isset($_POST['publish'])){
		$published = $_POST['publish'];
	}
	
	/* //Create slug by replacing spaces in title with hyphens */
	$post_slug = makeSlug($title);
	/* //Validate form */
	if(empty($title)){
		array_push($errors, "Post title is required");
	}else{
		$words = explode(' ', $title);
		foreach($words as $word){
			$sound .= metaphone($word).' ';
		}
	}
	if(empty($body)){
		array_push($errors, "Post body is required");
	}else{
		$words = explode(' ', $body);
		foreach($words as $word){
			$sound .= metaphone($word).' ';
		}
	}
	/* Prepare image  */
	include __DIR__ .'/load_image.php';
		
	if(!$errors){
		$result = $image_up_load->moveFile($target_file);
		$errors = $image_up_load->errors;
		if(!$errors && $result !== false){
			$image_path = BASE_URL.'resources/images/'.basename($received_name['name']);
		}else{
			$image_path = null;
		} 

		$query = "UPDATE `posts` SET `post_title`='$title', `post_slug`='$post_slug', `post_body`='$body', `meta_description`='$meta_description', `meta_keywords`='$meta_keywords', `published`=$published, `image`='$image_path',`image_caption`='$image_caption', `updated_at`=now(), `metaphoned`='$sound' WHERE `post_id`=$post_id";
	
		//Attach topic to posts in post_topic table 
		if(mysqli_query($conn, $query)){ 
			//if query was created successfully 

			if(isset($topic_id)){
				//create relationship between post and topic 
				$sql = "UPDATE `post_topic` SET topic_id=$topic_id WHERE post_id=$post_id";
				
				mysqli_query($conn, $sql);
				$_SESSION['message']= 'Post and topic values updated successfully.';
				header('Location: posts.php');
				exit(0);
			}
			$_SESSION['message'] = 'Post update successful.';
			header('Location: posts.php');
			exit(0);
		}else{
			$errors = 'Update was not successful. <br><strong>Description:</strong><br>'. $conn->error;
		}
    }     
	
	
}

/* //Delete blog post */
function deletePost($post_id){
	global $conn, $errors;
	$sql = "DELETE FROM `posts` WHERE post_id = $post_id";
	if(mysqli_query($conn, $sql)){
				
		$_SESSION['message'] = 'Post, related comments and replies deleted successfully.';
		header('Location: posts.php');
			exit(0);
	}else{
		array_push($errors, 'Delete failed! <br><strong>Description:</strong><br>'. $conn->error);
	}
}

/* //If user clicks Publish post button */
if(isset($_GET['publish']) || isset($_GET['unpublish'])){
	$message ='';
	if(isset($_GET['publish'])){
		$published = 1;
		$message = 'Post published successfully.';
		$post_id = $_GET['publish'];
	}elseif(isset($_GET['unpublish'])){
		$published = 0;
		$message = 'Post successfully unpublished.';
		$post_id = $_GET['unpublish'];
	}
	togglePublishPost($post_id, $published, $message);
}

/* Publish/ unpublish posts */
function togglePublishPost($post_id, $published, $message){
	global $conn;
	
	$sql = "UPDATE `posts` SET published =$published WHERE post_id=$post_id";
	if(mysqli_query($conn, $sql)){
		$_SESSION['message'] = $message;
		header('Location: posts.php');
		exit(0);
	}
}
function imageUpLoad(){
	
}