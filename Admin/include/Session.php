<?php
    Class Session{
        
        private static $_sess_start = false;
        
        public static function start(){
            if(self::$_sess_start==false){
                session_start();
                self::$_sess_start = true;
            }
        }

        public static function sess_set($key, $value){
            if(isset($key) && isset($value)){
                $_SESSION[$key]=$value;
            }
        }
        public static function sess_get(){
            $output ="";
            if(array_key_exists('message_success',$_SESSION)){
                $key = 'message_success';
                $output .="<div class='success'>";
                $output .=$_SESSION['message_success'];
                $output .="</div>";
            }
            
            if(array_key_exists('message_error',$_SESSION)){
                $key = 'message_error';
                $output .="<div class='error'>";
                $output .=$_SESSION['message_error'];
                $output .="</div>";
            }
            
            if(array_key_exists('errors',$_SESSION)){    
                $key = 'errors';
                $output =$_SESSION['errors'];
            }
            if (isset($key)) {
                    unset($_SESSION[$key]);
                }
            return $output;
            
           
        }


    }




?>