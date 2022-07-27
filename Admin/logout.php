<?php
    require_once "functions/function.php";
    session_start();
    session_destroy();
    
    redirect_to('../index.php');

?>