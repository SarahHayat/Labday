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

    <label><b>Lieux</b> <span class="obligatoire">*</span></label>
    <input type="text" placeholder="lieux" name="lieux" required>

    <label>Date de l'évenement <span class="obligatoire">*</span></label>
    <input type="datetime-local" name="date_evenement" required>

    <label><b>Description</b> <span class="obligatoire">*</span></label></br>
    <textarea name="description" placeholder="Décrire votre évenement" required></textarea>

    <input type="submit" id='enregistrer' value='ENREGISTRER'>
    <script>alert("<?php echo htmlspecialchars('Votre évènement a bien été créer !', ENT_QUOTES); ?>")</script>

</form>

<?php
require("footer.php");
?>
</body>
</html>

