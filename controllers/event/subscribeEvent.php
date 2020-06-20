<?php
session_start();
require("../bdd/AllRequest.php");
$resultat = new AllRequest();
/**
 * Inscription événement
 */

$id_evenement = $_GET['id_evenement'];

echo " id evenement : " . $id_evenement;

if (isset ($_SESSION['id_name']) && isset ($id_evenement)) {
    $req = $resultat->subscribeEvent($_SESSION['id_name'], $id_evenement);
//    $req = $bdd->prepare('INSERT INTO inscription_evenements (id_utilisateur, id_evenement) VALUES ( :id_utilisateur, :id_evenement)');
//    $req->execute(array(
//        'id_utilisateur' => $_SESSION['id_name'],
//        'id_evenement' => $id_evenement,
//    ));
    $reponse = $resultat->deleteFavorite($_SESSION['id_name'],$id_evenement );
//    $reponse = $bdd->prepare('DELETE FROM favoris WHERE id_utilisateur = :id_utilisateur AND id_evenement = :id_evenement');
//    $reponse->execute(array(
//        'id_utilisateur' => $_SESSION['id_name'],
//        'id_evenement' => $id_evenement,
//    ));
    header('Location: ../../php/user/profil.php');
}



?>