<?php
session_start();
require ("../controllers/AllRequest.php");
$resultat = new AllRequest();
require ("../controllers/bdd.php");
require("headerConnect.php");

$id_evenement =$_GET['id_evenement'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ShareEventTogether - Sorties</title>
    <link rel="stylesheet" href="../assets/css/events.css"/>
    <?php
    $reponse = $resultat->getEvent($bdd, $id_evenement);
//    $reponse = $bdd->query('SELECT ut.* ,ev.id_evenement, ev.titre_evenement, ev.id_utilisateur,  ev.adresse, ev.code_postal, ev.commune,  ev.date_evenement,DATE(ev.date_poste) as date_poste
//    ,ev.description, ce.* FROM evenements as ev left join utilisateurs as ut
//    on ev.id_utilisateur= ut.id_utilisateur left join categorie_evenements as ce on ce.id_categorie = ev.id_categorie
//    where ev.id_evenement ="'.$id_evenement.'"');
    // On affiche chaque entrée une à une
    $donnees = $reponse->fetchAll();
    for ($i = 0; $i < sizeof($donnees); $i++) {
    ?>
    <section class="fond" id="trie">
        <a href="events.php"> << Retour</a>
        <div class="listOfEvent">
            <div class="centerH3">
                <h3 class="titleOfEvent"><?php echo $donnees[$i]['titre_evenement']; ?> </h3>
            </div>
            <ul class="collectionItem">
                <div class="pictureEvent1">
                    <img id="imgTree" src="../assets/images/arbre_icon.png"/>
                    <p><?php echo $donnees[$i]['nom_categorie']; ?></p>
                </div>
                <div class="pictureEvent">
                    <div class="gauche">
                        <p><?php echo "Par " ?> <b><a
                                    href="userProfil.php?id_user= <?php echo $donnees[$i]['id_utilisateur'] ?>"> <?php echo $donnees[$i]['pseudo'] ?></a></b>
                            le : <?php echo $donnees[$i]['date_poste'] ?></p>
                        <p><?php echo $donnees[$i]['type_utilisateur']; ?></p>
                        <p><?php echo $donnees[$i]['commune'] . " " . $donnees[$i]['code_postal']; ?></p>
                        <p><b> <?php echo $donnees[$i]['date_evenement']; ?></b></p>
                    </div>
                    <p class="description"><?php echo $donnees[$i]['description']; ?></p>

                    <?php
                    if (isset($_SESSION['id_name']) && isset($donnees[$i]['id_evenement'])) {
                        $req = $resultat->isRegistered($bdd,$_SESSION['id_name'] , $donnees[$i]['id_evenement']);
//                        $req = $bdd->prepare('SELECT id_utilisateur, id_evenement FROM inscription_evenements WHERE id_utilisateur = :id_utilisateur AND id_evenement = :id_evenement');
//                        $req->execute(array(
//                            'id_utilisateur' => $_SESSION['id_name'],
//                            'id_evenement' => $donnees[$i]['id_evenement'],
//                        ));
                        $resultat = $req->fetch();
                        if ($donnees[$i]['id_utilisateur'] !== $_SESSION['id_name'] && $_SESSION['type_utilisateur'] == "particulier" && !$resultat) {
//                            ?>
                            <a class="inputListOfEvent"
                               href="../controllers/subscribeEvent.php?id_evenement= <?php echo $donnees[$i]['id_evenement']; ?>">s'inscrire </a>
                            <?php
                        }
                    }
                    if (isset($donnees[$i]['id_utilisateur'], $_SESSION['id_name'])) {
                        $reponse = $resultat->isFavorite($bdd,$donnees[$i]['id_evenement'], $_SESSION['id_name'] );
//                        $reponse = $bdd->prepare('SELECT id_utilisateur, id_evenement FROM favoris where id_utilisateur = :id_utilisateur AND id_evenement = :id_evenement');
//                        $reponse->execute(array(
//                            'id_evenement' => $donnees[$i]['id_evenement'],
//                            'id_utilisateur' => $_SESSION['id_name']
//                        ));
                        $mesDonnees = $reponse->fetch();
                        if ($donnees[$i]['id_utilisateur'] !== $_SESSION['id_name'] && !$resultat && !$mesDonnees && $_SESSION['type_utilisateur'] == "particulier") {
                            ?>
                            <a class="inputListOfEvent"
                               href="../controllers/addToMyFav.php?id_evenement= <?php echo $donnees[$i]['id_evenement']; ?>">Ajouter
                                à
                                mes favoris </a>

                            <?php
                        }
                    }


                    //
                    ?>
                </div>
            </ul>
        </div>
        <?php
    }
    ?>
        <script src="../js/security.js"></script>
    </section>
</head>
<body>
