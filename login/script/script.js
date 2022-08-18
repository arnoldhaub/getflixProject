$("#slideThree").on("click",function () {
  var a;
  if ($("#slideThree").is(":checked")) {
    a = "true";
      console.log("true")
      $(".toggle_remember").css({ "color": "white" });
      $(".toggle_remember").text('REMEMBER ME toggle ON');
   
  } else {
    $(".toggle_remember").css("color", "rgba(255, 255, 255, 0.2)");
      a = "false";
      $(".toggle_remember").text('REMEMBER ME toggle OFF');
    
    console.log("false");
  } // box is checked

});