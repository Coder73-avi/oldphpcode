<?php



    // login

   

if(isset($_GET['form'])){

?>

<div class="login-form">



<?php

    if($_GET['form']=="logIn"){

      if(isset($_POST['login'])){

        unset($_POST['login']);

        $login = new login;

        $login->logIn($_POST,'customer_info');

      }

?>

<form action="" method="post" >

<a href="index.php" class="exit">x</a>

    <!-- login form -->

    <h2>Login Form</h2>

    <?=showError()?>



  <div class="input-container">

    <i class="fa fa-user icon"></i>

    <input class="input-field" type="text" placeholder="Username" name="Username"  value="<?=Form_data('Username')?>" >

  </div>



  <div class="input-container">

    <i class="fa fa-key icon"></i>

    <input class="input-field" type="password" placeholder="Password" name="Password">

  </div>

    <input type="checkbox" name="save" id=""> Stay Sign In. <br><br>

  <button type="submit" class="btn" name="login">Login</button>

  <br><br>

  <a href="index.php?form=forgot">Forgot Password ?</a>

  <a href="index.php?form=signUp">Don't have a account Sign Up here.</a>

        <br><br>



</form>



<?php

    }

if($_GET['form']=="signUp"){

  if(isset($_POST['sign_in'])){

    unset($_POST['sign_in']);

    // print_r($_POST);
     if(!isset($_POST['checkbox'])){
        $_POST['checkbox']=null;
    }

    $singUp = new Mail;

    $singUp->send($_POST,'signup');



  }

?>

<form action="" method="post" >

    <!-- sing in form -->

    <a href="index.php" class="exit">x</a>



    <h2>Sign Up</h2>

    <span>Create your account. It's free and takes a minute.</span><br><br>

    <?=showError()?>



    <div class="input-container">

    <i class="fa fa-envelope icon"></i>

    <input class="input-field" type="text" value="<?=Form_data('Email')?>" placeholder="Email" name="Email">

  </div>

  <div class="input-container">

    <i class="fa fa-user icon"></i>

    <input class="input-field" type="text" placeholder="Username"  value="<?=Form_data('Username')?>" name="Username">

  </div>



  <div class="input-container">

    <i class="fa fa-key icon"></i>

    <input class="input-field" type="password" placeholder="Password" name="Password"  value="<?=Form_data('Password')?>" >

  </div>

  <div class="input-container">

    <i class="fa fa-lock icon"></i>

    <input class="input-field" type="Password" placeholder="Conform Password" name="Cpassword">

  </div>

    <p><input type="checkbox" name="checkbox" id="" value="checked">  accept the Terms of Use & Privacy Policy</p><br>

  <button type="submit" class="btn" name="sign_in">Sign In</button>

  <br><br>

  <a href="index.php?form=logIn">Have a account Log In here.</a>

    <br><br>

</form>

<?php

}

?>





<?php 

      

      if(isset($_GET['form'])){

        if($_GET['form']=="forgot"){



          // forgot password process

          if(isset($_POST['send'])){

            unset($_POST['send']);

            $reset = new Reset;

            $reset->resetPassword($_POST);

          }

          

   ?>



    <form action="" method="post" class="forgot">

      <a href="index.php?form=logIn" class="fa fa-long-arrow-alt-left"></a>

    <?php

          if(isset($_GET['forgot'])){

            

            $select_user = $db->db_select('customer_info');

            foreach($select_user as $user){

              if(password_verify($user->Email, $_GET['forgot'])){

                $valid = $user->Email;

                $Username = $user->Username;

              }

            }

            if(isset($valid)){

              $name = "Password";

              $btn = "New Password";

              $btn_name = "changePwd";

              $placeholder="New Password";



              if(isset($_POST['changePwd'])){

                unset($_POST['changePwd']);

                $pwd = $_POST['Password'];



                if(!empty($pwd)){

                  $pwd = passwordEncrypt($pwd);

                  // die($pwd);

                  $colomn_set = array('Password'=>$pwd);



                  $db->db_update('customer_info',$colomn_set,'Email=?',array($valid));



                  Session::sess_set('User',$Username);

                  Session::sess_set('Email',$valid);

                  header("location:index.php");

                  exit;



                  



                }else{

                  Session::sess_set('message_error',"Fill in the empty area.");

                }

              }



            }else{

              header("location:index.php?form=logIn");

            }

          }else{

            $name = "Email";

            $btn = "Send Password Reset Link";

            $btn_name = "send";

            $placeholder="example@gmail.com";

          }



          ?>

        <h2>Reset Password</h2>

        <?=showError()?>



      <label for=""><?=$name?> : </label>

      <input type="<?=$name?>"  class="reset-field" value="<?=Form_data($name)?>" name="<?=$name?>" id="" placeholder="<?=$placeholder?>"><br>

      <button type="submit" class="reset-btn" name="<?=$btn_name?>"><?=$btn?></button>

    </form>



    <?php 



      }

    }

    ?>















</div>



<?php } ?>













<?php



    if(isset($_GET['Admin'])){

      if(isset($_POST['admin_login'])){

          unset($_POST['admin_login']);

          $login = new login;

          $login->login($_POST);

      }

      if(isset($_SESSION['LOGIN'])){

        if($_SESSION['LOGIN']=="ADMIN"){

          header("location:Admin/");

          exit;

        }

      }

     

    ?>

    <div class="admin-panel">

        <form action="" method="post">

            <h2>Login to Admin Panel</h2>

            <?=showError()?>

            <div>

                <label for="username" class="fa fa-user"></label>

                    <input type="text" name="Username" value="<?=Form_data('Username')?>" id="username" placeholder="Username"><br>

                <label for="pwd" class="fa fa-lock"></label>

                    <input type="password" name="Password"  id="pwd" placeholder="Password"><br><br>

                    <hr><br>

                    <div class="row">

                        <div class="cols-9">

                            <input type="checkbox" name="" id="">

                            rememeber me <br><br>

                            <a href="index.php">Close admin panel</a>

                        </div>

                        <div class="cols-3">

                            <button type="submit" name="admin_login" class="admin-submit">Log In</button>

                        </div>

                    </div>

                    <br class="clear">

               

            </div>

        </form>

    </div>

    <?php } ?>

 