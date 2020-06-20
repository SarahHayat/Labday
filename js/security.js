function supprimer() {
    var btn_supprimer = document.getElementById("supprimer");
    if (confirm("Vous désirez vraiment supprimer votre compte ?")) {
        console.log("oui");
        window.location.href = '../controllers/user/deleteUser.php';
    } else {
        console.log("non");

        btn_supprimer.href = "../user/profil.php";
    }
}
/*

function supprimerEvent(){
    var btn_supprimerEvent = document.getElementById("supprimerEvent");
    console.log("test : " + btn_supprimerEvent);
    if (confirm("Vous désirez vraiment supprimer votre événement ?")) {
        console.log("oui")
        window.location.href = '../controllers/deleteEvent.php';
    } else {
        console.log("non")

        btn_supprimer.href = "profil.php";
    }
}
*/

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
        xmlhttp.open("GET",'../event/securiteForm.php?pseudo='+pseudo,true);
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
        xmlhttp.open("GET",'../event/securiteForm.php?mail='+mail,true);
        xmlhttp.send();
    }
}



function filtre() {
    console.log('filtre');
    var categorie = document.getElementById("categorie").value;
    var ordre = document.getElementById("ordre").value;
    var date_debut = document.getElementById("date_debut").value;
    var date_fin = document.getElementById("date_fin").value;
    var lieu = document.getElementById("lieu").value;
    var karma = document.getElementById("karma").value;
    if (karma === "NULL") {
        document.getElementById("filter").innerHTML = "";
        return;
    } else
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET",'../event/securiteForm.php?categorie='+categorie+'&ordre='+ordre+'&date_debut='+date_debut+'&date_fin='+date_fin+'&lieu='+lieu+'&karma='+karma,true);
        xmlhttp.send();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4) {
                if(this.status ==200){
                   // document.getElementById("filter").innerHTML = " ";
                    document.getElementById("filter").innerHTML = this.responseText;
                }else{
                }
            }
        };
    }
}

function myChoices(choice) {
    if (choice == "") {
        document.getElementById("evenement").innerHTML = "";
        console.log("null" + choice);
        return;
    } else
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            console.log(this.readyState);
            if (this.readyState == 3) {
                if(this.status ==200){
                    console.log("ordre" + choice);
                    document.getElementById("evenement").innerHTML = this.responseText;
                }else{
                    console.log("else");
                }
            }
        };
        xmlhttp.open("GET",'../event/myChoices.php?choice='+choice,true);
        xmlhttp.send();
    }
}
