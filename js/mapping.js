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


let adresse = document.getElementById("adresse").value;
let codePostal = document.getElementById("code_postale").value; // pas sur pour la value possiblement .val ou autre
let commune = document.getElementById('commune').value;

let url = new URL("https://api-adresse.data.gouv.fr/search/");

url.searchParams.append("q", adresse);
url.searchParams.append("postcode", codePostal);
url.searchParams.append("city" , commune);

