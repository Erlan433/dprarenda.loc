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