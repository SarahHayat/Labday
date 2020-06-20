<?php
session_start();
//require ("../controllers/AllRequest.php");
//$resultat = new AllRequest();
require ('../../controllers/bdd/bdd.php');

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ShareEventTogether - Sorties à prévoir</title>
    <link rel="stylesheet" href="../../assets/css/events.css"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"/>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>
<body>
<div style="display: flex; flex-direction: row">
    <?php
    if (isset($_SESSION['username'])) {
        require("../header/headerConnect.php");
    } else {
        require("../header/headerDisconnect.php");
    }
    $req = $bdd->query('SELECT  titre_evenement, x, y, id_evenement FROM evenements');
    $tabMap = array();
    while ($donnee = $req->fetchAll()) {
        array_push($tabMap, $donnee);
    }
    ?>
    <div style="width: 100%">
        <div>
            <script>
                var dataPhp = <?php echo json_encode($tabMap); ?>
            </script>
            <div id="map">
                <div id="mapid">
                </div>
            </div>
            <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
            <script type="text/javascript" src="../../js/mapping.js"></script>

            <form method="post" class="filtre" onsubmit="return false;">
                <select name="categorie" id="categorie" class="filtre-container">
                    <option value="NULL">Choisir une categorie</option>
                    <option value="1">Plein air</option>
                    <option value="2">Jeux de société</option>
                    <option value="3">Tourisme</option>
                    <option value="4">Soirée</option>
                </select>
                <select name="ordre" id="ordre" class="filtre-container">
                    // onchange="trier(this.value)"
                    <option value="DESC">Date croissant</option>
                    <option value="ASC">Date décroissant</option>
                </select>
                <?php
                $req = $bdd->query('SELECT ADDDATE(DATE(now()), 1) as date_now, MAX(DATE(date_evenement)) as date_max FROM evenements');
                while ($donnees = $req->fetch()) {
                    ?>
                    <input type="date" name="date_debut" value="<?php echo $donnees['date_now']; ?>" id="date_debut"
                           class="filtre-container">
                    <input type="date" name="date_fin" value="<?php echo $donnees['date_max']; ?>" id="date_fin"
                           class="filtre-container">
                    <?php
                }
                ?>
                <input type="text" name="lieu" placeholder="saisir une ville" id="lieu" class="filtre-container">
                <input type="range" name="karma" min="0" max="10" id="karma" class="filtre-container">
                <input type="submit" value="chercher" onclick="filtre()" class="filtre-container">
            </form>
        </div>

        <?php
        $reponse = $resultat->getAllEvent();
        //    $reponse = $bdd->query('SELECT ut.* ,ev.id_evenement, ev.titre_evenement, ev.id_utilisateur,  ev.adresse, ev.code_postal, ev.commune,  ev.date_evenement,DATE(ev.date_poste) as date_poste
        // ,ev.description, ce.* FROM evenements as ev left join utilisateurs as ut
        //        on ev.id_utilisateur= ut.id_utilisateur left join categorie_evenements as ce on ce.id_categorie = ev.id_categorie
        //        where DATE(ev.date_evenement) >= DATE(now()) order by DATE(ev.date_evenement) ASC');
        // On affiche chaque entrée une à une
        $donnees = $reponse->fetchAll();
        for ($i = 0; $i < sizeof($donnees); $i++) {
            ?>
            <section id="filter">
                <section class="fond" id="trie">
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

                                            <?php
                                            if (isset($_SESSION['id_name']) && isset($donnees[$i]['id_evenement'])) {
                                                //  $req = $resultat->isRegistered($bdd,$_SESSION['id_name'],$donnees[$i]['id_evenement'] );
                                                $req = $bdd->prepare('SELECT id_utilisateur, id_evenement FROM inscription_evenements WHERE id_utilisateur = :id_utilisateur AND id_evenement = :id_evenement');
                                                $req->execute(array(
                                                    'id_utilisateur' => $_SESSION['id_name'],
                                                    'id_evenement' => $donnees[$i]['id_evenement'],
                                                ));
                                                $resultat = $req->fetch();
                                                if ($donnees[$i]['id_utilisateur'] !== $_SESSION['id_name'] && $_SESSION['type_utilisateur'] == "particulier" && !$resultat) {
//                                       ?>
                                                    <a class="inputListOfEvent"
                                                       href="../../controllers/event/subscribeEvent.php?id_evenement= <?php echo $donnees[$i]['id_evenement']; ?>">s'inscrire </a>
                                                    <?php
                                                }
                                            }
                                            if (isset($donnees[$i]['id_utilisateur'], $_SESSION['id_name'])) {
                                                //  $reponse = $resultat->isFavorite($bdd, $donnees[$i]['id_evenement'], $_SESSION['id_name']);
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
                                            //
                                            ?>
                                        </div>
                                        <div class="centerH3">
                                            <h3 class="titleOfEvent"><?php echo $donnees[$i]['titre_evenement']; ?> </h3>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>

                </section>

            <?php
        }
        ?>
            </section>
    </div>
</div>
<script src="../../js/security.js"></script>
<?php
require("../footer/footer.php");
?>
</body>
</html>