<?php
session_start();
require('../controllers/bdd/bdd.php');

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ShareEventTogether - create event</title>
    <link rel="stylesheet" href="../assets/css/events.css"/>
</head>


<body>
<div style="display: flex; flex-direction: row">
    <?php
    // echo "session username : " . $_SESSION['username'];

    if (isset($_SESSION['username'])) {
        require("header/headerConnectIndex.php");
    } else {
        require("header/headerDisconnectIndex.php");

    }


    $articles = $bdd->query('SELECT * FROM evenements as e LEFT JOIN utilisateurs as u ON e.id_utilisateur = u.id_utilisateur ORDER BY e.date_evenement DESC');

    if (isset($_GET['search']) and !empty($_GET['search'])) {
        $search = htmlspecialchars($_GET['search']);
        $articles = $bdd->query('SELECT * FROM evenements as e LEFT JOIN utilisateurs as u ON e.id_utilisateur = u.id_utilisateur WHERE e.titre_evenement LIKE "%' . $search . '%" ORDER BY e.date_evenement DESC');

        if ($articles->rowCount() == 0) {
            $articles = $bdd->query('SELECT * FROM evenements as e LEFT JOIN utilisateurs as u ON e.id_utilisateur = u.id_utilisateur WHERE CONCAT(e.titre_evenement, e.description) LIKE "%' . $search . '%" ORDER BY e.date_evenement DESC');
        }
    }
    ?>
    <div style="width: 100%">
        <div style="height: 200px">

        </div>

        <section class="fond">
            <div class="filter">
                <?php

                if ($articles->rowCount() > 0) {
                while ($donnees = $articles->fetch()) {

                    ?>

                    <div class="listOfEvent">
                        <div style="background: linear-gradient(-45deg, rgb(33,33,33), rgba(97, 114, 133, 1)) ; border-radius: 10px; padding-bottom: 8px">
                            <ul class="collectionItem">
                                <div class="pictureEvent1">
                                    <img id="imgTree" src="../assets/images/event.png"/>
                                </div>
                                <div class="pictureEvent">
                                    <div style="display: flex; text-align: right">
                                        <div class="gauche">

                                            <p><?php echo "Par " ?> <b><a
                                                            href="user/userProfil.php?id_user= <?php echo $donnees['id_utilisateur'] ?>"> <?php echo $donnees['pseudo'] ?></a></b>
                                                le : <b> <?php echo $donnees['date_poste'] ?></b></p>
                                            <p><?php echo $donnees['type_utilisateur']; ?></p>
                                            <p><?php echo $donnees['commune'] . " " . $donnees['code_postal']; ?></p>
                                            <p><?php echo $donnees['date_evenement']; ?></p>
                                            <p class="description"><?php echo $donnees['description']; ?></p>
                                            <?php
                                            if (isset($_SESSION['id_name'], $donnees['id_evenement'])) {
                                                $req = $bdd->prepare('SELECT id_utilisateur, id_evenement FROM inscription_evenements WHERE id_utilisateur = :id_utilisateur AND id_evenement = :id_evenement');
                                                $req->execute(array(
                                                    'id_utilisateur' => $_SESSION['id_name'],
                                                    'id_evenement' => $donnees['id_evenement'],
                                                ));

                                                $resultat = $req->fetch();
                                                if ($donnees['id_utilisateur'] !== $_SESSION['id_name'] && $_SESSION['type_utilisateur'] == "particulier" && !$resultat) {
                                                    ?>
                                                    <a class="inputListOfEvent"
                                                       href="../controllers/event/subscribeEvent.php?id_evenement= <?php echo $donnees['id_evenement']; ?>">s'inscrire</a>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                        <div class="centerH3">
                                            <h3 class="titleOfEvent"><?php echo $donnees['titre_evenement']; ?> </h3>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>

                    <?php
                }
                ?>

            </div>

        </section>
    </div>

</div>
<?php
require("footer/footerIndex.php");
?>
</body>
</html>

<?php
} else {
    ?>
    Aucun résultat pour : <?= $search ?>...

    <?php
}
?>

