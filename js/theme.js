document.addEventListener("DOMContentLoaded", function () {
    let menuOpen = document.querySelector('.menu-open');
    let menuClose = document.querySelector('.menu-close');
    let navWrap = document.querySelector('.nav-wrap');
    let body = document.querySelector('body');

    menuOpen.addEventListener("click", function (event) {
        event.preventDefault();
        navWrap.classList.toggle('active');
        body.classList.toggle('menu_open');
        menuOpen.setAttribute('aria-expanded',`${!(menuOpen.getAttribute('aria-expanded') === 'true')}`);
        menuClose.setAttribute('aria-expanded',`${!(menuClose.getAttribute('aria-expanded') === 'true')}`);
    });

    menuClose.addEventListener("click", function (event) {
        event.preventDefault();
        navWrap.classList.toggle('active');
        body.classList.toggle('menu_open');
        menuOpen.setAttribute('aria-expanded',`${!(menuOpen.getAttribute('aria-expanded') === 'true')}`);
        menuClose.setAttribute('aria-expanded',`${!(menuClose.getAttribute('aria-expanded') === 'true')}`);

    });

    let acTitles = document.querySelectorAll('.ac-title');
    acTitles.forEach(function (acTitle) {
        acTitle.addEventListener("click", function () {
            this.classList.toggle('active');
            this.setAttribute('aria-expanded',`${!(menuClose.getAttribute('aria-expanded') === 'true')}`);
            let acContent = this.nextElementSibling;
            acContent.style.display = acContent.style.display === "none" ? "block" : "none";
        });
    });


    let subToggles = document.querySelectorAll('.sub-toggle');
    subToggles.forEach(function (subToggle) {
        subToggle.addEventListener("click", function (event) {
            event.preventDefault();
            let parent = this.parentNode;
            parent.classList.toggle('active');
        });
    });

});