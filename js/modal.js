const priceBtn = document.querySelector("#price-filter");
const cover = document.querySelector(".cover");
const priceModal = document.querySelector(".price-modal");
const xmark = document.querySelector("#xmark");

priceBtn.onclick = function() {
    cover.style.display = "block";
    priceModal.style.display = "flex";
}

xmark.onclick = function() {
    cover.style.display = "none";
    priceModal.style.display = "none";
}