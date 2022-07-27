
function purpose(){
    var id = document.getElementById('Purpose');
    if(id.value=="Land"){
        // alert("land");
        document.getElementById('house').style="display:none";
        document.getElementById('floor').required=false;

    }
    if(id.value=="Plotting"){
        // alert('plotting');
        document.getElementById('house').style="display:none";
        document.getElementById('floor').required=false;

    }
    if(id.value=="House"){
        // alert('house');
        document.getElementById('house').style="display:block";
        document.getElementById('floor').required=true;
    }
}
purpose();
// alert('h');
// window.onload(){
//     Purpose();
// }
function changeImg(src, id){
    var main_img = document.getElementById('img1');
    var main_img_src = document.getElementById('img1').src;
    var img = document.getElementById(id);
    var img_src = document.getElementById(id).src;

    // alert(main_img);
    // img.src = main_img_src;
    main_img.src = img_src;
}

// select img
function selectImg(id){
    id.classList.toggle("selected");
    // alert(id);
}
