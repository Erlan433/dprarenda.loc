function filterChange(){
    let ramp_access = document.querySelector("#ramp_access").checked;
    let sewerage = document.querySelector("#sewerage").checked;
    let crane_beam = document.querySelector("#crane_beam").checked;
    let water_supply = document.querySelector("#water_supply").checked;
    let level_floor = document.querySelector("#level_floor").checked;
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "/categories/shops/upload/");
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send("ramp_access=" + ramp_access + "&sewerage=" + sewerage + "&crane_beam=" + crane_beam + "&water_supply=" + water_supply + "&level_floor=" + level_floor);
    xmlhttp.onreadystatechange = function (){
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            document.querySelector(".pustPomesheniya").innerHTML = xmlhttp.responseText;
        }
    }
}