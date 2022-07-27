<?php

 function message($errors){
    $output = "";
    if(is_array($errors)){ 
     $output .="<ul class='list row'>";

     foreach ($errors as $key => $value){
         $output .= "<li class='cols-5'>";
         $output .= $value;
         $output .="</li>";
     }
     $output .="</ul>";
    }else{
        $output = $errors;
    }
     return $output;
 }
 function redirect_to($location){
     if(!empty($location)){
         header("location:".$location);
         exit;
     }

 }


// form data 

function Form_data($name,$id=NULL,$dbname=null){
    $output = "";
    if(isset($_POST[$name])){
        return $_POST[$name];
    }
    if(isset($id)){
        if(!empty($id)){
            if(empty($dbname)){
                $dbname = "post_information";
            }
            $db = Database::instantiate();

            $data = $db->db_select($dbname,'*','Sn=?',array($id));
            foreach($data as $data){
            
                return $data->$name;
            }
        }
        // echo $id;
    }
    
  
} //end

function Checked($checked,$status){
    if(isset($checked)){
        $value = "checked";
        
        if($checked == $status){
            return $value;
        }
    }
}

function Selected($value,$tb_name,$id=null){
    
        $db = Database::instantiate();
        $selected = "Selected";
        $data = $db->db_select('post_information','*','Sn=?',array($id));
        foreach($data as $data){
        
            // if($tb_name=="Status"){
                if($data->$tb_name==$value){
                    return $selected;
                }
           
            
        }
    
        if(empty($id)){
            if(isset($_POST[$tb_name])){
                if($value==$_POST[$tb_name]){
                    return $selected;
                }
            }
        }
    }//end function
    
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
?>