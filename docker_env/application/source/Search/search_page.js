/* ========================================== 

         ↓↓↓↓  FUNCTION HOVER ↓↓↓↓↓

============================================== */

const SelectCircle = document.getElementById("circle_selected");
SelectCircle.hidden = true;
const SelectCircle2 = document.getElementById("circle_selected2");
SelectCircle2.hidden = true;
const SelectCircle3 = document.getElementById("circle_selected3");
SelectCircle3.hidden = true;
const SearchBar = document.getElementById("container-content");
SearchBar.hidden = true;


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
   
   
   const slideFadeIn = (elem) => {
   const fadeIn = { opacity: 100, transtion: 'opacity 200ms ease-in-out' };
   elem.css(fadeIn).slideDown();
   }; // fonction qui permet le fade IN et qui slide down le menu
   
    
	var clickCounter = 0; // cliques pair = menu déroulé, cliques impairs = show ONLY le choix de la section du menu
	

    
    
 	$(".choix2").click(function(){
   	 	if (clickCounter % 2 == 0){
   			$("div.container_menu > p:not(.choix2)").slideUp();
            SelectCircle.hidden = false;
            $("#circle_selector").hide();
            SearchBar.hidden = false;
            slideFadeIn($("container-content"));
            $("#movie").prop("checked", true); // permet de check le radio button onclick
            slideFade($("div.container_menu > p:not(.choix2)"));
            
    		clickCounter++;
    		console.log(clickCounter);
    
            } else {
            SelectCircle.hidden = true;
            
            slideFade($("container-content"));
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
            $("#circle_selector2").hide();
            slideFade($("div.container_menu > p:not(.choix3)"));
    		clickCounter++;
    		console.log(clickCounter);
    
       } else {
            SelectCircle2.hidden = true;
            $("#circle_selector2").show();
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
            slideFade($("div.container_menu > p:not(.choix4)"));
    		clickCounter++;
    		console.log(clickCounter);
    
            } else {
            SelectCircle3.hidden = true;
            $("#circle_selector3").show();
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