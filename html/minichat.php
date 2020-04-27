<?php
require ('controllers/bdd.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="" />
    <title>Mini chat php</title>
</head>
<body>
<header>
    <h1>Mini Chat</h1>
</header>
<form method="post" action="minichat_post.php">
    <div class="chat">
        <label> Pseudo :</label>
        <input type="text" name="pseudo"/>
        <label> Message :</label>
        <textarea name="message"> Entrez votre message</textarea>
        <input type="submit" value="Envoyer"/>
    </div>
    <div class="reponse">
        <?php
        $reponse = $bdd->query("SELECT nom, message FROM miniChat ORDER BY id DESC LIMIT 10");
        $donnees = $reponse->fetch();
        // On affiche chaque entrée une à une
        while ($donnees = $reponse->fetch())
        {
            echo'<div class="pseudo">';
            echo '<strong>' . htmlspecialchars($donnees['nom']) . '</strong> : ' ;
            echo '</div>';
            echo '<p></p>';
            echo'<div class="message">';
            echo htmlspecialchars($donnees['message']) ;
            echo '</div>';
            echo '<p></p>';
        }
        $reponse->closeCursor(); // Termine le traitement de la requête
        ?>
    </div>
</form>
<?php
?>
<footer>
    Copyright
</footer>
</body>