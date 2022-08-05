// Start - code JS pour transition de first_new_user vers seconde_who_are_you

let first = document.querySelector(".first_new_user");
let seconde = document.querySelector(".seconde_who_are_you");

first.addEventListener("click", () => {
  first.classList.add("transition_none");
  seconde.classList.add("transition_flex");
});

// End - code JS pour transition de first_new_user vers seconde_who_are_you

// Start - Animation JS pour passer de seconde_who_are_you à third_img_userprofil_choices au clic sur l'icion stylo

// let seconde = document.querySelector(".seconde_who_are_you");
// let third = document.querySelector(".third_img_userprofil_choices");
// let penIcon = document.querySelector(".icon-pen");

// penIcon.addEventListener("click", () => {
//   seconde.classList.add("transition_none");
// });

// End- Animation JS pour passer de seconde_who_are_you à third_img_userprofil_choices au clic sur l'icion stylo
