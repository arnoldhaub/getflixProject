const swiper = new Swiper(".swiper-container", {
  slidesPerView: 5,
  slidesPerGroup: 1,
  centeredSlides: true,
  loop: false,
  navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    breakpoints: {
        100: {
      slidesPerView: 3,
      slidesPerGroup: 1,
      spaceBetween: 0,
      centeredSlides: false
      
      },
        400: {
      slidesPerView: 4,
      slidesPerGroup: 1,
      spaceBetween: 40,
      centeredSlides: false
      
      },
           462: {
      slidesPerView: 6,
      slidesPerGroup: 1,
      spaceBetween: 40,
      centeredSlides: false
      
    },
    // when window width is >= 600px
    600: {
      slidesPerView: 5,
      slidesPerGroup: 1,
      spaceBetween: 5,
      centeredSlides: false
      
    },
     // when window width is >= 900px
     900: {
      slidesPerView:5,
      slidesPerGroup: 1,
      spaceBetween: 0,
       centeredSlides: false
      
      },
      1000: {
      slidesPerView:5,
      slidesPerGroup: 1,
      spaceBetween: 5,
       centeredSlides: false
      
      },
        1024: {
      slidesPerView:5,
      slidesPerGroup: 1,
      spaceBetween: 5,
       centeredSlides: false
      
    },
    // when window width is >= 1200px
    1200: {
      slidesPerView: 5,
      slidesPerGroup: 1,
      spaceBetween: 5,
      centeredSlides: false
    },
     
     // when window width is >= 1500px
     1500: {
       slidesPerView: 5,
       slidesPerGroup: 1,
       spaceBetween: 5,
       centeredSlides: false
      },
     
     
     // when window width is >= 1800px
    1800: {
      slidesPerView: 5,
      slidesPerGroup: 1,
      spaceBetween: 5,
      centeredSlides: false
    }
    
  }
});



// JS GUILLAUME
// HEADER

let champPseudo = document.getElementById('sectionUser');

champPseudo.onmouseover = () => {
  document.getElementById('fleche').className = "fa-solid fa-angle-up";
  document.getElementById('listePseudos').style.display = "block";

}

champPseudo.onmouseout = () => {
  document.getElementById('fleche').className = "fa-solid fa-angle-down";
  document.getElementById('listePseudos').style.display = "none";
}