

<?php

    // require_once ("nav.php");



?>

<div class="contact-div">

<form action="" class="contact-form" method="post">

   

    <h3>Contact Information</h3><br>

    <?php

        if(isset($_POST['send'])){

            if(isset($_GET['Sn'])){

                $_POST['Purpose']=$Purpose;

                $_POST['Post_id']=$_GET['Sn'];

            }else{

                $_POST['Purpose'] = "Mail";

            }



            unset($_POST['send']);

            $send = new Mail;

            $send->Send($_POST);



        }

       

      ?>

          <?=showError()?>

            <br>

    <input type="text" name="Fullname" id="" Placeholder="Fulll Name" value="<?= Form_data("Fullname")?>" required><br>

    <input type="email" name="Email" id="" Placeholder="Email" value="<?=$user_Email?>" required><br>

    <input type="text" name="PhoneNumber" id="" Placeholder="Phone Number" value="<?= Form_data("PhoneNumber")?>"  required><br>

    <input type="text" name="Subject" id="" Placeholder="Subject" value="<?= Form_data("Subject")?>" required><br>

    <textarea name="Message" id="" cols="50" rows="10" placeholder="Message..."><?= Form_data("Message")?></textarea><br>



    <button type="submit" class="message-send" name="send">Send</button>

    

</form>

<?php

    if(isset($_GET['file'])){



?>


        <h1 class="our-T">Our Team</h1><br>

<div class="container row">

        <?php

    $data = $db->db_select('partner_info','*');

        foreach($data as $data){

    ?>

            <div class="cols-3">

                <div class="our-team">

                    <div class="pic">

                        <img src="Admin/<?=$data->Image?>" alt="" srcset="">

                    </div>

                    <div class="team-content">

                        <h3 class="title"><?=$data->Fullname?></h3>

                        <span class="post"><?=$data->Post?></span><br>

                        <span class="post"><?=$data->Contact?></span>

                    </div>

                    <ul class="social">

                        <li><a href="<?=$data->Facebook?>" class="fab fa-facebook"></a></li>

                        <li><a href="<?=$data->Twitter?>" class="fab fa-twitter"></a></li>

                        <li><a href="<?=$data->Google?>" class="fab fa-google-plus"></a></li>

                    </ul>

                </div>

            </div>

            <?php } ?>



    </div>

<?php } ?>

        </div>



       