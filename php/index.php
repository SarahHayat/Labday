<?php
session_start();
require "../controllers/bdd.php"
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ShareEventTogether - Accueil</title>
    <link rel="stylesheet" href="../assets/css/index.css"/>
</head>
<body>
<?php
// echo "session username : " . $_SESSION['username'];
if (isset($_SESSION['id_name'])) {
    require("headerConnect.php");
} else {
    require("headerDisconnect.php");
}
?>
<div class="fond1">
    <h3> MEILLEURS UTILISATEURS</h3>
    <?php
    $req = $bdd->query('SELECT u.*, pu.url
    FROM utilisateurs as u
    LEFT JOIN photo_utilisateurs as pu
    ON u.id_utilisateur = pu.id_utilisateur
    GROUP BY u.id_utilisateur
    ORDER by u.karma DESC LIMIT 3');
    $i = 1;
    while ($donnees = $req->fetch()) {
        ?>
        <div class="align_best">
            <p><?php echo "#" . $i ?></p>
            <img src="<?php echo $donnees['url'] ?>" id="photo_best_user">
            <a href="profilUser.php?id_user= <?php echo $donnees['id_utilisateur'] ?>"> <?php echo $donnees['pseudo'] ?></a>
        </div>
        <?php
        $i++;
    }
    ?>
</div>
<!--<div id="slider">-->
<!--    <figure>-->
<!--        <img src="../assets/images/jeu_societe.jpg" alt>-->
<!--        <img src="../assets/images/plein_air.png" alt>-->
<!--        <img src="../assets/images/tourisme.jpg" alt>-->
<!--        <img src="../assets/images/soiree.jpg" alt>-->
<!--    </figure>-->
<!--</div>-->
<div class="slideshow-container">
    <div class="mySlides fade">
        <img src="../assets/images/jeu_societe.jpg">
    </div>
    <div class="mySlides fade">
        <img src="../assets/images/plein_air.png">
    </div>
    <div class="mySlides fade">
        <img src="../assets/images/tourisme.jpg">
    </div>
    <div class="mySlides fade">
        <img src="../assets/images/soiree.jpg">
    </div>
    <span class="dot"></span>
    <span class="dot"></span>
    <span class="dot"></span>
    <span class="dot"></span>
</div>
<?php
if (isset($_SESSION['username'])) {
    ?>
    <div class="create">
        <form action="createEvent.php">
            <input type="submit" value="Creer un évenement"/>
        </form>

    </div>
    <?php
}
?>
<section class="fond flex_column">
    <div id="carte">
        <p>QUI SOMMES-NOUS ? </p>
        <p> Un groupe d'étudiant qui souhaite divertir les gens. Enfaite on aime faire des activités sympas et découvrir
            de nouvelles choses. On a donc souhaité faire rencontrer les gens avec des activités, aider les gens à
            sortir autrement. </p>
    </div>
    <div id="carte">
        <p>POUR QUI ? </p>
        <p> Ce site est accessible pour les professionnels de l'évènement comme pour les particuliers qui souhaitent
            promouvoir des évènements ou simplement les utilisateurs qui souhaite participer. </p>
    </div>
    <div id="carte">
        <p>VOUS SOUHAITEZ ? </p>
        <p> Faire quelque chose de nouveau ou apprendre?
            Vous ne savez pas quoi faire avec votre enfant, vote soeur ou bien vos copines pour sortir ? Trouver des
            évènements, de tous genre, autour de vous, avec des utilisateurs notés grâce à leurs évènements
            précédents. </p>
    </div>
</section>
</body>
<script src="../js/index.js"></script>
<?php
require("footer.php");
?>
</html>
