<?php

    ob_start();

    require_once ("nav.php");


    if(isset($_GET['file'])){

        if(isset($_GET['subFile'])){

            $file = $_GET['subFile'];

        }else{

            $file = $_GET['file'];

        }

    }else{

        $file = "home";

    }

    require_once ($file.".php");



    require_once ("footer.php");

    ob_end_flush();

?>

