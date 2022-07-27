<?php
    if(isset($_GET['Sn'])){
        
    $data = $db->db_select('post_information','*','Sn=?',array($_GET['Sn']));
    foreach($data as $data){
?>
<div class="mail-show-div row">
    <a href="index.php?file=mail" class="exit">x</a>
    <div class="cols-7">
        <div class="contener">
            <?php
            $img_src = $db->db_select('image_src','*','Post_id=?',array($_GET['Sn']));
            foreach($img_src as $src){}
            ?>
            <img src="<?=$src->File_name?>" alt="" width="100%" height="400px" id="img1">
        </div>
    </div>
    <div class="cols-5">
    <div class="other-img">
                <?php
                 
                
                    $i = 1;
                    foreach($img_src as $src){
                        $source = $src->File_name;
                        $i = 1 + $i;
                ?>
                <img src="<?=$source?>" alt="" onclick="changeImg('<?=$source?>','img<?=$i?>')" id="img<?=$i?>">
                <?php } ?>

            </div>
            <div class="discription">
                <h2>Discription : </h2>
                <p class="nepali"><?=$data->Discription?></p>
            </div>
            <div class="overview">
                <h2>Overview : </h2>
                    <table class="over-view-info">
                        <tr>
                            <td><b>Perpose: </b> For <?=$data->Type?></td>
                            <td><b>Sale price: </b> Rs. <?=number_format($data->Price, 0, '', ',')?></td>
                            
                            
                        </tr>
                        <tr>
                            <td><b>Area</b> <?=$data->Area?></td>
                            <td><b>Area No.</b> <?=$data->Area_no?></td>

                        </tr>
                        <tr>
                            <td><b>Location: </b> <?=$data->Location?></td>
                        </tr>
                    </table>
                <?php   ?>
            </div>
           
    </div> <!-- end cols-5 div !-->

    <div class="show-mail cols-12">
        <?php
            $mail = $db->db_select('mail','*','Sn=?',array($_GET['comment']));
            foreach($mail as $mail){}
        ?>
               <div class="comment">
                    <h3><?=$mail->Fullname?></h3>
                    <p><?=$mail->Message?></p>
               </div>
             
               
    </div>

    <form action="" method="post" class="reply-box">
        <?php
        if(isset($_POST['replyBtn'])){
            unset($_POST['replyBtn']);             
            if(!empty($_POST['Reply'])){
                $_POST['Comment_id']=$_GET['comment'];
                $db->db_insert('reply',$_POST);
                
            }
        }

?>
                <label for="">Reply</label><br>
                <textarea name="Reply" id="" cols="30" rows="3"></textarea>

                <button type="submit" name="replyBtn">Reply</button>
                   
            </form>
            <br><br>
</div>
<?php
    }
    }//end if isset Sn
    if(isset($_GET['mail'])){
        $sn = $_GET['mail'];
        $comment = $db->db_select('mail','*',"Sn=?",array($sn));
        foreach($comment as $comment){
     
     ?>
     <div class="comment-box">
     <a href="index.php?file=mail" class="exit">x</a>

        <table>
            <tr>
                <td colspan="3"><h2>Message Box </h2><hr></td>
            </tr>
            <tr>
                <td>First Name  </td>
                <td>:</td>
                <td> <?=$comment->Fullname?> </td>
            </tr>
            <tr>
                <td>Email  </td>
                <td>:</td>
                <td><?=$comment->Email?></td>
            </tr>
            <tr>
                <td>Phone Number  </td>
                <td> : </td>
                <td><?=$comment->PhoneNumber?></td>
            </tr>
            <tr>
                <td>Subject  </td>
                <td>:</td>
                <td><?=$comment->Subject?></td>
            </tr>
            <tr>
                <td >Message</td>
                <td>:</td>
            </tr>
            <tr>
                <td colspan="3" class="message-box"><?=$comment->Message?></td>
            </tr>
        </table>
        </div>
        <?php
        }//end foreach
    }

    $sess_msg = Session::sess_get();
    echo $sess_msg;
?>

<table class='mail-table'>

    <tr>
        <th>Sn</th>
        <th>Full Name</th>
        <th>Email Id</th>
        <th>Phone Number</th>
        <th>Subject</th>
        <th>Type of Purpose</th>
        <th>Action</th>
    </tr>
<?php
    $data = $db->db_select('mail','*',NULL,NULL, "Sn DESC");
    $i = 0;
    foreach($data as $data){
        $i +=1;
        if($data->Purpose=="Mail"){
            $link = "index.php?file=mail&&mail=".$data->Sn;
        }else{
            $link = "index.php?file=mail&&Sn=".$data->Post_id."&&comment=".$data->Sn;
        }
?>
    <tr>
        <td><?=$i?></td>
        <td><?=$data->Fullname?></td> 
        <td><?=$data->Email?></td>
        <td><?=$data->PhoneNumber?></td> 
        <td><?=$data->Subject?></td>
        <td><?=$data->Purpose?></td>
        <td><a href="<?=$link?>" class="far fa-eye"></a> <a href="delete.php?Sn=<?=$data->Sn?>&&delete=mail&&link=mail" class="fa fa-trash"></a></td>
    </tr>
    <?php } ?>

</table>