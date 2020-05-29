<?php
session_start();
require("../controllers/bdd.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ShareEventTogether - Profil</title>
    <link rel="stylesheet" href="../assets/css/profil.css"/>
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

<section class="fond">
    <div class="profil flex">
        <div class="avatar ">
            <div class="photo">
                <?php
                    $req = $bdd->query('SELECT * FROM photo_utilisateurs where id_utilisateur= "' . $_GET['id_user'] . '" LIMIT 1');
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
                <label>nom d'utilisateur : </label>
                <?php
                    $req = $bdd->query('SELECT * FROM utilisateurs where id_utilisateur= "' . $_GET['id_user'] . '"');
                    while ($donnees = $req->fetch()) {
                        ?>

                        <p> <?php echo $donnees['pseudo'] ?></p>
                        <?php
                }

                ?>
            </div>
            <div>
                <label>type : </label>
                <?php
                    $req = $bdd->query('SELECT * FROM utilisateurs where id_utilisateur= "' . $_GET['id_user'] . '"');
                    while ($donnees = $req->fetch()) {
                        echo '<p>' . $donnees['type_utilisateur'] . '</p>';
                }

                ?>
            </div>
            <div class="progress">
                <div>
                    <label>niveau de validité : </label>
                </div>
                <?php
                    $req = $bdd->query('SELECT karma FROM utilisateurs where id_utilisateur= "' . $_GET['id_user'] . '"');
                    while ($donnees = $req->fetch()) {
                        $moyenne = $donnees['karma'];
                }

                ?>
                <progress id="jauge" min="0" max="10" value="<?php echo $moyenne ?>"></progress>

            </div>

        </div>
    </div>
    <div class="evenement">
        <div>
            <h2>Évenements</h2>
        </div>
        <div class="evenement">
            <?php
            require("../controllers/bdd.php");
            $reponse = $bdd->query('SELECT ut.* , ev.* FROM evenements as ev left join utilisateurs as ut 
        on ev.id_utilisateur= ut.id_utilisateur where ut.id_utilisateur = "' . $_GET['id_user'] . '"');
            // On affiche chaque entrée une à une
            while ($donnees = $reponse->fetch()) {
                ?>

                <div class="listOfEvent">
                    <ul class="collectionItem">
                        <div class="pictureEvent">
                            <img class="imgTree" src="../assets/images/arbre_icon.png"/>
                        </div>
                        <div class="pictureEvent">
                            <h3 class="titleOfEvent"><?php echo $donnees['titre_evenement']; ?> </h3>
                            <p><?php echo "Par " . '<b>' . $donnees['pseudo'] . '</b>' . " le : " . '<b>' . $donnees['date_poste'] . '</b>'; ?></p>
                            <p><?php echo $donnees['type_utilisateur']; ?></p>
                            <p><?php echo $donnees['date_evenement']; ?></p>

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
                </div>
                <?php
            }
            ?>
        </div>
    </div>

</section>
<?php
require("footer.php");
?>
</body>
</html>
