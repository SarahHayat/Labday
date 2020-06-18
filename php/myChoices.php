<?php
session_start();
require("../controllers/bdd.php");
?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>ShareEventTogether - Profil</title>
        <link rel="stylesheet" href="../assets/css/events.css"/>
    </head>
<?php

if (isset($_GET['choice'])) {

    if ($_GET['choice'] == "mesEvent") {

        $sql = $bdd->query('SELECT ut.* , ev.*, ce.* FROM evenements as ev left join utilisateurs as ut 
        on ev.id_utilisateur= ut.id_utilisateur 
        left join categorie_evenements as ce on ce.id_categorie = ev.id_categorie where ut.id_utilisateur = "' . $_SESSION['id_name'] . '"');

    } else if ($_GET['choice'] == "mesInscription") {

        $sql = $bdd->query('SELECT ie.* , e.*, u.*, ce.* FROM inscription_evenements as ie left join evenements as e on ie.id_evenement = e.id_evenement 
    LEFT join utilisateurs as u on e.id_utilisateur = u.id_utilisateur 
    left join categorie_evenements as ce on ce.id_categorie = e.id_categorie 
    where ie.id_utilisateur ="' . $_SESSION['id_name'] . '"');

    } else if ($_GET['choice'] == "mesEventPassees") {
        $sql = $bdd->query('SELECT ie.* , e.*, u.*, ce.* FROM inscription_evenements as ie 
left join evenements as e on ie.id_evenement = e.id_evenement 
LEFT join utilisateurs as u on e.id_utilisateur = u.id_utilisateur 
left join categorie_evenements as ce on ce.id_categorie = e.id_categorie 
where ie.id_utilisateur ="' . $_SESSION['id_name'] . '" AND e.date_evenement < now()');
    } else if ($_GET['choice'] == "mesFavoris") {
        $sql = $bdd->query('SELECT f.* , e.*, u.*, ce.* FROM favoris as f left join evenements as e on f.id_evenement = e.id_evenement 
    LEFT join utilisateurs as u on e.id_utilisateur = u.id_utilisateur 
    left join categorie_evenements as ce on ce.id_categorie = e.id_categorie 
    where f.id_utilisateur ="' . $_SESSION['id_name'] . '"');
    }
    while ($donnees = $sql->fetch()) {
        ?>
        <div class="listOfEvent">
        <div style="background: linear-gradient(-45deg, rgb(33,33,33), rgba(97, 114, 133, 1)) ; border-radius: 10px; padding-bottom: 8px">
        <ul class="collectionItem">
                <div class="pictureEvent1">
                    <img id="imgTree" src="../assets/images/event.png"/>
                    <p><?php echo $donnees['nom_categorie']; ?></p>

                </div>
                <div class="pictureEvent">
                    <div style="display: flex; text-align: right">
                    <div class="gauche">
                        <p><?php echo "Par " . '<b>' . $donnees['pseudo'] . '</b>' . " le : " . $donnees['date_poste'] . '</b>'; ?></p>
                        <p><?php echo $donnees['type_utilisateur']; ?></p>
                        <p><?php echo $donnees['commune'] . " " . $donnees['code_postal']; ?></p>
                        <p><b><?php echo $donnees['date_evenement']; ?></b></p>
                    </div>
                        <div class="centerH3">
                            <h3 class="titleOfEvent"><?php echo $donnees['titre_evenement']; ?> </h3>
                        </div>
                    </div>

                    <?php
                    if ($_GET['choice'] == "mesEvent") {
                        ?>

                        <a class="inputListOfEvent" id="supprimerEvent"
                           href="../controllers/deleteEvent.php?id_evenement= <?php echo $donnees['id_evenement']; ?> ">supprimer</a>
                        <a class="inputListOfEvent"
                           href="updateEvent.php?id_evenement= <?php echo $donnees['id_evenement']; ?>">modifier</a>
                        <?php
                    } else if ($_GET['choice'] == "mesEventPassees") {
                        $req = $bdd->query('SELECT id_karma, id_evenement FROM karma WHERE id_evenement = "' . $donnees['id_evenement'] . '"');

                        $resultat = $req->fetch();
                        if ($donnees['id_utilisateur'] !== $_SESSION['id_name'] && !$resultat) {
                            ?>
                            <a class="inputListOfEvent"
                               href="karma.php?id_utilisateur=<?php echo $donnees['id_utilisateur']; ?>&amp;id_evenement=<?php echo $donnees['id_evenement'] ?>">noter</a>
                            <?php
                        }
                    } else if ($_GET['choice'] == "mesInscription") {
                        ?>
                        <a class="inputListOfEvent"
                           href="../controllers/unsubscribe.php?id_evenement= <?php echo $donnees['id_evenement']; ?>">se
                            désincrire</a>
                        <?php
                    } else if ($_GET['choice'] == "mesFavoris") {
                        $req = $bdd->query('SELECT * FROM favoris WHERE id_evenement = "' . $donnees['id_evenement'] . '" AND id_utilisateur ="' . $_SESSION['id_name'] . '"');
                        $resultat = $req->fetch();
                        if ($resultat) {
                            ?>
                            <a class="inputListOfEvent"
                               href="../controllers/deleteFavorite.php?id_evenement= <?php echo $donnees['id_evenement']; ?>">enlever
                                favoris</a>
                            <?php
                            if (isset($_SESSION['id_name']) && isset($donnees['id_evenement'])) {
                                $req = $bdd->prepare('SELECT id_utilisateur, id_evenement FROM inscription_evenements WHERE id_utilisateur = :id_utilisateur AND id_evenement = :id_evenement');
                                $req->execute(array(
                                    'id_utilisateur' => $_SESSION['id_name'],
                                    'id_evenement' => $donnees['id_evenement'],
                                ));
                                $resultat = $req->fetch();
                                if ($donnees['id_utilisateur'] !== $_SESSION['id_name'] && $_SESSION['type_utilisateur'] == "particulier" && !$resultat) {
                                    //                            ?>
                                    <a class="inputListOfEvent"
                                       href="../controllers/subscribeEvent.php?id_evenement= <?php echo $donnees['id_evenement']; ?>">s'inscrire </a>
                                    <?php
                                }
                            }
                        }
                    }
                    ?>


                </div>
            </ul>
        </div>
        </div>
        <script src="../js/security.js"></script>
        <?php
    }
}
?>
<script src="../js/security.js"></script>
