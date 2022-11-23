let btnMenu = document.querySelector(".nav__btn");
let navList = document.querySelector(".nav__list");
btnMenu.addEventListener("click", () => {
    navList.classList.toggle('nav__list--mobile');
});
