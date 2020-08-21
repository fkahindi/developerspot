<?php
class ImageLoad
{
    private $target_file;
    private $image_file_name;
    private $image_file_type;
    private $file_size_limit;
    
    public function __construct($target_file='', $image_file_name='', image_File_Type='', file_size_limit=0){
        $this->target_file=$target_file;
        $this->image_file_name=$image_file_name;
        $this->image_tile_type=$image_file_type;
        $this->file_size_limit=$file_size_limit;
    }
    public function isImageThere($image_temp_name, $file_path){
        if(!empty(getimagesize($image_temp_name))){
            $target_file = $file_path;
           return $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        }else{
            $target_file = null;
            array_push($errors, 'Sorry, image is not found');
            
        }
    }
    public function imageSize($image_size,$file_size_limit){
        if($image_size>$file_size_limit){
			array_push($errors, 'Sorry, image is too large');
        }else{
            
        }
    }
    public function getImageType($parameters){
        if($image_file_type != $parameters ){
            array_push($errors,'Sorry, only files of type '.$parameters. 'can be uploaded');
        }
    }
    public function uploadImage(){
        if(!move_uploaded_file($_FILES['post_main_image']['tmp_name'],$target_file)){
				array_push($errors, 'Post image could not be uploaded, if problem persists try publishing without the image.');
			}else{
				$image_path = BASE_URL .'resources/images/'.basename($image_file);
			}
}