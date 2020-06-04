<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ShareEventTogether - create event</title>
    <link rel="stylesheet" href="../assets/css/connect.css"/>
</head>


<body>
<?php
// echo "session username : " . $_SESSION['username'];

if (isset($_SESSION['username'])) {
    require("headerConnect.php");
} else {
    require("headerDisconnect.php");

}

?>
<form action="../controllers/createEvent.php" method="post" class="container_connect fond">
    <a href="index.php"><< Retour</a>
    <h1> Creation nouveau Evenement</h1>

    <label><b>Catégorie</b></label>
    <select name="categorie">
        <option>Selectionnez une catégorie</option>
        <option value="1">Plein air</option>
        <option value="2">Jeux de société</option>
        <option value="3">Tourisme</option>
        <option value="4">Soirée</option>
    </select>

    <label><b>Titre</b> <span class="obligatoire">*</span></label>
    <input type="text" placeholder="titre" name="titre" required>

    <label><b>Adresse</b> <span class="obligatoire">*</span></label>
    <input type="text" placeholder="adresse (N°, rue)" name="adresse" id="adresse" required>

    <label><b>Code Postale</b> <span class="obligatoire">*</span></label>
    <input type="text" placeholder="(ex: 95000)" name="code_postale" id="code_postale" required>

    <label><b>Commune</b> <span class="obligatoire">*</span></label>
    <input type="text" placeholder="ville" name="commune" id="commune" required>

    <label>Date de l'évenement <span class="obligatoire">*</span></label>
    <input type="datetime-local" name="date_evenement" required>

    <label><b>Description</b> <span class="obligatoire">*</span></label></br>
    <textarea name="description" placeholder="Décrire votre évenement" required></textarea>

    <input type="submit" id='enregistrer' value='ENREGISTRER'>

</form>

<?php
require("footer.php");
?>

<script src="../js/mapping.js"></script>
</body>
</html>

