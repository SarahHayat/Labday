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

function confirmer() {
    var mailElt = document.getElementById("mail");
    var pseudoElt = document.getElementById("pseudo");

    if (mailElt == mailElt) {
        if (alert("mail déjà prit")) {
            window.location.href = '../php/connect.php';
        }
    }
    else if (pseudoElt !== "") {
        if (alert("pseudo déjà prit")) {
            window.location.href = '../php/connect.php';
        }
    }

}
