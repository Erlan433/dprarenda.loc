const buttonMap = document.querySelector(".map-button");
const coverMap = document.querySelector(".cover-map");
const modalMap = document.querySelector(".map-modal");
const closeMap = document.querySelector("#close-map");

buttonMap.onclick = function (){
    coverMap.style.display = "block";
    modalMap.style.display = "block";
}

closeMap.onclick = function (){
    coverMap.style.display = "none";
    modalMap.style.display = "none";
}