<?php



?>

<a href="index.php?file=user-info&&addPartner" class="add-btn">Add new Partner</a>

<br><br>

<?php

    require_once ("login_request.php");//check session is create or not



    $id="";

    $dbname = "";
    $btnName = "Add Partner";

    if(isset($_POST['addPartner'])){

        unset($_POST['addPartner']);

        $users = new User;

        $users->addPartner($_POST,$_FILES,$_GET['addPartner']);

       

    }



    if(isset($_GET['addPartner'])){

        $id=$_GET['addPartner'];

        $dbname = "partner_info";
        $btnName = "Update Partner";

?>

<form action="" method="post" class="add-partner " id="addPartner" enctype="multipart/form-data">

<a href="index.php?file=user-info" class="exit">x</a>

<div class="form-div row">

    <?php

        showError();

    ?>

    <h2>Partner Information : </h2><hr><br>

    <div class="cols-5">
    <label for="">Fullname</label><br>
        <input type="text" name="Fullname" value="<?=Form_data('Fullname',$id, $dbname)?>" placeholder="Fullname" id=""><br>
    </div>

    <div class="cols-6">
    <label for="">Post</label><br>

        <input type="text" name="Post" value="<?=Form_data('Post',$id, $dbname)?>" placeholder="Post" id=""><br>
    </div>
    
    <div class="cols-5">
    <label for="">Contact Number</label><br>

        <input type="text" name="Contact" value="<?=Form_data('Contact',$id, $dbname)?>" placeholder="Contact Number" id=""><br>
    </div>

    <div class="cols-6">
    <label for="">Facebook Link</label><br>

        <input type="text" name="Facebook" id="" placeholder="Facebook link" value=<?=Form_data('Facebook',$id,$dbname)?>><br>
    </div>
    <div class="cols-5">
    <label for="">Twitter Link</label><br>

        <input type="text" name="Twitter" id="" placeholder="Twitter link"  value=<?=Form_data('Twitter',$id,$dbname)?>><br>

    </div>
    <div class="cols-6">
    <label for="">Google Link</label><br>

        <input type="text" name="Google" id="" placeholder="Google link"  value=<?=Form_data('Google',$id,$dbname)?>><br>
    </div>
    <br class="clear">
    <br>
    <label for="img" class="add-img">Add img</label><br>

        <input type="file" name="file" id="img">

    

    <br>

    <button type="submit" name="addPartner"><?=$btnName?></button>

</div>

</form>



<?php

    }

?>

<div class="container row">

        <?php
        showError();
        $data = $db->db_select('partner_info');

    // $data = array(1,2,3,4);

        foreach($data as $data){

    ?>

            <div class="cols-3">

                <div class="our-team">

                    <div class="pic">

                        <img src="<?=$data->Image?>" alt="" srcset="">

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

                        <li><a href="index.php?file=user-info&&addPartner=<?=$data->Sn?>" class="fa fa-edit" title="Edit"></a></li>

                        <li><a href="delete.php?Sn=<?=$data->Sn?>&&delete=partner_info&&link=user-info" class="fa fa-trash" title="Delete"></a></li>

                    </ul>

                </div>

            </div>

            <?php } ?>



    </div>

