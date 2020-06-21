<?php
session_start();
require("../bdd/AllRequest.php");
$resultat = new AllRequest();

/**
 * Se désincrire d'un favoris
 */

$id_evenement = $_GET['id_evenement'];
$req = $resultat->deleteFavorite($id_evenement, $_SESSION['id_name']);

header('Location: ../../php/user/profil.php');

?>