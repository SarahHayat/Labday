<?php
session_start();
require('../controllers/bdd.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ShareEventTogether - Contact</title>
    <link rel="stylesheet" href="../assets/css/forum.css"/>
</head>


<div>
<?php
// echo "session username : " . $_SESSION['username'];

if (isset($_SESSION['username'])) {
    require("headerConnect.php");
} else {
    require("headerDisconnect.php");

}

?>
<div class="fond">
<form action="rechercheForum.php" method="get" >
    <input type="search" name="search_forum" placeholder="recherche...">
    <input type="submit" value="entrer">
</form>
<form method="post" action="../controllers/minichat_post.php" id="form_forum">
    <input type="submit" id="button" value="Créer un sujet" class="button_sujet">
    <div id="chat">
        <label><b>Sujet :</b> <span class="obligatoire">*</span></label>
        <input type="text" name="sujet" required>
        </br>
        <label> Message : <span class="obligatoire">*</span></label>
        <textarea name="message" required placeholder="Entrez votre messsage..."></textarea>
        <input type="submit" value="Envoyer"/>
    </div>


    <div class="reponse">
        <?php

        $reponse = $bdd->query("SELECT sj.nom_sujet, m.message, sj.id_sujet, u.pseudo,m.date_message FROM sujets_forum as sj 
left join utilisateurs as u 
on sj.id_utilisateur = u.id_utilisateur
left join messages as m
on sj.id_sujet = m.id_sujet
GROUP BY sj.id_sujet
ORDER BY `m`.`date_message` DESC LIMIT 10");
        // On affiche chaque entrée une à une
        while ($donnees = $reponse->fetch()) {

        echo '<div class="container_sujet">';
        echo '<div class="sujet">';
        echo $donnees['nom_sujet'];
        echo '</div>';
        echo '<div class="pseudo">';
        echo 'Par ' . '<b>' . $donnees['pseudo'] . '</b>' . ' le ' . $donnees['date_message'];
        echo '</div>';
        echo '<div class="contain_message">';
        echo '<p class="message">'.$donnees['message'].'</p>';

        ?>
        <div class="right_div"><a class="inputListOfEvent"
                                  href="page_forum.php?id_sujet= <?php echo $donnees['id_sujet']; ?>">lire</a>
        </div>
    </div>
    </div>
    <?php

    }
    $reponse->closeCursor(); // Termine le traitement de la requête

    ?>

    </div>
</form>
</div>
</body>
<?php

require("footer.php");

?>
<script src="../js/hideSujet.js"></script>
</body>
</html>