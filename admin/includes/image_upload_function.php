<?php
$image_file_name = $_FILES['post_main_image']['name'];
$image_file_temp_name = $_FILES['post_main_image']['tmp_name'];
$image_file_size = $_FILES['post_main_image']['size'];
$file_ext_type = ['jpg','png','gif'];
$target_file = '../resources/images/'.basename($image_file_name);
    
if(!empty($image_file_temp_name)){
    $target_file = '../resources/images/'.basename($image_file_name);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    //Check image size
    if($image_file_size>500000){
        array_push($errors, 'Sorry, image is too large');
        
    // Allow only .jpg, .png and .gif file formats 
    }
    if(!in_array($imageFileType,$file_ext_type)){
        array_push($errors,'Sorry, only JPG, PNG or GIF files are allowed');
    }
    if(!move_uploaded_file($image_file_temp_name,$target_file)){
        array_push($errors, 'Post image could not be uploaded, if problem persists try publishing without the image.');
    }else{
        $image_path = BASE_URL .'resources/images/'.basename($image_file_name);
    }
}else{
    $image_path = null;
}
