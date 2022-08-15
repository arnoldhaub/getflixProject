const FadeOnlyOut = (elem) => {
    const fadeOpacity = { opacity: 0, transition: 'opacity 300ms ease-in-out' };
        elem.css(fadeOpacity);
    }
    
    const FadeOnlyIn = (elem) => {
    const fadeOpacityIn = { opacity: 100, transition: 'opacity 900ms ease-in-out' };
        elem.css(fadeOpacityIn);
    }

$('#addButton').hide();
$('#container_form').hide();
$('.profile_select').css('opacity','0%');
$('#Calque_1.test').hide()
$('#Calque_2.test').hide()
$('#Calque_3.test').hide()
$('#Calque_4.test').hide() // hide le pen de que la page est load


$('#addButton').click(function () { //appeaars when there's no account
    $('#container_form').show();
    $('#addButton').hide();
    $('.profil_un').hide();
    $('#edit').hide();

    
    
});
    
    
$(document).ready(function () {

   var clickInstance = 0;
    $('#edit').click(function () {
        if (clickInstance % 2 == 0) {
            $('#Calque_1.test').show();
            $('#Calque_2.test').show();
            $('#Calque_3.test').show();
            $('#Calque_4.test').show();
            $('#addButton').show();
            clickInstance++;
            console.log(clickInstance);
            
           
        
        } else {
            $('#Calque_1.test').hide();
            $('#Calque_2.test').hide();
            $('#Calque_3.test').hide();
            $('#Calque_4.test').hide();
            $('#addButton').hide();
            clickInstance++;
            console.log(clickInstance);   
        }


        });
    
});

  
$(window).on('load', function () {

    console.log('window loaded');
    FadeOnlyIn($(".profile_select"));
    //$('#width_image').animate({ width: "70%" });
    //$('.profil2').animate({ width: "70%" });
    //$('.profil3').animate({ width: "70%" });
    //$('.profil4').animate({ width: "70%" });

});

/* click on pen for editing username etc */

$('#Calque_1.test').click(function () {
    $('.profil_un').animate({
        opacity: '0%',
        display: 'none'
    },
        500);
    $('.profil_un').hide();
    $('#container_form').show();
    $('#addButton').hide();
     $('#edit').hide();


});

$('#Calque_2.test').click(function () {
    $('.profil_un').animate({
        opacity: '0%',
        display: 'none'
    },
        500);
    $('.profil_un').hide();
    $('#container_form').show();
     $('#addButton').hide();
     $('#edit').hide();

});

$('#Calque_3.test').click(function () {
    $('.profil_un').animate({
        opacity: '0%',
        display: 'none'
    },
        500);
    $('.profil_un').hide();
    $('#container_form').show();
     $('#addButton').hide();
     $('#edit').hide();

});

$('#Calque_4.test').click(function () {
    $('.profil_un').animate({
        opacity: '0%',
        display: 'none'
    },
        500);
    $('.profil_un').hide();
    $('#container_form').show();
     $('#addButton').hide();
     $('#edit').hide();

});




 