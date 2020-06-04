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
                if (isset($_SESSION['id_name'])) {
                    $req = $bdd->query('SELECT * FROM photo_utilisateurs where id_utilisateur= "' . $_SESSION['id_name'] . '" LIMIT 1');
                    while ($donnees = $req->fetch()) {
                        $url = $donnees['url'];
                        ?>
                        <img src="<?php echo $url ?>" height="150px" width="150px">
                        <?php
                    }
                }

                ?>


            </div>
            <div class="modifier">
                <a href="photo.php">modifier photo</a>
            </div>
        </div>
        <div class="flex event">
            <div>
                <label>nom d'utilisateur : </label>
                <p> <?php if (isset($_SESSION['username'])) echo $_SESSION['username'] ?></p>
            </div>
            <div>
                <label>type : </label>
                <?php
                if (isset($_SESSION['id_name'])) {
                    $req = $bdd->query('SELECT * FROM utilisateurs where id_utilisateur= "' . $_SESSION['id_name'] . '"');
                    while ($donnees = $req->fetch()) {
                        echo '<p>' . $donnees['type_utilisateur'] . '</p>';
                    }
                }

                ?>
            </div>
            <div class="progress">
                <div>
                    <label>niveau de validité : </label>
                </div>
                <?php
                if (isset($_SESSION['id_name'])) {
                    $req = $bdd->query('SELECT karma FROM utilisateurs where id_utilisateur= "' . $_SESSION['id_name'] . '"');
                    while ($donnees = $req->fetch()) {
                        $moyenne = $donnees['karma'];
                    }
                }

                ?>
                <progress id="jauge" min="0" max="10" value="<?php echo $moyenne ?>"></progress>

            </div>
            <!--                <div class="f-50">-->
            <!--                    <input type="text" id="username" value="-->
            <?php //if (isset($_SESSION['username']))echo $_SESSION['username'] ?><!-- ">-->
            <!--                </div>-->
            <div class="supp">
                <input type="submit" onclick="supprimer()" value="supprimer" id="supprimer">
            </div>

        </div>
    </div>


    <div>
        <div class="event">
            <select name="choix" onchange="myChoices(this.value)">
                <option value="mesEvent"> Mes Événements</option>
                <option value="mesInscription">Mes inscriptions</option>
                <option value="mesFavoris">Mes favoris</option>
                <option value="mesEventPassees">Mes inscriptions passées</option>
            </select>

            <div id="evenement">
                <?php
                require("../controllers/bdd.php");
                $reponse = $bdd->query('SELECT ut.* , ev.*, ce.* FROM evenements as ev left join utilisateurs as ut 
        on ev.id_utilisateur= ut.id_utilisateur 
        left join categorie_evenements as ce on ce.id_categorie = ev.id_categorie where ut.id_utilisateur = "' . $_SESSION['id_name'] . '"');
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
                                    <p><?php echo "Par " . '<b>' . $donnees['pseudo'] . '</b>' . " le : " . '<b>' . $donnees['date_poste'] . '</b>'; ?></p>
                                    <p><?php echo $donnees['type_utilisateur']; ?></p>
                                    <p><?php echo $donnees['date_evenement']; ?></p>
                                    <a class="inputListOfEvent"
                                       href="../controllers/deleteEvent.php?id_evenement= <?php echo $donnees['id_evenement']; ?>">supprimer</a>
                                    <a class="inputListOfEvent"
                                       href="updateEvent.php?id_evenement= <?php echo $donnees['id_evenement']; ?>">modifier</a>
                                </div>

                            </div>
                        </ul>
                    </div>
                    <?php
                }
                ?>
            </div>

        </div>


    </div>
</section>
<?php
require("footer.php");
?>
<script src="../js/securite.js"></script>
</body>


</html>