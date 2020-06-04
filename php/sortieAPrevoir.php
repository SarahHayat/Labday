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
    <select name="categorie" id="categorie">
        <option value="NULL">Choisir une categorie</option>
        <option value="1">Plein air</option>
        <option value="2">Jeux de société</option>
        <option value="3">Tourisme</option>
        <option value="4">Soirée</option>
    </select>
    <select name="ordre" id="ordre">
        // onchange="trier(this.value)"
        <option value="DESC">Date croissant</option>
        <option value="ASC">Date décroissant</option>
    </select>
    <?php
    $req = $bdd->query('SELECT ADDDATE(DATE(now()), 1) as date_now, MAX(DATE(date_evenement)) as date_max FROM evenements');
    while ($donnees = $req->fetch()) {
        ?>
        <input type="date" name="date_debut" value="<?php echo $donnees['date_now']; ?>"id="date_debut" >
        <input type="date" name="date_fin" value="<?php echo $donnees['date_max']; ?>" id="date_fin">
        <?php
    }
    ?>
    <input type="text" name="lieu" placeholder="saisir une ville" id="lieu">
    <input type="range" name="karma" min="0" max="10" id="karma">
    <input type="submit" value="chercher" onclick="filtre()">
</form>
<section class="fond" id="trie">
    <?php
    $reponse = $bdd->query('SELECT ut.* , ev.*, ce.* FROM evenements as ev left join utilisateurs as ut  
        on ev.id_utilisateur= ut.id_utilisateur left join categorie_evenements as ce on ce.id_categorie = ev.id_categorie 
        where DATE(ev.date_evenement) >= DATE(now()) order by DATE(ev.date_evenement) ASC');
    // On affiche chaque entrée une à une
    while ($donnees = $reponse->fetch()) {
        ?>

        <div class="listOfEvent">
            <div class="centerH3">
            <h3 class="titleOfEvent"><?php echo $donnees['titre_evenement']; ?> </h3>
            </div>
            <ul class="collectionItem">

                <div class="pictureEvent1">
                    <img id="imgTree" src="../assets/images/arbre_icon.png"/>
                    <p><?php echo $donnees['nom_categorie']; ?></p>
                </div>
                <div class="pictureEvent">
                    <div class="gauche">
                    <p><?php echo "Par " ?> <b><a
                                    href="profilUser.php?id_user= <?php echo $donnees['id_utilisateur'] ?>"> <?php echo $donnees['pseudo'] ?></a></b>
                        le : <?php echo $donnees['date_poste'] ?></p>
                    <p><?php echo $donnees['type_utilisateur']; ?></p>
                    <p><?php echo $donnees['lieu']; ?></p>
                    <p><b> <?php echo $donnees['date_evenement']; ?></b></p>
                    </div>
                    <p class="description"><?php echo $donnees['description']; ?></p>
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
                            <a class="inputListOfEvent"
                               href="../controllers/addToMyFav.php?id_evenement= <?php echo $donnees['id_evenement']; ?>">Ajouter à mes favoris </a>

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
    <script src="../js/securite.js"></script>
</section>
<?php
require("footer.php");
?>
</body>
</html>