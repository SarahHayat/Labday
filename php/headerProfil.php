<?php
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Labday</title>
    <link rel="stylesheet" href="../assets/css/headerConnect.css"/>
</head>
<header class="header">
    <div class="menuHaut">
        <h1 id="title"> LabDay</h1>
        <input id="search" type="text" placeholder="recherche...">
        <a id="profil" href="profil.php"> Profil </a>
        <h3><?php $_SESSION["username"] ?></h3>
        <a id="deconnect" href="deconnect.php"> Deconnexion </a>

    </div>
    <div class="menuBas">
        <a href="index.php"> Accueil</a>
        <a href="sortieDuJour.php"> Sorties du jour</a>
        <a href="sortieAPrevoir.php"> Sorties à prévoir</a>
        <a href="contact.php"> Contact</a>
    </div>

</header>
</html>