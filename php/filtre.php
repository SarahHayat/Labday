<?php
session_start();
require("../controllers/bdd.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ShareEventTogether - create event</title>
    <link rel="stylesheet" href="../assets/css/sortie.css"/>
</head>


<body>

<?php
if (isset($_SESSION['username'])) {
    require("headerConnect.php");
} else {
    require("headerDisconnect.php");

}


$categorie = $_POST['categorie'];
$date_debut = $_POST['date_debut'];
$date_fin = $_POST['date_fin'];
//$localisation = $_POST['$localisation'];
$karma = $_POST['karma'];
$search = $_POST['localisation'];


?>
<form action="#" method="post" class="filtre">
    <select name="categorie">
        <option value="NULL">Choisir une categorie</option>
        <option value="1">Plein air</option>
        <option value="2">Jeux de société</option>
        <option value="3">Tourisme</option>
        <option value="4">Soirée</option>
    </select>
    <?php
    $req = $bdd->query('SELECT MIN(DATE(date_evenement)) as date_min, MAX(DATE(date_evenement)) as date_max FROM evenements');
    while ($donnees = $req->fetch()) {
        ?>
        <input type="date" name="date_debut" value="<?php echo $donnees['date_min']; ?>">

        <input type="date" name="date_fin" value="<?php echo $donnees['date_max']; ?>">
        <?php
    }
    ?>

    <input type="text" name="localisation" placeholder="saisir une ville">

    <input type="range" name="karma" min="0" max="10">

    <input type="submit" value="chercher">

</form>

<section class="fond">
    <div class="filter">

        <?php
        if (isset($_SESSION['id_name']) || isset($categorie) || isset($date_debut) || isset($date_fin) || isset($karma)) {
            $req = $bdd->query('SELECT round(AVG(note)) as moyenne, e.*,u.*
    FROM karma as k
    left join utilisateurs as u
    on k.id_utilisateur = u.id_utilisateur
    left join evenements as e
    on u.id_utilisateur = e.id_utilisateur
    WHERE ( (id_categorie =' . $categorie . ' ) 
    AND (DATE(date_evenement) BETWEEN "' . $date_debut . '" AND "' . $date_fin . '")
    AND UCASE(e.lieu) LIKE "%'.$search.'%")
    GROUP by k.id_utilisateur
    HAVING (moyenne >= '.$karma.')');

            if ($categorie == "NULL") {
                $req = $bdd->query('SELECT round(AVG(note)) as moyenne, e.*,u.*
    FROM karma as k
    left join utilisateurs as u
    on k.id_utilisateur = u.id_utilisateur
    left join evenements as e
    on u.id_utilisateur = e.id_utilisateur
    WHERE ( (DATE(date_evenement) BETWEEN "' . $date_debut . '" AND "' . $date_fin . '")
    AND UCASE(e.lieu) LIKE "%'.$search.'%")
    GROUP by k.id_utilisateur
    HAVING (moyenne >= '.$karma.')');
            }

            while ($donnees = $req->fetch()) {

                ?>

                <div class="listOfEvent">
                    <ul class="collectionItem">
                        <div class="pictureEvent">
                            <img id="imgTree" src="../assets/images/arbre_icon.png"/>
                        </div>
                        <div class="pictureEvent">

                            <h3 class="titleOfEvent"><?php echo $donnees['titre_evenement']; ?> </h3>
                            <p><?php echo "Par " ?> <b><a
                                            href="profilUser.php?id_user= <?php echo $donnees['id_utilisateur'] ?>"> <?php echo $donnees['pseudo'] ?></a></b>
                                le : <b> <?php echo $donnees['date_poste'] ?></b></p>
                            <p><?php echo $donnees['type_utilisateur']; ?></p>
                            <p><?php echo $donnees['lieu']; ?></p>
                            <p><?php echo $donnees['date_evenement']; ?></p>
                            <p class="description"><?php echo $donnees['description']; ?></p>
                            <?php
                            if ($donnees['id_utilisateur'] !== $_SESSION['id_name'] && $_SESSION['type_utilisateur'] == "particulier") {
                                    ?>
                                    <a class="inputListOfEvent"
                                       href="../controllers/inscription.php?id_evenement= <?php echo $donnees['id_evenement']; ?>">s'inscrire</a>
                                    <?php
                            }
                            ?>
                        </div>
                    </ul>
                </div>

                <?php
            }
        }

        ?>

    </div>

</section>

