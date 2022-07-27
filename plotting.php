<div class="plotting-contener">

<h2 >Plotting List</h2>  

<?php

    // require_once ("nav.php");



    $post=$db->db_select('post_information','*','Purpose=? && Status=?',array('Plotting','Published'));

    $a = 0;

   foreach($post as $post){

       

?>



<div class="row plotting" >

             

                <h2><?=$post->Title?></h2>


             <div class="">


             <div class="mySlides">

                 <img src="" style="width:100%" height="" id="img_src<?=$a?>" alt="main_img">

             </div>

         

          

         

             <div class="caption-container">

                 <p id="caption" class="nepali"><?=$post->Discription?></p>

             </div>

         

             <div class="row">

                 <?php

                     $image =$db->db_select('image_src','*','Post_id=?',array($post->Sn),null,"1,5");

                    $i = 0;

                     foreach($image as $image){

                         $i +=1;

                         

                 ?>

                     <div class="column">

                         <img class="demo cursor" id="img<?=$a.$i?>" src="Admin/<?=$image->File_name?>" style="width:100%" onclick="selectImg('img_src<?=$a?>','img<?=$a.$i?>')" alt="">

                     </div>

                 <?php } ?>

             </div>

            

                       

                 

        </div> <!-- contaner div !-->
        <br>
        
         <a href="landInformation.php?Sn=<?=$post->Sn?>" class="see-more">See More <i class="fas fa-arrow-right"></i></a>

                 

    </div> <!-- plotting div !-->

    <br>

                     <?php $a +=1;} ?>







</div><!-- end plotting contener !-->

         