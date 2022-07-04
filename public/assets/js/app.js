
//search form and lens button
let searchForm = document.getElementById('searchForm');
let searchButton = document.getElementById('searchLogo');


//send form onclick of the searchlogo
searchButton.addEventListener('click', () => {searchForm.submit();});



const menuButton = document.querySelector('.menu-btn');
const hamburger = document.querySelector('.menu-btn_burger');
// const nav = document.querySelector('.navbar');
const menuNav = document.querySelector('.menu-nav');
const navItems = document.querySelectorAll('.dropdownMenu')

let showMenu = false;

menuButton.addEventListener('click', toggleMenu);

function toggleMenu(){
    if(!showMenu){
        hamburger.classList.add('open');
        // nav.classList.add('open');
        menuNav.classList.add('open');
        navItems.forEach(item => item.classList.add('open')); 
        
        showMenu = true;
    }else{
        hamburger.classList.remove('open');
        // nav.classList.remove('open');
        menuNav.classList.remove('open');
        navItems.forEach(item => item.classList.remove('open')); 

        showMenu = false;
    }
}
