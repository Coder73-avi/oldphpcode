<?php
// require_once('functions/function.php');
if(!isset($_SESSION['LOGIN'])){
        redirect_to('https://www.samalgrouprealestate.com');
    
}
if(isset($_SESSION['LOGIN'])){
    if($_SESSION['LOGIN']!=="ADMIN"){
        redirect_to('https://www.samalgrouprealestate.com');
    }
}

?>