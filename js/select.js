const selectBtn = document.querySelector(".select-btn");
const dropDown = document.querySelector(".drop-down");
const labels = document.querySelectorAll(".drop-down label");

selectBtn.onclick = function (){
    if (dropDown.style.display == 'none'){
        dropDown.style.display = 'block';
        selectBtn.style.backgroundImage = 'url(/images/chevron-up.png)';
    } else {
        dropDown.style.display = 'none';
        selectBtn.style.backgroundImage = 'url(/images/chevron-down.png)';
    }
}

labels.forEach(label => {
    label.onclick = function (){
        dropDown.style.display = 'none';
        selectBtn.innerHTML = label.innerHTML;
        selectBtn.style.backgroundImage = 'url(/images/chevron-down.png)';
    }
});