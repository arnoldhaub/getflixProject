

const SelectCircle = document.getElementById("circle_selected");
SelectCircle.hidden = true;
const SelectCircle2 = document.getElementById("circle_selected2");
SelectCircle2.hidden = true;
const SelectCircle3 = document.getElementById("circle_selected3");
SelectCircle3.hidden = true;
//const SearchBar = document.getElementById("container-content");
//SearchBar.hidden = true;




 if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
};

/* ========================================== 

         ↓↓↓↓  FUNCTION HOVER ↓↓↓↓↓

============================================== */

$(document).ready(function(){

    $(".choix2").hover(
        //MOUSE IN
        function () {
            if (SelectCircle.hidden == true) { 
            $("#circle_selector").css("opacity", "100%").css("transition", "50ms");
        }
        
        },
    // MOUSE OUT
    function () {
        
        $("#circle_selector").css("opacity", "0%");
        
});
	
    $(".choix3").hover(
        
        function () {
            if (SelectCircle2.hidden == true) {
                $("#circle_selector2").css("opacity", "100%").css("transition", "50ms");
            }
        },
        
        function () {
             $("#circle_selector2").css("opacity", "0%");
});
	
    $(".choix4").hover(
        function () {
            if (SelectCircle3.hidden == true) {
                $("#circle_selector3").css("opacity", "100%").css("transition", "50ms");
            
            }
        },
        function () {
    $("#circle_selector3").css("opacity", "0%");
  });


});


/* ========================================== 

        ↑↑↑↑↑  FUNCTION HOVER ↑↑↑↑

============================================== */








/* ========================================== 

        ↓↓↓↓  FUNCTION MENU DEROULANT ↓↓↓↓↓

============================================== */



$(document).ready(function () {


   const slideFade = (elem) => {
   const fade = { opacity: 0, transition: 'opacity 200ms ease-in-out' };
   elem.css(fade).slideUp();
   }; // fonction qui permet le fade OUT et qui slide up le menu
   
    const FadeOnlyOut = (elem) => {
    const fadeOpacity = { opacity: 0, transition: 'opacity 300ms ease-in-out' };
        elem.css(fadeOpacity);
    }
    
    const FadeOnlyIn = (elem) => {
    const fadeOpacityIn = { opacity: 100, transition: 'opacity 700ms ease-in-out' };
        elem.css(fadeOpacityIn);
    }

   
   const slideFadeIn = (elem) => {
   const fadeIn = { opacity: 100, transtion: 'opacity 200ms ease-in-out' };
   elem.css(fadeIn).slideDown();
   }; // fonction qui permet le fade IN et qui slide down le menu
   
    
	var clickCounter = 0; // cliques pair = menu déroulé, cliques impairs = show ONLY le choix de la section du menu
	

    
    
 	$(".choix2").click(function(){
   	 	if (clickCounter % 2 == 0){
   			$("div.container_menu > p:not(.choix2)").slideUp();
            SelectCircle.hidden = false;
            FadeOnlyIn($("#container-content"));
            $("#circle_selector").hide();
            $("#input_Search").prop('disabled', false);
            $("#movie").prop("checked", true); // permet de check le radio button onclick
            slideFade($("div.container_menu > p:not(.choix2)"));
            $("#input_Search").focus(function () {
            $(".wrapper_container_search > i").css('color', 'white');  
            });
            $("#input_Search").focusout(function () {
            $(".wrapper_container_search > i").css('color', 'gray');  
});
    		clickCounter++;
    		console.log(clickCounter);
                  } else {
            
            SelectCircle.hidden = true;          
            FadeOnlyOut($("#container-content"));
            $("#input_Search").prop('disabled', true);          
            $("#circle_selector").show();
            $("#movie").prop("checked", true); // permet de check le radio button onclick
    		$("div.container_menu > p").slideDown();
            slideFadeIn($("div.container_menu > p:not(.choix2)"));
    		clickCounter++;
    		console.log(clickCounter);
    		};
   
   
   
   });
   
   
   $(".choix3").click(function(){
       if (clickCounter % 2 == 0) {
            $("#serie").prop("checked", true); // permet de check le radio button onclick
            $("div.container_menu > p:not(.choix3)").slideUp(300);
            SelectCircle2.hidden = false;
            FadeOnlyIn($("#container-content"));
            $("#input_Search").prop('disabled', false);
            $("#circle_selector2").hide();
           slideFade($("div.container_menu > p:not(.choix3)"));
            $("#input_Search").focus(function () {
            $(".wrapper_container_search > i").css('color', 'white');  
            });
            $("#input_Search").focusout(function () {
            $(".wrapper_container_search > i").css('color', 'gray');  
});
    		clickCounter++;
    		console.log(clickCounter);
    
       } else {
            SelectCircle2.hidden = true;
            $("#circle_selector2").show();
            FadeOnlyOut($("#container-content"));
            $("#input_Search").prop('disabled', true);
            $("#serie").prop("checked", true);
    		$("div.container_menu > p").slideDown();
            slideFadeIn($("div.container_menu > p:not(.choix3)"));
    		clickCounter++;
    		console.log(clickCounter);
    		};
            
   });
   
   
     $(".choix4").click(function(){
   	 	if (clickCounter % 2 == 0){
            $("div.container_menu > p:not(.choix4)").slideUp();
            SelectCircle3.hidden = false;
            $("#circle_selector3").hide();
            FadeOnlyIn($("#container-content"));
            $("#input_Search").prop('disabled', false);
            slideFade($("div.container_menu > p:not(.choix4)"));
            $("#input_Search").focus(function () {
            $(".wrapper_container_search > i").css('color', 'white');  
            });
            $("#input_Search").focusout(function () {
            $(".wrapper_container_search > i").css('color', 'gray');  
});
    		clickCounter++;
            console.log(clickCounter);
                      
    
            } else {
            SelectCircle3.hidden = true;
            $("#circle_selector3").show();
            FadeOnlyOut($("#container-content"));
            $("#input_Search").prop('disabled', true);
    		$("div.container_menu > p").slideDown();
            slideFadeIn($("div.container_menu > p:not(.choix4)"));
    		clickCounter++;
    		console.log(clickCounter);
    		};
            
   });
   
    
});



/* ========================================== 

    ↑↑↑↑↑  FUNCTION MENU DEROULANT ↑↑↑↑

============================================== */
