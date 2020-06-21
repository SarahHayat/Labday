<?php
session_start();


if (isset($_SESSION['username'])) {
    require("../header/headerConnect.php");
} else {
    require("../header/headerDisconnect.php");

}


/**
 * Reprend les éléments de l'événement
 */
$id_evenement = $_GET['id_evenement'];
$id_utilisateur = $_GET['id_utilisateur'];
$reponse = $resultat->getKarmaByEvent($id_evenement);

while ($donnees = $reponse->fetch()) {
    $description = $donnees['description'];
    $date_evenement = $donnees['date_evenement'];
    $titre_evenement = $donnees['titre_evenement'];
    $lieu = $donnees['commune'];


/**
 * Formulaire note
 */


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Labday</title>
    <link rel="stylesheet" href="../../assets/css/connect.css"/>
</head>


<form action="#" method="post" class="container fond container_connect">
    <a href="../index.php"><< Retour</a>
    <h1> Modification Evenement</h1>

    <label><b>Catégorie</b></label>
    <select name="categorie">
        <option value="<?php echo $donnees['$id_categorie'] ?>"><?php echo $donnees['nom_categorie'] ?></option>
    </select>

    <label><b>Titre</b></label>
    <input type="text" placeholder="titre" name="titre_evenement" value="<?php echo $titre_evenement ?>" readonly>

    <label><b>Lieu</b></label>
    <input type="text" placeholder="lieux" name="lieu" value="<?php echo $lieu ?>" readonly>

    <label><b>Date de l'évenement</b></label>
    <input type="datetime" name="date_evenement" value="<?php echo $date_evenement ?>" readonly>

    <label><b>Description</b></label></br>
    <textarea name="description" readonly><?php echo $description ?></textarea>

    <label><b>Karma /10</b></label>
    <input type="number" name="note" required>

    <input type="submit" id='enregistrer' value='ENREGISTRER'>
</form>
<?php
}
/**
 * Ajouter une note
 */

echo "id evenement : " . $id_evenement;
if (isset($_POST['note']) && isset($id_utilisateur)) {
    $req = $resultat->addKarma($_POST['note'], $id_utilisateur, $id_evenement);

    $requete = $resultat->averageKarma($id_utilisateur);
    $donnees= $requete->fetch();
    $moyenne = $donnees['moyenne'];
    $reponse = $resultat->updateAverageKarma($moyenne, $id_utilisateur);

    header('Location: profil.php');
}
require("../footer/footer.php");
?>

