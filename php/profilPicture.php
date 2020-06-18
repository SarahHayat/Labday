<?php
session_start();
require ("../controllers/AllRequest.php");
$resultat = new AllRequest();
require("../controllers/bdd.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ShareEventTogether - connect</title>
    <link rel="stylesheet" href="../assets/css/profil.css"/>
</head>


<body>
<div style="display: flex; flex-direction: row">
    <?php
    // echo "session username : " . $_SESSION['username'];

    if (isset($_SESSION['username'])) {
        require("../php/headerConnect.php");
    } else {
        require("../php/headerDisconnect.php");

    }


    /**
     * mettre url de la photo dans bdd
     */
    ?>
    <div class="fond">
        <form action="#" method="post" class="photoProfil">
            <div>
                <img src="../assets/photoProfil/femme.jpg" width="150" height="150">
                <input type="radio" name="photo" value="../assets/photoProfil/femme.jpg" id="femme">
            </div>
            <div>
                <img src="../assets/photoProfil/femme_2.jpg" width="150" height="150">
                <input type="radio" name="photo" value="../assets/photoProfil/femme_2.jpg" id="femme_2">
            </div>
            <div>
                <img src="../assets/photoProfil/homme.jpg" width="150" height="150">
                <input type="radio" name="photo" value="../assets/photoProfil/homme.jpg" id="homme">
            </div>
            <div>
                <img src="../assets/photoProfil/homme_2.jpg" width="150" height="150">
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

        $req = $resultat->deleteUserPicture($bdd, $_SESSION['id_name']);
//        $req = $bdd->query('DELETE FROM photo_utilisateurs WHERE id_utilisateur ="' . $_SESSION['id_name'] . '"');


        /**
         * ajouter nouvelle photo
         */
        $req = $resultat->addNewUserPicture($bdd, $_SESSION['id_name'], $_POST['photo']);
//        $req = $bdd->prepare('INSERT INTO photo_utilisateurs(id_utilisateur, url) VALUES(:id_utilisateur, :url)');
//        $req->execute(array(
//            'id_utilisateur' => $_SESSION['id_name'],
//            'url' => $_POST['photo'],
//
//        ));
        header('Location: ../php/profil.php');
    }
    ?>
</div>
<?php
require("footer.php");
?>
</body>
</html>



