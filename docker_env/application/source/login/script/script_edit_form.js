


$('#container_form_images').hide();
$('#LetMeOut').hide();
$('.svg_red_delete').hide();



$('#changeThis').click(function () {
    
    $('#container_form_edit').hide();
    $('#container_form_images').show();
    $('#LetMeOut').show();
    $('#delButton').hide();

    

});




// ARNOLD QUI ESSAYE LE JS 

$('#containerImages').click(function () {
    var checked = document.querySelector('input[name="brandtype"]:checked').value;
    document.getElementById("changeThis").src=checked;
    document.getElementById("imageProfile").value=checked;
    $('#container_form_edit').show();
    $('#container_form_images').hide();
    $('#LetMeOut').hide();
     $('#delButton').show();
    


});


    
    

$(document).ready(function () {

    $("#delButton").hover(
        //MOUSE IN
        function () {
            $('.svg_red_delete').show();
            $('.svg_white_delete').hide();
        },
        
      
        // MOUSE OUT
        function () {
            $('.svg_red_delete').hide();
            $('.svg_white_delete').show();
        
        });
    
}); 



