document.getElementById('foto').addEventListener('change', function () {
    const label = document.querySelector('.foto-label-text');
    label.textContent = this.files.length ? this.files[0].name : 'Выберите файл';

    if (this.files[0]) {
        const reader = new FileReader();
        reader.onload = e => document.getElementById('photo-preview').src = e.target.result;
        reader.readAsDataURL(this.files[0]);
    }
});

document.getElementById('add_pictures').onclick = function(){
    document.getElementById('file_select').click();
}

function uploadImg(files, id){
    let form_data = new FormData();
    form_data.append("picture", files[0]);
    form_data.append("id", id)
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "/upload_img/");
    xmlhttp.send(form_data);
    xmlhttp.onreadystatechange = function(){
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            
        }
    }
}

