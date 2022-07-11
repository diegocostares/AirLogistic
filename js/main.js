// ---------- SCRIPT PARA MENU RESPONSIVE --------------------------------
const showMenu = (toggleId, navId) => {
    const toggle = document.getElementById(toggleId),
        nav = document.getElementById(navId)
    if (toggle && nav) {
        toggle.addEventListener('click', () => {
            nav.classList.toggle('show')
        })

        nav.addEventListener('click', e => {
            let el = e.target
            if (el.tagName == 'A') {
                nav.classList.toggle('show')
            }
        })
    }

}

showMenu('navbar-menu-mobile', 'navbar-container')

// ---------- SCRIPT PARA HOME --------------------------------
let skys = document.getElementById('skys');
let edicios = document.getElementById('edicios');
let text = document.getElementById('text');
let avion_1 = document.getElementById('avion_1');
let avion_2 = document.getElementById('avion_2');

window.addEventListener('scroll', function() {
    let scroll = window.scrollY;
    skys.style.left = -scroll / 2 + 'px';
    edicios.style.marginLeft = scroll / 4 + 'px';
    edicios.style.marginTop = scroll / 8 + 'px';
    text.style.marginLeft = scroll / 2 + 'px';
    text.style.marginTop = scroll + 'px';
    avion_1.style.marginLeft = scroll / 2 + 'px';
    avion_1.style.marginTop = scroll / 2 + 'px';
    avion_2.style.marginLeft = scroll / 2 + 'px';
    avion_2.style.marginTop = -scroll / 8 + 'px';
    // calle.style.top = scroll * 0 + 'px';
});