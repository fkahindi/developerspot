<?php
$received_name = $_FILES['post_main_image'];
$target_file = '../resources/images/'.basename($received_name['name']);
$image_max_size=500000;
$allowed_types = ['jpg','jpeg','png','gif','webp'];

$image_up_load = new ImageUpLoad($received_name,$target_file);
$image_up_load->checkImageType($allowed_types);
$image_up_load->imageSize($image_max_size);

$errors = $image_up_load->errors;