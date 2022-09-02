const el = document.getElementById('playButton');
$("#notListed").css("opacity", "50%");



el.addEventListener('mouseenter', changeColorIcon);
el.addEventListener('mouseleave', changeColorIconWhite);

function changeColorIcon() {
    const playIcon = document.getElementById('fa-play');
    playIcon.style.color = "#27242B";
};

function changeColorIconWhite() {
    const playIcon = document.getElementById('fa-play');
    playIcon.style.color = "white";
};


// SCRIPT - Video YouTube

$(document).ready(function() {
    var $videoSrc;
    $(".video-btn").click(function() {
        $videoSrc = $(this).data("src");
    });
    $("#myModal").on("shown.bs.modal", function(e) {
        $("#video").attr(
            "src",
            $videoSrc + "?autoplay=1&amp;showinfo=0"
        );
    });
    $("#myModal").on("hide.bs.modal", function(e) {
        $("#video").attr("src", ""); // Remove the video source.
    });
});


// JS GUILLAUME

// HEADER

let champPseudo = document.getElementById('sectionUser');

champPseudo.onmouseover = () => {
    clearTimeout(closeTimeout);
    document.getElementById('fleche').className = "fa-solid fa-angle-up";
    document.getElementById('listePseudos').style.display = "block";
  
  }
  
  champPseudo.onmouseout = () => {
    closeTimeout = setTimeout(function () {
      document.getElementById('fleche').className = "fa-solid fa-angle-down";
      document.getElementById('listePseudos').style.display = "none";
    }, 1000);
  }


// L I S T I N G // 

$("#listed2").hide()
$("#notListed").hover(function() {
    $("#notListed").css("opacity", "100%");
}, function() {
    $("#notListed").css("opacity", "50%");
   
});

$("#listed").hover(function () {
    $("#listed").hide();
    $("#listed2").show();
}, function() {
    $("#listed").show();
    $("#listed2").hide()

});
