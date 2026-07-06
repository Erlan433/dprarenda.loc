function uploadImg(files, id){
    let form_data = new FormData();
    form_data.append("picture", files[0]);
    form_data.append("id", id)
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "/upload_img/");
    xmlhttp.send(form_data);
    xmlhttp.onreadystatechange = function(){
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            let imgLoaded = JSON.parse(xmlhttp.responseText);
            let div = document.createElement("div");
            div.style.backgroundImage = "url(" + imgLoaded.file + ")";
            div.classList.add("img-item");
            let span = document.createElement("span");
            span.classList.add("cross");
            span.innerHTML = "&times;";
            span.id = "del-" + imgLoaded.id;
            span.setAttribute("onclick", "deletePic(" + imgLoaded.id + ")")
            div.appendChild(span);
            document.querySelector(".fotos").appendChild(div);
        }
    }
}

function deletePic(id){
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "/admin/edit/item/delete/");
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send("i=" + id);
    xmlhttp.onreadystatechange = function(){
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200 && xmlhttp.responseText == 1){
            document.getElementById("del-" + id).parentElement.remove();
        }
    }
}