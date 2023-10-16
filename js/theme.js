document.addEventListener("DOMContentLoaded", function () {
    let menuOpen = document.querySelector('.menu-open');
    let menuClose = document.querySelector('.menu-close');
    let navWrap = document.querySelector('.nav-wrap');
    let body = document.querySelector('body');

    menuOpen.addEventListener("click", function (event) {
        event.preventDefault();
        navWrap.classList.toggle('active');
        body.classList.toggle('menu_open');

        console.log('OK');
    });

    menuClose.addEventListener("click", function (event) {
        event.preventDefault();
        navWrap.classList.toggle('active');
        body.classList.toggle('menu_open');

        console.log('OK');
    });

    let acTitles = document.querySelectorAll('.ac_title');
    acTitles.forEach(function (acTitle) {
        acTitle.addEventListener("click", function () {
            this.classList.toggle('active');
            let acContent = this.nextElementSibling;
            acContent.style.display = acContent.style.display === "none" ? "block" : "none";
        });
    });
});