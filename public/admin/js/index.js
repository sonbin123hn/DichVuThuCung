$('.logo-slider').slick({
    slidesToShow:5,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    infinite: true ,
    autoplayHoverPause:false,
    mobileFirst: true,
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 5,
                slidesToScroll: 1,
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 1,
            }
        },
        {
            breakpoint: 576,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
        }

  ]
});

$(document).ready(function(){
    $("#email").keyup(function(){
        if(validateEmail()){
            $("#email").css("border","2px solid green");
            $("#emailMsg").html("<p class='text-success'>Validated</p>");
        }else{
            $("#email").css("border","2px solid red");
            $("#emailMsg").html("<p style='width:100%' sty class='text-danger'>Un-validated</p>");
        }
    });
    $("#pass").keyup(function(){
        if(validatePassword()){
            $("#pass").css("border","2px solid green");
            $("#passMsg").html("<p class='text-success'>Password validated</p>");
        }else{
            $("#pass").css("border","2px solid red");
            $("#passMsg").html("<p class='text-danger'>Password not valid</p>");
        }
       
    });
});

function validateEmail(){
    var email=$("#email").val();
     var reg = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/
     if(reg.test(email)){
         return true;
     }else{
         return false;
     }

}
function validatePassword(){
   
    var pass=$("#pass").val();
   
    if(pass.length > 6){
        return true;
    }else{
        return false;
    }

}