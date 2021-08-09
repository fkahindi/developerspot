<?php
class ImageUpLoad
{
    private $received_name;
    private $target_file;
    public $errors='';
    
  
    public function __construct($received_name='', $target_file=''){
        $this->received_name = $received_name;
        $this->target_file = $target_file;   
    }
    private function checkImageSelected(){
        $image_temp_name = $this->received_name['tmp_name'];
        if(empty($image_temp_name)){
            return false;
        }else {
            return true;
        }
    }
    public function checkImageType($allowed_types){
        $target_file =$this->target_file;
        $image_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        if(($this->checkImageSelected()==true)&&!in_array($image_type,$allowed_types)){
            return $this->errors = 'Sorry, image type not allowed';
        }
    }
    public function imageSize($image_max_size){

        $image_size = $this->received_name['size'];
        if(($this->checkImageSelected()==true) && ($image_size>$image_max_size)){
            return $this->errors = 'Image is too large';
        }
    }
    
    public function moveFile($target_file){
        $image_temp_name = $this->received_name['tmp_name'];
        if($this->checkImageSelected()==true){
            if(!move_uploaded_file($image_temp_name,$target_file)){
                return $this->errors = 'Sorry, image could not be uploaded';
            }
        }else{
            return false;
        }
    }
}
