
<?php
session_start();
require ("AllRequest.php");
$resultat = new AllRequest();

require ("bdd.php");

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

        echo "x : " . $x;
        echo "y : " . $y;

        if (isset($_SESSION['id_name'], $description, $date_evenement, $titre, $adresse, $code_postal, $commune, $_SESSION['username'], $categorie)) {
           $req =$resultat->createEvent();
//            $req = $bdd->prepare('INSERT INTO evenements(id_utilisateur, description, date_evenement, titre_evenement, adresse, code_postal, commune, id_categorie, x, y) VALUES(:utilisateur, :description, :date_evenement, :titre, :adresse, :code_postal, :commune, :categorie, :x, :y)');
//            $req->execute(array(
//                'utilisateur' => $_SESSION['id_name'],
//                'description' => $description,
//                'date_evenement' => $date_evenement,
//                'titre' => $titre,
//                'adresse' => $adresse,
//                'code_postal' => $code_postal,
//                'commune' => $commune,
//                'categorie' => $categorie,
//                'x' => $x,
//                'y' => $y,
//
//            ));
            
            header('location: ../php/profil.php');

        }else {
            echo '<script> alert("Vous n\'êtes pas connecté ")</script>';
            header('location: ../php/connexion.php');

        }

?>


