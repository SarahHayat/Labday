<?php
session_start();
require "../controllers/bdd.php"
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title >ShareEventTogether - Accueil</title>
    <link rel="stylesheet" href="../assets/css/index.css"/>
</head>



<body>
<?php
// echo "session username : " . $_SESSION['username'];

if(isset($_SESSION['id_name'])){
    require("headerConnect.php");
}
else{
        require("headerDisconnect.php");

}
?>
<div class="fond1">
    <h3> MEILLEURS UTILISATEURS</h3>
<?php
$req = $bdd->query('SELECT round(AVG(note)) as moyenne, e.*,u.*, pu.url
    FROM karma as k
    left join utilisateurs as u
    on k.id_utilisateur = u.id_utilisateur
    left join evenements as e
    on u.id_utilisateur = e.id_utilisateur
    LEFT JOIN photo_utilisateurs as pu
    ON u.id_utilisateur = pu.id_utilisateur
    GROUP by k.id_utilisateur
    ORDER by moyenne DESC LIMIT 3');
$i=1;
while($donnees = $req ->fetch()){
    ?>
    <div class="align_best">
        <p><?php echo "#".$i ?></p>
    <img src="<?php echo $donnees['url'] ?>" id="photo_best_user">
    <a href="profilUser.php?id_user= <?php echo $donnees['id_utilisateur'] ?>"> <?php echo $donnees['pseudo'] ?></a>
    </div>
    <?php
    $i++;
}
?>
</div>
<div id="slider">
    <figure>
        <img src="../assets/images/jeu_societe.jpg" alt>
        <img src="../assets/images/plein_air.png" alt>
        <img src="../assets/images/tourisme.jpg" alt>
        <img src="../assets/images/soiree.jpg" alt>
    </figure>
</div>
<?php

if(isset($_SESSION['username'])){
?>
    <div class="create">
        <form action="creerEvent.php">
            <input type="submit" value="Creer un évenement" />
        </form>
        <form action="minichat.php">
            <input type="submit" value="Chat/Forum">
        </form>
    </div>
<?php
}
?>
    <section class="fond">
        <div>
            <p>Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des
                morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié. Il a été popularisé dans les
                années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.</p>
            <p>Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des
                morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié. Il a été popularisé dans les
                années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.</p>
        </div>
    </section>

</body>


</html>