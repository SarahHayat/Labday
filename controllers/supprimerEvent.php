<?php
session_start();

require ("bdd.php");
if(isset($id_evenement)) {
    $id_evenement = $_GET['id_evenement'];
    $req = $bdd->prepare('DELETE FROM evenements WHERE id_evenement = :id_evenement');
    $req->execute(array(
        'id_evenement' => $id_evenement,
    ));
    header('Location: ../php/index.php');
}

if(isset($_SESSION['id_name'])) {
    $id_evenement = $_GET['id_evenement'];
    $req = $bdd->prepare('DELETE FROM utilisateurs WHERE id_utilisateur = :id_utilisateur');
    $req->execute(array(
        'id_utilisateur' => $_SESSION['id_name'],
    ));
    session_destroy();
    header('Location: ../php/connect.php');
}




