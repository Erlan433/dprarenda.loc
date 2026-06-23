const itemMainFoto = document.querySelector(".item-main-foto");
const btnLeft = document.querySelector("#item-btn-left");
const btnRight = document.querySelector("#item-btn-right");
const fotos = document.querySelector(".item-fotos");
const caruoselBlock = document.querySelector(".item-caruosel-block");
const caruoselFoto = document.querySelectorAll(".item-caruosel-foto");

let offset = 0;
let caruoselFotoLength = caruoselFoto.length;
let caruoselFotoWidth = Math.round(parseFloat(window.getComputedStyle(document.querySelector(".item-caruosel-foto")).width));
let fotosGap = Math.round(parseFloat(window.getComputedStyle(fotos).gap));
let widthAndGap = caruoselFotoWidth + fotosGap;
let caruoselBlockWidth = Math.round(parseFloat(window.getComputedStyle(caruoselBlock).width));
let sumFotosInWindow = Math.round(parseFloat(caruoselBlockWidth / widthAndGap));

caruoselFoto.forEach(foto => {
    foto.onclick = function (){
        caruoselFoto.forEach(fotoBorder => {
            if (fotoBorder.classList.contains('item-foto-selected')){
                fotoBorder.classList.remove('item-foto-selected');
            }
        })
        foto.classList.add('item-foto-selected');
        itemMainFoto.style.backgroundImage = "url(" + foto.dataset.img + ")";
    }
})

if(caruoselFotoLength <= sumFotosInWindow){
    btnLeft.style.display = "none";
    btnRight.style.display = "none";
}

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