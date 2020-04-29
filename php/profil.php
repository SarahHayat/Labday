<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Labday</title>
    <link rel="stylesheet" href="../assets/css/profil.css"/>
</head>


<body>
<?php
// echo "session username : " . $_SESSION['username'];

if(isset($_SESSION['username'])){
    require("headerProfil.php");
}
else{
    require("headerConnect.php");

}

?>

<section class="fond">
    <div class="profil">
        <div class="avatar flex">
            <div class="photo">
                <img src="../assets/images/rebelle.png" height="100px" width="100px">
            </div>
        </div>

        <div class="info">
            <div class="flex">
                <div class="f-50">
                    <label>nom d'utilisateur:</label>
                </div>
                <div class="f-50">
                    <input type="text" id="username" value="<?php if (isset($_SESSION['username']))echo $_SESSION['username'] ?> ">
                </div>

            </div>
            <div class="flex">
                <div class="f-50">
                    <label>date de création:</label>
                </div>
                <div class="f-50">
                    <input type="text" id="creation">
                </div>

            </div>

        </div>
        <div class="progress">
            <div class="f-50">
                <label>niveau de validité:</label>
            </div>
            <progress id="jauge" min="0" max="100" value="50"></progress>

        </div>
    </div>

    <div class="event flex">
        <div>
            <div>
                <h2>Mes évenements</h2>
            </div>
            <div>
                <?php
                require ("../controllers/bdd.php");
                $reponse = $bdd->query('SELECT titre_evenement, date_poste, date_evenement FROM evenements where id_utilisateur ="' . $_SESSION['id_name'] . '"');
                // On affiche chaque entrée une à une
                while ($donnees = $reponse->fetch()) {
                    ?>

                    <div class="listOfEvent">
                        <ul class="collectionItem">
                            <div class="pictureEvent">
                                <img id="imgTree" src="../assets/images/arbre_icon.png"/>
                            </div>
                            <div class="pictureEvent">
                                <h3 class="titleOfEvent"><?php echo $donnees['titre_evenement']; ?> </h3>
                                <p><?php echo $donnees['date_evenement']; ?></p>

                            </div>
                        </ul>
                    </div>
                    <?php
                }
                ?>
        </div>
            <div>
                <div>
                    <h2>Mes inscriptions</h2>
                </div>
                <div>
                    <?php
                    require ("../controllers/bdd.php");
                    $reponse = $bdd->query('SELECT ie.* , e.* FROM inscription_evenements as ie left join evenements as e on ie.id_evenement = e.id_evenement where ie.id_utilisateur = "' . $_SESSION['id_name'] . '"');
                    // On affiche chaque entrée une à une
                    while ($donnees = $reponse->fetch()) {
                        ?>

                        <div class="listOfEvent">
                            <ul class="collectionItem">
                                <div class="pictureEvent">
                                    <img id="imgTree" src="../assets/images/arbre_icon.png"/>
                                </div>
                                <div class="pictureEvent">
                                    <h3 class="titleOfEvent"><?php echo $donnees['titre_evenement']; ?> </h3>
                                    <p><?php echo $donnees['date_evenement']; ?></p>

                                </div>
                            </ul>
                        </div>
                        <?php
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