<?php
    require_once("functions/function.php");

    function autoload($classname){

        $filename = 'include/'.$classname. '.php';

        if(file_exists($filename)){

            require_once ($filename);

            

        }

    }

spl_autoload_register('autoload');

?>