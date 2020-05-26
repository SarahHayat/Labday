<?php
session_start();
require('../controllers/bdd.php');

$requete = $bdd->prepare('SELECT * FROM sujets_forum WHERE nom_sujet = :sujet');
$requete->execute(array(
    'sujet' => $_POST['sujet'],
));
$donnees = $requete->fetch();
$id_sujet = $donnees['id_sujet'];


$req = $bdd->prepare("INSERT INTO messages(id_utilisateur, message, id_sujet) VALUES(:id_utilisateur, :message, :id_sujet)");
$req->execute(array(
    'id_utilisateur' => $_SESSION['id_name'],
    'message' => $_POST['message'],
    'id_sujet' => $id_sujet,
));
header('Location: page_forum.php');