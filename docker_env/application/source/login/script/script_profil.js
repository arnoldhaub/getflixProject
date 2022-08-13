$('#Calque_3.test').hide()

$(document).ready(function () {

   var clickInstance = 0;
    $('#edit').click(function () {
        if (clickInstance % 2 == 0) {
            $('#Calque_3.test').hide();
            clickInstance++;
            console.log(clickInstance);
        
        } else {
            $('#Calque_3.test').show();
            clickInstance++;
            console.log(clickInstance);
            
        }


        });
    
  });  

