<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>ShareEventTogether - Mes Évenements </title>
    <link rel="stylesheet" href="../assets/css/sortie.css" />
</head>
<div class="evenement">
    <div>
        <h2>Mes évenements</h2>
    </div>
    <div class="evenement">
        <?php
        require ("../controllers/bdd.php");
        $reponse = $bdd->query('SELECT ut.* , ev.* FROM evenements as ev left join utilisateurs as ut 
        on ev.id_utilisateur= ut.id_utilisateur where ut.id_utilisateur = "'.$_SESSION['id_name'].'"');
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
                        <a class="inputListOfEvent" href="../controllers/supprimerEvent.php?id_evenement= <?php echo $donnees['id_evenement']; ?>">supprimer</a>
                        <a class="inputListOfEvent" href="../controllers/updateEvent.php?id_evenement= <?php echo $donnees['id_evenement']; ?>">modifier</a>


                    </div>
                </ul>
            </div>
            <?php
        }
        ?>
    </div>
</div>