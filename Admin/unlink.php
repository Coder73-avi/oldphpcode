<?php 


 require_once ('include/initialization.php'); 


 Session::start();


 $db = Database::instantiate();





if(isset($_GET['unlink'])){


    $sn = $_GET['unlink'];


    $edit = $_GET['Sn'];


    $src = $db->db_select('image_src','*','Sn=?',array($sn));


    foreach($src as $src){


        $unlink = $src->File_name;


        unlink($unlink);


    }





    


    if($unlink){


        $db->db_delete('image_src',"Sn=?",array($sn));


        //    Session::sess_set("message_success", "Delete Successfully.");


           redirect_to('index.php?file=post&&sub_file=post-new&&Sn='.$edit);


     


    }


    





}
if(isset($_GET['video'])){
    if(isset($_GET['Sn'])){
        $db->db_delete('video_link',"Sn=?",array($_GET['Sn']));
        redirect_to('index.php?file=post&&sub_file=post-new&&Sn='.$_GET['video']);

    }
}





?>