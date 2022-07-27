<!-- add new land information -->



<?php

    if(Input::method()){

        $User = new User;

        if(isset($_POST['Purpose'])){

            if($_POST['Purpose']!=="House"){

                 unset($_POST['Floor']);

         }

     }

        if(isset($_GET['Sn'])){

            // update

            $User->save($_POST,$_FILES,$_GET['Sn']);

        }else{

            //insert

           

          $User->save($_POST,$_FILES);

        }

    }



?>

<style>

    @font-face{

    font-family: nepali;

    src:url('../style/font/preeti.TTF');

}

</style>

<?php

        $sess_msg = Session::sess_get();

        

        if($sess_msg !==""){

            if(is_array($sess_msg)){

                ?>

    <div class="list-errors">

    <ul>

    <?php

        foreach($sess_msg as $msg){

        ?>

        <li><?=$msg?></li>

    <?php  } ?>

        </ul>

        </div>

    <?php

    }else{

        echo $sess_msg;

    }

}

    ?>



            <?php

        

        // echo message($sess_msg);

        $btn="SUBMIT";

        $id = "";

        $Purpose = "";

        $Type = "";

        $Title = "";

        $Location = "";

        $Area = "";

        $Area_no = "";

        $Price = "";

        $Status = "";

        $Discription = "";

        if(isset($_POST['Discription'])){

            $Discription = $_POST['Discription'];

        }



        if(isset($_GET['Sn'])){

            $id = $_GET['Sn'];

            $btn = "UPDATE";

            $data  = $db->db_select('post_information','*',"Sn=?",array($id));

            foreach($data as $data){

            //     $Purpose = $data->Purpose;

            //     $Type = $data->Type;

            //     $Title = $data->Title;

            //     $Location = $data->Location;

            //     $Area = $data->Area;

            //     $Area_no = $data->Area_no;

            //     $Price = $data->Price;

            //     $Status = $data->Status;

                $Discription = $data->Discription;



            }

        }

    ?>

<br>

<div class="post-new">

    <h2> Enter Your Land Information </h2><hr>

    <form action="" method="post" class="row post-form" enctype="multipart/form-data">

    <div class="cols-6">

        <label for="">Choose Purpose</label><br>

        <select name="Purpose" id="Purpose" onchange="purpose()">

            <option value="">--select purpose--</option>

            <option value="Land" <?=Selected('Land','Purpose',$id)?>>Land</option>

            <option value="Plotting" <?=Selected('Plotting','Purpose',$id)?>>Plotting</option>

            <option value="House" <?=Selected('House','Purpose',$id)?>>House</option>

        </select>

    </div>

    <div class="cols-6">

        <label for="">Choose type</label><br>

        <select name="Type" id="">

            <option value="Sale" <?=Selected('Sale','Type',$id)?>>SALE</option>

            <option value="Rent" <?=Selected('Rent','Type',$id)?>>RENT</option>

        </select>

    </div>



        <div class="cols-6">

            <label for="">Title Name (<span class="nepali">gfd</span>)</label><br>

            <input type="text" name="Title" value="<?= Form_data("Title",$id)?>" placeholder="Title Name" required><br>

        </div>



        <div class="cols-6">

            <label for="">Location: (<span class="nepali">hUuf /x]sf] 7fpF</span>)</label><br>

            <input type="text" name="Location" value="<?= Form_data("Location",$id)?>" placeholder="Location Name" required><br>

        </div>



        <div class="cols-6">

            <label for="">Area (<span class="nepali">If]qkmn</span>)</label><br>

            <input type="text" name="Area" value="<?= Form_data("Area",$id)?>" placeholder="Area in sq. ft" required><br>

        </div>



        <div class="cols-6">

            <label for="">Area No. (<span class="nepali">lsTtf g+=</span>)</label><br>

            <input type="text" name="Area_no" value="<?= Form_data("Area_no",$id)?>" placeholder="Area no." required><br>

        </div>



        <div class="cols-6" id="house">

            <label for="">No. of Floor (<span class="nepali">3/sf] tNnf</span>)</label><br>

            <input type="text" name="Floor" value="<?= Form_data("Floor",$id)?>" placeholder="No. of Floor" id="floor"><br>

        </div>



        <div class="cols-6">

            <label for="">Price (<span class="nepali">d'No</span>)</label><br>

            <input type="text" name="Price" value="<?= Form_data("Price",$id)?>" placeholder="Price" required><br>

        </div>

        <div class="cols-6">

            <label for="">Status</label><br>

                <select name="Status" id="">

                    <option value="Published" <?=Selected("Published","Status",$id)?>>Published</option>

                    <option value="Unpublished" <?=Selected('Unpublished','Status',$id)?> >Unpublished</option>

                    <option value="Requested" <?=Selected('Requested','Status',$id)?> >Requested</option>

                </select>

        </div>

        <?php if(isset($_GET['Sn'])){ ?>

        <div class="cols-12 update-img">

            <?php

                $img_src = $db->db_select('image_src','*',"Post_id=?",array($id));

                foreach($img_src as $src){

            ?>

            <div class="cols-2">

                <img src="<?=$src->File_name ?>" alt="" class="" width="100%" height="100px">

                <a href="unlink.php?unlink=<?=$src->Sn?>&&Sn=<?=$_GET['Sn']?>" class="fa fa-trash"></a>

            </div>

            <?php

                }

            ?>

        </div>

        <?php } ?>

        <div class="cols-8"><br>

            <label for="file" class="file-btn"><i class="fas fa-file-upload"></i> Upload Images </label><br>

            <input type="file" multiple name="file[]" id="file"><br>

        </div>

        <?php if(isset($_GET['Sn'])){ ?>

<div class="cols-12 update-img">

    <?php

        $video = $db->db_select('video_link','*',"Post_id=?",array($id));

        foreach($video as $video){

    ?>

    <div class="cols-3" id="video-list">

        <?=$video->link?>
        <a href="unlink.php?video=<?=$id?>&&Sn=<?=$video->Sn?>" class="fa fa-trash"></a>

    </div>

    <?php

        }

    ?>

</div>

<?php } ?>
        <div class="cols-8">
            
            <br>
            <label for="link">Video Link</label>
            <textarea name="link" id="link" cols="30" rows="5"></textarea>
        </div>
        




        <div class="cols-11">

            <label for="">Discription (<span class="nepali">hUufsf] lja/0f</span>)</label><br>

            <textarea name="Discription" id="" cols="30" rows="10"><?=$Discription?></textarea><br>

        </div>

        

       <div class="cols-12">

            <button type="submit"><?=$btn?></button>

       </div>

       

    

    </form>

    

</div>







