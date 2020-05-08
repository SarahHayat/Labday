<?php
session_start();
require("../controllers/bdd.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ShareEventTogether - create event</title>
    <link rel="stylesheet" href="../assets/css/sortie.css"/>
</head>


<body>

<?php
if (isset($_SESSION['username'])) {
    require("headerConnect.php");
} else {
    require("headerDisconnect.php");

}


$categorie = $_POST['categorie'];
$date_debut = $_POST['date_debut'];
$date_fin = $_POST['date_fin'];
//$localisation = $_POST['$localisation'];
$karma = $_POST['karma'];

if (isset($_SESSION['id_name']) && isset($categorie) && isset($date_debut) && isset($date_fin) && isset($karma)) {
    $req = $bdd->query('SELECT * 
FROM evenements as e 
left join karma as k 
on e.id_karma = k.id_karma 
left join utilisateurs as u
on u.id_utilisateur = e.id_utilisateur
WHERE (id_categorie ='.$categorie.' )
OR (date_evenement BETWEEN "'.$date_debut.'" AND "'.$date_fin.'") 
OR (note >= '.$karma.')');

    ?>
<form action="filtre.php" method="post" class="filtre">
    <select name="categorie">
        <option value="1">Plein air</option>
        <option value="2">Jeux de société</option>
        <option value="3">Tourisme</option>
        <option value="4">Soirée</option>
    </select>

    <input type="date" name="date_debut" placeholder="date de début">

    <input type="date" name="date_fin" placeholder="date de fin">

    <input type="text" name="localisation" placeholder="saisir une ville">

    <input type="range" name="karma" min="0" max="10">

    <input type="submit" value="chercher">

</form>
    <section class="fond">
        <div class="filter">

            <?php

            while ($donnees = $req->fetch()) {

                    ?>

                    <div class="listOfEvent">
                        <ul class="collectionItem">
                            <div class="pictureEvent">
                                <img id="imgTree" src="../assets/images/arbre_icon.png"/>
                            </div>
                            <div class="pictureEvent">

                                <h3 class="titleOfEvent"><?php echo $donnees['titre_evenement']; ?> </h3>
                                <p><?php echo "Par " ?> <b><a
                                                href="profilUser.php?id_user= <?php echo $donnees['id_utilisateur'] ?>"> <?php echo $donnees['pseudo'] ?></a></b>
                                    le : <b> <?php echo $donnees['date_poste'] ?></b></p>
                                <p><?php echo $donnees['type_utilisateur']; ?></p>
                                <p><?php echo $donnees['lieu']; ?></p>
                                <p><?php echo $donnees['date_evenement']; ?></p>
                                <p class="description"><?php echo $donnees['description']; ?></p>
                                <?php
                                if ($donnees['id_utilisateur'] !== $_SESSION['id_name']) {
                                    ?>
                                    <a class="inputListOfEvent"
                                       href="../controllers/inscription.php?id_evenement= <?php echo $donnees['id_evenement']; ?>">s'inscrire</a>
                                    <?php
                                }
                                ?>
                            </div>
                        </ul>
                    </div>

                    <?php
                }
            }

            ?>

        </div>

    </section>

