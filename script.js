$(".toggle-password-icon").click(function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
    input.attr("type", "text");
    } else {
    input.attr("type", "password");
    }
 });

 $(document).on('click', (".nav-item"), function(){
     $this.addClass('active').siblings().removeClass('active')
 })


 $(".toggle-filter").click(function(){
    $(this).toggleClass("fa-angle fa-angle-up");

    let button = document.querySelector('.toggle-filter');
    let list = document.querySelector('.filter');

    button.addEventListener('click', () => {
        if(list.style.display === 'none'){
            dispatchEvent.style.display = 'block';
            $(this).toggleClass("fa fa-angle-up");
        }else{
            list.style.display = 'none';
        }
    });
 });

var tabs = document.querySelectorAll('.tabs-toggle');
var contents = document.querySelectorAll('.tabs-content');

tabs.forEach((tab, index) => {
    tab.addEventListener('click', () => {
        contents.forEach((content) => {
            content.classList.remove('is-active');
        });
        tabs.forEach((tab) => {
            tab.classList.remove('is-active');
        });

        contents[index].classList.add('is-active');
        tabs[index].classList.add('is-active');
    });
});

 var btnContainer = document.getElementById("navbarNav");
 var btns = btnContainer.getElementsByClassName("btn");

 for(var i = 0; i<btns.length; i++){
     btns[i].addEventListener('click', function(){
         var current = document.getElementsByClassName("active");
         current[0].className = current[0].className.replace("active");
         this.className += "active";
     })
 }

 var iconContainer = document.getElementById("sidebar");
 var icons = iconContainer.getElementsByClassName("icon");

 for(var i = 0; i<btns.length; i++){
     icons[i].addEventListener('click', function(){
         var current = document.getElementsByClassName("active");
         current[0].className = current[0].className.replace("active");
         this.className += "active";
     })
 }

var c = 0;
function LogConfirm() {
    if (c == 0) {
        document.getElementById("confirm-box").style.display = "block"
        c = 1;
    }
    else {
        document.getElementById("confirm-box").style.display = "none"
        c = 0;
    }
}


c = 0;
function PG(){
    if (c == 0 ){
        document.getElementsByClassName("radio").style.display = "block";
        document.getElementsByClassName("paragraf").style.display = "none";
        c = 1;
    } else{
        document.getElementsByClassName(".radio").style.display = "none"
        c = 0;
    }
}

function TEKS(){
    if (c == 0 ){
        document.getElementsByClassName(".paragraf").style.display = "block";
        document.getElementsByClassName(".radio").style.display = "none"
        
        c = 1;
    } else{
        document.getElementsByClassName(".paragraf").style.display = "none"
        c = 0;
    }
}



function pg(){
    if(c = 1) {
        document.getElementById("soal-default1").style.display = "block"
        document.getElementById("soal-default2").style.display = "none"
        document.getElementById("add-opsi").style.display = "block"
        c = 1;
    } else{
        document.getElementById("soal-default1").style.display = "block"
        c = 0;
    }
}

function essay(){
    if(c = 1) {
        document.getElementById("soal-default2").style.display = "block"
        document.getElementById("soal-default1").style.display = "none"
        document.getElementById("add-opsi").style.display = "none"
        c = 1;
    } else{
        document.getElementById("soal-default2").style.display = "none"
        c = 0;
    }
}


function addoptions() {
    $('#soal-default1').append('<div>'
     + '<input type="radio" name="mytext[]" class="opsi">'
     + ' <input type="text" placeholder="Opsi" class="keterangan">' 
     + '<button class="remove" onclick="remove(this)"><i class="fa fa-close"></i></button>' 
     + "</div>");
}
  
function remove(btn) {
    ((btn.parentNode).parentNode).removeChild(btn.parentNode);
}



