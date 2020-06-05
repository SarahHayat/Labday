<?php
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>ShareEventTogether</title>
    <link rel="stylesheet" href="../assets/css/headerConnect.css"/>
</head>
<div style="margin-bottom: 14%">
</div>
<header class="header">
    <div class="menuHaut" id="menuHaut">
        <h1 id="title"> ShareEventTogether</h1>
        <form action="recherche.php" method="get" class="search">
            <input class="input-search" type="search" name="search" placeholder="recherche...">
            <input type="submit" value="valider">
        </form>
        <a id="profil" href="profil.php"> Profil </a>
        <a id="deconnect" href="logOut.php"> Deconnexion </a>
        <h3><?php
            if(isset($_SESSION['id_name']))echo $_SESSION['username'] ;?></h3>

    </div>
    <div class="menuBas" id="nav-scroll">
        <a href="index.php"> Accueil</a>
<!--        <a href="sortieDuJour.php"> Sorties du jour</a>-->
        <a href="minichat.php">Forum</a>
        <a href="sortieAPrevoir.php"> Sorties à prévoir</a>
        <a href="contact.php"> Contact</a>
    </div>
<script type="text/javascript">
   let lastSrollTop = 0;
   navbar = document.getElementById('nav-scroll');
   menuHaut = document.getElementById('menuHaut');
   window.addEventListener("scroll", function () {
       let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
       if (scrollTop > lastSrollTop){
            navbar.style.display="none";
            menuHaut.style.borderBottom = "solid white 2px";
       }else {
           navbar.style.display="flex";
           menuHaut.style.borderBottom = "none";

       }
       lastSrollTop = scrollTop;
   })
</script>
</header>
</html>