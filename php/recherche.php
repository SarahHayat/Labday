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
// echo "session username : " . $_SESSION['username'];

if (isset($_SESSION['username'])) {
    require("headerConnect.php");
} else {
    require("headerDisconnect.php");

}


$articles = $bdd->query('SELECT * FROM evenements as e LEFT JOIN utilisateurs as u ON e.id_utilisateur = u.id_utilisateur ORDER BY e.date_evenement DESC');

if (isset($_GET['search']) AND !empty($_GET['search'])) {
    $search = htmlspecialchars($_GET['search']);
    $articles = $bdd->query('SELECT * FROM evenements as e LEFT JOIN utilisateurs as u ON e.id_utilisateur = u.id_utilisateur WHERE e.titre_evenement LIKE "%' . $search . '%" ORDER BY e.date_evenement DESC');

    if ($articles->rowCount() == 0) {
        $articles = $bdd->query('SELECT * FROM evenements as e LEFT JOIN utilisateurs as u ON e.id_utilisateur = u.id_utilisateur WHERE CONCAT(e.titre_evenement, e.description) LIKE "%' . $search . '%" ORDER BY e.date_evenement DESC');
    }
}
?>
<section class="fond">
    <div class="filter">
        <?php

        if ($articles->rowCount() > 0) {
        while ($donnees = $articles->fetch()) {

            ?>

            <div class="listOfEvent">
                <ul class="collectionItem">
                    <div class="pictureEvent">
                        <img id="imgTree" src="../assets/images/arbre_icon.png"/>
                    </div>
                    <div class="pictureEvent">

                        <h3 class="titleOfEvent"><?php echo $donnees['titre_evenement']; ?> </h3>
                        <p><?php echo "Par " ?> <b><a href="profilUser.php?id_user= <?php echo $donnees['id_utilisateur'] ?>"> <?php echo $donnees['pseudo'] ?></a></b> le : <b> <?php echo $donnees['date_poste'] ?></b></p>
                        <p><?php echo $donnees['type_utilisateur']; ?></p>
                        <p><?php echo $donnees['lieu']; ?></p>
                        <p><?php echo $donnees['date_evenement']; ?></p>
                        <p class="description"><?php echo $donnees['description']; ?></p>
                        <?php
                        $req = $bdd->prepare('SELECT id_utilisateur, id_evenement FROM inscription_evenements WHERE id_utilisateur = :id_utilisateur AND id_evenement = :id_evenement');
                        $req->execute(array(
                            'id_utilisateur' => $_SESSION['id_name'],
                            'id_evenement' => $donnees['id_evenement'],
                        ));

                        $resultat = $req->fetch();
                        if ($donnees['id_utilisateur'] !== $_SESSION['id_name']  && $_SESSION['type_utilisateur'] == "particulier" && !$resultat) {
                            ?>
                            <a class="inputListOfEvent" href="../controllers/inscription.php?id_evenement= <?php echo $donnees['id_evenement']; ?>">s'inscrire</a>
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

</section>
<?php
require("footer.php");
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

