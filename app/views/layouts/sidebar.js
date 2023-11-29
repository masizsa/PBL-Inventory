const sidebarMenu = document.querySelectorAll(".list-menu > li > a");
const selectMenu = () => {
    sidebarMenu.forEach((element) => {
        element.addEventListener('mouseover', ({ target }) => {
            target.classList.add('hover-menu')

        })
        element.addEventListener('mouseout', ({ target }) => {
            target.style.backgroundColor = ''
            target.classList.remove('hover-menu')

        })
    })

}
selectMenu();

const urlParamsString = window.location.search;
const urlParams = new URLSearchParams(urlParamsString);
const paramValue = urlParams.get('page')
switch (paramValue) {
    case 'ajukan-peminjaman':
        sidebarMenu[0].classList.add('active-menu');
        break;
    case 'barang-dipinjam':
        sidebarMenu[1].classList.add('active-menu');
        break;
    case 'riwayat':
        sidebarMenu[2].classList.add('active-menu');
        break;
    case 'sandi':
        sidebarMenu[3].classList.add('active-menu');
        break;
    case 'keluar':
        sidebarMenu[4].classList.add('active-menu');
        break;
    default:
        break;
}
console.log(paramValue);