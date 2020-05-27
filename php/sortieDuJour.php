<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>ShareEventTogether - Sorties du jour</title>
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

?>

<form action="filtre.php" method="post" class="filtre">
    <select name="categorie">
        <option value="NULL">Choisir une categorie</option>
        <option value="1">Plein air</option>
        <option value="2">Jeux de société</option>
        <option value="3">Tourisme</option>
        <option value="4">Soirée</option>
    </select>

    <input type="date" name="date_debut" placeholder="date de début">

    <input type="date" name="date_fin" placeholder="date de fin">

    <input type="text" name="localisation" placeholder="saisir une ville">

    <input type="range" name="karma" min="0" max="10">

    <input type="submit" value="chercher">

</form>

<section class="fond">
    <div class="filter">

    </div>
    <?php
    require("../controllers/bdd.php");
    $reponse = $bdd->query('SELECT ut.* , ev.*, ce.* FROM evenements as ev left join utilisateurs as ut 
        on ev.id_utilisateur= ut.id_utilisateur  
        left join categorie_evenements as ce on ce.id_categorie = ev.id_categorie 
        where ev.date_evenement= NOW() order by ev.date_evenement ASC');
    // On affiche chaque entrée une à une
    while ($donnees = $reponse->fetch())
    {
    ?>

    <div class="listOfEvent">
        <ul class="collectionItem">
            <div class="pictureEvent">
                <img id="imgTree" src="../assets/images/arbre_icon.png"/>
                <p><?php echo $donnees['nom_categorie']; ?></p>
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
                if (isset($_SESSION['id_name']) && isset($donnees['id_evenement'])) {

                    $req = $bdd->prepare('SELECT id_utilisateur, id_evenement FROM inscription_evenements WHERE id_utilisateur = :id_utilisateur AND id_evenement = :id_evenement');
                    $req->execute(array(
                        'id_utilisateur' => $_SESSION['id_name'],
                        'id_evenement' => $donnees['id_evenement'],
                    ));

                    $resultat = $req->fetch();
                    if ($donnees['id_utilisateur'] !== $_SESSION['id_name'] && $_SESSION['type_utilisateur'] == "particulier" && !$resultat) {
                        ?>
                        <a class="inputListOfEvent"
                           href="../controllers/inscription.php?id_evenement= <?php echo $donnees['id_evenement']; ?>">s'inscrire</a>

                        <?php
                    }
                }
                ?>

            </div>

        </ul>
        <?php
        }
        ?>
    </div>
</section>


</body>


</html>