<?php



class validation{



    public function validate($submit,$rules,$file=null){

        // print_r($submit);



       //checked empty area.
       if(!empty($file)){
       if(empty($file['file']['name'][0])){

        $this->setErrors("Picture is empty select any pictures.");

    }else{

        image_valid($file);

    }
}
        

        foreach($rules as $item=>$rule){

            foreach ($rule as $key=>$ruleValue){

                if($key=="required" && empty($submit[$item])){



                    if($item=="Cpassword"){

                        $this->setErrors("Confirm Passoword is required");

                    }else{

                     $this->setErrors(ucfirst($item. " is required"));

                    }



                    }else if($submit[$item]!==""){

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

                                    if($ruleValue=="email"){

                                        if (!filter_var($submit[$item], FILTER_VALIDATE_EMAIL)) {

                                            $this->setErrors("Invalid email format");

                                        }

                                    }



                                    if($ruleValue=="password"){

                                        $lowercase = preg_match('@[a-z]@', $submit[$item]);

                                        $number    = preg_match('@[0-9]@', $submit[$item]);

                                        if(!$lowercase || !$number || strlen($submit[$item]) < 6){

                                            $this->setErrors("Password should be at least 8 characters in length and should include at least one number,.");

                                        }

                                    }

                                }

                            break;

                                case "unique":{

                                    $db = Database::instantiate();

                                    $db->db_select($ruleValue,'*',$item."=?",array($submit[$item]));

                                    if($db->db_count()!==0){

                                        $this->setErrors($item. " is already exist.");

                                    }

                                }

                            break;

                                case "match":{

                                    if($submit[$item] !== $submit[$ruleValue]){

                                        $this->setErrors($ruleValue ." Doesn't match.");

                                    }

                                }   

                            break;
                            case "checkbox":{
                                    if($submit['checkbox']==null){
                                        $this->setErrors("Please checked in Privacy Policy.");
                                    }
                                }
                            break;

                        }//end switch

                    }//end if not empty or empty

            }//end foreach 2

        }//end foreach 1

        
    }



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



    public function logIn(){



    }

}

//end of class



function Form_data($name){

    $output = "";

    if(isset($_POST[$name])){

        return $_POST[$name];

    }else{

        return $output;

    }

            // echo $id;

    

    

  

} //end

function Selected($value,$tb_name){

            $selected = "Selected";      



            if(isset($_POST[$tb_name])){

                if($value==$_POST[$tb_name]){

                    return $selected;

                }

            }



   

}

// show error

function showError(){

        $sess_msg = Session::sess_get();

        

        if($sess_msg !==""){

            if(is_array($sess_msg)){

                echo "<div class='list-errors'>";

                echo "<ul>";

               foreach($sess_msg as $msg){   

                   echo "<li>".$msg."</li>";

               }

               echo "</ul></div>";

            }else{

                echo $sess_msg;

            }

        }

    }



    function passwordEncrypt($pwd=""){

        if(!(empty($pwd))){

            return password_hash($pwd,PASSWORD_DEFAULT);

        }

    }



    function redirect_to($location){

        // ob_start();

        if(!empty($location)){

            header("Location:".$location);

            exit;

        }

        // ob_end_flush();

    }
     function image_valid($file){

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

    ?>







