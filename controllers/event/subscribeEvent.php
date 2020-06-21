<?php
session_start();
require("../bdd/AllRequest.php");
$resultat = new AllRequest();
/**
 * Inscription événement
 */

$id_evenement = $_GET['id_evenement'];


if (isset ($_SESSION['id_name']) && isset ($id_evenement)) {
    $req = $resultat->subscribeEvent($_SESSION['id_name'], $id_evenement);

    $reponse = $resultat->deleteFavorite($_SESSION['id_name'],$id_evenement );

    header('Location: ../../php/user/profil.php');
}



?>