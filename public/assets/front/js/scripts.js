let menuButton = document.querySelector('.menu_btn');

menuButton.addEventListener('click', event => {
    event.preventDefault();
    toggleMenu();
});

function toggleMenu() {
    let mainNav = document.querySelector('.main_nav');
    /* let inst = document.querySelector('.header__institution'); */

    menuButton.classList.toggle('menu_btn--active');
    mainNav.classList.toggle('main_nav--active');
}


let mainNavItemParent = document.querySelector('.main_nav__item--parent');
mainNavItemParent.addEventListener('click', event => event.target.preventDefault());


let sidebarMenuParentItems = document.querySelectorAll('.sidebar_menu__item--parent i');

sidebarMenuParentItems.forEach(item => {
    item.addEventListener('click', event => {
        event.currentTarget.parentElement.nextElementSibling.classList.toggle('sidebar_submenu--active');
    })
})

let scrollToTopButton = document.querySelector('.scroll_to_top_button--hidden');

if(scrollToTopButton){
    window.addEventListener('scroll', ()=>{
        let y = window.scrollY;
        if (y > 10) {
            scrollToTopButton.className = "scroll_to_top_button";
        } else {
            scrollToTopButton.className = "scroll_to_top_button--hidden";
        }
    })

    scrollToTopButton.addEventListener('click', () =>{
        scrollTo({ top: 0, behavior: 'smooth' })
    })
}
