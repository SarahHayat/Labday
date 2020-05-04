<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>ShareEventTogether - Mes inscriptions Passées </title>
    <link rel="stylesheet" href="../assets/css/sortie.css" />
</head>

<div>
    <div>
        <h2>Mes inscriptions Passées</h2>
    </div>
    <div class="evenement">
        <?php
        require ("../controllers/bdd.php");
        $reponse = $bdd->query('SELECT ie.* , e.*, u.* FROM inscription_evenements as ie left join evenements as e on ie.id_evenement = e.id_evenement LEFT join utilisateurs as u on e.id_utilisateur = u.id_utilisateur where ie.id_utilisateur ="' . $_SESSION['id_name'] . '" AND e.date_evenement < now()');
        // On affiche chaque entrée une à une
        while ($donnees = $reponse->fetch()) {
            ?>

            <div class="listOfEvent">
                <ul class="collectionItem">
                    <div class="pictureEvent">
                        <img class="imgTree" src="../assets/images/arbre_icon.png"/>
                    </div>
                    <div class="pictureEvent">
                        <h3 class="titleOfEvent"><?php echo $donnees['titre_evenement']; ?> </h3>
                        <p><?php echo  "Par " . '<b>'. $donnees['pseudo'] .'</b>'. " le : " . '<b>'. $donnees['date_poste'].'</b>' ; ?></p>
                        <p><?php echo $donnees['type_utilisateur']; ?></p>
                        <p><?php echo $donnees['date_evenement']; ?></p>
                        <?php
                        if ($donnees['id_utilisateur'] !== $_SESSION['id_name']) {
                            ?>
                            <a class="inputListOfEvent"
                               href="../controllers/karma.php?id_utilisateur=<?php echo $donnees['id_utilisateur']; ?>&amp;id_evenement=<?php echo $donnees['id_evenement'] ?>">noter</a>
                            <?php
                        }
                        ?>

                    </div>
                </ul>
            </div>
            <?php
        }
        ?>
    </div>
</div>