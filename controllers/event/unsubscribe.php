<?php
require("../bdd/AllRequest.php");
$resultat = new AllRequest();

/**
 * Se désincrire d'un événement
 */

$id_evenement = $_GET['id_evenement'];
$req = $resultat->unsubscribeEvent($id_evenement);

header('Location: ../../php/user/profil.php');

?>