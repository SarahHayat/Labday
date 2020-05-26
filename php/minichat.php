<?php
session_start();
require('../controllers/bdd.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ShareEventTogether - Contact</title>
    <link rel="stylesheet" href="../assets/css/styleContact.css"/>
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

<form method="post" action="../controllers/minichat_post.php">
    <div class="chat">
        <label><b>Sujet :</b></label>
        <input type="text" name="sujet">
        <label> Pseudo : <?php echo $_SESSION['username'] ?></label>
        <label> Message :</label>
        <textarea name="message"> Entrez votre message</textarea>
        <input type="submit" value="Envoyer"/>
    </div>
    <div class="reponse">
        <?php
        $reponse = $bdd->query("SELECT * FROM messages as m 
left join utilisateurs as u 
on m.id_utilisateur = u.id_utilisateur
left join sujets_forum as sf 
on m.id_sujet = sf.id_sujet
ORDER BY m.id_message ASC LIMIT 10");
        // On affiche chaque entrée une à une
        $donnees = $reponse->fetch() ;
        echo '<div class="sujet">';
        echo $donnees['nom_sujet'];
        echo '</div>';
        echo '<div class="pseudo">';
        echo $donnees['pseudo'];
        echo '</div>';
        echo '<div class="message">';
        echo $donnees['message'];
        echo '</div>';
        ?>
        <a class="inputListOfEvent"
           href="page_forum.php?id_sujet= <?php echo $donnees['id_sujet']; ?>">lire</a>
        <?php

        $reponse->closeCursor(); // Termine le traitement de la requête
        ?>
    </div>
</form>
<?php
?>

</body>