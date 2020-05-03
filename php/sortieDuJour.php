<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>ShareEventTogether - Sorties du jour</title>
    <link rel="stylesheet" href="../assets/css/sortie.css" />
</head>



<body>
<?php
// echo "session username : " . $_SESSION['username'];

if(isset($_SESSION['username'])){
    require("headerConnect.php");
}
else{
    require("headerDisconnect.php");

}

?> 

    <section class="fond">
        <div class="filter">

        </div>
        <?php
        require ("../controllers/bdd.php");
        $reponse = $bdd->query('SELECT ut.* , ev.* FROM evenements as ev left join utilisateurs as ut 
        on ev.id_utilisateur= ut.id_utilisateur where DATE(ev.date_evenement)= DATE(NOW()) order by DATE(ev.date_evenement) ASC');
        // On affiche chaque entrée une à une
        while ($donnees = $reponse->fetch())
        {
        ?>

        <div class="listOfEvent">
            <ul class="collectionItem">
                <div class="pictureEvent">
                    <img id="imgTree" src="../assets/images/arbre_icon.png"/>
                </div>
                <div class="pictureEvent">
                    <h3 class="titleOfEvent"><?php echo $donnees['titre_evenement']; ?> </h3>
                    <p><?php echo  "Par " . '<b>'. $donnees['pseudo'] .'</b>'. " le : " . '<b>'. $donnees['date_poste'].'</b>' ; ?></p>
                    <p><?php echo $donnees['type_utilisateur']; ?></p>
                    <p><?php echo $donnees['lieu']; ?></p>
                    <p><?php echo $donnees['date_evenement']; ?></p>
                    <p class="description"><?php echo $donnees['description']; ?></p>
                    <?php
                    if($donnees['id_utilisateur'] !== $_SESSION['id_name'] ) {
                        ?>
                        <a class="inputListOfEvent"
                           href="../controllers/inscription.php?id_evenement= <?php echo $donnees['id_evenement']; ?>">s'inscrire</a>

                        <?php
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