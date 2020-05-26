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


<body>
<?php
// echo "session username : " . $_SESSION['username'];

if (isset($_SESSION['username'])) {
    require("headerConnect.php");
} else {
    require("headerDisconnect.php");

}

?>

<form method="post" action="../controllers/minichat_post.php" class="fond">
    <input type="submit" id="button" value="Créer un sujet" class="button_sujet">
    <div id="chat">
        <label><b>Sujet :</b></label>
        <input type="text" name="sujet" required>
        </br>
        <label> Message :</label>
        <textarea name="message" required> Entrez votre message</textarea>
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
ORDER BY `m`.`date_message` ASC LIMIT 10");
        // On affiche chaque entrée une à une
        while ($donnees = $reponse->fetch() ) {

        echo '<div class="container_sujet">';
        echo '<div class="sujet">';
        echo $donnees['nom_sujet'];
        echo '</div>';
        echo '<div class="pseudo">';
        echo 'Par '. '<b>'.$donnees['pseudo'] .'</b>'.' le ' . $donnees['date_message'];
        echo '</div>';
        echo '<div class="contain_message">';
        echo '<div class="message">';
        echo $donnees['message'];
        echo '</div>';

        ?>
       <div class="right_div"> <a class="inputListOfEvent"
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
<?php

?>
<script src="../js/hideSujet.js"></script>
</body>