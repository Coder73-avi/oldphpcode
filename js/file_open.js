
function OneClick(data){
        window.location.href="landInformation.php?Sn=" + data;
}



function changeImg(src, id){
        var main_img = document.getElementById('img1');
        var main_img_src = document.getElementById('img1').src;
        var img = document.getElementById(id);
        var img_src = document.getElementById(id).src;

        // alert(main_img);
        // img.src = main_img_src;
        main_img.src = img_src;

}
document.getElementById("Admin").addEventListener("dblclick", myFunction);
// document.getElementById("Admin").addEventListener("click", homepage);

function homepage(){
        window.location.href="index.php";
}

function myFunction(){ 
        window.location.href="index.php?Admin";

} 

