<?php

    class Input{

        public static function method($method="post"){
            switch($method){
                case "post":{
                    if(!empty($_POST) && $_SERVER['REQUEST_METHOD']=="POST"){
                        return true;
                    }
                    break;
                }
                case "get":{
                    if(!empty($_GET) && $_SERVER['REQUEST_METHOD']=="GET"){
                        return true;
                    }
                    break;
                }
            }
            return false;
        }

    }


?>