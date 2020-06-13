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
<div style="display: flex; flex-direction: row">
    <div style="background: #FFD700;" id="menu-none">
        <p>test</p>
    </div>
<div>
<section class="body">
    <div class="margin_left">
        <p class="margin_left">ShareEventTogether</p>
        <div class="margin_right1" id="display">
            <ul>
                <li><a>Menu</a></li>
                <ul>
                    <li><a href=index.php>Accueil</a></li>
                    <li><a href="minichat.php">Forum</a></li>
                    <li><a href="sortieAPrevoir.php"> Sorties</a></li>
                    <li><a href="contact.php"> Contact</a></li>

                </ul>
            </ul>
        </div>
    </div>
    <div class="img_arrow">
        <a href="#myID"> <img src="../assets/images/arrow-down.png"> </a>
    </div>
    <div id="section2"></div>

</section>
<?php
// echo "session username : " . $_SESSION['username'];
if (isset($_SESSION['id_name'])) {
    require("headerConnect.php");
} else {
    require("headerDisconnect.php");
}
?>

<section id="myID" class="no_back">
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


    <!--<div class="slideshow-container">-->
    <!--    <div class="mySlides fade">-->
    <!--        <img src="../assets/images/jeu_societe.jpg">-->
    <!--    </div>-->
    <!--    <div class="mySlides fade">-->
    <!--        <img src="../assets/images/plein_air.png">-->
    <!--    </div>-->
    <!--    <div class="mySlides fade">-->
    <!--        <img src="../assets/images/tourisme.jpg">-->
    <!--    </div>-->
    <!--    <div class="mySlides fade">-->
    <!--        <img src="../assets/images/soiree.jpg">-->
    <!--    </div>-->
    <!--    <span class="dot"></span>-->
    <!--    <span class="dot"></span>-->
    <!--    <span class="dot"></span>-->
    <!--    <span class="dot"></span>-->
    <!--</div>-->
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
<!--    <section class="fond flex_column">-->
<!--        <div id="carte">-->
<!--            <p>QUI SOMMES-NOUS ? </p>-->
<!--            <p> Un groupe d'étudiant qui souhaite divertir les gens. Enfaite on aime faire des activités sympas et-->
<!--                découvrir-->
<!--                de nouvelles choses. On a donc souhaité faire rencontrer les gens avec des activités, aider les gens-->
<!--                à-->
<!--                sortir autrement. </p>-->
<!--        </div>-->
<!---->
<!--        <div id="carte">-->
<!--            <p>POUR QUI ? </p>-->
<!--            <p> Ce site est accessible pour les professionnels de l'évènement comme pour les particuliers qui-->
<!--                souhaitent-->
<!--                promouvoir des évènements ou simplement les utilisateurs qui souhaite participer. </p>-->
<!--        </div>-->
<!---->
<!--        <div id="carte">-->
<!--            <p>VOUS SOUHAITEZ ? </p>-->
<!--            <p> Faire quelque chose de nouveau ou apprendre?-->
<!--                Vous ne savez pas quoi faire avec votre enfant, vote soeur ou bien vos copines pour sortir ? Trouver-->
<!--                des-->
<!--                évènements, de tous genre, autour de vous, avec des utilisateurs notés grâce à leurs évènements-->
<!--                précédents. </p>-->
<!--        </div>-->
<!---->
<!---->
<!--    </section>-->
<section class="fond flex_column">
    <div class="test_container background_image">
        <div class="test_card">
            <div class="test_title">
                <h2>POUR QUI ?</h2>
            </div>
            <div class="test_paragraphe">
                <p>Ce site est accessible pour les professionnels de l'évènement comme pour les particuliers qui
                    souhaitent
                    promouvoir des évènements ou simplement les utilisateurs qui souhaite participer.</p>
            </div>
        </div>
    </div>
    <div class="test_container background_image_1">
        <div class="test_card">
            <div class="test_title">
                <h2>QUI SOMMES-NOUS?</h2>
            </div>
            <div class="test_paragraphe">
                <p>Un groupe d'étudiant qui souhaite divertir les gens. Enfaite on aime faire des activités sympas
                    et découvrir
                    de nouvelles choses. On a donc souhaité faire rencontrer les gens avec des activités, aider les
                    gens à
                    sortir autrement.</p>
            </div>
        </div>
    </div>
    <div class="test_container background_image_2">
        <div class="test_card">
            <div class="test_title">
                <h2>VOUS SOUHAITEZ ?</h2>
            </div>
            <div class="test_paragraphe">
                <p> Faire quelque chose de nouveau ou apprendre?
                    Vous ne savez pas quoi faire avec votre enfant, vote soeur ou bien vos copines pour sortir ? Trouver
                    des
                    évènements, de tous genre, autour de vous, avec des utilisateurs notés grâce à leurs évènements
                    précédents.</p>
            </div>
        </div>
    </div>
</section>
</section>
</div>
</div>
</body>
<script src="../js/index.js"></script>
<script src="../js/displayNone.js"></script>
<script src="../js/scroll.js"></script>

<?php
require("footer.php");
?>
</html>
