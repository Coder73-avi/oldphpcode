
<?php
require_once ("include/User.php");
if(isset($_GET['changePwd'])){
    if(isset($_POST['changePassword'])){
        unset($_POST['changePassword']);
        $changepwd = new updatePwd;
        $changepwd->Change($_POST);
    }
?>
<div class="pwd-div">
    <form action="" method="post" class="changePwd">
        <a href="index.php?file=user" class="fa fa-long-arrow-alt-left"></a><br>
        <?=showError()?>
        <br>
        <input type="password" name="oldPassword" value="<?=Form_data('oldPassword')?>" id="" placeholder="Old Password"><br>
        <input type="password" name="Password" id="" placeholder="New Password" value="<?=Form_data('Password')?>" ><br>
        <input type="password" name="Cpassword" id="" placeholder = "Confirm Password" value="<?=Form_data('Cpassword')?>" ><br>
        <button type="submit" name="changePassword">Chanage</button><br>
    </form>
</div>
<?php 
}
?>


<div class="user-info">

    <form action="" method="post" class="user-form"  enctype="multipart/form-data">
        <h2>User Information</h2>
        
        <?php
        require_once ("login_request.php");//check session is create or not
        
        $data = $db->db_select('users_info','*');
        foreach($data as $user){
    
        if(isset($_POST['update_user'])){
            unset($_POST['update_user']);
            $User = new User;
            if(password_verify($_POST['Password'], $user->Password)){
                $User->userUpdate($_POST,$_FILES,$user->Sn);
            }else{
                Session::sess_set('message_error',"Incorrect Password.");
            }
            
        }

?>
        <?=showError()?>
        <table>
            
            <tr>
                <td><label for="Site-name">Site Name :</label></td>
                <td><input type="text" name="Site_name" id="Site-name" required value="<?=$user->Site_name?>"></td>
            </tr>
            <tr>
                <td><label for="Contact">Contact Number :</label></td>
                <td><input type="text" name="Contact" id="Contact" required value="<?=$user->Contact?>"></td>
            </tr>
            <tr>
                <td><label for="Address">Address :</label></td>
                <td><input type="text" name="Address" id="Address" required value="<?=$user->Address?>"></td>
            </tr>
            <tr>
                <td><label for="Email">Email Id : </label></td>
                <td><input type="email" name="Email" id="Email" required value="<?=$user->Email?>"></td>
            </tr>
            <tr>
                <td>Choose your upload logo : </td>
                <td><label for="logo-upload" class="upload-btn"><i class="fa fa-image"></i> Add logo </label></td>
               <input type="file" name="file" id="logo-upload">
            </tr>
            <tr>
                <td><label for="Username">Username : </label></td>
                <td><input type="text" name="Username" id="Username" required value="<?=$user->Username?>"></td>
            </tr>
            <tr>
                <td><label for="Pwd">Password : </label></td>
                <td><input type="password" name="Password" id="Pwd" required></td>
            </tr>
            
            <tr>
                <td></td>
                <td><button type="submit" class="update-users" name="update_user">Update Users</button></td>
            </tr>
            <tr>
                <td><a href="index.php?file=user&&changePwd">Do you want to change password ?</a><td>
            </tr>
                <?php } ?>
        </table>
       
        
    </form>

</div>