<?php
session_start();
/**
 * Supprime un événement
 */
require("bdd.php");
$id_evenement = $_GET['id_evenement'];
/**
 * supprimer evenement
 */
if (isset($id_evenement)) {
    $id_evenement = $_GET['id_evenement'];
    $req = $bdd->prepare('DELETE FROM evenements WHERE id_evenement = :id_evenement');
    $req->execute(array(
        'id_evenement' => $id_evenement,
    ));
    header('Location: ../php/index.php');
}

?>




