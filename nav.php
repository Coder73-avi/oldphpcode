<?php

 include_once "database/database.php";

 $db = Database::instantiate();

 Session::start();


if(isset($_SESSION['User'])){

    $user_Email = $_SESSION['Email'];

}else{

    $user_Email = Form_data("Email");

}



 $User_info = $db->db_select('users_info','*');

 foreach($User_info as $User_info){



 }

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="description" contact="All type of land, plotting and house are available here. You can buy and sell.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    

    <link rel="stylesheet" href="Admin/style/message.css">

    <link rel="stylesheet" href="style/colomn.css">

    <link rel="stylesheet" href="style/nav.css">

    <link rel="stylesheet" href="style/style-1.css">

    <link rel="stylesheet" href="style/style-2.css">

    <link rel="stylesheet" href="style/style-3.css">
    <link rel="stylesheet" href="style/style-4.css">


    <link rel="stylesheet" href="style/footer.css">

    <link rel="stylesheet" href="style/form.css">

    <link rel="stylesheet" href="style/responsive.css">



    <link rel="shortcut icon" href="Admin/<?=$User_info->logo?>" type="image/x-icon">

    <title><?=$User_info->Site_name?></title>

</head>

<?php 

    if(isset($_GET['form'])){



?>

<style>

.login-form{

    display:block;

}

</style>

<?php

    }

    $db->db_select('post_information','*','Purpose=? && Status=?',array('Plotting','Published'));

    $ploting_no = $db->db_count();

    

    ?>

<body onload="selectImg('','',<?=$ploting_no?>)">

    

<?php  require_once ("login.php");?>





<div class="site-head row" id='site'>

    <div class="cols-1 img" >

        <img src="Admin/<?=$User_info->logo?>" alt="" height="70px" width="70px">

    </div>

    <div class="cols-4 head">

        

    <p class="name"><?=$User_info->Site_name?></p>

    <h3 class="nepali">hUuf vl/b las|L s]Gb| latf{df]8, emfkf</h3 >

    </div>

    <div class="cols-5 company-info">

    <br>

        <span class="far fa-envelope text-info"> <?=$User_info->Email?> <span> &nbsp&nbsp

        <span class="fas fa-phone-square text-info"> <?=$User_info->Contact?></span>

 

    </div>

    <div class="cols-2 right-head">

        <span class="fa fa-user admin" id="Admin" onclick="homepage()" ondblclick="myFunction()"> </span>

        <?php

            if(!isset($_SESSION['User'])){

        ?>

        <a href="index.php?form=logIn" class="sign-btn"> Log In</a>

        <a href="index.php?form=signUp" class="sign-btn"> Sign In</a>

    <?php }else{ ?>

            <span><?=$_SESSION['User']?></span>

            <a href="logout.php" title="Logout" class="fa fa-sign-out-alt logout"></a>

    <?php } ?>

    </div>

</div>



<hr class="hr1">

<marquee behavior="" direction="" class="nepali">3/ hUuf vl/b las|L, Knl6Ë ljleGg ;6/ ef8fdf nufpg'k/]df ;Demg'xf]nf .  ;Dks{ g+= (*)&(((()) ÷)@#–%$#*&^</marquee>

<br>





    <div class="navigation" id="navbar">

        <?php

            

            if(isset($_GET['file'])){

                $menu = $_GET['file'];

            }else{

                $menu = "home";

            }

        ?>

        

        <nav class="topnav" id="myTopnav">

            <label for="btn" class="icon">
            <span class="fa fa-bars"> Menu bar</span>
            </label>
            <input type="checkbox" id="btn"  class="input-box">
            
            <ul>
                <li><a href="index.php?file=home" class="<?php if ($menu=="home") echo 'active' ?>">Home</a></li>
                <li><a href="index.php?file=plotting" class="<?php if ($menu=="plotting") echo 'active' ?>">Plotting</a></li>
                <li>
                    <label for="btn-1" class="<?php if ($menu=="land") echo 'active' ?>" id="show"> Land <i class="fa fa-caret-down"></i></label>
                    
                    <a href="#" class="<?php if ($menu=="land") echo 'active' ?>">Land <i class="fa fa-caret-down"></i></a>
                    <input type="checkbox" id="btn-1" class="input-box">

                    <ul>
                        <li><a href="index.php?file=land&&type=buy&&a=1" >Buy</a></li>
                        <li><a href="index.php?file=land&&type=sale" >Sale</a></li>
                    </ul>
                </li>
                <li>
                    <label for="btn-2" class="<?php if ($menu=="houseing") echo 'active' ?>" id="show"> House & Rent <i class="fa fa-caret-down"></i></label>
                    <a href="#" class="<?php if ($menu=="houseing") echo 'active' ?>">House & Rent <i class="fa fa-caret-down"></i></a>
                    <input type="checkbox" id="btn-2"  class="input-box">

                    <ul>
                        <li><a href="index.php?file=houseing&&type=buy&&a=1">Buy</a></li>
                        <li><a href="index.php?file=houseing&&type=sale">Sale</a></li>
                    </ul>
                </li>
                <li><a href="index.php?file=about" class="<?php if ($menu=="about") echo 'active' ?>">About</a></li>
                <li><a href="index.php?file=contact" class="<?php if ($menu=="contact") echo 'active' ?>">Contact</a></li>
            </ul>

        </nav>






    </div>









<br>

