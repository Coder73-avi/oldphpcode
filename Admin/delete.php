<?php

    require_once ('include/initialization.php');

    Session::start();

    $db = Database::instantiate();



    if(isset($_GET['delete'])){



        $sn = $_GET['Sn'];

        $tbname = $_GET['delete'];

        $link = $_GET['link'];


        // delete image src or file
if($tbname=="post_information"){

        $img = $db->db_select('image_src','*','Post_id=?',array($sn));
        if($db->db_count() !==0){
          foreach($img as $img_src){
            $filename = $img_src->File_name;
            unlink($filename);
          }
          $db->db_delete('image_src',"Post_id=?",array($sn));

        }
  }

           $db->db_delete($tbname,"Sn=?",array($sn));

           Session::sess_set("message_success", "Delete Successfully.");

           redirect_to('index.php?file='.$link);



    }



?>