<?php
session_start();
require("bdd.php");
require ("AllRequest.php");
$resultat = new AllRequest();


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

/**
 * ajout d'un nouveau compte
 */
if (isset($prenom, $nom, $date_naissance, $adresse, $code_postale, $pays, $telephone, $mail, $pseudo, $mot_de_passe)) {
    $reponse = $bdd->query('SELECT pseudo from utilisateurs where pseudo = "' . $pseudo . '" OR mail = "' . $mail . '"');
    $donnees = $reponse->fetch();
    if (!$donnees) {
        $req = $bdd->prepare('INSERT INTO utilisateurs(prenom, nom, date_naissance, adresse, code_postale, pays, telephone, mail, pseudo, mot_de_passe, type_utilisateur, ville) VALUES(:prenom, :nom, :date_naissance, :adresse, :code_postale, :pays, :telephone, :mail, :pseudo, :mot_de_passe, :type_utilisateur, :ville)');
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
        ?>
        <script>
            alert("Votre compte à bien été crée, veuillez vous connecter");

        </script>
        <?php
        header('Location: ../php/index.php');

    } else {

        header('Location: ../php/connexion.php');

    }

}


$username = $_POST["username"];
$password = $_POST["password"];


/**
 * verification connexion
 */
if (isset($username,$password)) {
//    $req = $bdd->prepare('SELECT pseudo, mot_de_passe FROM utilisateurs WHERE pseudo = :pseudo AND mot_de_passe = :password');
//    $req->execute(array(
//        'pseudo' => $username,
//        'password' => $password
//    ));

    $result = $resultat->verifConnect($bdd, $username, $password);

    // $resultat = $req->fetch();

    if (!$result) {
        // header('Location: ../php/connexion.php');
        header('Location:' . $_SERVER['HTTP_REFERER']);

    } else {
        /**
         * recuperer l'id de l'utilisateur connecté
         */
        $_SESSION['username'] = $username;

         //$req = $bdd->query('SELECT * from utilisateurs where pseudo="' . $_SESSION['username'] . '"');
            $req = $resultat->getUserId($bdd, $_SESSION['username']);
        while ($donnees = $req->fetch()) {
            $id_name = $donnees['id_utilisateur'];
            $_SESSION['id_name'] = $id_name;
            $type = $donnees['type_utilisateur'];
            $_SESSION['type_utilisateur'] = $type;

            echo " karma : " . $donnees['karma'] . " utilisateur : " . $donnees['id_utilisateur'];
            if ($donnees['karma'] == 0.00) {

                //$req = $bdd->prepare('INSERT INTO karma(id_utilisateur, note) VALUES(:id_utilisateur, :note)');
               // $req->execute(array(
               //     'id_utilisateur' => $id_name,
               //     'note' => 5,
               // ));
                $req = $resultat->startKarma($bdd, $id_name);
            }
           // $requete = $bdd->query('SELECT AVG(note) as moyenne FROM karma WHERE id_utilisateur ="' . $_SESSION['id_name'] . '"');
           $requete = $resultat->averageKarma($bdd, $_SESSION['id_name']);
            $donnees = $requete->fetch();
            $moyenne = $donnees['moyenne'];
            echo "moyenne : " . $moyenne;

          // $reponse = $bdd->query('UPDATE utilisateurs SET karma="'.$moyenne.'" WHERE id_utilisateur ="'.$_SESSION['id_name'].'"');
            $reponse = $resultat->updateAverageKarma($bdd, $moyenne,$_SESSION['id_name'] );
            header('Location: ../php/index.php');
        }



        $req->closeCursor();
        $_SESSION['id_name'] = $id_name;
        $_SESSION['type_utilisateur'] = $type;

        $_SESSION['username'] = $username;
          header('Location: ../php/index.php');
    }
}


?>

