<?php
session_start();

require("bdd.php");
/**
 * Reprend les éléments de l'événement
 */
$id_evenement = $_GET['id_evenement'];
$id_utilisateur = $_GET['id_utilisateur'];

$reponse = $bdd->query('SELECT e.*, ce.* FROM evenements as e left join categorie_evenements as ce
on e.id_categorie = ce.id_categorie
where id_evenement = "' . $id_evenement . '"');
// On affiche chaque entrée une à une
while ($donnees = $reponse->fetch()) {
    $description = $donnees['description'];
    $date_evenement = $donnees['date_evenement'];
    $titre_evenement = $donnees['titre_evenement'];
    $lieu = $donnees['lieu'];
}

/**
 * Formulaire note
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

    <label><b>Catégorie</b></label>
    <select name="categorie">
        <option value="<?php echo $donnees['$id_categorie'] ?>"><?php echo $donnees['$nom_categorie'] ?></option>
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
/**
 * Ajouter une note
 */
if (isset($_POST['note']) && isset($id_utilisateur)) {
    $req = $bdd->prepare('INSERT INTO karma(note, id_utilisateur) VALUES(:note, :id_utilisateur)');
    $req->execute(array(
        'note' => $_POST['note'],
        'id_utilisateur' => $id_utilisateur,

    ));
    $req = $bdd->query('SELECT id_karma FROM karma ORDER BY id_karma DESC LIMIT 1');
    while ($donnees = $req->fetch()) {
        $id_karma = $donnees['id_karma'];


        $req = $bdd->query('UPDATE evenements SET id_karma= "' . $id_karma . '" WHERE id_evenement =  "' . $id_evenement . '"');

        $req->closeCursor();
    }

    header('Location: ../php/profil.php');
}

?>

