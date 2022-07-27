<div class="row about-div">

<div class="about"><br><br>

<div class="cols-6">
    <h1>About Us</h1><br>
    <p>
    <span class="nepali">
    ca ljtf{df]8 emfkfdf 3/ hUufsf] laZjfl;nf] e/kbf{] Jojl:yt / j}1flgs tl/sfn] plrt d'Nodf vl;b las|L ug{sf] nflu
     </span>Samal Group Real Estate
     <span class="nepali"> nfO{ ;Demg'xf]; .
    </span>
    </p>
    </div>
    <div class="cols-5">
        <img src="https://images.pexels.com/photos/3184296/pexels-photo-3184296.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="" srcset="" width="100%">
    </div>
        <br class="clear"><br><br>
    <div class="cols-6">
        <img src="pictures/office.jpg" alt="picture" width="90%" height="">
    </div>
    <div class="service cols-5">
    <h1>Our Services <span class="nepali"> xfd|f ;]jfx? </span></h1><br>
    <p>
        <span class="nepali">
        hUuf Knl6ª, vl/b ljs|L ;fy} 3/ vl/b las|L, 3/ ef8f tyf lnh . 
        </span>
    </p>
    </div>
    <br class="clear">
    <br><br>
    <h1>Contact Office</h1>
    <hr width="50%"><br>
    <p class="office-address">Near Gorkha Super Market Sanischare road Birtamode-5 Jhapa<br/> Contact Number: 023-543876 || 9842755058 - 9807999900 <br/>
    
    </p>
    <img src="https://upload.wikimedia.org/wikipedia/commons/2/23/Emblem_of_Nepal.svg" alt="" height="100px">
    <span>Authorized by Goverment of Nepal</span>
</div><br>
        <h1 class="our-T">Our Team</h1><br>
        <div class="container row">
        <?php
        $data = $db->db_select('partner_info');
    // $data = array(1,2,3,4);
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