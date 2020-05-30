<?php
session_start();
require ("../controllers/bdd.php");


if(isset($_GET['pseudo'])) {
    $sql = $bdd->query('SELECT * FROM utilisateurs WHERE pseudo ="' . $_GET['pseudo'] . '"');

    while ($result = $sql->fetch()) {
        if ($result) {

            echo "pseudo deja pris";
        }
    }
}
if(isset($_GET['mail'])) {
    $req = $bdd->query('SELECT * FROM utilisateurs WHERE mail ="' . $_GET['mail'] . '"');

    while ($result = $req->fetch()) {
        if ($result) {

            echo "mail deja pris";
        }
    }
}


?>