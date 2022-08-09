// Start - code JS pour transition de first_new_user vers seconde_who_are_you

// let first = document.querySelector(".first_new_user");
// let penIcon = document.querySelector(".icon-pen");
let seconde = document.querySelector(".seconde_who_are_you");
let defaultPic = document.querySelector(".img_creat_username_box");
let third = document.querySelector(".third_img_userprofil_choices");
let userAvatard = [...document.querySelectorAll(".box1 img")];

third.classList.add("transition_none");
defaultPic.addEventListener("click", () => {
  third.classList.remove("transition_none");
  third.classList.add("transition_flex");
});

userAvatard.forEach((element) => {
  element.addEventListener("click", () => {
    third.classList.remove("transition_flex");
    third.classList.add("transition_none");
  });
});

// first.addEventListener("click", () => {
//   first.classList.remove("transition_flex");
//   first.classList.add("transition_none");
//   seconde.classList.remove("transition_none");
//   seconde.classList.add("transition_flex");
// });

// penIcon.addEventListener("click", () => {
//   seconde.classList.remove("transition_flex");
//   seconde.classList.add("transition_none");
//   third.classList.remove("transition_none");
//   third.classList.add("transition_flex");
// });

// End- Animation JS pour passer de seconde_who_are_you à third_img_userprofil_choices au clic sur l'icion stylo
