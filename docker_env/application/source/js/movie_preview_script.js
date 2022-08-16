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


