<?php
class ImageLoad
{
    public $target_file='';
    public $image_temp_name='';
    public $image_file_type='';
    public $file_size_limit=0; 
    
    public function __construct($target_file,$image_temp_name,$image_file_type,$file_size_limit){
        $this->target_file=$target_file;
        $this->image_temp_name=$image_temp_name;
        $this->image_file_type=$image_file_type;
        $this->file_size_limit=$file_size_limit;
    }
    public function isImageThere($image_temp_name, $file_path){
        if(!empty(getimagesize($image_temp_name))){
            $target_file = $file_path;
             $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
           $this->imageSize();
           $this->getImageType();
        }else{
            $target_file = null;
            array_push($errors, 'Sorry, image is not found');
            
        }
    }
    public function imageSize(){
        if($actual_image_size>$file_size_allowed){
			//array_push($errors, 'Sorry, image is too large');
            echo 'Image too large';
        }
    }
    public function getImageType(){
        
        if(!in_array($image_type, $file_type_allowed) ){
           // array_push($errors,'Sorry, only files of type '.$file_ext_type. 'can be uploaded');
           echo 'File type not allowed';
        }else{
            uploadImage();
        }
    }
    public function uploadImage(){
        move_uploaded_file($image_temp_name, $target_file);
            
        //return $image_path = BASE_URL ."resources/images/".basename($image_file);
        echo "I'm uploading...";
    }
}