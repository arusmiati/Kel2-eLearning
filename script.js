$(".toggle-password-icon").click(function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
    input.attr("type", "text");
    } else {
    input.attr("type", "password");
    }
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