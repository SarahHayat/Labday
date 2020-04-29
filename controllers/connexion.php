<?php
session_start();
require ("bdd.php");


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

echo $pseudo;

if(isset($prenom) && isset($nom) && isset($date_naissance) && isset($adresse) && isset($code_postale) && isset($pays) && isset($telephone) && isset($mail) && isset($pseudo) && isset($mot_de_passe)){
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
    echo "votre compte à été crée" ;
}
$username = $_POST["username"];
$password = $_POST["password"];

$_SESSION['username'] = $username;

$req = $bdd->prepare('SELECT pseudo, mot_de_passe FROM utilisateurs WHERE pseudo = :pseudo AND mot_de_passe = :password');
$req->execute(array(
'pseudo' => $username,
'password' => $password
));

$resultat = $req->fetch();

if (!$resultat)
{
header('Location: ../php/connect.php');
}
else
{
    /**
     * recuperer l'id de l'utilisateur connecté
     */




    $req = $bdd->query('SELECT * from utilisateurs where pseudo="' . $_SESSION['username'] . '"');

    while ($donnees = $req->fetch()) {
        $id_name = $donnees['id_utilisateur'];
        $_SESSION['id_name'] = $id_name;
    }


    $req->closeCursor();
    $_SESSION['id_name'] = $id_name;

    $_SESSION['username'] = $username;
header('Location: ../php/index.php');
}


?>