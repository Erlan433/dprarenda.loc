const selectBtn = document.querySelector(".select-btn");
const selectBtnText = document.querySelector(".select-btn span");
const selectBtnIcon = document.querySelector(".select-btn i");
const dropDown = document.querySelector(".drop-down");
const labels = document.querySelectorAll(".drop-down label");

selectBtn.onclick = function (){
    if (dropDown.style.display == 'none'){
        dropDown.style.display = 'block';
        selectBtnIcon.className = 'fa-solid fa-chevron-up';
    } else {
        dropDown.style.display = 'none';
        selectBtnIcon.className = 'fa-solid fa-chevron-down';
    }
}

labels.forEach(label => {
    label.onclick = function (){
        dropDown.style.display = 'none';
        selectBtnText.innerHTML = label.innerHTML;
        selectBtnIcon.className = 'fa-solid fa-chevron-down';
    }
});