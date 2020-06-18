<?php
session_start();
require ("../controllers/AllRequest.php");
$resultat = new AllRequest();
require('../controllers/bdd.php');

//$requete = $bdd->query('SELECT * FROM sujets_forum WHERE id_sujet = "'.$_GET['id_sujet'].'"');
//$donnees = $requete->fetch();
//$id_sujet = $donnees['id_sujet'];
$id_sujet = $_GET['id_sujet'];
$date = date('Y-m-d H:i:s');

$req = $resultat-> addNewMessage($bdd, $date, $_SESSION['id_name'], $_POST['message'], $id_sujet );
//$req = $bdd->prepare("INSERT INTO messages(id_utilisateur, message, id_sujet, date_message) VALUES(:id_utilisateur, :message, :id_sujet, :date_message)");
//$req->execute(array(
//    'date_message' => $date,
//    'id_utilisateur' => $_SESSION['id_name'],
//    'message' => $_POST['message'],
//    'id_sujet' => $id_sujet,
//));
$req->closeCursor();
header('Location:' . $_SERVER['HTTP_REFERER']);
