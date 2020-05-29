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

    <input type="text" name="localisation" placeholder="saisir une ville">

    <input type="range" name="karma" min="0" max="10">

    <input type="submit" value="chercher">

</form>

<section class="fond">
    <div class="filter">

        <?php
        if (isset($_SESSION['id_name']) || isset($categorie) || isset($date_debut) || isset($date_fin) || isset($karma)) {
            $req = $bdd->query('SELECT e.*,u.*, ce.* 
FROM evenements as e 
left join utilisateurs as u on e.id_utilisateur = u.id_utilisateur  
left join categorie_evenements as ce on ce.id_categorie = e.id_categorie 
WHERE ( (e.id_categorie =' . $categorie . ' ) 
AND(DATE(date_evenement) = DATE(now())) AND (UCASE(e.lieu) LIKE "%' . $search . '%") AND u.karma >= "' . $karma . '") 
ORDER BY date_evenement ASC');

            if ($categorie == "NULL") {
                $req = $bdd->query('SELECT e.*,u.*, ce.* 
FROM evenements as e 
left join utilisateurs as u on e.id_utilisateur = u.id_utilisateur  
left join categorie_evenements as ce on ce.id_categorie = e.id_categorie 
WHERE ( (DATE(date_evenement) = DATE(now())) AND (UCASE(e.lieu) LIKE "%' . $search . '%") AND u.karma >= "' . $karma . '") 
ORDER BY date_evenement ASC');
            }


            while ($donnees = $req->fetch()) {


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
                                le : <?php echo $donnees['date_poste'] ?></p>
                            <p><?php echo $donnees['type_utilisateur']; ?></p>
                            <p><?php echo $donnees['lieu']; ?></p>
                            <p><b><?php echo $donnees['date_evenement']; ?></b></p>
                            <p class="description"><?php echo $donnees['description']; ?></p>
                            <?php
                            $reponse = $bdd->prepare('SELECT id_utilisateur, id_evenement FROM inscription_evenements WHERE id_utilisateur = :id_utilisateur AND id_evenement = :id_evenement');
                            $reponse->execute(array(
                                'id_utilisateur' => $_SESSION['id_name'],
                                'id_evenement' => $donnees['id_evenement'],
                            ));

                            $resultat = $reponse->fetch();
                            if ($donnees['id_utilisateur'] !== $_SESSION['id_name'] && $_SESSION['type_utilisateur'] == "particulier" && !$resultat) {
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
<?php
require("footer.php");
?>
</body>
</html>

