<?php
session_start();
require("../bdd/AllRequest.php");
$resultat = new AllRequest();
/**
 * Ajouter un événement à ses favoris
 */

$id_evenement = $_GET['id_evenement'];

if (isset ($_SESSION['id_name']) && isset ($id_evenement)) {
    $req = $resultat->addFavorite($_SESSION['id_name'], $id_evenement);
//    $req = $bdd->prepare('INSERT INTO favoris (id_utilisateur, id_evenement) VALUES ( :id_utilisateur, :id_evenement)');
//    $req->execute(array(
//        'id_utilisateur' => $_SESSION['id_name'],
//        'id_evenement' => $id_evenement,
//    ));
    header('Location: ../../php/event/events.php');
}


?>