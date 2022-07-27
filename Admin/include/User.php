<?php

    class User{



        private $_db;

        private $_tablename = "post_information";

        private $_validation;

        private $_rules = array(

            'Title'=> array(

                

            ),

            'Location'=> array(



            ),

            'Area'=> array(

                

            ),

            'Area_no'=> array(


                

            ),

            'Price'=> array(

                'number'

            ),

            

            'file'=>array(

                "valid"=>"image"

            ),

            'Discription'=> array(



                )

            );



        function __construct(){

            $this->_db = Database::instantiate();

            $this->_validation = new Validation();

        }

        public function save($submit,$file,$id=NULL){

            $videolink = $submit['link'];
            unset($submit['link']);

            if(isset($id)){

                //update

                

                // print_r($_POST);



                // die();

                $this->_validation->validate($submit,$file,$this->_rules,$id);

                if(!$this->_validation->checkValidation()){

                    Session::sess_set('errors',$this->_validation->getErrors());

                }else{

                $date = date('Y-m-d');

                $submit['Update_time']=$date;

               $this->_db->db_update($this->_tablename,$submit,"Sn=?",array($id));



               if(!empty($file['file']['name'][0])){

                    foreach ($file['file']['tmp_name'] as $key => $image){

                        $imageName = $file['file']['name'][$key];

                        $tmpName = $file['file']['tmp_name'][$key];



                        $imageName = preg_replace("/\s+/","_",$imageName);

                        $ext = pathinfo($imageName,PATHINFO_EXTENSION);

                        $name = pathinfo($imageName,PATHINFO_FILENAME);

                        $imageName = $name.'_'.date('mjYHis').'.'.$ext;

                        

                        $distinetion = "uploadImage/".$imageName;

                      

            

                    move_uploaded_file($tmpName, $distinetion);

                    $image_info = array('Post_id'=>$id,"File_name"=>$distinetion,"Type"=>"None");

                    $this->_db->db_insert('image_src',$image_info);

                    }//end for each

                }
                if(strlen($videolink) > 10 ){
                    $link = array("Post_id"=>$id,"link"=>$videolink);
                    $this->_db->db_insert('video_link',$link);
                }
                

                Session::sess_set('message_success',"Update Successfully.");

                }

               

            }else{

                if(isset($submit['Floor'])){

                    $push = array('Floor'=>array('number'));

                    array_push($this->_rules,$push);

                }

                // validation

                $this->_validation->validate($submit,$file,$this->_rules);

                if(!$this->_validation->checkValidation()){

                    Session::sess_set('errors',$this->_validation->getErrors());

                }else{

                //insert

               

                $date = date('Y-m-d');

                $submit['Upload_time']=$date;

    

                $this->_db->db_insert($this->_tablename,$submit);

                  $db = $this->_db->db_select($this->_tablename,'*');
                foreach($db as $db_id){}
                
                if(strlen($videolink) > 10){
                    $link = array("Post_id"=>$db_id->Sn,"link"=>$videolink);
                    $this->_db->db_insert('video_link',$link);
                }

                foreach ($file['file']['tmp_name'] as $key => $image){

                    $imageName = $file['file']['name'][$key];

                    $tmpName = $file['file']['tmp_name'][$key];

                   

                    $imageName = preg_replace("/\s+/","_",$imageName);

                    $ext = pathinfo($imageName,PATHINFO_EXTENSION);

                    $name = pathinfo($imageName,PATHINFO_FILENAME);

                    $imageName = $name.'_'.date('mjYHis').'.'.$ext;



                    $distinetion = "uploadImage/".$imageName;

                    $db = $this->_db->db_select($this->_tablename,'*');

                    foreach($db as $db_id){}

        

                    move_uploaded_file($tmpName, $distinetion);

                    $image_info = array('Post_id'=>$db_id->Sn,"File_name"=>$distinetion,"Type"=>'None');

                    $this->_db->db_insert('image_src',$image_info);

                }

                Session::sess_set('message_success',"Insert Successfully.");

                unset($_POST);

                }

            }



        }

// user update

        public function userUpdate($submit,$file,$id=null){

            $tb_name = "users_info";

            

            $this->_validation->userValidate($submit,$file,$id);

            if(!$this->_validation->checkValidation()){

                Session::sess_set('errors',$this->_validation->getErrors());

            }else{

                if(!empty($file['file']['name'])){

                    $imageName = $file['file']['name'];

                    $tmpName = $file['file']['tmp_name'];

                    

                    $imageName = preg_replace("/\s+/","_",$imageName);

                    $ext = pathinfo($imageName,PATHINFO_EXTENSION);

                    $name = pathinfo($imageName,PATHINFO_FILENAME);

                    $imageName = $name.'_'.date('mjYHis').'.'.$ext;



                    $user = $this->_db->db_select('users_info','*','Sn=?',array($id));

                    foreach($user as $user){

                        unlink($user->logo);

                    }



                    $distinetion = "image/".$imageName;

                    move_uploaded_file($tmpName, $distinetion);

                    $submit['logo'] = $distinetion;



                }

                unset($submit['Password']);

                $this->_db->db_update($tb_name,$submit,"Sn=?",array($id));

                Session::sess_set('message_success',"Update Successfully.");



            }

        }



        // add or update user-info

        public function addPartner($submit,$file,$id=null){

            // print_r($submit);

            $tbname = "partner_info";

            $rules = array(

                "Fullname"=>array(

                    'notNumber'=>''

                ),

                "Post"=>array(

                    'notNumber'=>''

                ),

                "Contact"=>array(

                    'number'=>''

                )

            );

            if(!empty($id)){

                

                $this->_validation->userValidate($submit,$file,$id,$rules);

            }else{

                $this->_validation->userValidate($submit,$file,null,$rules);

            }

            if(!$this->_validation->checkValidation()){



                Session::sess_set('errors',$this->_validation->getErrors());



            }else{

                if(!empty($file['file']['name'])){

                    $imageName = $file['file']['name'];

                    $tmpName = $file['file']['tmp_name'];

                    

                    $imageName = preg_replace("/\s+/","_",$imageName);

                    $ext = pathinfo($imageName,PATHINFO_EXTENSION);

                    $name = pathinfo($imageName,PATHINFO_FILENAME);

                    $imageName = $name.'_'.date('mjYHis').'.'.$ext;



                    if(!empty($id)){

                        $user = $this->_db->db_select($tbname,'*','Sn=?',array($id));

                    foreach($user as $user){

                        unlink($user->Image);

                    }

                    }



                    $distinetion = "image/".$imageName;

                    move_uploaded_file($tmpName, $distinetion);

                    $submit['Image'] = $distinetion;



                }
                if($submit['Facebook']=="error"){
                    $submit['Facebook']="http://www.facebook.com";
                }
                if($submit['Twitter']=="error"){
                    $submit['Twitter']="http://www.twitter.com";
                }
                if($submit['Google']=="error"){
                    $submit['Google']= "http://www.gmail.com";
                }

                if(!empty($id)){

                    $this->_db->db_update($tbname,$submit,"Sn=?",array($id));

                    Session::sess_set('message_success',"Update Successfully.");



                }else{

                    Session::sess_set('message_success',"Add Successfully.");

                    $this->_db->db_insert($tbname,$submit);

                }

                unset($_POST);

            }



        }



    



        private function passwordEncrypt($pwd=""){

            if(!(empty($pwd))){

                return password_hash($pwd,PASSWORD_DEFAULT);

            }

        }

        

    }





class updatePwd{

    public function Change($password){

        $error = array();

        $db = Database::instantiate();



        if(empty($password['oldPassword'])){

            $error[]="Old password is required.";

        }

        if(empty($password['Password'])){

            $error[]="New passsword is required.";

        }

        if(empty($password['Cpassword'])){

            $error[]="Confirm password is required.";

        }

       

        if(count($error) !== 0){

            Session::sess_set('errors',$error);

        }else{

            

            $select = $db->db_select('users_info');

            foreach($select as $info){

                $username = $info->Username;



                if(password_verify($password['oldPassword'],$info->Password)){

                    if($password['Password']===$password['Cpassword']){

                            $pwd = passwordEncrypt($password['Password']);

                            $db->db_update('users_info',array('Password'=>$pwd),"Username=?",array($username));

                            Session::sess_set('message_success','Password changed Successfully.');

                            unset($_POST);

                    }else{

                        Session::sess_set('message_error',"New password or Confirm password doesn't match. ");

                    }

                }else{

                    Session::sess_set('message_error', "Incorrect password.");

                }

            }

            

        }

    }

}





?>