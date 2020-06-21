
<?php
session_start();
require("../bdd/AllRequest.php");
$resultat = new AllRequest();


/**
 * Creer un évenement
 */

        $description = $_POST["description"];
        $date_evenement = $_POST["date_evenement"];
        $titre = $_POST["titre"];
        $adresse = $_POST["adresse"];
        $code_postal = $_POST["code_postal"];
        $commune = $_POST["commune"];
        $categorie = $_POST['categorie'];
        $x = $_POST['x'];
        $y = $_POST['y'];


        if (isset($_SESSION['id_name'], $description, $date_evenement, $titre, $adresse, $code_postal, $commune, $_SESSION['username'], $categorie)) {
           $req =$resultat->createEvent($_SESSION['id_name'], $description, $date_evenement, $titre, $adresse, $code_postal, $commune, $categorie, $x, $y);

            
            header('location: ../../php/user/profil.php');

        }else {
            echo '<script> alert("Vous n\'êtes pas connecté ")</script>';
            header('location: ../../php/connexion/connexion.php');

        }

?>


