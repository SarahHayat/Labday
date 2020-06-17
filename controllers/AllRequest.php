<?php
require("bdd.php");

class AllRequest

{
    public $bdd = null;


    public function __construct()
    {
        try {
            $this->bdd = new PDO('mysql:host=localhost;dbname=ShareEventTogether', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            // echo "connexion réussi <br/> ";
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function isAllSet($tab)
    {
        for ($i = 0; $i < count($tab); $i++) {
            if (isset($tab[$i])) {
            } else {
                return false;
            }
        }
        return true;
    }

//    public function selectFromBdd($table,$champs, $value){
//        if($champs) {
//            return "SELECT * FROM " . $table . " WHERE " . $champs . "  =  " . $value;
//        }else{
//            return "SELECT * FROM " . $table;
//        }
//    }
//
//    public function insertToBdd($table, $champs, $value){
//        return ("INSERT INTO ".$table[($champs)]."VALUES".[$value]);
//    }

    public function verifConnect($bdd, $username, $password)
    {
        $req = $bdd->prepare('SELECT pseudo, mot_de_passe FROM utilisateurs WHERE pseudo = :pseudo AND mot_de_passe = :password');
        $req->execute(array(
            'pseudo' => $username,
            'password' => $password
        ));
        $resultat = $req->fetch();
        return $resultat;
    }

    public function getUserId($bdd, $username)
    {
        $req = $bdd->query('SELECT * from utilisateurs where pseudo="' . $username . '"');
        return $req;
    }

    public function startKarma($bdd, $id_name)
    {
        $req = $bdd->prepare('INSERT INTO karma(id_utilisateur, note) VALUES(:id_utilisateur, :note)');
        $req->execute(array(
            'id_utilisateur' => $id_name,
            'note' => 5,
        ));
        return $req;
    }

    public function averageKarma($bdd, $id_name ){
        $requete = $bdd->query('SELECT AVG(note) as moyenne FROM karma WHERE id_utilisateur ="' . $id_name. '"');
        return $requete;
    }

    public function updateAverageKarma($bdd, $moyenne, $id_name){
        $reponse = $bdd->query('UPDATE utilisateurs SET karma="'.$moyenne.'" WHERE id_utilisateur ="'.$id_name.'"');
        return $reponse;
    }

    public function createAccount()
    {
        $prenom = $_POST["prenom"];
        $nom = $_POST["nom"];
        $date_naissance = $_POST["date_naissance"];
        $adresse = $_POST["adresse"];
        $code_postale = $_POST["code_postale"];
        $pays = $_POST["pays"];
        $telephone = $_POST["telephone"];
        $mail = $_POST["mail"];
        $pseudo = $_POST["pseudo"];
        $mot_de_passe = $_POST["mot_de_passe"];
        $ville = $_POST["ville"];
        $type_utilisateur = $_POST["type_utilisateur"];

        $tableau = array($prenom, $nom, $date_naissance, $adresse, $code_postale, $pays, $telephone, $mail, $pseudo, $mot_de_passe, $ville, $type_utilisateur);

        /**
         * ajout d'un nouveau compte
         */
        if ($this->isAllSet($tableau)) {
            $req = $this->insertToBdd($this->bdd, "utilisateurs(['prenom', 'nom', 'date_naissance', 'adresse', code_postale, pays, telephone, mail, pseudo, mot_de_passe, type_utilisateur, ville])");
            //$req = $bdd->prepare('INSERT INTO utilisateurs(prenom, nom, date_naissance, adresse, code_postale, pays, telephone, mail, pseudo, mot_de_passe, type_utilisateur, ville) VALUES(:prenom, :nom, :date_naissance, :adresse, :code_postale, :pays, :telephone, :mail, :pseudo, :mot_de_passe, :type_utilisateur, :ville)');
            $req->execute(array(
                'prenom' => $prenom,
                'nom' => $nom,
                'date_naissance' => $date_naissance,
                'adresse' => $adresse,
                'code_postale' => $code_postale,
                'pays' => $pays,
                'telephone' => $telephone,
                'mail' => $mail,
                'pseudo' => $pseudo,
                'mot_de_passe' => $mot_de_passe,
                'type_utilisateur' => $type_utilisateur,
                'ville' => $ville,
            ));
        }
    }

    public function desincriptionEvent($bdd)
    {
        $id_evenement = $_GET['id_evenement'];
        if (isset($id_evenement)) {
            $req = $bdd->prepare('DELETE FROM inscription_evenements WHERE id_evenement = :id_evenement');
            $req->execute(array(
                'id_evenement' => $id_evenement,
            ));
            header('Location: ../php/profil.php');
        }
    }


    public function inscriptionEvent($bdd)
    {
        $id_evenement = $_GET['id_evenement'];

        if (isset ($_SESSION['id_name']) && isset ($id_evenement)) {
            $req = $bdd->prepare('INSERT INTO inscription_evenements (id_utilisateur, id_evenement) VALUES ( :id_utilisateur, :id_evenement)');
            $req->execute(array(
                'id_utilisateur' => $_SESSION['id_name'],
                'id_evenement' => $id_evenement,
            ));
            echo "Vous vous êtes inscrit à un évènement";
            header('Location: ../php/profil.php');
        }
    }

    public function createEvent($bdd)
    {
        $description = $_POST["description"];
        $date_evenement = $_POST["date_evenement"];
        $titre = $_POST["titre"];
        $lieu = $_POST["lieux"];

        $tableau = array($description, $date_evenement, $titre, $lieu, $_SESSION['id_name'], $_SESSION['username']);

        if ($this->isAllSet($tableau)) {
            $req = $bdd->prepare('INSERT INTO evenements(id_utilisateur, description, date_evenement, titre_evenement, lieu) VALUES(:utilisateur, :description, :date_evenement, :titre, :lieu)');
            $req->execute(array(
                'utilisateur' => $_SESSION['id_name'],
                'description' => $description,
                'date_evenement' => $date_evenement,
                'titre' => $titre,
                'lieu' => $lieu,

            ));
            header('location: ../php/profil.php');

        } else {
            echo '<script> alert("Vous n\'êtes pas connecté ")</script>';
            header('location: ../php/connexion.php');

        }
    }

    public function deleteEvent($bdd)
    {
        if (isset($id_evenement)) {
            $id_evenement = $_GET['id_evenement'];
            $req = $bdd->prepare('DELETE FROM evenements WHERE id_evenement = :id_evenement');
            $req->execute(array(
                'id_evenement' => $id_evenement,
            ));
            header('Location: ../php/index.php');
        }
    }

    public function deleteUser($bdd)
    {
        if (isset($_SESSION['id_name'])) {
            $id_evenement = $_GET['id_evenement'];
            $req = $bdd->prepare('DELETE FROM utilisateurs WHERE id_utilisateur = :id_utilisateur');
            $req->execute(array(
                'id_utilisateur' => $_SESSION['id_name'],
            ));
            session_destroy();
            header('Location: ../php/connexion.php');
        }
    }

    public function updateEvent($bdd)
    {
        $id_evenement = $_GET['id_evenement'];


        $reponse = $this->selectFromBdd($bdd, "evenements", "id_evenement", $id_evenement);
        // On affiche chaque entrée une à une
        while ($donnees = $reponse->fetch()) {
            $description = $donnees['description'];
            $date_evenement = $donnees['date_evenement'];
            $titre_evenement = $donnees['titre_evenement'];
            $lieu = $donnees['lieu'];
        }

        ?>
        <!DOCTYPE html>
        <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Labday</title>
        <link rel="stylesheet" href="../assets/css/connect.css"/>
    </head>


    <form action="#" method="post" class="container fond">
        <h1> Modification Evenement</h1>

        <label><b>Titre</b></label>
        <input type="text" placeholder="titre" name="titre_evenement" required value="<?php echo $titre_evenement ?>">

        <label><b>Lieu</b></label>
        <input type="text" placeholder="lieux" name="lieu" value="<?php echo $lieu ?>" required>

        <label><b>Date de l'évenement</b></label>
        <input type="datetime" name="date_evenement" value="<?php echo $date_evenement ?>" required>

        <label><b>Description</b></label></br>
        <textarea name="description" required><?php echo $description ?></textarea>

        <input type="submit" id='enregistrer' value='ENREGISTRER'>
    </form>
        <?php


        if ($this->isAllSet(array($_POST['description'], $_POST['date_evenement'], $_POST['titre_evenement'], $_POST['lieu'], $id_evenement))) {

            $req = $bdd->prepare('UPDATE evenements SET description = :description, date_evenement = :date_evenement
, titre_evenement = :titre_evenement, lieu = :lieu WHERE id_evenement = "' . $id_evenement . '"');
            $req->execute(array(
                'description' => $_POST['description'],
                'date_evenement' => $_POST['date_evenement'],
                'titre_evenement' => $_POST['titre_evenement'],
                'lieu' => $_POST['lieu'],


            ));
            header('Location: ../php/profil.php');
        }
    }
}
