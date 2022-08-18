


$('#container_form_images').hide();
$('#LetMeOut').hide();


$('#changeThis').click(function () {
    
    $('#container_form_edit').hide();
    $('#container_form_images').show();
    $('#LetMeOut').show();

    

});


$('#LetMeOut').click(function () {
    $('#container_form_edit').show();
    $('#container_form_images').hide();
    
});

// ARNOLD QUI ESSAYE LE JS 

$('#containerImages').click(function () {
    var checked = document.querySelector('input[name="brandtype"]:checked').value;
    document.getElementById("changeThis").src=checked;
    document.getElementById("imageProfile").value=checked;
    $('#container_form_edit').show();
    $('#container_form_images').hide();
    $('#LetMeOut').hide();


});


