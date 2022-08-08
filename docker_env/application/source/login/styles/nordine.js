// Start - code JS pour transition de first_new_user vers seconde_who_are_you

let first = document.querySelector(".first_new_user");
let seconde = document.querySelector(".seconde_who_are_you");
let third = document.querySelector(".third_img_userprofil_choices");
let penIcon = document.querySelector(".icon-pen");

first.addEventListener("click", () => {
  first.classList.remove("transition_flex");
  first.classList.add("transition_none");
  seconde.classList.remove("transition_none");
  seconde.classList.add("transition_flex");
});

penIcon.addEventListener("click", () => {
  seconde.classList.remove("transition_flex");
  seconde.classList.add("transition_none");
  third.classList.remove("transition_none");
  third.classList.add("transition_flex");
});

// End- Animation JS pour passer de seconde_who_are_you à third_img_userprofil_choices au clic sur l'icion stylo
