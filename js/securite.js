function supprimer() {
    var btn_supprimer = document.getElementById("supprimer");
    if (confirm("Vous désirez vraiment supprimer votre compte ?")) {
        console.log("oui")
        window.location.href = '../controllers/supprimerUtilisateur.php';
    } else {
        console.log("non")

        btn_supprimer.href = "profil.php";
    }
}

function isPseudoExist(pseudo) {
    if (pseudo == "") {
        document.getElementById("txtpseudo").innerHTML = "";
        return;
    } else{
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtpseudo").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET",'http://localhost:8888/Labday/php/securiteForm.php?pseudo='+pseudo,true);
        xmlhttp.send();
    }
}
function isMailExist(mail) {
    if (mail == "") {
        document.getElementById("txtmail").innerHTML = "";
        return;
    } else{
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtmail").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET",'http://localhost:8888/Labday/php/securiteForm.php?mail='+mail,true);
        xmlhttp.send();
    }
}
