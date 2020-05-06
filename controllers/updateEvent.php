<?php
session_start();

require("bdd.php");

/**
 * Récupere les élements de l'événement
 */
$id_evenement = $_GET['id_evenement'];


$reponse = $bdd->query('SELECT * FROM evenements where id_evenement = "' . $id_evenement . '"');
// On affiche chaque entrée une à une
while ($donnees = $reponse->fetch()) {
    $description = $donnees['description'];
    $date_evenement = $donnees['date_evenement'];
    $titre_evenement = $donnees['titre_evenement'];
    $lieu = $donnees['lieu'];
}

/**
 * Formulaire de l'événement
 */
?>
    <!DOCTYPE html>
    <html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Labday</title>
    <link rel="stylesheet" href="../assets/css/connect.css"/>
</head>


<form action="#" method="post" class="container fond">
    <h1> Modification Evenement</h1>

    <label><b>Titre</b></label>
    <input type="text" placeholder="titre" name="titre_evenement" required value="<?php echo $titre_evenement ?>">

    <label><b>Lieu</b></label>
    <input type="text" placeholder="lieux" name="lieu" value="<?php echo $lieu ?>" required>

    <label><b>Date de l'évenement</b></label>
    <input type="datetime" name="date_evenement" value="<?php echo $date_evenement ?>" required>

    <label><b>Description</b></label></br>
    <textarea name="description" required><?php echo $description ?></textarea>

    <input type="submit" id='enregistrer' value='ENREGISTRER'>
</form>
<?php
/**
 * Modifie l'écénement
 */
if (isset($_POST['description']) && isset($_POST['date_evenement']) && isset($_POST['titre_evenement']) && isset($_POST['lieu']) && isset($id_evenement)) {
    $req = $bdd->prepare('UPDATE evenements SET description = :description, date_evenement = :date_evenement
, titre_evenement = :titre_evenement, lieu = :lieu WHERE id_evenement = "' . $id_evenement . '"');
    $req->execute(array(
        'description' => $_POST['description'],
        'date_evenement' => $_POST['date_evenement'],
        'titre_evenement' => $_POST['titre_evenement'],
        'lieu' => $_POST['lieu'],


    ));
    header('Location: ../php/profil.php');
}


?>