<!--SELECT *-->
<!--FROM evenements as e-->
<!--left join karma as k-->
<!--on e.id_karma = k.id_karma-->
<!--left join utilisateurs as u-->
<!--on u.id_utilisateur = k.id_utilisateur-->
<!--where e.id_evenement = 16-->

<?php
session_start();

require("bdd.php");
/**
 * ajouter note
 */
$id_evenement = $_GET['id_evenement'];
$id_utilisateur = $_GET['id_utilisateur'];


echo "id event : " . $id_evenement;
echo "id user : " . $id_utilisateur;
$reponse = $bdd->query('SELECT * FROM evenements where id_evenement = "' . $id_evenement . '"');
// On affiche chaque entrée une à une
while ($donnees = $reponse->fetch()) {
    $description = $donnees['description'];
    $date_evenement = $donnees['date_evenement'];
    $titre_evenement = $donnees['titre_evenement'];
    $lieu = $donnees['lieu'];
}


//$description = $_POST['description'];
//$date_evenement = $_POST['date_evenement'];
//$titre_evenement = $_POST['titre_evenement'];
//$lieu = $_POST['lieu'];

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

if (isset($_POST['note']) && isset($id_utilisateur)) {
    $req = $bdd->prepare('INSERT INTO karma(note, id_utilisateur) VALUES(:note, :id_utilisateur)');
    $req->execute(array(
        'note' => $_POST['note'],
        'id_utilisateur' => $id_utilisateur,

    ));
    header('Location: ../php/profil.php');
}

?>

