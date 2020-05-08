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
                    $req = $bdd->query('SELECT round(AVG(note)) as moyenne FROM karma where id_utilisateur= "' . $_SESSION['id_name'] . '"');
                    while ($donnees = $req->fetch()) {
                        $moyenne = $donnees['moyenne'];
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
                <a class="inputListOfEvent"
                   href="../controllers/supprimerEvent.php?id_evenement= <?php echo $_SESSION['username']; ?>">supprimer
                    compte</a>
            </div>

        </div>
    </div>


    <div>
        <div class="event">
            <form action="#" method="post">
                <select name="choix">
                    <option value="default">Choix</option>
                    <option value="mesEvent"> Mes Événements</option>
                    <option value="mesInscription">Mes inscriptions</option>
                    <option value="mesEventPassees">Mes inscriptions passées</option>
                </select>
                <input type="submit" name="submit" value="Entrer">
            </form>


            <div class="evenement">
                <?php
                if (isset($_POST['choix']) && $_POST['choix'] !== "default") {
                    if ($_POST['choix'] == "mesEvent") {
                        include("mesEvents.php");
                    } else if ($_POST['choix'] == "mesInscription") {
                        include("mesInscriptions.php");
                    } else if ($_POST['choix'] == "mesEventPassees") {
                        include("mesInscriptionsPassees.php");
                    } else if ($_POST['choix'] == "default") {
                        //
                    }
                }
                ?>

            </div>


        </div>
</section>


<footer>
    <div>

    </div>

</footer>
</body>


</html>