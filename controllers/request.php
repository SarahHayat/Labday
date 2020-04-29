
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


        if (isset($id_name) && isset($description) && isset($date_evenement) && isset($titre) && isset($lieu) && isset($_SESSION['username'])) {
            $req = $bdd->prepare('INSERT INTO evenements(id_utilisateur, description, date_evenement, titre_evenement, lieu) VALUES(:utilisateur, :description, :date_evenement, :titre, :lieu)');
            $req->execute(array(
                'utilisateur' => $id_name,
                'description' => $description,
                'date_evenement' => $date_evenement,
                'titre' => $titre,
                'lieu' => $lieu,

            ));
            header('location: ../php/sortieDuJour.php');

        }else {
            echo '<script> alert("Vous n\'êtes pas connecté ")</script>';
            header('location: ../php/connect.php');

            if (!$resultat) {
                header('Location: ../php/connect.php');
            } else {
                $_SESSION['username'] = $username;
                header('Location: ../php/index.php');
            }
        }
//lister les évènement d'une personne

            $titre_evenement = $_POST["titre_evenement"];
            $date_poste = $_POST["date_poste"];

            $req = $bdd->prepare('SELECT titre_evenement, date_poste FROM evenements where id_utilisateur = :id_utilisateur');
            $req->execute(array(
                'titre_evenement' => $titre_evenement,
                'date_poste' => $date_poste

            ));


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


