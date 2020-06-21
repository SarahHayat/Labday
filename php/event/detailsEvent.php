<?php
session_start();

require ('../../controllers/bdd/bdd.php');


$id_evenement = $_GET['id_evenement'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ShareEventTogether - Sorties</title>
    <link rel="stylesheet" href="../../assets/css/events.css"/>
</head>
<body>
<div style="display: flex; flex-direction: row">
    <?php
    if (isset($_SESSION['username'])) {
        require("../header/headerConnect.php");
    } else {
        require("../header/headerDisconnect.php");
    }
    ?>


    <?php
    $reponse = $resultat->getEvent($id_evenement);

    $donnees = $reponse->fetchAll();
    for ($i = 0;
    $i < sizeof($donnees);
    $i++) {
    ?>

    <div style="width: 100%;">
        <div style="height: 200px">

        </div>
        <section class="fond" id="trie">
            <a href="events.php"> << Retour</a>
            <div class="listOfEvent">
                <div style="background: linear-gradient(-45deg, rgb(33,33,33), rgba(97, 114, 133, 1)) ; border-radius: 10px; padding-bottom: 8px">

                    <ul class="collectionItem">
                        <div class="pictureEvent1">
                            <img id="imgTree" src="../../assets/images/event.png"/>
                            <p><?php echo $donnees[$i]['nom_categorie']; ?></p>
                        </div>
                        <div class="pictureEvent">
                            <div style="display: flex; text-align: right">

                                <div class="gauche">
                                    <p><?php echo "Par " ?> <b><a
                                                    href="../user/userProfil.php?id_user= <?php echo $donnees[$i]['id_utilisateur'] ?>"> <?php echo $donnees[$i]['pseudo'] ?></a></b>
                                        le : <?php echo $donnees[$i]['date_poste'] ?></p>
                                    <p><?php echo $donnees[$i]['type_utilisateur']; ?></p>
                                    <p><?php echo $donnees[$i]['commune'] . " " . $donnees[$i]['code_postal']; ?></p>
                                    <p><b> <?php echo $donnees[$i]['date_evenement']; ?></b></p>
                                    <p class="description"><?php echo $donnees[$i]['description']; ?></p>

                                </div>
                                <div class="centerH3">
                                    <h3 class="titleOfEvent"><?php echo $donnees[$i]['titre_evenement']; ?> </h3>
                                </div>
                            </div>


                            <?php
                            if (isset($_SESSION['id_name']) && isset($donnees[$i]['id_evenement'])) {
                                $req = $bdd->prepare('SELECT id_utilisateur, id_evenement FROM inscription_evenements WHERE id_utilisateur = :id_utilisateur AND id_evenement = :id_evenement');
                                $req->execute(array(
                                    'id_utilisateur' => $_SESSION['id_name'],
                                    'id_evenement' => $donnees[$i]['id_evenement'],
                                ));
                                $resultat = $req->fetch();
                                if ($donnees[$i]['id_utilisateur'] !== $_SESSION['id_name'] && $_SESSION['type_utilisateur'] == "particulier" && !$resultat) {
//                            ?>
                                    <a class="inputListOfEvent"
                                       href="../../controllers/event/subscribeEvent.php?id_evenement= <?php echo $donnees[$i]['id_evenement']; ?>">s'inscrire </a>
                                    <?php
                                }
                            }

                            if (isset($donnees[$i]['id_utilisateur']) && isset($_SESSION['id_name'])) {
                                $reponse = $bdd->prepare('SELECT id_utilisateur, id_evenement FROM favoris where id_utilisateur = :id_utilisateur AND id_evenement = :id_evenement');
                                $reponse->execute(array(
                                    'id_evenement' => $donnees[$i]['id_evenement'],
                                    'id_utilisateur' => $_SESSION['id_name']
                                ));
                                $mesDonnees = $reponse->fetch();
                                if ($donnees[$i]['id_utilisateur'] !== $_SESSION['id_name'] && !$resultat && !$mesDonnees && $_SESSION['type_utilisateur'] == "particulier") {
                                    ?>
                                    <a class="inputListOfEvent"
                                       href="../../controllers/event/addToMyFav.php?id_evenement= <?php echo $donnees[$i]['id_evenement']; ?>">Ajouter
                                        à
                                        mes favoris </a>

                                    <?php
                                }
                            }
                            ?>

                        </div>
                    </ul>
                </div>
            </div>
            <?php
            }
            ?>

        </section>
    </div>
</div>
<body>
<script src="../../js/security.js"></script>
