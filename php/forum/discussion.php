<?php
session_start();

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>ShareEventTogether - Sorties à prévoir</title>
    <link rel="stylesheet" href="../../assets/css/forum.css"/>
</head>


<body>
<div style="display: flex; flex-direction: row">
<?php

if (isset($_SESSION['username'])) {
    require("../header/headerConnect.php");
} else {
    require("../header/headerDisconnect.php");

}
$req = $resultat->getSubjectById($_GET['id_sujet']);
$donnees = $req->fetch();
?>
<div class="fond">
    <a href="createForum.php"><< Retour</a>

    <div class="sujet">
        <h3><?php echo $donnees['nom_sujet'] ?></h3>
    </div>
    <?php
    $reponse = $resultat->getMessageBySubject($_GET['id_sujet']);

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
require("../footer/footer.php");
?>
</body>
</html>
