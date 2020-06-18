<?php
session_start();

/**
 * Se désincrire d'un favoris
 */

require("bdd.php");
$id_evenement = $_GET['id_evenement'];
$req = $bdd->prepare('DELETE FROM favoris WHERE id_evenement = :id_evenement AND id_utilisateur = :id_utilisateur');
$req->execute(array(
    'id_evenement' => $id_evenement,
    'id_utilisateur' => $_SESSION['id_name'],
));
header('Location: ../php/profil.php');

?>