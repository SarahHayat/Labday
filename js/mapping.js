function coordonnee(){
    var mapTab = dataPhp[0];
    var mymap = L.map('mapid').setView([49.1374, 2.32753], 13);
    for (var i = 0; i < mapTab.length; i++) {
        marker = new L.marker([mapTab[i].x,mapTab[i].y])
            .bindPopup(`<a href=\"detailsEvent.php?id_evenement=${mapTab[i].id_evenement}\"> ${mapTab[i].titre_evenement} </a>`)
            .addTo(mymap);
    }
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1Ijoic2hhcmVldmVudCIsImEiOiJja2F4d2pvcmQwOGZ1MnFwNnQ0OTluMWQyIn0.YJ8RW6Z5-A-J3ttr38YiGQ'
    }).addTo(mymap);
}
coordonnee();