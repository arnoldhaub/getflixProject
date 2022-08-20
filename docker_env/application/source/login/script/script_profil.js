const FadeOnlyOut = (elem) => {
    const fadeOpacity = { opacity: 0, transition: 'opacity 300ms ease-in-out' };
        elem.css(fadeOpacity);
    }
    
    const FadeOnlyIn = (elem) => {
    const fadeOpacityIn = { opacity: 100, transition: 'opacity 900ms ease-in-out' };
        elem.css(fadeOpacityIn);
    }

$('#container_form').hide();
$('#redirectMe2').hide();
$('#redirectMe4').hide();
$('#redirectMe6').hide();
$('#redirectMe8').hide();
$('.add_div').hide();



    $('#addButton').hide();
    $('.profile_select').css('opacity', '0%');
    $('#Calque_1.test').hide()
    $('#Calque_2.test').hide()
    $('#Calque_3.test').hide()
    $('#Calque_4.test').hide() // hide le pen de que la page est load



$('.add_div').click(function () {
    $('h1').html('Whats your name?');///appeaars when there's no account
    $('#container_form').show();
    $('.add_div').hide();
    $('.profil_un').hide();
    $('#edit').hide();

    function hidingTXTQuery(x) {
           
                if (x.matches) {
                    $('h1').hide();
                    console.log("test passed");
                    //$('#subButton').click(function () {
                    //    $('h1').show();
                    //});
                } else {
                    console.log("test not passed")
                }
       
                
            }
    var x = window.matchMedia("(max-width: 375px)"); // mediaQuery iPhone Se
    hidingTXTQuery(x);
    x.addEventListener(hidingTXTQuery);   
});


$('.row_images').click(function () { //hide le h1 quand on selectionne une image dans le AddUser
    $('h1').hide();
});


function getBack(){
    $('.arrowBack').click(function () {
        location.reload(true);
    });
}

    
    
$(document).ready(function () {

   var clickInstance = 0;
    $('#edit').click(function () {
        if (clickInstance % 2 == 0) {
            $('.add_div').show();
            $('#Calque_1.test').show();
            $('#Calque_2.test').show();
            $('#Calque_3.test').show();
            $('#Calque_4.test').show();
            $('#edit').html('Finish');

            $('#redirectMe1').hide(); //les redirects s'affiche et se cachent pr modifier de a href dans image_profile
            $('#redirectMe2').show();
             $('#redirectMe3').hide();
            $('#redirectMe4').show();
             $('#redirectMe5').hide();
            $('#redirectMe6').show();
             $('#redirectMe7').hide();
            $('#redirectMe8').show();
            


        
            clickInstance++;
            console.log(clickInstance);
            
           
        
        } else {
            $('#redirectMe1').show(); //les redirects s'affiche et se cachent pr modifier de a href dans image_profile
            $('#redirectMe2').hide();
             $('#redirectMe3').show();
            $('#redirectMe4').hide();
             $('#redirectMe5').show();
            $('#redirectMe6').hide();
             $('#redirectMe7').show();
            $('#redirectMe8').hide();
            $('#Calque_1.test').hide();
            $('#Calque_2.test').hide();
            $('#Calque_3.test').hide();
            $('#Calque_4.test').hide();
            $('#addButton').hide();
            $('#edit').html('Edit');
            clickInstance++;
            console.log(clickInstance);   
        }


        });
    
});

  
$(window).on('load', function () {

    console.log('window loaded');
    FadeOnlyIn($(".profile_select"));
    //$('#width_image').animate({ width: "70%" });
    //$('.profil3').animate({ width: "70%" });
    //$('.profil4').animate({ width: "70%" });

});

/* click on pen for editing username etc */

$('#Calque_1.test').click(function () {
    
});

$('#Calque_2.test').click(function () {


});

$('#Calque_3.test').click(function () {


});

$('#Calque_4.test').click(function () {
 

});


// ARNOLD QUI ESSAYE LE JS 
$('#imageProfile').hide();
$('#container_form_images').hide();

$('#changeThis').click(function () {

    document.querySelector("h1").textContent = "Choose a profile picture";
    $('h1').hide()
    $('#container_form').hide();
    $('#container_form_images').show();


});

$('#containerImages').click(function () {
    document.querySelector("h1").textContent="Who are you ?";
    var checked = document.querySelector('input[name="brandtype"]:checked').value;
    document.getElementById("changeThis").src=checked;
    document.getElementById("imageProfile").value = checked;
    $('#container_form').show();
    $('#container_form_images').hide();
    $('#LetMeOut').hide();
    
     function hidingTXTQuery(x) {
           
                if (x.matches) {
                    $('h1').hide();
                    console.log("test passed for h1");
                    //$('#subButton').click(function () {
                    //    $('h1').show();
                    //});
                } else {
                    $('h1').show();
                    console.log("test not passed")
                }
       
                
            }
    var x = window.matchMedia('(max-width: 375px)'); // mediaQuery iPhone Se
    hidingTXTQuery(x);
    x.addEventListener(hidingTXTQuery);   
    
    
    
});




 
    
       

//iPhone SE queries for profil_select


