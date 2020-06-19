<?php
require ("AllRequest.php");
$resultat = new AllRequest();

/**
 * Se désincrire d'un événement
 */

require("bdd.php");
$id_evenement = $_GET['id_evenement'];
$req = $resultat->unsubscribeEvent($bdd , $id_evenement);
//$req = $bdd->prepare('DELETE FROM inscription_evenements WHERE id_evenement = :id_evenement');
//$req->execute(array(
//    'id_evenement' => $id_evenement,
//));
header('Location: ../php/profil.php');

?>