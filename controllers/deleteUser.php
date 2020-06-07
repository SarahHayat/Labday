<?php
session_start();
require("bdd.php");
/**
 * Supprime l'utilisateur
 */
if (isset($_SESSION['id_name'])) {
    $req = $bdd->prepare('DELETE FROM utilisateurs WHERE id_utilisateur = :id_utilisateur');
    $req->execute(array(
        'id_utilisateur' => $_SESSION['id_name'],
    ));
    session_destroy();
    header('Location: ../php/index.php');
}

?>