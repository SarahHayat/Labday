<?php
session_start();
require ("bdd.php");


/**
 * mettre url de la photo dans bdd
 */
?>

<form action="#" method="post">
    <label> choisir votre photo :</label>
    <input type="file" name="photo" value="Parcourir ...">
    <input type="submit" value="Envoyer">
</form>

<?php
$url_photo = $_POST['photo'];
$id_utilisateur = $_SESSION['id_name'];

if (isset($url_photo) && isset($id_utilisateur)) {
    $req = $bdd->prepare('INSERT INTO photo_utilisateurs(id_utilisateur, url) VALUES(:id_utilisateur, :url)');
    $req->execute(array(
        'id_utilisateur' => $id_utilisateur,
        'url' => $url_photo,

    ));
    header('Location: ../php/profil.php');
}

/**
 * mettre url dans photoProfil
 */


?>


