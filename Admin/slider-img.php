
<form method="post" action="" class="slider-box">
    <?php
    
    if(isset($_GET['slider'])){
        $submit = "Remove";
        $a = "selected-btn";
        $b = null;
    }else{
        $submit = "Add";
        $b = "selected-btn";
        $a = null;

    }
        if(isset($_POST['Add'])){
            if($_POST['Add']=="Add"){
                $array = array('Slider'=>'Yes');
            }else{
                $array = array('Slider'=>'No');
            }
            unset($_POST['Add']);
            foreach($_POST as $keys=>$value){
                $db->db_update('image_src',$array,"Sn=?",array($value));
            }
        }
        
    ?>
        <a href="index.php?file=slider-img" class="slider-title <?=$b?>">Choose in Slider Image</a>
        <a href="index.php?file=slider-img&&slider=Yes" class="slider-title <?=$a?>">Removie from Slider Image</a>
     
    <br class="clear">
    <div class="slider-img">
        <?php
        if(isset($_GET['slider'])){
            $info = $_GET['slider'];
        }else{
            $info = 'No';
        }
            $image = $db->db_select('image_src','*',"Slider=?",array($info));
            $a = 0;
            foreach($image as $src){
                $a +=1;
        ?>
            <input type="checkbox" name="img<?=$a?>" value="<?=$src->Sn?>" id="checked<?=$a?>">
            <label for="checked<?=$a?>">
                <img src="<?=$src->File_name?>" onclick="selectImg(this)" alt="" class="cols-3" height="200px">
            </label>
            
        <?php
            }
        ?>
    </div>

        <button type="submit" name="Add" value="<?=$submit?>" class="slider-btn"><?=$submit?></button>


</form>