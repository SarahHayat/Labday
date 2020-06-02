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
        xmlhttp.open("GET",'../php/securiteForm.php?pseudo='+pseudo,true);
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
        xmlhttp.open("GET",'../php/securiteForm.php?mail='+mail,true);
        xmlhttp.send();
    }
}

function trier(ordre) {
    if (ordre == "NULL") {
        document.getElementById("trie").innerHTML = "";
        console.log("null" + ordre);
        return;
    } else
        {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            console.log(this.readyState);
            if (this.readyState == 3) {
                if(this.status ==200){
                    console.log("ordre" + ordre);
                    document.getElementById("trie").innerHTML = this.responseText;
                }else{
                    console.log("else");
                }
            }
        };
        xmlhttp.open("GET",'../php/securiteForm.php?ordre='+ordre,true);
        xmlhttp.send();
    }
}
