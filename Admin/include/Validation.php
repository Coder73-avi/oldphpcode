<?php

class Validation {
    private $_errors=array();

    public function validate($submit,$file,$rules,$id=null){
        // echo "<pre>";
        // print_r($submit);
        // print_r($rules);
      
        foreach($rules as $item => $rule){
            foreach($rule as $key => $ruleValue){
                        switch($key){
                            case "number":{
                                if(!is_numeric($submit[$item])){       
                                    $this->setErrors($item ." use only number.");
                                }
                            }
                            break;
                                case "notNumber":{
                                    if(is_numeric($submit[$item])){
                                        $this->setErrors($item. " don't use number.");
                                    }
                                }
                            break;
                                case "valid":{
                                    
                                    if($ruleValue=="image"){
                                        $db = Database::instantiate();
                                        if(!empty($id)){
                                            $data = $db->db_select('image_src','*',"Post_id=?",array($id));
                                            if(count($data)==0 && empty($file['file']['name'][0])){
                                                $this->setErrors($item. "cann't be empty.");
                                            }else{

                                            if(!empty($file['file']['name'][0])){
                                                $this->image_valid($file);
                                            }
                                        }//if count
                                        }else{
                                        if(empty($file['file']['name'][0])){
                                            $this->setErrors($item. " cann't be empty.");
                                        }else{
                                            $this->image_valid($file);
                                        }
                                    }//if image
                                }
                                }//valid case end
                            
                        }
                
            }//second foreach
        }//end of foreach
        
                
    }//end of function

    public function userValidate($submit,$file=null,$id=null,$rules=null){
        foreach($submit as $post=>$key){
          
            if(empty($key)){
                $this->setErrors($post. " is required.");
            
        }
    }
        if(!empty($file['file']['name'])){
            $extension = array(
                'application/pdf',
                'image/jpeg',
                'image/jpg',
                'image/gif',
                'image/png'
            );
            $maxsize = 6025000;
            $imageName = $file['file']['name'];
            $tmpName = $file['file']['tmp_name'];
            $file_extension = $file['file']['type'];
            $size = $file['file']['size'];

            if(!in_array($file_extension,$extension)){
            $this->setErrors("Not a Image. Only PDF, JPG, GIF and PNG types are accepted.");
        }
        if(($file['file']['size'] >= $maxsize)) {
            $this->setErrors('File too large. File must be less than 20 megabytes.');
        }
        }elseif(empty($id)){
            $this->setErrors('Pictures is required.');
        }

        if(!empty($rules)){
            foreach($rules as $item=>$keys){
                foreach($keys as $keys=>$ruleValue){

                    switch($keys){
                        case "number":{
                            if(!is_numeric($submit[$item])){       
                                $this->setErrors($item ." use only number.");
                            }
                        }
                        break;
                            case "notNumber":{
                                if(is_numeric($submit[$item])){
                                    $this->setErrors($item. " don't use number.");
                                }
                            }
                        break;
                    }



                }//foreach end
            }//foreach end
        }
       

    }//end function


    private function setErrors($error){
        $this->_errors[]=$error;
    }
    
    public function checkValidation(){
        if(empty($this->_errors)){
            return true;
        }
        return false;
    }

    public function getErrors(){
        return $this->_errors;
    }

    private function image_valid($file){
        $extension = array(
            'application/pdf',
            'image/jpeg',
            'image/jpg',
            'image/gif',
            'image/png'
        );
        $maxsize = 6025000;
        
            foreach ($file['file']['tmp_name'] as $key => $image){
                $imageName = $file['file']['name'][$key];
                $tmpName = $file['file']['tmp_name'][$key];
                $file_extension = $file['file']['type'][$key];
                $size = $file['file']['size'][$key];

                if(!in_array($file_extension,$extension)){
                $this->setErrors("Not a Image. Only PDF, JPG, GIF and PNG types are accepted.");
            }
            if(($file['file']['size'][$key] >= $maxsize)) {
                $this->setErrors('File too large. File must be less than 20 megabytes.');
            }
        }//end for each
   
    }


}


?>