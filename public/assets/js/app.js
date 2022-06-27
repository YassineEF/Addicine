let imgSlider = document.getElementsByClassName('slider');
let titleSlider = document.getElementsByClassName('titleFilmPopulaire');

let actualImg = 0;

let imgNumber = imgSlider.length;

let previous = document.querySelector('.previous');
let next = document.querySelector('.next');

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


setInterval(function(){ NextImage(); },3000)
