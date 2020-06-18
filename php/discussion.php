<?php
session_start();
require("../controllers/bdd.php");
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>ShareEventTogether - Sorties à prévoir</title>
    <link rel="stylesheet" href="../assets/css/forum.css"/>
</head>


<body>
<?php
// echo "session username : " . $_SESSION['username'];

if (isset($_SESSION['username'])) {
    require("headerConnect.php");
} else {
    require("headerDisconnect.php");

}

$req = $bdd->query('SELECT nom_sujet FROM sujets_forum  WHERE id_sujet ="' . $_GET['id_sujet'] . '" ');
$donnees = $req->fetch();
?>
<div class="fond">
    <a href="createForum.php"><< Retour</a>

    <div class="sujet">
        <h3><?php echo $donnees['nom_sujet'] ?></h3>
    </div>
    <?php
    $reponse = $bdd->query('SELECT m.id_utilisateur, m.message, sf.nom_sujet, u.pseudo,m.date_message FROM sujets_forum as sf join messages as m on sf.id_sujet = m.id_sujet
left join utilisateurs as u on m.id_utilisateur = u.id_utilisateur WHERE m.id_sujet ="' . $_GET['id_sujet'] . '" '); ?>

    <?php
    while ($donnees = $reponse->fetch()) {
    ?>


    <form method="post" action="replyDiscussion.php?id_sujet=<?php echo $_GET['id_sujet'] ?>">


        <div class="listOfEvent">
            <div class="pictureEvent">
                <p><?php echo "Par " . '<b>' . $donnees['pseudo'] . '</b>' . " Le " . $donnees['date_message'] ?></p>
                <p class="message"><?php echo $donnees['message']; ?></p>

            </div>
        </div>


        <?php
        }
        ?>
        <label> Message :</label>
        <textarea name="message" placeholder="Entrez votre message: "></textarea>

        <input type="submit" value="Envoyer"/>
</div>
</form>
</div>
<?php
require("footer.php");
?>
</body>
</html>
