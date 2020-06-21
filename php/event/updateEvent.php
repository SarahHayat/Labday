<?php
session_start();
//require ("../controllers/AllRequest.php");
//$resultat = new AllRequest();

?>
    <!DOCTYPE html>
    <html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Labday</title>
    <link rel="stylesheet" href="../../assets/css/connect.css"/>
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
     * Récupere les élements de l'événement
     */
    $id_evenement = $_GET['id_evenement'];

    $reponse = $resultat->getEventForUpdate($id_evenement);

    while ($donnees = $reponse->fetch()) {
        $id_categorie = $donnees['id_categorie'];
        $nom_categorie = $donnees['nom_categorie'];
        $description = $donnees['description'];
        $date_evenement = $donnees['date_evenement'];
        $titre_evenement = $donnees['titre_evenement'];
        $adresse = $donnees["adresse"];
        $commune = $donnees["commune"];
        $code_postal = $donnees["code_postal"];
        $x = $donnees["x"];
        $y = $donnees["y"];

    }

    /**
     * Formulaire de l'événement
     */
    ?>

    <form id="create-event-form" action="../user/profil.php" method="post" class="container fond container_connect">
        <a href="../user/profil.php"><< Retour</a>
        <h1> Modification Evenement</h1>

        <label><b>Catégorie</b></label>
        <select name="categorie" id="categorie">
            <option value="<?php echo $id_categorie ?>"><?php echo $nom_categorie ?></option>
            <option value="1">Plein air</option>
            <option value="2">Jeux de société</option>
            <option value="3">Tourisme</option>
            <option value="4">Soirée</option>
        </select> </br>

        <label><b>Titre</b></label>
        <input id="title" type="text" placeholder="titre" name="titre_evenement" required value="<?php echo $titre_evenement ?>">

        <label><b>Adresse</b> <span class="obligatoire">*</span></label>
        <input type="text" name="adresse" id="adresse" value="<?php echo $adresse ?>" required>

        <label><b>Code Postal</b> <span class="obligatoire">*</span></label>
        <input type="text" name="code_postal" id="code_postal" maxlength="5" value="<?php echo $code_postal ?>"
               required>

        <label><b>Commune</b> <span class="obligatoire">*</span></label>
        <input type="text" name="commune" id="commune" value="<?php echo $commune ?>" required>

        <label><b>Date de l'évenement</b></label>
        <input id="dateEvent" type="datetime" name="date_evenement" value="<?php echo $date_evenement ?>" required>

        <label><b>Description</b></label></br>
        <textarea id="desc" name="description" required><?php echo $description ?></textarea>

        <input type="hidden" name="x" id="coordinates-x" value="<?php echo $x?>">
        <input type="hidden" name="y" id="coordinates-y" value="<?php echo $y?>">

        <div id='enregistrer' onclick="sendGeocode();">
            <span>ENREGISTRER</span>
        </div>
    </form>
</div>

<?php
/**
 * Modifie l'événement
 */

if (isset($_POST['description'], $_POST['date_evenement'], $_POST['titre_evenement'], $_POST['adresse'], $_POST['commune'], $_POST['code_postal'], $id_evenement, $_POST['x'],$_POST['y'] )) {

    $req = $resultat->updateEvent($_POST['description'], $_POST['date_evenement'], $_POST['titre_evenement'], $_POST['adresse'], $_POST['commune'], $_POST['code_postal'], $_POST['categorie'], $id_evenement,  $_POST['x'], $_POST['y']);

}


include("../footer/footer.php");
?>
</body>
<script src="../../js/geocodage.js"></script>