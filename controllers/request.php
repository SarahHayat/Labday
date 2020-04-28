
<?php
session_start();

require ("bdd.php");


$name = $_SESSION['username'];

        $req = $bdd->prepare('SELECT * from utilisateurs where pseudo = ":pseudo"');
        $req->execute(array(
            'pseudo' => $name
        ));

        $req = $bdd->query('SELECT * from utilisateurs where pseudo="' . $name . '"');
        while ($donnees = $req->fetch()) {
            $id_name = $donnees['id_utilisateur'];
            $_SESSION['id_name'] = $id_name;
        }

        $req->closeCursor();
        $_SESSION['id_name'] = $id_name;

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
            header('location: ../php/index.php');

        }else {
            echo '<script> alert("Vous n\'êtes pas connecté ")</script>';
            header('location: ../php/connect.php');

        }



?>
</body>
</html>
