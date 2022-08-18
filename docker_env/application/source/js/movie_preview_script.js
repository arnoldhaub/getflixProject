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

// MODIF ARNOLD - Hover navbar

// $("#sectionUser").hover(
//     //Hover;
//     function () {
//         clearTimeout(closeTimeout);
//         document.getElementById('listePseudos').style.display = "block";
//         document.getElementById('listePseudos').style.zIndex = "5";
//         document.getElementById('fleche').className = "fa-solid fa-angle-up";
//     },
//     //Hoverout;
//     function () {
//         closeTimeout = setTimeout(function () {
//           document.getElementById('listePseudos').style.display = "none";
//           document.getElementById('listePseudos').style.zIndex = "1";
//           document.getElementById('fleche').className = "fa-solid fa-angle-down";
//         }, 1000);
//     });