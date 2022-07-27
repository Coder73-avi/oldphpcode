

<h2>Requested Post: </h2>

<?=showError()?>

<table class="table">

        <tr>

            <th>Sn</th>

            <th>Full Name</th>

            <th>Email</th>

            <th>Location</th>

            <th>Status</th>

            <th>Type of post</th>

            <th>Post Date</th>

            <th>Action</th>

        </tr>

        <?php

        $data = $db->db_select('post_information','*',"Status=?",array("Requested"),"Sn DESC");

        $sn = 0;

        foreach($data as $tb_name){  

            $sn =  1 + $sn;      

        ?>

        <tr>

           <td><?=$sn?></td>

           <td><?=$tb_name->Fullname?></td>

           <td><?=$tb_name->Email?></td>

           <td><?=$tb_name->Location?></td>

           <td><?=$tb_name->Status?></td>

           <td><?=$tb_name->Purpose?></td>

           <td><?=$tb_name->Upload_time?></td>

           <td><a href="index.php?file=post&&sub_file=post-new&&Sn=<?=$tb_name->Sn?>" class="fa fa-edit"></a> <a href="delete.php?Sn=<?=$tb_name->Sn?>&&link=request_post&&delete=post_information" class="fa fa-trash"></a></td>



        </tr>

        <?php }  ?>



</table>