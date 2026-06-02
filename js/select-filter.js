// ПЕРЕМЕННЫЕ ВЫБОРА
const buttonFilter = document.querySelector(".button-filter");
const dropDown = document.querySelector(".drop-down");
const filterSelectPrice = document.querySelector(".filter-select-price");
const filterSelectSquarePrice = document.querySelector(".filter-select-square-price");

// ПЕРЕМЕННЫЕ ФИЛЬТРА ЦЕНЫ И ЦЕНЫ ЗА КВАДРАТНЫЙ МЕТР
const cover = document.querySelector(".cover");
const priceModal = document.querySelector("#price-modal");
const squarePriceModal = document.querySelector("#square-price-modal");
const xmarkPrice = document.querySelector("#xmark-price");
const xmarkSquarePrice = document.querySelector("#xmark-square-price");

buttonFilter.onclick = function (){
    if (dropDown.style.display == 'none'){
        dropDown.style.display = 'flex';
    } else {
        dropDown.style.display = 'none';
    }
}

filterSelectPrice.onclick = function (){
    dropDown.style.display = 'none';
    cover.style.display = "block";
    priceModal.style.display = "flex";
}

filterSelectSquarePrice.onclick = function (){
    dropDown.style.display = 'none';
    cover.style.display = "block";
    squarePriceModal.style.display = "flex";
}

xmarkPrice.onclick = function() {
    cover.style.display = "none";
    priceModal.style.display = "none";
}

xmarkSquarePrice.onclick = function() {
    cover.style.display = "none";
    squarePriceModal.style.display = "none";
}