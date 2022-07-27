<?php



    require_once ('nav.php');

   

    $view = $db->db_select('view','*','Post_id=?',array($_GET['Sn']));

    $num=1;

    $count = $db->db_count();

    if($count==0){

        $array = array("Post_id"=>$_GET['Sn'],"Viewcount"=>1);

        $db->db_insert('view',$array);



        

    }else{

        foreach($view as $view){

            if(empty($view->Viewcount)){

                $num = 1;

            }else{

                $num = $view->Viewcount +1;

            }

         ;

        }



        $array = array("Viewcount"=>$num);

        $db->db_update('view',$array,'Post_id=?',array($_GET['Sn']));

    }

    





    $data = $db->db_select('post_information','*','Sn=?',array($_GET['Sn']));

                foreach($data as $data){

                    $Purpose = $data->Purpose;



?>



<div class="land-info">

    <div class="row land-head">

        <div class="cols-10">

            <h2 class=""><?=$data->Title?></h2>

            <p class=""> <i class="fa fa-map-marker-alt"></i> <?=$data->Location?></p>

            <p> Area : <?=$data->Area?></p>

        </div>

        <div class="cols-2"> <span class="info-for"> For <?=$data->Type?></span></div>

        

    </div> 

    <br class="clear">

    

    <div class="row land-information">

            <div class="cols-8">

                <p class="viewers">No. of Viewers <i class="fa fa-eye"></i> <?=$num?> </p>

                <?php

                

                

                    $img_src = $db->db_select('image_src','*','Post_id=?',array($_GET['Sn']));

                    foreach($img_src as $src){}

                ?>

                

            <img src="Admin/<?=$src->File_name?>" alt="" width="100%" height="" id="img1">



            <div class="other-img">

                <?php

                    $i = 1;
                    $none = "none";
                    if($data->Price !== "1"){
                        $price = $data->Price;
                    }else{
                        $price = $none;
                    }
                    if($data->Area !=="1"){
                        $area = $data->Area;
                    }else{
                        $area = $none;
                    }
                    if($data->Area_no !=="1"){
                        $area_no = $data->Area_no;
                    }else{
                        $area_no = $none;
                    }

                    foreach($img_src as $src){

                        $source = "Admin/".$src->File_name;

                        $i = 1 + $i;

                ?>

                <img src="<?=$source?>" alt="" onclick="changeImg('<?=$source?>','img<?=$i?>')" id="img<?=$i?>">

                <?php } ?>



            </div>


            <div class="videos">
                <h2>Videos : </h2>
                <div class="video-list">
                    <?php
                    $video = $db->db_select('video_link','*','Post_id=?',array($_GET['Sn']));
                        foreach($video as $video){
                            echo $video->link;
                        }
                     
                     ?>
                </div>
            </div>


            <div class="discription">

                <h2>Discription : </h2>

                <p class="nepali"><?=$data->Discription?></p>

            </div>



            <div class="overview">

                <h2>Overview</h2>

                <ul class="overview-info">
                        <li><b>Perpose: </b> For <?=$data->Type?></li>
                        <li><b>Perpose: </b> For <?=$data->Type?></li>
                        <li><b>Sale price: </b> Rs. <?=$price?></li>
                        <li><b>Area :</b> <?=$area?></li>
                        <li><b>Area No :</b> <?=$area_no?></li>
                        <li><b>Location: </b> <?=$data->Location?></li>
                </ul>

                

                <?php  } ?>

            </div>



            <!-- location: area -->

            <div class="location">

                <h2>Location</h2>



                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d189.8021914785933!2d87.98882618225787!3d26.6423460687878!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39e5baf5bbac5971%3A0xf4e38a45f65be2e7!2sBirtamode!5e1!3m2!1sen!2snp!4v1594985831778!5m2!1sen!2snp" width="100%" height="500px" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>



            </div>

            

            <div class="show-comment">

                    <h2>Comments : </h2>

                    <?php



                        $comment = $db->db_select('mail','*',"Purpose=?",array($Purpose));

                        foreach($comment as $comment){

                    ?> 

                    <div class="comment-box">

                    

                        <h3><?=$comment->Fullname?></h3>

                        <p><b>Message:</b> <?=$comment->Message?></p>

                        <?php

                            $reply = $db->db_select('reply','*','Comment_id=?',array($comment->Sn));

                            foreach($reply as $reply){

                        ?>

                        <div class="replay">

                            <p><b>Message : </b><?=$reply->Reply?></p>

                            <span class="fa fa-reply"> Reply by Admin</span>

                        </div>

                        <?php

                            }

                        ?>

                    </div>

                    <?php } ?>



            </div>

            </div>

            

            <div class="cols-4">

               

            <div class="contact-info">

                <div class="row owner-contact">

                        <img src="pictures/profile.jpg" alt="" class="cols-3">

                        <div class="cols-8">

                            <h2>L.B. Samal (<span class="nepali">/fh'</span>)</h2>

                            <p>Contact Number:</p>

                            <p> 9807999900 || 023-543876</p>

                        </div>

                    

                </div><br>

                <?php

                //    $post_id = $data->Sn;

                    require_once ("contact.php");

                ?>  

               </div>



               <div class="recent-post">

               <h2>Recent Post</h2><hr><br>

               <?php

                    $recent = $db->db_select('post_information','*',"Purpose=?",array($Purpose));

                    foreach($recent as $recent){

                        if($recent->Status=="Published"){

               ?>

               <div class="post-box cols-12" onclick="OneClick(<?=$recent->Sn?>)">

                    <div class="cols-3 recent-box">

                    <?php

                     $i = 1;

                     $img_src = $db->db_select('image_src','*','Post_id=? && Type=?',array($recent->Sn,'Profile'),'Sn DESC','0, 5');

                     // echo $db->db_count();

                     if($db->db_count()==0){

                         $img_src = $db->db_select('image_src','*','Post_id=?',array($recent->Sn));

                         foreach($img_src as $src){

                             $source = "Admin/". $src->File_name;

                         }

                     }else{

                         

                         foreach($img_src as $src){

                             if($src->Post_id == $recent->Sn){

                             $source = "Admin/".$src->File_name;

                         }

                     }

                 }

                  

                    ?>

                        <img src="<?=$source?>" alt="" height="60px" width="100%">

                     

                    </div>

                    <div class="cols-8 recent-info">

                        <h3><?=$recent->Title?></h3>

                        <table>

                            <tr>

                                <td>Location</td>

                                <td>:</td>

                                <td><?=$recent->Location?></td>

                            </tr>

                            <tr>

                                <td>Price</td>

                                <td>:</td>

                                <td><?=number_format($data->Price, 0, '', ',')?></td>

                            </tr>

                        </table>

                    </div>

                </div>

                    <?php } }?>

               </div> <!-- end recent post div !-->

               

            </div>

        </div>



        <br class="clear">

</div>





<?php

    require_once ("footer.php");



?>



