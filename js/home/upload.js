function levelFloorChange(element){
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "/categories/warehouses/upload/");
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send("level_floor=" + element.checked);
    xmlhttp.onreadystatechange = function (){
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            console.log(xmlhttp.responseText);
        }
    }
}