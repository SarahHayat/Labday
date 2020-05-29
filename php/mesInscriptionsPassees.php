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
        $reponse = $bdd->query('SELECT ie.* , e.*, u.*, ce.* FROM inscription_evenements as ie 
left join evenements as e on ie.id_evenement = e.id_evenement 
LEFT join utilisateurs as u on e.id_utilisateur = u.id_utilisateur 
left join categorie_evenements as ce on ce.id_categorie = e.id_categorie 
where ie.id_utilisateur ="' . $_SESSION['id_name'] . '" AND e.date_evenement < now()');
        // On affiche chaque entrée une à une
        while ($donnees = $reponse->fetch()) {
            ?>

            <div class="listOfEvent">
                <ul class="collectionItem">
                    <div class="pictureEvent">
                        <img class="imgTree" src="../assets/images/arbre_icon.png"/>
                        <p><?php echo $donnees['nom_categorie']; ?></p>

                    </div>
                    <div class="pictureEvent">
                        <h3 class="titleOfEvent"><?php echo $donnees['titre_evenement']; ?> </h3>
                        <p><?php echo "Par " ?> <b><a href="profilUser.php?id_user= <?php echo $donnees['id_utilisateur'] ?>"> <?php echo $donnees['pseudo'] ?></a></b> le : <b> <?php echo $donnees['date_poste'] ?></b></p>
                        <p><?php echo $donnees['type_utilisateur']; ?></p>
                        <p><?php echo $donnees['date_evenement']; ?></p>
                        <?php
                        $req = $bdd->prepare('SELECT id_karma, id_evenement FROM evenements WHERE id_evenement = :id_evenement AND id_karma IS NULL');
                        $req->execute(array(
                                'id_evenement' => $donnees['id_evenement'],
                        ));
                        $resultat = $req->fetch();
                        if ($donnees['id_utilisateur'] !== $_SESSION['id_name'] && $resultat) {
                            ?>
                            <a class="inputListOfEvent"
                               href="karma.php?id_utilisateur=<?php echo $donnees['id_utilisateur']; ?>&amp;id_evenement=<?php echo $donnees['id_evenement'] ?>">noter</a>
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

</html>
