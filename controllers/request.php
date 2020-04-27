
<?php
session_start();
?>
<html>
<body>

<form method="post" action="#">
</form>

<?php

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

echo $pseudo;
if(isset($prenom) && isset($nom) && isset($date_naissance) && isset($adresse) && isset($code_postale) && isset($pays) && isset($telephone) && isset($mail) && isset($pseudo) && isset($mot_de_passe)){
    $req = $bdd->prepare('INSERT INTO utilisateurs(prenom, nom, date_naissance, adresse, code_postale, pays, telephone, mail, pseudo, mot_de_passe) VALUES(:prenom, :nom, :date_naissance, :adresse, :code_postale, :pays, :telephone, :mail, :pseudo, :mot_de_passe)');
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

    ));
    echo "votre compte à été crée" ;
}

$username = $_POST["username"];
$password = $_POST["password"];

$_SESSION["username"] = $username;

$req = $bdd->prepare('SELECT pseudo, mot_de_passe FROM utilisateurs WHERE pseudo = :pseudo AND mot_de_passe = :password');
$req->execute(array(
    'pseudo' => $username,
    'password' => $password
));

$resultat = $req->fetch();

if (!$resultat)
{
    header('Location: ../html/connect.php');
}
else
{

    header('Location: ../html/index.php');
}

?>

</body>
</html>
