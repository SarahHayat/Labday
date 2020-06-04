// let long;
// let lat;
// let tab_long_lat = [long,lat];
// var mymap = L.map('mapid').setView( tab_long_lat , 13);
//
// L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
//     attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
//     maxZoom: 18,
//     id: 'mapbox/streets-v11',
//     tileSize: 512,
//     zoomOffset: -1,
//     accessToken: 'pk.eyJ1Ijoic2hhcmVldmVudCIsImEiOiJja2F4d2pvcmQwOGZ1MnFwNnQ0OTluMWQyIn0.YJ8RW6Z5-A-J3ttr38YiGQ'
// }).addTo(mymap);

function sendGeocodage(){
    let adresse = document.getElementById("adresse").value;
    let codePostal = document.getElementById("code_postale").value;
    let commune = document.getElementById('commune').value;

    let url = new URL("https://api-adresse.data.gouv.fr/search/");

    url.searchParams.append("q", adresse);
    url.searchParams.append("postcode", codePostal);
    url.searchParams.append("city" , commune);
    console.log("url = ", url);


    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET",url.href);
    xmlhttp.send();
    xmlhttp.onreadystatechange = function() {
        console.log("this.readyState = ", this.readyState);
        if (this.readyState === 4 && this.status ===200) {
            let response = JSON.parse(xmlhttp.responseText);
            let coordinates = response.features[0].geometry.coordinates;
            document.getElementById("coordinates-x").value = coordinates[0];
            document.getElementById("coordinates-y").value = coordinates[1];

            document.getElementById("create-event-form").submit();

        }
    };
}

