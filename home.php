

<!-- slider -->



<div class="galleryContainer">

    <div class="slideShowContainer">

        <div onclick="plusSlides(-1)" class="nextPrevBtn leftArrow"><span class="arrow arrowLeft"></span></div>

        <div onclick="plusSlides(1)" class="nextPrevBtn rightArrow"><span class="arrow arrowRight"></span></div>

        <div class="captionTextHolder"><p class="captionText slideTextFromTop"></p></div>

       
        <div class="imageHolder">

            <img src="pictures/slider-1.jpg">

            <p class="captionText"></p>

        </div>
        <div class="imageHolder">

            <img src="pictures/example.jpg">

            <p class="captionText"></p>

        </div>

<?php
 $db = Database::instantiate();


    $imgname = $db->db_select('image_src','*','Slider=?',array('Yes'));

    foreach($imgname as $name){

        $caption = $db->db_select('post_information','*','Sn=?',array($name->Post_id));

        foreach($caption as $caption){

            $postId = $name->Post_id;

?>

        <div class="imageHolder">

            <img src="Admin/<?=$name->File_name?>">

            <p class="captionText"> <a href="landInformation.php?Sn=<?=$postId?>"><?=$caption->Title?></a></p>

        </div>

  <?php

        }

    }

  ?>



    </div>

    <div id="dotsContainer"></div>

</div>



<br>

<br>



<div class="main-container">

   

        <h2>Leatest Land List:</h2>

            <div class="leatest-property row">

            

            <?php

                $data = $db->db_select('post_information','*','Purpose=?',array("Land"),'Sn DESC','0,7');

                foreach($data as $data){

                    $id = $data->Sn;

                    $source = "";

                    if($data->Status!=="Requested" && $data->Status!=="Unpublished"){





                    $img_src = $db->db_select('image_src','*','Post_id=? && Type=?',array($id,'Profile'));

                    // echo $db->db_count();

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

                   <div class="cols-12">

                    <a href="index.php?file=land&&type=buy&&a=1" class="see-more">See More <i class="fas fa-arrow-right"></i></a>

                    </div>

    </div>





</div>

<div class="main-container">

    <h2>Leatest Ploting area</h2>

    

    <?php

    // require_once ("nav.php");



    $post=$db->db_select('post_information','*','Purpose=? && Status=?',array('Plotting','Published'),null,"0,2");

    $a = 0;

   foreach($post as $post){

       

?>



<div class="row plotting" >

             



             <div class="">

                

             <div class="mySlides">

                 <img src="" style="width:100%" height="" id="img_src<?=$a?>" alt="main_img">

             </div>

         

          

         

             <div class="caption-container">

                 <p id="caption" class="nepali"><?=$post->Discription?></p>

             </div>

         

             <div class="row">

                 <?php

                     $image =$db->db_select('image_src','*','Post_id=?',array($post->Sn),null,"0,4");

                    $i = 0;

                     foreach($image as $image){

                         $i +=1;

                         

                 ?>

                     <div class="column">

                         <img class="demo cursor" id="img<?=$a.$i?>" src="Admin/<?=$image->File_name?>" style="width:100%" onclick="selectImg('img_src<?=$a?>','img<?=$a.$i?>')" alt="">

                     </div>

                 <?php } ?>

             </div>
                <br>
                <a href="landInformation.php?Sn=<?=$post->Sn?>" class="see-more">See More <i class="fas fa-arrow-right"></i></a>


                       

                 

        </div> <!-- contaner div !-->

         

                 

    </div> <!-- plotting div !-->

    <br>

                     <?php $a +=1;} ?>





        

</div>







<div class="owner-info row">

    <h2 align="center">Owner Information: </h2>

    

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

    



       







</div>





<br class="clear">