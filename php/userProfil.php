<?php
session_start();
//require ("../controllers/AllRequest.php");
//$resultat = new AllRequest();
require("../controllers/bdd.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ShareEventTogether - Profil</title>
    <link rel="stylesheet" href="../assets/css/events.css"/>
</head>
<body>
<div style="display: flex; flex-direction: row">

    <?php
    if (isset($_SESSION['username'])) {
        require("headerConnect.php");
    } else {
        require("headerDisconnect.php");
    }
    ?>
    <section class="fond" style="width: 100%">
        <div class="profil flex">
            <div class="avatar ">
                <div class="photo">
                    <?php
                    $req = $resultat->getUserPicture($bdd, $_GET['id_user'] );
//                    $req = $bdd->query('SELECT * FROM photo_utilisateurs where id_utilisateur= "' . $_GET['id_user'] . '" LIMIT 1');
                    while ($donnees = $req->fetch()) {
                        $url = $donnees['url'];
                        ?>
                        <img src="<?php echo $url ?>" height="150px" width="150px">
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="flex event">
                <div>
                    <?php
                    $req = $resultat->getUser($bdd, $_GET['id_user'] );
//                    $req = $bdd->query('SELECT * FROM utilisateurs where id_utilisateur= "' . $_GET['id_user'] . '"');
                    while ($donnees = $req->fetch()) {
                        ?>
                        <p>nom d'utilisateur : <?php echo $donnees['pseudo'] ?></p>
                        <?php
                    }
                    ?>
                </div>
                <div>
                    <?php
                    $req = $resultat->getUser($bdd, $_GET['id_user'] );

//                    $req = $bdd->query('SELECT * FROM utilisateurs where id_utilisateur= "' . $_GET['id_user'] . '"');
                    while ($donnees = $req->fetch()) {
                        echo '<p> type : ' . $donnees['type_utilisateur'] . '</p>';
                    }
                    ?>
                </div>
                <div class="progress">
                    <div>
                        <label>niveau de validité : </label>
                    </div>
                    <?php
                    $req = $resultat->getUser($bdd, $_GET['id_user'] );
//                    $req = $bdd->query('SELECT karma FROM utilisateurs where id_utilisateur= "' . $_GET['id_user'] . '"');
                    while ($donnees = $req->fetch()) {
                        $moyenne = $donnees['karma'];
                    }
                    ?>
                    <progress id="jauge" min="0" max="10" value="<?php echo $moyenne ?>"></progress>
                </div>
            </div>
        </div>
        <div class="evenement">
            
            <div class="evenement">
                <?php
                require("../controllers/bdd.php");
                $reponse = $resultat->getEventByUser($bdd, $_GET['id_user'] );
//                $reponse = $bdd->query('SELECT ut.* , ev.*, ce.* FROM evenements as ev left join utilisateurs as ut
//        on ev.id_utilisateur= ut.id_utilisateur
//        left join categorie_evenements as ce on ce.id_categorie = ev.id_categorie where ut.id_utilisateur = "' . $_GET['id_user'] . '"');
//                // On affiche chaque entrée une à une
                while ($donnees = $reponse->fetch()) {
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
                                            <p><?php echo "Par " . '<b>' . $donnees['pseudo'] . '</b>' . " le : " . '<b>' . $donnees['date_poste'] . '</b>'; ?></p>
                                            <p><?php echo $donnees['type_utilisateur']; ?></p>
                                            <p><?php echo $donnees['date_evenement']; ?></p>
                                        </div>
                                        <div class="centerH3">
                                            <h3 class="titleOfEvent"><?php echo $donnees['titre_evenement']; ?> </h3>
                                        </div>
                                    </div>
                                    <?php
                                    if (isset($_SESSION['id_name']) && isset($donnees['id_evenement'])) {
                                     //  $req = $resultat->isRegistered($bdd, $_SESSION['id_name'], $donnees['id_evenement']);
                                        $req = $bdd->prepare('SELECT id_utilisateur, id_evenement FROM inscription_evenements WHERE id_utilisateur = :id_utilisateur AND id_evenement = :id_evenement');
                                        $req->execute(array(
                                            'id_utilisateur' => $_SESSION['id_name'],
                                            'id_evenement' => $donnees['id_evenement'],
                                        ));
                                        $resultat = $req->fetch();
                                        if ($donnees['id_utilisateur'] !== $_SESSION['id_name'] && $_SESSION['type_utilisateur'] == "particulier" && !$resultat) {
                                            ?>
                                            <a class="inputListOfEvent"
                                               href="../controllers/subscribeEvent.php?id_evenement= <?php echo $donnees['id_evenement']; ?>">s'inscrire</a>
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
            </div>
        </div>
    </section>
</div>
<?php
require("footer.php");
?>
</body>
</html>