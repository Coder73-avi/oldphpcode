// show responsive menu script

 

function showSubmit(){

    var iframe = document.getElementById('iframe');

    iframe.style="display:block";

}

function exit(id) {

    var data = document.getElementById(id);

    data.style="display:none";



}



window.onscroll = function() {myFunction()};



var navbar = document.getElementById("navbar");

var sticky = navbar.offsetTop;



function myFunction() {

  if (window.pageYOffset >= sticky) {

    navbar.classList.add("sticky")

  } else {

    navbar.classList.remove("sticky");

  }

}



//plotting 



function selectImg(img_src="",current="",totalPlotting=""){

  if(img_src=="" || current==""){

    for(var i=0;i < totalPlotting; i++){

      var x = "img_src"+i;

      var y = "img"+i+"1";

    

      var mainImg = document.getElementById(x);

      var ImgSrc = document.getElementById(y);

      mainImg.src = ImgSrc.src;

    }

  }else{

    var mainImg = document.getElementById(img_src);

    var Img = document.getElementById(current);

    mainImg.src = Img.src;

    

  }

}



function homeImg(img_src,current){

 

    var mainImg = document.getElementById(img_src);

    var Img = document.getElementById(current);

    mainImg.src = Img.src;

  

}



