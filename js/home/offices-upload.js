function filterChange(){
    let legal_address = document.querySelector("#legal_address").checked;
    let air_conditining = document.querySelector("#air_conditining").checked;
    let water_supply = document.querySelector("#water_supply").checked;
    let sewerage = document.querySelector("#sewerage").checked;
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "/categories/offices/upload/");
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send("legal_address=" + legal_address + "&air_conditining=" + air_conditining + "&water_supply=" + water_supply + "&sewerage=" + sewerage);
    xmlhttp.onreadystatechange = function (){
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            document.querySelector(".pustPomesheniya").innerHTML = xmlhttp.responseText;
        }
    }
}