<?php
session_start();
require("../bdd/AllRequest.php");
$resultat = new AllRequest();
/**
 * Supprime un événement
 */
$id_evenement = $_GET['id_evenement'];

if (isset($id_evenement)) {
    $id_evenement = $_GET['id_evenement'];
    $req = $resultat->deleteEvent($id_evenement);

    header('Location: ../../php/user/profil.php');
}

?>




