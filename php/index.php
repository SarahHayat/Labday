<?php
session_start();
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