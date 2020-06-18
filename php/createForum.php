<?php
session_start();
require ("../controllers/AllRequest.php");
$resultat = new AllRequest();
require('../controllers/bdd.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ShareEventTogether - Contact</title>
    <link rel="stylesheet" href="../assets/css/forum.css"/>
</head>
<body>
<div style="display: flex; flex-direction: row">

    <?php
    // echo "session username : " . $_SESSION['username'];

    if (isset($_SESSION['username'])) {
        require("headerConnect.php");
    } else {
        require("headerDisconnect.php");

    }

    ?>

    <div class="fond">

        <form action="forumSearch.php" method="get">
            <input type="search" name="search_forum" placeholder="recherche...">
            <input type="submit" value="entrer">
        </form>
        <form method="post" action="../controllers/forum.php" id="form_forum">
            <input type="submit" id="button" value="Créer un sujet" class="button_sujet">
            <div id="chat">
                <label><b>Sujet :</b> <span class="obligatoire">*</span></label>
                <input type="text" name="sujet" required>
                </br>
                <label> Message : <span class="obligatoire">*</span></label>
                <textarea name="message" required placeholder="Entrez votre messsage..."></textarea>
                <input type="submit" value="Envoyer"/>
            </div>

        </form>

        <div>
            <?php
            $reponse = $resultat->getAllSubjectForum($bdd);
//            $reponse = $bdd->query("SELECT sj.nom_sujet, m.message, sj.id_sujet, u.pseudo,m.date_message FROM sujets_forum as sj
//left join utilisateurs as u
//on sj.id_utilisateur = u.id_utilisateur
//left join messages as m
//on sj.id_sujet = m.id_sujet
//GROUP BY sj.id_sujet
//ORDER BY `m`.`date_message` DESC LIMIT 10");
            // On affiche chaque entrée une à une
            while ($donnees = $reponse->fetch()) {
            ?>
            <div>
                <div class="container_sujet">
                    <div class="sujet">
                        <p> <?php echo $donnees['nom_sujet']; ?></p>
                    </div>
                </div>
                <div class="pseudo">
                    <p>Par <?php echo $donnees['pseudo'] . ' le ' . $donnees['date_message']; ?> </p>
                </div>
                <div class="contain_message">
                    <p class="message">  <?php echo $donnees['message'] ?> </p>
                </div>

                <div class="right_div">
                    <a class="inputListOfEvent"
                       href="discussion.php?id_sujet= <?php echo $donnees['id_sujet']; ?>">lire</a>
                </div>
            </div>

                <?php

            }
            $reponse->closeCursor(); // Termine le traitement de la requête

            ?>
        </div>


    </div>
</div>


<?php

require("footer.php");

?>
</body>


<script src="../js/hideSujet.js"></script>

</html>