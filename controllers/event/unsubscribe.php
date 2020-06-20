<?php
require("../bdd/AllRequest.php");
$resultat = new AllRequest();

/**
 * Se désincrire d'un événement
 */

$id_evenement = $_GET['id_evenement'];
$req = $resultat->unsubscribeEvent($id_evenement);
//$req = $bdd->prepare('DELETE FROM inscription_evenements WHERE id_evenement = :id_evenement');
//$req->execute(array(
//    'id_evenement' => $id_evenement,
//));
header('Location: ../../php/user/profil.php');

?>