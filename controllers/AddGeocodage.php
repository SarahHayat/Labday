<?php
require ("bdd.php");
session_start();

$req = $bdd->query('SELECT x, y, titre_evenement FROM evenements');

while ($donnee = $req->fetch()){
    $tabMap = [];
    $coordonnee = ('["'.$donnee['titre_evenement'].'",'.$donnee['x'] .',' .$donnee['y'].']');
    array_push($tabMap,  $coordonnee);
    print_r($tabMap);
}
?>

