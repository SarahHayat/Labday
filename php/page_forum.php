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




$reponse = $bdd->query('SELECT * FROM sujets_forum as sf join messages as m on sf.id_sujet = m.id_sujet
left join utilisateurs as u on sf.id_utilisateur = u.id_utilisateur WHERE sf.id_sujet ="'.$_GET['id_sujet'].'" ');
while ($donnees = $reponse->fetch()) {
?>

<div class="evenement">
    <form method="post" action="reponseForum.php">
        <div>
            <input name="sujet" value="<?php echo $donnees['nom_sujet'] ?>">
        </div>

        <div class="evenement">

            <div class="listOfEvent">
                <ul class="collectionItem">
                    <div class="pictureEvent">
                        <p><?php echo "Par " . '<b>' . $donnees['id_utilisateur'] . '</b>' ?></p>
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
