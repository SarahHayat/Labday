<?php
session_start();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ShareEventTogether - Profil</title>
    <link rel="stylesheet" href="../../assets/css/events.css"/>
</head>


<body>
<div style="display: flex; flex-direction: row">
    <?php

    if (isset($_SESSION['username'])) {
        require("../header/headerConnect.php");
    } else {
        require("../header/headerDisconnect.php");

    }


    ?>

    <section class="fond" style="width: 100%">
        <div class="profil flex">
            <div class="avatar ">
                <div class="photo">
                    <?php
                    if (isset($_SESSION['id_name'])) {
                        $req = $resultat->getUserPicture($_SESSION['id_name']);
                        while ($donnees = $req->fetch()) {
                            $url = $donnees['url'];
                            ?>
                            <img src="<?php echo '../' . $url ?>" height="150px" width="150px">
                            <?php
                        }
                    }

                    ?>
                    <div class="modifier">
                        <a href="profilPicture.php">modifier photo</a>
                    </div>

                </div>


                <div class="supp">
                    <input type="submit" onclick="supprimer()" value="supprimer le profil" id="supprimer">
                </div>
            </div>
            <div class="flex event">
                <div>
                    <p> nom d'utilisateur : <?php if (isset($_SESSION['username'])) echo $_SESSION['username'] ?></p>
                </div>
                <div>
                    <?php
                    if (isset($_SESSION['id_name'])) {
                        $req = $resultat->getUser($_SESSION['id_name']);
                        while ($donnees = $req->fetch()) {
                            echo '<p>' . 'type : ' . $donnees['type_utilisateur'] . '</p>';
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
                        $req = $resultat->getUser($_SESSION['id_name']);
                        while ($donnees = $req->fetch()) {
                            $moyenne = $donnees['karma'];
                        }
                    }

                    ?>
                    <progress id="jauge" min="0" max="10" value="<?php echo $moyenne ?>"></progress>

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
                    $reponse = $resultat->getEventByUser($_SESSION['id_name']);

                    if ($reponse->rowCount() > 0) {
                        while ($donnees = $reponse->fetch()) {

                            ?>

                            <div class="listOfEvent">
                                <div style="background: linear-gradient(-45deg, rgb(33,33,33), rgba(97, 114, 133, 1)) ; border-radius: 10px; padding-bottom: 8px">
                                    <ul class="collectionItem">
                                        <div class="pictureEvent1">
                                            <img id="imgTree" src="../../assets/images/event.png"/>
                                            <p><?php echo $donnees['nom_categorie']; ?></p>
                                        </div>
                                        <div class="pictureEvent">
                                            <div style="display: flex; text-align: right">

                                                <div class="gauche">
                                                    <p><?php echo "Par " . '<b>' . $donnees['pseudo'] . '</b>' . " le : " . '<b>' . $donnees['date_poste'] . '</b>'; ?></p>
                                                    <p><?php echo $donnees['type_utilisateur']; ?></p>
                                                    <p><?php echo $donnees['date_evenement']; ?></p>
                                                    <a class="inputListOfEvent"
                                                       href="../../controllers/event/deleteEvent.php?id_evenement= <?php echo $donnees['id_evenement']; ?>">supprimer</a>
                                                    <a class="inputListOfEvent"
                                                       href="../event/updateEvent.php?id_evenement= <?php echo $donnees['id_evenement']; ?>">modifier</a>
                                                </div>
                                                <div class="centerH3">
                                                    <h3 class="titleOfEvent"><?php echo $donnees['titre_evenement']; ?> </h3>
                                                </div>
                                            </div>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                            <?php

                        }
                    } else {
                        echo '<div>' . 'no event' . '</div>';
                    }
                    ?>
                </div>

            </div>


        </div>
    </section>
</div>
<?php
require("../footer/footer.php");
?>

</body>
<script src="../../js/security.js"></script>

</html>