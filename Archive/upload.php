<?php
session_start();
require __DIR__ . '/loginStatus.php';

$errors = [];

$target_dir = '../resources/photos/';
$target_file = $target_dir . basename($_FILES['fileToUpload']['name']);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

//Check if image file is an actual image or fake image
if(isset($_POST['image-upload'])){
	
	try{	
		//Check if an image has been selected
	
		$check = getimagesize($_FILES['fileToUpload']['tmp_name']);
		if($check !== false){
			
			// Check file size
			if($_FILES['fileToUpload']['size']>500000){
				$uploadOk = 0;
				$errors['fileToUpload'] = 'Sorry, your file is too large';

				include __DIR__ . '/../templates/imageupload.html.php';
				
				// Allow certain file formats
			}else if($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'gif'){
				$uploadOk = 0;
				$errors['fileToUpload'] = 'Sorry, only JPG and PNG files are allowed';
				
				include __DIR__ . '/../templates/imageupload.html.php';
			}else{
				$uploadOk = 1;
			
			}
			
		}else{
			$uploadOk = 0;
			$errors['fileToUpload'] =  'No image selected';	
		}
		
		//If everything is ok, try to upload the file
		if($uploadOk == 1){
			
			//Rename the image file with account session name
			$fullname_arr = explode(' ',$_SESSION['fullname']);
			$name = implode($fullname_arr);
			
			$file_pieces = explode('.',$_FILES['fileToUpload']['name']);
			
			//Pick the file extension only
			$extension = $file_pieces[1];
			
			//Combine the name with the extension part
			$target_file = $name .'.'.$extension;
			if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'],'../resources/photos/'.$target_file)){
				$file_path = '/spexproject/resources/photos/'.$target_file;			
				echo 'The file '. basename($target_file). ' has been uploaded<br>';
				echo 'Full file path '.$file_path; 
				
			}else{
				echo 'Sorry, there was an error uploading your file.';
			}		
		}else{
		
			echo 'Sorry, your file was not uploaded.';
		}
	}catch(Exception $e){
		echo 'Caught Exception: ' . $e->getMessage();
	}
}