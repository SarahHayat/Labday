
<?php
session_start();

require ("bdd.php");



/**
 * Creer un évenement
 */

        $description = $_POST["description"];
        $date_evenement = $_POST["date_evenement"];
        $titre = $_POST["titre"];
        $lieu = $_POST["lieux"];
        $categorie = $_POST['categorie'];


        if (isset($_SESSION['id_name']) && isset($description) && isset($date_evenement) && isset($titre) && isset($lieu) && isset($_SESSION['username']) && isset($categorie)) {
            $req = $bdd->prepare('INSERT INTO evenements(id_utilisateur, description, date_evenement, titre_evenement, lieu, id_categorie) VALUES(:utilisateur, :description, :date_evenement, :titre, :lieu, :categorie)');
            $req->execute(array(
                'utilisateur' => $_SESSION['id_name'],
                'description' => $description,
                'date_evenement' => $date_evenement,
                'titre' => $titre,
                'lieu' => $lieu,
                'categorie' => $categorie,

            ));
            header('location: ../php/profil.php');

        }else {
            echo '<script> alert("Vous n\'êtes pas connecté ")</script>';
            header('location: ../php/connect.php');

        }

?>


