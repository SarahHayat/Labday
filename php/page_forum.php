<?php
session_start();
require("../controllers/bdd.php");
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>ShareEventTogether - Sorties à prévoir</title>
    <link rel="stylesheet" href="../assets/css/sortie.css"/>
</head>


<body>
<?php
// echo "session username : " . $_SESSION['username'];

if (isset($_SESSION['username'])) {
    require("headerConnect.php");
} else {
    require("headerDisconnect.php");

}

$req = $bdd->query('SELECT nom_sujet FROM sujets_forum  WHERE id_sujet ="'.$_GET['id_sujet'].'" ');
$donnees = $req->fetch();
?>
<div>
    <h3><?php echo $donnees['nom_sujet'] ?></h3>
</div>
<?php
$reponse = $bdd->query('SELECT m.id_utilisateur, m.message, sf.nom_sujet, u.pseudo,m.date_message FROM sujets_forum as sf join messages as m on sf.id_sujet = m.id_sujet
left join utilisateurs as u on m.id_utilisateur = u.id_utilisateur WHERE m.id_sujet ="'.$_GET['id_sujet'].'" ');
while ($donnees = $reponse->fetch()) {
?>

<div class="evenement">
    <form method="post" action="reponseForum.php?id_sujet=<?php echo $_GET['id_sujet'] ?>">

        <div class="evenement">

            <div class="listOfEvent">
                <ul class="collectionItem">
                    <div class="pictureEvent">
                        <p><?php echo "Par " . '<b>' . $donnees['pseudo'] . '</b>' ?></p>
                        <p> <?php echo "Le " . $donnees['date_message'] ?> </p>
                        <p><?php echo $donnees['message']; ?></p>

                    </div>
                </ul>
            </div>


            <?php
            }
            ?>
            <div>
                <label> Message :</label>
                <textarea name="message"> Entrez votre message</textarea>

                <input type="submit" value="Envoyer"/>
            </div>
    </form>
</div>
</body>
