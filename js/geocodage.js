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
function sendGeocode() {
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

        }
    };
    sendForm();
}

function sendForm() {
    var title = document.getElementById('title').value;
    var adresse = document.getElementById('adresse').value;
    var code_postal = document.getElementById('code_postal').value;
    var commune = document.getElementById('commune').value;
    var dateEvent = document.getElementById('dateEvent').value;
    var desc = document.getElementById('desc').value;
    var categorie = document.getElementById('categorie').value;
    var x = document.getElementById("coordinates-x").value;
    var y = document.getElementById("coordinates-y").value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", window.location.href);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send('titre_evenement=' + title
        + "&adresse="+ adresse
        + "&code_postal=" +  code_postal
        + "&commune=" + commune
        + "&date_evenement=" + dateEvent
        + "&description=" + desc
        +"&y=" + x
        +"&x="+ y
        +'&categorie='+categorie);

    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            let response = xmlhttp.responseText;
            console.log(response);
            document.getElementById("create-event-form").submit();

        }
    };
}

