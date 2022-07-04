//div image and div title
let imgSlider = document.getElementsByClassName('slider');
let titleSlider = document.getElementsByClassName('titleFilmPopulaire');

let actualImg = 0;
//number of image
let imgNumber = imgSlider.length;
//button next & previous
let previous = document.querySelector('.previous');
let next = document.querySelector('.next');


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