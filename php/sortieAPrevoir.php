<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ShareEventTogether - Sorties à prévoir</title>
    <link rel="stylesheet" href="../assets/css/sortie.css"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"/>
</head>
<body>
<?php
// echo "session username : " . $_SESSION['username'];
if (isset($_SESSION['username'])) {
    require("headerConnect.php");
} else {
    require("headerDisconnect.php");
}
?>
<?php
require("../controllers/bdd.php");
?>

<div id="map">
    <div id="mapid">
    </div>
</div>
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
<script type="text/javascript" src="../js/mapping.js"></script>
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
        <input type="date" name="date_debut" value="<?php echo $donnees['date_now']; ?>" id="date_debut" class="filtre-container">
        <input type="date" name="date_fin" value="<?php echo $donnees['date_max']; ?>" id="date_fin" class="filtre-container">
        <?php
    }
    ?>
    <input type="text" name="lieu" placeholder="saisir une ville" id="lieu" class="filtre-container">
    <input type="range" name="karma" min="0" max="10" id="karma" class="filtre-container">
    <input type="submit" value="chercher" onclick="filtre()" class="filtre-container">
</form>
<section class="fond" id="trie">
    <?php
    $reponse = $bdd->query('SELECT ut.* ,ev.id_evenement, ev.titre_evenement, ev.id_utilisateur,  ev.lieu,  ev.date_evenement,DATE(ev.date_poste) as date_poste
 ,ev.description, ce.* FROM evenements as ev left join utilisateurs as ut  
        on ev.id_utilisateur= ut.id_utilisateur left join categorie_evenements as ce on ce.id_categorie = ev.id_categorie 
        where DATE(ev.date_evenement) >= DATE(now()) order by DATE(ev.date_evenement) ASC');
    // On affiche chaque entrée une à une
    $donnees = $reponse->fetchAll();
    for ($i = 0; $i< sizeof($donnees); $i++) {
        ?>

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
                                        href="profilUser.php?id_user= <?php echo $donnees[$i]['id_utilisateur'] ?>"> <?php echo $donnees[$i]['pseudo'] ?></a></b>
                            le : <?php echo $donnees[$i]['date_poste'] ?></p>
                        <p><?php echo $donnees[$i]['type_utilisateur']; ?></p>
                        <p><?php echo $donnees[$i]['lieu']; ?></p>
                        <p><b> <?php echo $donnees[$i]['date_evenement']; ?></b></p>
                    </div>
                    <p class="description"><?php echo $donnees[$i]['description']; ?></p>

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
                               href="../controllers/subscribeEvent.php?id_evenement= <?php echo $donnees[$i]['id_evenement']; ?>">s'inscrire </a>
                            <?php
                        }
                    }

                    $reponse = $bdd->prepare('SELECT id_utilisateur, id_evenement FROM favoris where id_utilisateur = :id_utilisateur AND id_evenement = :id_evenement');
                    $reponse->execute(array(
                        'id_evenement' => $donnees[$i]['id_evenement'],
                        'id_utilisateur' => $_SESSION['id_name']
                    ));
                    $mesDonnees = $reponse->fetch();
                    if (!$mesDonnees) {
                        ?>
                        <a class="inputListOfEvent"
                           href="../controllers/addToMyFav.php?id_evenement= <?php echo $donnees[$i]['id_evenement']; ?>">Ajouter
                            à
                            mes favoris </a>

                        <?php
                    }


                    //
                    ?>
                </div>
            </ul>
        </div>
        <?php
    }
    ?>
    <script src="../js/securite.js"></script>
</section>
<?php
require("footer.php");
?>
</body>
</html>