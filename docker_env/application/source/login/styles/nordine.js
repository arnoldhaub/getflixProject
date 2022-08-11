// Start - code JS pour transition de first_new_user vers seconde_who_are_you

let seconde = document.querySelector(".seconde_who_are_you");
let defaultPic = document.querySelector(".default_image");
let third = document.querySelector(".third_img_userprofil_choices");
let userAvatard = [...document.querySelectorAll(".box1 img")];
let buttons1 = document.querySelector(".guillaume_box");

third.classList.add("transition_none");
defaultPic.addEventListener("click", () => {
  buttons1.classList.remove("transition_flex");
  buttons1.classList.add("transition_none");
  third.classList.remove("transition_none");
  third.classList.add("transition_flex");
});

userAvatard.forEach((element) => {
  element.addEventListener("click", () => {
    third.classList.remove("transition_flex");
    third.classList.add("transition_none");
    buttons1.classList.remove("transition_none");
    buttons1.classList.add("transition_flex");
  });
});

// End- Animation JS pour passer de seconde_who_are_you à third_img_userprofil_choices au clic sur l'icion stylo
