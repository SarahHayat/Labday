<?php
session_start();
require ('../../controllers/bdd/bdd.php');

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ShareEventTogether - create event</title>
    <link rel="stylesheet" href="../../assets/css/forum.css"/>
</head>



<?php

if (isset($_SESSION['username'])) {
    require("../header/headerConnect.php");
} else {
    require("../header/headerDisconnect.php");

}


$articles = $bdd->query('SELECT * FROM sujets_forum as sj LEFT JOIN utilisateurs as u ON sj.id_utilisateur = u.id_utilisateur left join messages as m on sj.id_sujet = m.id_sujet');

if (isset($_GET['search_forum']) and !empty($_GET['search_forum'])) {
    $search = $_GET['search_forum'];
    $articles = $bdd->query('SELECT * FROM  sujets_forum as sj LEFT JOIN utilisateurs as u ON sj.id_utilisateur = u.id_utilisateur left join messages as m on sj.id_sujet = m.id_sujet WHERE sj.nom_sujet LIKE "%'.$search.'%" group by sj.id_sujet');

    if ($articles->rowCount() == 0) {
        $articles = $bdd->query('SELECT * FROM sujets_forum as sj LEFT JOIN utilisateurs as u ON sj.id_utilisateur = u.id_utilisateur left join messages as m on sj.id_sujet = m.id_sujet WHERE sj.nom_sujet LIKE "%'.$search.'%" group by sj.id_sujet');
    }
}
?>
<body>
<div class="fond">
    <a href="createForum.php"> << Retour</a>
<form method="post" action="#">
    <input type="search" name="search_forum" placeholder="recherche...">
    <input type="submit" value="entrer">
</form>
<form method="post" action="#">

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


        if ($articles->rowCount() > 0) {
        while ($donnees = $articles->fetch()) {


        echo '<div class="container_sujet">';
        echo '<div class="sujet">';
        echo $donnees['nom_sujet'];
        echo '</div>';
        echo '<div class="pseudo">';
        echo 'Par ' . '<b>' . $donnees['pseudo'] . '</b>' . ' le ' . $donnees['date_message'];
        echo '</div>';
        echo '<div class="contain_message">';
        echo '<div class="message">';
        echo $donnees['message'];
        echo '</div>';

        ?>
        <div class="right_div"><a class="inputListOfEvent"
                                  href="discussion.php?id_sujet= <?php echo $donnees['id_sujet']; ?>">lire</a>
        </div>
    </div>
    </div>
    <?php

    }
    }else {
        ?>
        Aucun résultat pour : <?= $search ?>...

        <?php
    }

    ?>

    </div>
</form>
</div>
<?php

require("../footer/footer.php");

?>
<script src="../../js/hideSujet.js"></script>
</body>
</html>
