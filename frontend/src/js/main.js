const userProfile = document.querySelector('.user-profile');
const userMenu = document.querySelector('.user-menu') ?? null;
const body = document.querySelector('body') ?? null;


if(userProfile) {

userProfile.addEventListener('click', e => {
    if (userMenu.classList.contains('opacity-0')) {
        e.stopPropagation()
    }
    openUserMenu()
} );

function openUserMenu() {
    if (userMenu === null) return
    userMenu.classList.remove('opacity-0');
    userMenu.classList.remove('pointer-events-none');
    userMenu.addEventListener('click', e => e.stopPropagation());
    body.addEventListener('click', closeUserMenu);
}

function closeUserMenu() {
    if(userMenu === null) return
    userMenu.classList.add('opacity-0');
    userMenu.classList.add('pointer-events-none');
}

}

//Slider index
const swiper = new Swiper('.swiper', {
    slidesPerView: 1,
    spaceBetween: 20,
    loop: true,

    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },

    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },

    breakpoints: {
        768: {  // Tablet
            slidesPerView: 3,
        },
        1024: { // Desktop
            slidesPerView: 3,
        },
    },
});