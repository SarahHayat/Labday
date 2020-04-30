<?php
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>ShareEventTogether</title>
    <link rel="stylesheet" href="../assets/css/headerConnect.css"/>
</head>
<header class="header">
    <div class="menuHaut">
        <h1 id="title"> ShareEventTogether</h1>
        <input id="search" type="text" placeholder="recherche...">
        <a id="profil" href="profil.php"> Profil </a>
        <a id="deconnect" href="deconnect.php"> Deconnexion </a>
        <h3><?php
            if(isset($_SESSION['id_name']))echo $_SESSION['username'] ;?></h3>

    </div>
    <div class="menuBas">
        <a href="index.php"> Accueil</a>
        <a href="sortieDuJour.php"> Sorties du jour</a>
        <a href="sortieAPrevoir.php"> Sorties à prévoir</a>
        <a href="contact.php"> Contact</a>
    </div>

</header>
</html>