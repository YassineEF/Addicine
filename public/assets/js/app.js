//div image and div title
let imgSlider = document.getElementsByClassName('slider');
let titleSlider = document.getElementsByClassName('titleFilmPopulaire');

let actualImg = 0;
//number of image
let imgNumber = imgSlider.length;
//button next & previous
let previous = document.querySelector('.previous');
let next = document.querySelector('.next');
//
let searchForm = document.getElementById('searchForm');
let searchButton = document.getElementById('searchLogo');
// let searchInput = document.getElementById('keyWord').value;
// slider in home page wher usqer click on the prevoious or nest button
function notActive(){
    for(let i =0; i < imgNumber; i++){
        imgSlider[i].classList.remove('active');
        titleSlider[i].classList.remove('active');
    }
}
function NextImage(){
    actualImg++;
    if(actualImg >= imgNumber){
        actualImg = 0;
    }
    notActive();    
    imgSlider[actualImg].classList.add('active');
    titleSlider[actualImg].classList.add('active');
}

next.addEventListener('click', () =>{ NextImage() })

previous.addEventListener('click', () =>{

    actualImg--;
    if(actualImg < 0){
        actualImg = imgNumber - 1;
    }
    notActive();    
    imgSlider[actualImg].classList.add('active');
    titleSlider[actualImg].classList.add('active');
})

// slider automatic after 3 seconds
setInterval(function(){ NextImage(); },3000);

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
