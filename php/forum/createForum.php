<?php
session_start();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ShareEventTogether - Contact</title>
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

    ?>

    <div class="fond">

        <form action="forumSearch.php" method="get">
            <input type="search" name="search_forum" placeholder="recherche...">
            <input type="submit" value="entrer">
        </form>
        <form method="post" action=".././controllers/forum/forum.php" id="form_forum">
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
            $reponse = $resultat->getAllSubjectForum();

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
            $reponse->closeCursor();

            ?>
        </div>


    </div>
</div>


<?php

require("../footer/footer.php");

?>
</body>


<script src="../../js/hideSujet.js"></script>

</html>