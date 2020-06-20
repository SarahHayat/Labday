<?php
session_start();
require("../bdd/AllRequest.php");
$resultat = new AllRequest();
/**
 * Supprime un événement
 */
$id_evenement = $_GET['id_evenement'];
/**
 * supprimer evenement
 */
if (isset($id_evenement)) {
    $id_evenement = $_GET['id_evenement'];
    $req = $resultat->deleteEvent($id_evenement);
//    $req = $bdd->prepare('DELETE FROM evenements WHERE id_evenement = :id_evenement');
//    $req->execute(array(
//        'id_evenement' => $id_evenement,
//    ));
    header('Location: ../../php/user/profil.php');
}

?>




