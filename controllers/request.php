
<?php
session_start();

require ("bdd.php");


$name = $_SESSION['username'];

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
        $req = $bdd->prepare('SELECT * from utilisateurs where pseudo = ":pseudo"');
        $req->execute(array(
            'pseudo' => $name
        ));

echo $pseudo;
Updated upstream

if(isset($prenom) && isset($nom) && isset($date_naissance) && isset($adresse) && isset($code_postale) && isset($pays) && isset($telephone) && isset($mail) && isset($pseudo) && isset($mot_de_passe)){
    $req = $bdd->prepare('INSERT INTO utilisateurs(prenom, nom, date_naissance, adresse, code_postale, pays, telephone, mail, pseudo, mot_de_passe) VALUES(:prenom, :nom, :date_naissance, :adresse, :code_postale, :pays, :telephone, :mail, :pseudo, :mot_de_passe)');
 Stashed changes
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
        $req = $bdd->query('SELECT * from utilisateurs where pseudo="' . $name . '"');
        while ($donnees = $req->fetch()) {
            $id_name = $donnees['id_utilisateur'];
            $_SESSION['id_name'] = $id_name;
        }


    ));
    echo "votre compte à été crée" ;
}
        $req->closeCursor();
        $_SESSION['id_name'] = $id_name;


$username = $_POST["username"];
$password = $_POST["password"];
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

if (!$resultat)
{
    header('Location: ../php/connect.php');
}
else
{
    $_SESSION['username'] = $username;
    header('Location: ../php/index.php');
}
//lister les évènement d'une personne

$titre_evenement = $_POST["titre_evenement"];
$date_poste = $_POST["date_poste"];

$req = $bdd->prepare('SELECT titre_evenement, date_poste FROM evenements where id_utilisateur = :id_utilisateur');
$req->execute(array(
        'titre_evenement' => $titre_evenement,
        'date_poste' => $date_poste

));

//ajouter un évènement

$id_evenement = $_POST["id_evenement"];
$id_utilisateur = $_POST["id_utilisateur"];
$date_poste = $_POST["date_poste"];
$description = $_POST["description"];
$date_evenement = $_POST["date_evenement"];
$titre_evenement = $_POST["titre_evenement"];
$id_karma = $_POST["id_karma"];
$lieu = $_POST["lieu"];

if (isset($id_evenement) && isset($id_utilisateur) && isset($date_poste) && isset($description) && isset($date_evenement) && isset($titre_evenement) && isset($id_karma) && isset($lieu)){
    $req = $bdd->prepare('INSERT INTO evenement(id_evenement, id_utilisateur, date_poste, description, date_evenement, titre_evenement, id_karma, lieu) VALUES (:id_evenement, :id_utilisateur, :date_poste, :description, :date_evenement, :titre_evenement, :id_karma, :lieu)');
    $req->execute(array(
        'id_evenement' => $id_evenement,
        'id_utilisateur' => $id_utilisateur,
        'date_poste' => $date_poste,
        'description' => $description,
        'date_evenement' => $date_evenement,
        'titre_evenement' => $titre_evenement,
        'id_karma' => $id_karma,
        'lieu' => $lieu,

    ));
    echo "Votre évènement à été crée" ;
}

// supprimer un evenement
$req = $bdd->prepare('DELETE FROM evenement WHERE id_evenement = :id_evenement');

//modifier un evenement

$req = $bdd->prepare('UPDATE evenement SET id_evenement = $id_evenement, id_utilisateur = $id_utilisateur, date_poste = $date_poste, description = $description, date_evenement = $date_evenement, titre_evenement = $titre_evenement, id_karma = $id_karma, lieu = $lieu');

// voir la note de karma d'un utilisateur

$req = $bdd->prepare('SELECT note FROM karma WHERE id_utilisateur = :id_utilisateur');

// inscription à un evenement

$id_inscription = $_POST["id_inscription"];
$id_utilisateur = $_POST["id_utilisateur"];
$id_evenement = $_POST["id_evenement"];

if(isset($id_inscription) && isset ($id_utilisateur) && isset ($id_evenement)){
    $req = $bdd->prepare('INSERT INTO inscription_evenements (id_inscription, id_utilisateur, id_evenement) VALUES (:id_inscription, :id_utilisateur, :id_evenement)');
    $req->execute(array(
        'id_inscription' =>$id_inscription,
        'id_utilisateur' =>$id_utilisateur,
        'id_evenement' =>$id_evenement,
    ));
    echo "Vous vous êtes inscrit à un évènement" ;
}
?>


?>
</body>
</html>
