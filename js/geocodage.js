function sendGeocodage() {
    let adresse = document.getElementById("adresse").value;
    let codePostal = document.getElementById("code_postal").value;
    let commune = document.getElementById('commune').value;

    let url = new URL("https://api-adresse.data.gouv.fr/search/");

    url.searchParams.append("q", adresse);
    url.searchParams.append("postcode", codePostal);
    url.searchParams.append("city", commune);



    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", url.href);
    xmlhttp.send();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            let response = JSON.parse(xmlhttp.responseText);
            let coordinates = response.features[0].geometry.coordinates;
            document.getElementById("coordinates-x").value = coordinates[0];
            document.getElementById("coordinates-y").value = coordinates[1];
            document.getElementById("create-event-form").submit();

        }
    };
}