<?php



class Users {



    private $_db;

    private $_validation;

    private $_tablename = "post_information";

    private $_rules = array(

        'Fullname'=>array(

            'notNumber'=>''

        ),

        'Contact'=>array(

            'number'=>''

        ),
        

        'Price'=>array(

            'number'=>''

        )

        

    );



    function __construct(){

        $this->_validation = new validation;

        $this->_db = Database::instantiate();

    }



    public function insert($submit,$file){

        if($submit['Purpose']=="House"){

            $this->_rules['Area_no']=array('number'=>'');

            $this->_rules['Floor']=array('number'=>'');

            // print_r($this->_rules);

        }

        

        

        $this->_validation->validate($submit,$this->_rules,$file);

        if(!$this->_validation->checkValidation()){

            Session::sess_set('errors',$this->_validation->getErrors());

        }else{

            unset($submit['checkbox']);
            $date = date('Y-m-d');

            $submit['Upload_time']=$date;

            $submit['Status']="Requested";

            // print_r($submit);

            $this->_db->db_insert($this->_tablename,$submit);
            
            if(!empty($file['file']['name'][0])){

                foreach ($file['file']['tmp_name'] as $key => $image){

                    $imageName = $file['file']['name'][$key];

                    $tmpName = $file['file']['tmp_name'][$key];



                    $imageName = preg_replace("/\s+/","_",$imageName);

                    $ext = pathinfo($imageName,PATHINFO_EXTENSION);

                    $name = pathinfo($imageName,PATHINFO_FILENAME);

                    $imageName = $name.'_'.date('mjYHis').'.'.$ext;

                    

                    $distinetion = "Admin/uploadImage/".$imageName;

                    $data = $this->_db->db_select('post_information','*');
                    foreach($data as $data){
                    
                    }
                   $id = $data->Sn;
                    

        

                move_uploaded_file($tmpName, $distinetion);

                $image_info = array('Post_id'=>$id,"File_name"=>$distinetion,"Type"=>"None");

                $this->_db->db_insert('image_src',$image_info);

                }//end for each

            }


            

            Session::sess_set('message_success',"Send Request Successfully.");

            unset($_POST);

        }

    }



}//users class







class Mail{

    

    private $_db;

   

    function __construct(){

        $this->_validation = new validation;

        $this->_db = Database::instantiate();

    }

    public function Send($submit,$type=null){

        // print_r($submit);

        if($type=="signup"){

            $tablename = "customer_info";

            $rules = array(

               'Email'=>array(

                    'required'=>true,

                    'valid'=>'email',

                   'unique'=>'customer_info'

               ),

               'Username'=>array(

                    'required'=>true,

                   'unique'=>'customer_info'

               ),

               "Password"=>array(

                    'required'=>true,

                   'valid'=>'password'

               ),

               "Cpassword"=>array(

                

                'required'=>true,   

                'match'=>'Password'

               ),
               "checkbox"=>array(
                   'checkbox'=>'Checkbox'
               )

            );

        }else{

            $tablename = "mail";

            $rules = array(

                'Fullname'=>array(

                    'required'=>true,

                    'notNumber'=>''

                ),

                'PhoneNumber'=>array(

                    'required'=>true,

                    'number'=>''

                )

            );

        }



        $this->_validation->validate($submit,$rules);

        if(!$this->_validation->checkValidation()){

            Session::sess_set('errors',$this->_validation->getErrors());

        }else{

            if($type=="signup"){

                unset($submit['Cpassword']);

                unset($submit['checkbox']);

                $submit['Password']=passwordEncrypt($submit['Password']);

            }



            $this->_db->db_insert($tablename,$submit);

            unset($_POST);

            if($type=="signup"){

                Session::sess_set('User',$submit['Username']);

                Session::sess_set('Email',$submit['Email']);

                redirect_to('index.php');



            }else{

                Session::sess_set('message_success',"Insert Successfully.");

            }

            // header("location: index.php?file=contact");

        }//if end

    }// send function end

}



class login {

    private $_db;

    private $_errors = array();



    function __construct(){

        $this->_validation = new validation;

        $this->_db = Database::instantiate();

    }



    public function logIn($submit,$dbname=null){

        foreach($submit as $name=>$value){

            if(empty($value)){

                $this->_errors[] = $name." cann't be empty."; 

            }



        }

       

        if(count($this->_errors)==0){



            // login 

            $db = $this->_db;

            if(empty($dbname)){

                $userInfo = $db->db_select('users_info');

                

            }else{

                $userInfo = $db->db_select($dbname,'*',"Username=? || Email=?",array($submit['Username'],$submit['Username']));   

                if($db->db_count()==0){

                    Session::sess_set('message_error',"Invalid Username.");

                }            

            }



            foreach($userInfo as $userInfo){    

                if(isset($dbname)){

                    $email= $userInfo->Email;

                }else{

                    $email = null;

                }

                

                if($userInfo->Username===$submit['Username'] || $userInfo->Email===$email){





                    if(password_verify($submit['Password'],$userInfo->Password)){

                        if(empty($dbname)){

                            Session::sess_set('LOGIN',"ADMIN");

                        }else{

                            Session::sess_set('User',$userInfo->Username);

                            Session::sess_set('Email',$userInfo->Email);

                            redirect_to('index.php');

                        }



                    }else{

                        Session::sess_set('message_error',"Invalid Password.");

                    }

                }else{

                    Session::sess_set('message_error',"Invalid Username.");

                }

            }

            

        }else{

            Session::sess_set('errors',$this->_errors);

         

        }



    

}





}//end login



class Reset{



    public function resetPassword($submit,$dbname=null){



        if(!empty($submit['Email'])){

            $email = $submit['Email'];



            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){

                

                Session::sess_set('message_error','Invalid Email.');



            }else{

                $link = "https://samalgrouprealestate.com/index.php?form=forgot&&forgot=".passwordEncrypt($email);

                $db = Database::instantiate();

                $select = $db->db_select('customer_info','*',"Email=?",array($email));



                if($db->db_count() !== 0){



                    $template_file = './mailTemplate/template_mail.php';



                    // create the swap variable array

                        $swap_var = array(

                            "{SITE_NAME}"=>"SAMAL REAL ESTATE PVT.",

                            "{RESET_LINK}"=>$link

                        );



                        $to_email = $email;

                        $subject = "Password Reset Link";



                        $headers = "From: SAMAL REAL ESTATE PVT. <samal@samalgrouprealestate.com> \r\n";

                        $headers .="MIME-Version: 1.0 \r\n";

                        $headers .="Content-Type: text/html; cherset-ISO-8859-1 \r\n";



                        if(file_exists($template_file))

                                $message = file_get_contents($template_file);

                            else    

                                die("unabl to locate the template file.");

                        foreach(array_keys($swap_var) as $key){

                            if(strlen($key) > 2 && trim($key) !=="")

                                $message = str_replace($key, $swap_var[$key], $message);

                        }



                    // echo $message;

                    // die("invaild");



                    $mail = mail($to_email, $subject, $message, $headers);

                    if(!$mail)

                        die("Reset mail error go back.");
                    else
                        Session::sess_set("message_success","Reset mail send check you email.");
                        unset($_POST);



            }else{

                Session::sess_set('message_error',"Email is not registered.");

            }

        }//check email validation

        }else{

            Session::sess_set('message_error',"Emaill is required.");

        }

    }

}









?>

