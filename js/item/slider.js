const itemMainFoto = document.querySelector(".item-main-foto");
const btnLeft = document.querySelector("#item-btn-left");
const btnRight = document.querySelector("#item-btn-right");
const caruoselFoto = document.querySelectorAll(".item-caruosel-foto");

let offset = 0;
const caruoselFotoLength = caruoselFoto.length;

btnLeft.onclick = function(){
    if(offset != 0){
        offset += 220;
        caruoselFoto.forEach(foto => {
            foto.style.left = offset + 'px';
        })
        btnIsActive();
    }
}

btnRight.onclick = function(){
    if(offset != -((caruoselFotoLength - 4) * 220)){
        offset -= 220;
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
        btnLeft.style.opacity = 0.5;
    }

    if(offset != -((caruoselFotoLength - 4) * 220)){
        btnRight.style.opacity = 1;
    } else  {
        btnRight.style.opacity = 0.5;
    }
}

btnIsActive();