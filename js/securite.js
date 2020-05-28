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
    if (alert("pseudo ou mail déjà prit")) {
        window.location.href = '../php/connect.php';

    }
}
