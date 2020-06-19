<?php
include("../../controllers/bdd/bdd.php");
require("../../controllers/bdd/AllRequest.php");
$resultat = new AllRequest();
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>ShareEventTogether</title>
    <link rel="stylesheet" href="../../assets/css/headerConnect.css"/>
</head>

    <header style="background: linear-gradient(-90deg, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2));" id="menu-none">
        <section style="position: -webkit-sticky;position: sticky;top: 0;">
            <div class="menu-div" id="menu-div">
                <div class="photo">
                    <?php
                    if (isset($_SESSION['id_name'])) {
                        $req = $resultat->getUserPicture($bdd, $_SESSION['id_name'] );
//                        $req = $bdd->query('SELECT * FROM photo_utilisateurs where id_utilisateur= "' . $_SESSION['id_name'] . '" LIMIT 1');
                        while ($donnees = $req->fetch()) {
                            $url = $donnees['url'];
                            ?>
                            <img src="<?php echo $url ?>" height="70%" width="70%">
                            <?php
                        }
                    }

                    ?>


                    <h3><?php
                        if (isset($_SESSION['id_name'])) echo $_SESSION['username']; ?></h3>

                    <a id="profil" href="../user/profil.php"> Profil </a>
                    <a id="deconnect" href="../connexion/logOut.php"> Deconnexion </a>

                </div>
            </div>
            <form action="searchHeader.php" method="get" class="search" style="text-align: center;margin-top: 7%">
                <input class="input-search" type="search" name="search" placeholder="recherche...">
                <input type="submit" value="valider">
            </form>
            <div class="menu-div-bas">
                <p>MENU</p>
                <ul>
                    <li><a href=../index.php>Accueil</a></li>
                    <li><a href="../forum/createForum.php">Forum</a></li>
                    <li><a href="events.php"> Sorties</a></li>
                    <li><a href="../contact/contact.php"> Contact</a></li>

                </ul>
                </ul>
            </div>


        </section>

    </header>
<div id="display" style="background: linear-gradient(-90deg, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2));height: fit-content;position: -webkit-sticky;position: sticky;top: 0;">
    <ul>
        <li><a>Menu --></a></li>
    </ul>
</div>




<div style=" margin-bottom: 150px;"></div>
</html>
<script src="../../js/index.js"></script>
<script src="../../js/displayNone.js"></script>
