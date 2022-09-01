const el = document.getElementById('playButton');



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



$("#notListed").hover(function() {
    $("#notListed").removeClass("fa-regular fa-fade");
    $("#notListed").addClass("fa-solid");
}, function() {
    $("#notListed").removeClass("fa-solid");
    $("#notListed").addClass("fa-regular");
});

$("#listed").hover(function() {
    $("#listed").removeClass("fa-solid");
    $("#listed").addClass("fa-regular");
}, function() {
    $("#listed").removeClass("fa-regular");
    $("#listed").addClass("fa-solid");
});
