<?php

    require_once ('nav.php');

    

if(isset($_GET['type'])){



    if($_GET['type']=="buy"){

        $a = 0;

        $b = 12;

        if(isset($_GET['a'])){

            if($_GET['a']==0){

                $_GET['a']=1;

            }

            $a = ($_GET['a']-1) * 12;

            $b = $a + 12;

        }

?>





<div class="allLand">

            <h2>Available Land</h2>



            <div class="row">

               

            <?php

                $data = $db->db_select('post_information','*','Purpose=?',array("Land"),'Sn DESC',$a.','.$b);

                foreach($data as $data){

                    $id = $data->Sn;

                    if($data->Status=="Published"){





                    $img_src = $db->db_select('image_src','*','Post_id=? && Type=?',array($id,'Profile'));

                    if($db->db_count()==0){

                        $img_src = $db->db_select('image_src','*','Post_id=?',array($id));

                        foreach($img_src as $src){

                            $source = "Admin/". $src->File_name;

                        }

                    }else{

                        foreach($img_src as $src){

                            if($src->Post_id == $id){

                            $source = "Admin/".$src->File_name;

                        }

                    }

                }

                    

            ?>

            <div class="property-details cols-3" onclick="OneClick(<?=$data->Sn?>)">

                

                <img src="<?=$source?>" alt="" width="100%">

                    <span class="for">For <?=$data->Type?></span>



                    <h2><?=$data->Title?></h2>

                    <p><i class="fa fa-map-marker-alt"></i> <?=$data->Location?></p>

                    <p class="area"><?=$data->Area?></p>



                    <hr>

                    <div class="span">

                        <span><i class="far fa-calendar-check"></i> <?=$data->Upload_time?> Updated</span>

                    </div>



            </div>

                <?php

                }

            }

                   

                ?>

           

            </div>



            <div class="pagination ">

                <?php

                    if(isset($_GET['a'])){

                        $back = $_GET['a'];

                    }else{

                        $back = "";

                    }

                ?>

                    <a href="index.php?file=land&&type=buy&&a=<?=$back-1?>">&laquo;</a>

                    <?php

                    $db->db_select('post_information','*',"Purpose=? && Status=?",array("Land","Published"));

                    $count = $db->db_count();

                    $num = ceil($count /12);

                    // $num = 12;

                    

                    for($i=1;$i <= $num; $i++){

                        $active = "";

                        if(isset($_GET['a'])){

                            if($_GET['a']==$i){

                                $active = "active";

                            }

                        }

                    ?>

                    <a href="index.php?file=land&&type=buy&&a=<?=$i?>" class="<?=$active?>"><?=$i?></a>

                    <?php  

                    }

                    ?>

                    <a href="index.php?file=land&&type=buy&&a=<?=$back+1?>">&raquo;</a>

                </div>

                <br class="clear"><br>

        </div>

        <?php 

        }else{ 

            if(!isset($_SESSION['User'])){

                header('location:index.php?form=logIn');

                exit;

            }

            ?>

    <div class="sale-area main-container">

    <h2>Enter your Land Infromation</h2>

            <?php

                if(isset($_POST['submit'])){

                    unset($_POST['submit']);



                    if(!isset($_POST['checkbox'])){

                        $_POST['checkbox']="";

                    }

                    $Users = new Users;

                    $_POST['Purpose']="Land";

                    $Users->insert($_POST);

                }

            ?>

         

    <form action="" method="post" class="" enctype="multipart/form-data">

    <?=showError()?>

<br>

                <label for="">Choose type</label><br>

                    <select name="Type" id="">

                        <option value="Sale" <?=Selected('Sale','Type')?>>SALE</option>

                        <option value="Rent" <?=Selected('Rent','Type')?>>RENT</option>

                    </select><br>

                <label for="">Full name: (<span class="nepali">k'/f gfd</span>)</label><br>

                    <input type="text" name="Fullname" value="<?= Form_data("Fullname")?>" required id="" placeholder="Full Name"><br>



                <label for="">Email Id: (<span class="nepali">Od]n cfO8L</span>)</label><br>

                    <input type="email" name="Email" id="" value="<?=$user_Email?>" required placeholder="Email"><br>

                <label for="">Contact Number: (<span class="nepali">;Dks{ g+=</span>)</label><br>

                    <input type="text" name="Contact" id="" value="<?= Form_data("Contact")?>" required placeholder="contact Number"><br>



                <label for="">Location: (<span class="nepali">hUuf /x]sf] 7fpF</span>)</label><br>

                    <input type="text" name="Location" value="<?= Form_data("Location")?>" required id="" placeholder="Location">

                    <br>

                <label for="">Area: (<span class="nepali">If]qkmn</span>)</label><br>

                    <input type="text" name="Area" id="" value="<?= Form_data("Area")?>" required placeholder="Area in sq.ft">

                    <br>

                <label for="">Area No: (<span class="nepali">lsTtf g+=</span>)</label><br>

                    <input type="text" name="Area_no" id="" value="<?= Form_data("Area_no")?>" required placeholder="Area No">

                    <br>
                <label for="add-image" class="add-img"> Add Image </label>
                    <input type="file" name="file[]" id="add-image" multiple><br><br>

                <label for="">Discription (<span class="nepali">hUufsf] lja/0f</span>)</label><br>

                    <textarea name="Discription" id="" cols="30" rows="10"><?= Form_data("Discription")?></textarea><br>



                <label for="">Price: (<span class="nepali">d'No</span>)</label><br>

                    <input type="text" name="Price" id="" value="<?= Form_data("Price")?>" required placeholder="Price of Land"><br>



                <input type="checkbox" name="checkbox" id="checkbox" value="checked">

                <label for="checkbox" >I agree on all the policies of Samal Real State PVT. regarding online entry of land information.</label><br>

                <button type="submit" name="submit">Submit</button>

            </form>

            

            

    </div>

    <?php 

        } 

    }

    ?>



