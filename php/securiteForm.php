<?php
session_start();
require("../controllers/bdd.php");


if (isset($_GET['pseudo'])) {
    $sql = $bdd->query('SELECT * FROM utilisateurs WHERE pseudo ="' . $_GET['pseudo'] . '"');

    while ($result = $sql->fetch()) {
        if ($result) {

            echo "pseudo deja pris";
        }
    }
}
if (isset($_GET['mail'])) {
    $req = $bdd->query('SELECT * FROM utilisateurs WHERE mail ="' . $_GET['mail'] . '"');

    while ($result = $req->fetch()) {
        if ($result) {

            echo "mail deja pris";
        }
    }
}

if (isset($_GET['ordre'])) {
    $ordre = $_GET['ordre'];
    if($ordre =='ASC') {
        $req = $bdd->query('SELECT ut.pseudo, ut.type_utilisateur,ev.id_utilisateur,  ev.titre_evenement,ev.date_poste, ev.description,
 ev.date_evenement, ev.lieu, ce.nom_categorie 
 FROM evenements as ev left join utilisateurs as ut on ev.id_utilisateur= ut.id_utilisateur 
 left join categorie_evenements as ce on ce.id_categorie = ev.id_categorie 
 where DATE(ev.date_evenement) > DATE(now()) order by DATE(ev.date_evenement) ASC');
    } else if($ordre == 'DESC'){
        $req = $bdd->query('SELECT ut.pseudo, ut.type_utilisateur,ev.id_utilisateur, ev.titre_evenement,ev.date_poste, ev.description,
 ev.date_evenement, ev.lieu, ce.nom_categorie 
 FROM evenements as ev left join utilisateurs as ut on ev.id_utilisateur= ut.id_utilisateur 
 left join categorie_evenements as ce on ce.id_categorie = ev.id_categorie 
 where DATE(ev.date_evenement) > DATE(now()) order by DATE(ev.date_evenement) DESC');
    }
    ?>
<!--    <script>-->
<!--        var fond = document.getElementById("listOfEvent").style.display = "none";-->
<!--    </script>-->
    <?php
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
                <p><b> <?php echo $donnees['date_evenement']; ?></b></p>
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
//                            ?>
                        <a class="inputListOfEvent"
                           href="../controllers/inscription.php?id_evenement= <?php echo $donnees['id_evenement']; ?>">s'inscrire </a>
                        <?php
                    }
                }
                //
                ?>

            </div>

        </ul>

    </div>
    <?php
}
?>

