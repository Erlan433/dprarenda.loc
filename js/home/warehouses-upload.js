function filterChange(){
    let level_floor = document.querySelector("#level_floor").checked;
    let ramp_access = document.querySelector("#ramp_access").checked;
    let crane_beam = document.querySelector("#crane_beam").checked;
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "/categories/warehouses/upload/");
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send("level_floor=" + level_floor + "&ramp_access=" + ramp_access + "&crane_beam=" + crane_beam);
    xmlhttp.onreadystatechange = function (){
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            document.querySelector(".pustPomesheniya").innerHTML = xmlhttp.responseText;
        }
    }
}