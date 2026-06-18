const itemMainFoto = document.querySelector(".item-main-foto");
const btnLeft = document.querySelector("#item-btn-left");
const btnRight = document.querySelector("#item-btn-right");
const caruoselFoto = document.querySelectorAll(".item-caruosel-foto");

let offset = 0;

btnLeft.onclick = function(){
    offset += 210;
    caruoselFoto.forEach(foto => {
        foto.style.left = offset + 'px';
    })
}

btnRight.onclick = function(){
    offset -= 210;
    caruoselFoto.forEach(foto => {
        foto.style.left = offset + 'px';
    })
}