<?php
ob_start();

    require_once ('include/initialization.php'); 
   
    Session::start();

    $db = Database::instantiate();
    require_once('login_request.php');
    

    $user_info = $db->db_select('users_info');

    foreach($user_info as $user_info){}

?>



<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../style/colomn.css">

    <link rel="stylesheet" href="style/style-1.css">

    <link rel="stylesheet" href="style/style-2.css">

    <link rel="stylesheet" href="style/style-3.css">

    <link rel="stylesheet" href="style/style-4.css">

    <link rel="stylesheet" href="style/message.css">

    <link rel="shortcut icon" href="<?=$user_info->logo?>" type="image/x-icon">
    <title>DashBoard</title>

</head>

<body>



<div class="row dashboard">

    <div class="head">

        <div class="cols-1">

            <img src="<?=$user_info->logo?>" alt="" height="70px">

        </div>

        <h1 class="cols-7"><?=$user_info->Site_name?></h1>

        

        <marquee behavior="" direction="" class="nepali">3/ hUuf vl/b las|L, Knl6Ë ljleGg ;6/ ef8fdf nufpg'k/]df ;Demg'xf]nf .  ;Dks{ g+= (*)&(((()) ÷)@#–%$#*&^</marquee>

    </div>



    <?php



     ?>

    

<div class="sidenav">

  <a href="index.php?file=post" class="<?php if ($_GET['file']=="post") echo "active"?>"><i class="fa fa-pencil-alt"></i> Post</a>

  <a href="index.php?file=mail" class="<?php if ($_GET['file']=="mail") echo "active" ?>"><i class="fa fa-envelope-open-text"></i> Mail</a>

  <a href="index.php?file=request_post" class="<?php if ($_GET['file']=="request_post") echo "active" ?>"><i class="fas fa-inbox"></i> Request</a>

  <a href="index.php?file=user" class="<?php if ($_GET['file']=="user") echo "active" ?>"> <i class="fa fa-user"></i> User</a>

  <a href="index.php?file=user-info" class="<?php if ($_GET['file']=="user-info") echo "active" ?>"> <i class="fa fa-users"></i> Partner Information</a>

  <a href="index.php?file=slider-img" class="<?php if ($_GET['file']=="slider-img") echo "active" ?>"> <i class="fa fa-image"></i> Choose Slider Image</a>
  <a href="logout.php" > <i class="fa fa-sign-out-alt"></i> Log out</a>

</div>



<div class="main">

  <?php

        if(isset($_GET['file'])){

            if(isset($_GET['sub_file'])){

                $file_name = $_GET['sub_file'] . ".php";

            }else{

                $file_name = $_GET['file'] . ".php";

            }

            require_once ($file_name);

        }else{

            redirect_to('index.php?file=post');


            exit;

        }



    ?>

 

 

 </div>





</div>





<script src="https://kit.fontawesome.com/a076d05399.js"></script>

<script src="js/script-1.js"></script>


<?php 
    ob_end_flush();

?>
</body>

</html>