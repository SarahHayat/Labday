<?php
session_start();
require("../bdd/AllRequest.php");
$resultat = new AllRequest();
/**
 * Supprime l'utilisateur
 */
if (isset($_SESSION['id_name'])) {
    $req = $resultat->deleteUser($_SESSION['id_name'] );

    session_destroy();
    header('Location: ../php/index.php');
}

?>