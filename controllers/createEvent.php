
<?php
session_start();

require ("bdd.php");

/**
 * Creer un évenement
 */

        $description = $_POST["description"];
        $date_evenement = $_POST["date_evenement"];
        $titre = $_POST["titre"];
        $adresse = $_POST["adresse"];
        $code_postale = $_POST["code_postale"];
        $commune = $_POST["commune"];
        $categorie = $_POST['categorie'];
        $x = $_POST['x'];
        $y = $_POST['y'];

        if (isset($_SESSION['id_name']) && isset($description) && isset($date_evenement) && isset($titre) && isset($adresse) && isset($code_postale) && isset($commune) && isset($_SESSION['username']) && isset($categorie)) {
            $req = $bdd->prepare('INSERT INTO evenements(id_utilisateur, description, date_evenement, titre_evenement, adresse, code_postale, commune, id_categorie) VALUES(:utilisateur, :description, :date_evenement, :titre, :adresse, :code_postale, :commune, :categorie)');
            $req->execute(array(
                'utilisateur' => $_SESSION['id_name'],
                'description' => $description,
                'date_evenement' => $date_evenement,
                'titre' => $titre,
                'adresse' => $adresse,
                'code_postale' => $code_postale,
                'commune' => $commune,
                'categorie' => $categorie,

            ));
            header('location: ../php/profil.php');

        }else {
            echo '<script> alert("Vous n\'êtes pas connecté ")</script>';
            header('location: ../php/connexion.php');

        }

?>


