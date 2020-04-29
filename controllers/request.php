
<?php
session_start();

require ("bdd.php");




echo "id user" . $_SESSION['id_name'];


/**
 * Creer un évenement
 */

        $description = $_POST["description"];
        $date_evenement = $_POST["date_evenement"];
        $titre = $_POST["titre"];
        $lieu = $_POST["lieux"];


        if (isset($_SESSION['id_name']) && isset($description) && isset($date_evenement) && isset($titre) && isset($lieu) && isset($_SESSION['username'])) {
            $req = $bdd->prepare('INSERT INTO evenements(id_utilisateur, description, date_evenement, titre_evenement, lieu) VALUES(:utilisateur, :description, :date_evenement, :titre, :lieu)');
            $req->execute(array(
                'utilisateur' => $_SESSION['id_name'],
                'description' => $description,
                'date_evenement' => $date_evenement,
                'titre' => $titre,
                'lieu' => $lieu,

            ));
            header('location: ../php/profil.php');

        }else {
            echo '<script> alert("Vous n\'êtes pas connecté ")</script>';
            header('location: ../php/connect.php');

        }



// supprimer un evenement
            $req = $bdd->prepare('DELETE FROM evenement WHERE id_evenement = :id_evenement');

//modifier un evenement

            $req = $bdd->prepare('UPDATE evenement SET id_evenement = $id_evenement, id_utilisateur = $id_utilisateur, date_poste = $date_poste, description = $description, date_evenement = $date_evenement, titre_evenement = $titre_evenement, id_karma = $id_karma, lieu = $lieu');

// voir la note de karma d'un utilisateur

$req = $bdd->prepare('SELECT note FROM karma WHERE id_utilisateur = :id_utilisateur');



/**
 * recuperer l'id évenement
 */


?>


