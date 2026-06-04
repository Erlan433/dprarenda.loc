const buttonMap = document.querySelector(".map-button");
const coverMap = document.querySelector(".cover-map");
const modalMap = document.querySelector(".map-modal");

buttonMap.onclick = function (){
    coverMap.style.display = "block";
    modalMap.style.display = "block";
}