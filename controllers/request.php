<html>
<body>

<form method="post" action="#">
</form>

<?php
require ("Account.php");
require ("bdd.php");
//if (!empty($_POST)){
//    var_dump($_POST);
//    $createaccount = new Account ($_POST["prenom"], $_POST["nom"], $_POST["date_naissance"], $_POST["adresse"],$_POST["code_postal"], $_POST["pays"], $_POST["telephone"], $_POST["mail"], $_POST["pseudo"],$_POST["mot_de_passe"]);
//  //  echo "votre compte à été créer" .$createaccount->getPrenom()."";
//}
$prenom = $_POST["prenom"];
$nom = $_POST["nom"];
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
if(($prenom) && isset($nom) && isset($date_naissance) && isset($adresse) && isset($code_postale) && isset($pays) && isset($telephone) && isset($mail) && isset($pseudo) && isset($mot_de_passe)){
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

header('Location: ../html/index.html');

?>


<form method="post" action="#">
</form>

<?php


?>
</body>
</html>
