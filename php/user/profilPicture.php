<?php
session_start();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ShareEventTogether - connect</title>
    <link rel="stylesheet" href="../../assets/css/profil.css"/>
</head>


<body>
<div style="display: flex; flex-direction: row">
    <?php

    if (isset($_SESSION['username'])) {
        require("../header/headerConnect.php");
    } else {
        require("../header/headerDisconnect.php");

    }


    /**
     * mettre url de la photo dans bdd
     */
    ?>
    <div class="fond" style="width: 100%">
        <form action="#" method="post" class="photoProfil">
            <div>
                <img src="../../assets/photoProfil/femme.jpg" width="150" height="150">
                <input type="radio" name="photo" value="../assets/photoProfil/femme.jpg" id="femme">
            </div>
            <div>
                <img src="../../assets/photoProfil/femme_2.jpg" width="150" height="150">
                <input type="radio" name="photo" value="../assets/photoProfil/femme_2.jpg" id="femme_2">
            </div>
            <div>
                <img src="../../assets/photoProfil/homme.jpg" width="150" height="150">
                <input type="radio" name="photo" value="../assets/photoProfil/homme.jpg" id="homme">
            </div>
            <div>
                <img src="../../assets/photoProfil/homme_2.jpg" width="150" height="150">
                <input type="radio" name="photo" value="../assets/photoProfil/homme_2.jpg" id="homme_2">
            </div>
            <input type="submit" value="Envoyer">
        </form>
    </div>


    <?php
    if (isset($_POST['photo']) && isset($_SESSION['id_name'])) {
        /**
         * supprimer photo d'avant
         */

        $req = $resultat->deleteUserPicture($_SESSION['id_name']);


        /**
         * ajouter nouvelle photo
         */
        $req = $resultat->addNewUserPicture($_SESSION['id_name'], $_POST['photo']);

        header('Location: profil.php');
    }
    ?>
</div>
<?php
require("../footer/footer.php");
?>
</body>
</html>



