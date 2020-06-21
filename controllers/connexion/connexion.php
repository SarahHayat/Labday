<?php
session_start();
require("../bdd/AllRequest.php");
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
    $reponse = $resultat->existAccount($pseudo, $mail);

    $donnees = $reponse->fetch();

    $mot_de_passe= sha1($mot_de_passe);

    if (!$donnees) {
        $req = $resultat->createAccount($prenom, $nom, $date_naissance, $adresse, $code_postale, $pays, $telephone,
                                            $mail, $pseudo, $mot_de_passe, $type_utilisateur, $ville);

        header('Location: ../../php/index.php');

    } else {

        header('Location: ../../php/connexion/connexion.php');

    }
}


$username = $_POST["username"];
$password = $_POST["password"];



/**
 * verification connexion
 */
if (isset($username,$password)) {


    $password= sha1($password);
    $result = $resultat->verifConnect($username, $password);


    if (!$result) {
        header('Location:' . $_SERVER['HTTP_REFERER']);

    } else {
        /**
         * recuperer l'id de l'utilisateur connecté
         */
        $_SESSION['username'] = $username;

            $req = $resultat->getUserId($_SESSION['username']);
        while ($donnees = $req->fetch()) {
            $id_name = $donnees['id_utilisateur'];
            $_SESSION['id_name'] = $id_name;
            $type = $donnees['type_utilisateur'];
            $_SESSION['type_utilisateur'] = $type;

            if ($donnees['karma'] == 0.00) {

                $req = $resultat->startKarma($id_name);
            }
           $requete = $resultat->averageKarma($_SESSION['id_name']);
            $donnees = $requete->fetch();
            $moyenne = $donnees['moyenne'];

            $reponse = $resultat->updateAverageKarma($moyenne,$_SESSION['id_name'] );
            header('Location: ../../php/connexion/connexion.php');
        }



        $req->closeCursor();
        $_SESSION['id_name'] = $id_name;
        $_SESSION['type_utilisateur'] = $type;

        $_SESSION['username'] = $username;
          header('Location: ../../php/index.php');
    }
}


?>

