<?php

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=ShareEventTogether', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
     // echo "connexion réussi <br/> ";
}
catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>