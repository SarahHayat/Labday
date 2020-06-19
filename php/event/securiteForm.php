<?php
session_start();
require("../../controllers/bdd/AllRequest.php");
$resultat = new AllRequest();
require("../../controllers/bdd/bdd.php");


if (isset($_GET['pseudo'])) {
    $sql = $resultat->getPseudo($bdd, $_GET['pseudo']);
//    $sql = $bdd->query('SELECT * FROM utilisateurs WHERE pseudo ="' . $_GET['pseudo'] . '"');

    while ($result = $sql->fetch()) {
        if ($result) {

            echo "pseudo deja pris";
        }
    }
}
if (isset($_GET['mail'])) {
    $req = $resultat->getMail($bdd, $_GET['mail']);
//    $req = $bdd->query('SELECT * FROM utilisateurs WHERE mail ="' . $_GET['mail'] . '"');

    while ($result = $req->fetch()) {
        if ($result) {

            echo "mail deja pris";
        }
    }
}

if (isset($_GET['ordre'])) {
    $ordre = $_GET['ordre'];
    if ($_GET['categorie'] == "NULL") {
        if ($ordre == 'ASC') {
            $req = $bdd->query('SELECT * from(SELECT ut.pseudo,ut.type_utilisateur, ev.id_evenement ,ev.id_utilisateur,  ev.titre_evenement,ev.date_poste, ev.description,
 ev.date_evenement, ev.commune, ev.code_postal, ce.nom_categorie, ce.id_categorie, ut.karma
 FROM evenements as ev left join utilisateurs as ut on ev.id_utilisateur= ut.id_utilisateur
 left join categorie_evenements as ce on ce.id_categorie = ev.id_categorie
 where DATE(ev.date_evenement) > DATE(now()))tri
 WHERE (  ((DATE(tri.date_evenement) BETWEEN "' . $_GET['date_debut'] . '" AND "' . $_GET['date_fin'] . '")) 
AND (UCASE(tri.commune) LIKE "%' . $_GET['lieu'] . '%") AND tri.karma >= "' . $_GET['karma'] . '") 
order by tri.date_evenement ASC');
        } else if ($ordre == 'DESC') {

            $req = $bdd->query('SELECT tri.* from(SELECT ut.pseudo,ut.type_utilisateur, ev.id_evenement ,ev.id_utilisateur,  ev.titre_evenement,ev.date_poste, ev.description,
 ev.date_evenement, ev.commune, ev.code_postal, ce.nom_categorie, ce.id_categorie, ut.karma
 FROM evenements as ev left join utilisateurs as ut on ev.id_utilisateur= ut.id_utilisateur
 left join categorie_evenements as ce on ce.id_categorie = ev.id_categorie
 where DATE(ev.date_evenement) > DATE(now()))tri
 WHERE ( ((DATE(tri.date_evenement) BETWEEN "' . $_GET['date_debut'] . '" AND "' . $_GET['date_fin'] . '")) 
AND (UCASE(tri.commune) LIKE "%' . $_GET['lieu'] . '%") AND tri.karma >= "' . $_GET['karma'] . '") 
order by tri.date_evenement DESC');
        }
    } else if ($_GET['categorie'] !== "NULL") {
        if ($ordre == "ASC") {
            $req = $bdd->query('SELECT tri.* from(SELECT ut.pseudo,ut.type_utilisateur, ev.id_evenement ,ev.id_utilisateur,  ev.titre_evenement,ev.date_poste, ev.description,
 ev.date_evenement, ev.commune, ev.code_postal, ce.nom_categorie, ce.id_categorie, ut.karma
 FROM evenements as ev left join utilisateurs as ut on ev.id_utilisateur= ut.id_utilisateur
 left join categorie_evenements as ce on ce.id_categorie = ev.id_categorie
 where DATE(ev.date_evenement) > DATE(now()))tri
 WHERE ( (tri.id_categorie =' . $_GET['categorie'] . ' ) 
AND((DATE(tri.date_evenement) BETWEEN "' . $_GET['date_debut'] . '" AND "' . $_GET['date_fin'] . '")) 
AND (UCASE(tri.commune) LIKE "%' . $_GET['lieu'] . '%") AND tri.karma >= "' . $_GET['karma'] . '") 
order by tri.date_evenement ASC');
        } else if ($ordre == "DESC") {
            $req = $bdd->query('SELECT tri.* from(SELECT ut.pseudo,ut.type_utilisateur, ev.id_evenement ,ev.id_utilisateur,  ev.titre_evenement,ev.date_poste, ev.description,
 ev.date_evenement, ev.commune, ev.code_postal, ce.nom_categorie, ce.id_categorie, ut.karma
 FROM evenements as ev left join utilisateurs as ut on ev.id_utilisateur= ut.id_utilisateur
 left join categorie_evenements as ce on ce.id_categorie = ev.id_categorie
 where DATE(ev.date_evenement) > DATE(now()))tri
 WHERE ( (tri.id_categorie =' . $_GET['categorie'] . ' ) 
AND((DATE(tri.date_evenement) BETWEEN "' . $_GET['date_debut'] . '" AND "' . $_GET['date_fin'] . '")) 
AND (UCASE(tri.commune) LIKE "%' . $_GET['lieu'] . '%") AND tri.karma >= "' . $_GET['karma'] . '") 
order by tri.date_evenement DESC');
        }
    }


    ?>
    <!--    <script>-->
    <!--        var fond = document.getElementById("listOfEvent").style.display = "none";-->
    <!--    </script>-->
    <?php

    $donnees = $req->fetchAll();
    if ($donnees) {
        for ($i = 0; $i < sizeof($donnees); $i++) {

            ?>
            <div class="listOfEvent">
                <div style="background: linear-gradient(-45deg, rgb(33,33,33), rgba(97, 114, 133, 1)) ; border-radius: 10px; padding-bottom: 8px">


                    <ul class="collectionItem">
                        <div class="pictureEvent1">
                            <img id="imgTree" src="../../assets/images/event.png"/>
                            <p><?php echo $donnees[$i]['nom_categorie']; ?></p>
                        </div>
                        <div class="pictureEvent">
                            <div style="display: flex; text-align: right">

                                <div class="gauche">
                                    <p><?php echo "Par " ?> <b><a
                                                    href="../user/userProfil.php?id_user= <?php echo $donnees[$i]['id_utilisateur'] ?>"> <?php echo $donnees[$i]['pseudo'] ?></a></b>
                                        le : <?php echo $donnees[$i]['date_poste'] ?></p>
                                    <p><?php echo $donnees[$i]['type_utilisateur']; ?></p>
                                    <p><?php echo $donnees[$i]['commune'] . " " . $donnees[$i]['code_postal']; ?></p>
                                    <p><b> <?php echo $donnees[$i]['date_evenement']; ?></b></p>
                                    <p class="description"><?php echo $donnees[$i]['description']; ?></p>


                                    <?php
                                    if (isset($_SESSION['id_name']) && isset($donnees[$i]['id_evenement'])) {
                                        //  $req = $resultat->isRegistered($bdd,  $_SESSION['id_name'], $donnees[$i]['id_evenement']);
                                        $req = $bdd->prepare('SELECT id_utilisateur, id_evenement FROM inscription_evenements WHERE id_utilisateur = :id_utilisateur AND id_evenement = :id_evenement');
                                        $req->execute(array(
                                            'id_utilisateur' => $_SESSION['id_name'],
                                            'id_evenement' => $donnees[$i]['id_evenement'],
                                        ));
                                        $resultat = $req->fetch();
                                        if ($donnees[$i]['id_utilisateur'] !== $_SESSION['id_name'] && $_SESSION['type_utilisateur'] == "particulier" && !$resultat) {
//                            ?>
                                            <a class="inputListOfEvent"
                                               href="../../controllers/event/subscribeEvent.php?id_evenement= <?php echo $donnees[$i]['id_evenement']; ?>">s'inscrire </a>
                                            <?php
                                        }
                                    }
                                    //
                                    ?>

                                </div>
                                <div class="centerH3">
                                    <h3 class="titleOfEvent"><?php echo $donnees[$i]['titre_evenement']; ?> </h3>
                                </div>
                            </div>
                        </div>
                    </ul>
                </div>

            </div>
            <?php
        }


    } else {
        ?>
        <p>Aucun événements ...</p>
        <?php

    }
}
?>

