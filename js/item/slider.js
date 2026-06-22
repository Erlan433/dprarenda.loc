const itemMainFoto = document.querySelector(".item-main-foto");
const btnLeft = document.querySelector("#item-btn-left");
const btnRight = document.querySelector("#item-btn-right");
const fotos = document.querySelector(".item-fotos");
const caruoselBlock = document.querySelector(".item-caruosel-block");
const caruoselFoto = document.querySelectorAll(".item-caruosel-foto");

let offset = 0;
const caruoselFotoLength = caruoselFoto.length;
const caruoselFotoWidth = Math.round(parseFloat(window.getComputedStyle(document.querySelector(".item-caruosel-foto")).width));
const fotosGap = Math.round(parseFloat(window.getComputedStyle(fotos).gap));
const widthAndGap = caruoselFotoWidth + fotosGap;
const caruoselBlockWidth = Math.round(parseFloat(window.getComputedStyle(caruoselBlock).width));
const sumFotosInWindow = Math.round(parseFloat(caruoselBlockWidth / widthAndGap));

caruoselFoto.forEach(foto => {
    foto.onclick = function (){
        itemMainFoto.style.backgroundImage = "url(" + foto.dataset.img + ")";
    }
})

btnLeft.onclick = function(){
    if(offset != 0){
        offset += widthAndGap;
        caruoselFoto.forEach(foto => {
            foto.style.left = offset + 'px';
        })
        btnIsActive();
    }
}

btnRight.onclick = function(){
    if(offset != -((caruoselFotoLength - sumFotosInWindow) * widthAndGap)){
        offset -= widthAndGap;
        caruoselFoto.forEach(foto => {
            foto.style.left = offset + 'px';
        })
        btnIsActive();
    }
}

function btnIsActive(){
    if(offset != 0){
        btnLeft.style.opacity = 1;
    } else {
        btnLeft.style.opacity = 0.4;
    }

    if(offset != -((caruoselFotoLength - sumFotosInWindow) * widthAndGap)){
        btnRight.style.opacity = 1;
    } else {
        btnRight.style.opacity = 0.4;
    }
}

btnIsActive();