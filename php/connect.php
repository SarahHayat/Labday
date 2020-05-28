<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ShareEventTogether - connect</title>
    <link rel="stylesheet" href="../assets/css/connect.css"/>
</head>


<body>
<?php
// echo "session username : " . $_SESSION['username'];

if (isset($_SESSION['username'])) {
    require("headerConnect.php");
} else {
    require("headerDisconnect.php");

}

?>
<div class="connect">
    <div class="container_connect">
        <!-- zone de connexion -->

        <form action="../controllers/connexion.php" method="POST" class="connexion">
            <h1>Connexion</h1>

            <label><b>Nom d'utilisateur</b></label>
            <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>

            <label><b>Mot de passe</b></label>
            <input type="password" placeholder="Entrer le mot de passe" name="password" required>

            <input type="submit" id='submit' value='LOGIN'>

        </form>
    </div>
    <div class="container_connect">
        <form action="../controllers/connexion.php" method="post" class="creer">
            <h1> Creation nouveau utilisateur</h1>

            <label><b>Type utilisateur</b> <span class="obligatoire">*</span></label></br>

            <input type="radio" name="type_utilisateur" id="professionnel" value="professionnel" required>
            <label for="professionnel">professionnel</label>

            <input type="radio" name="type_utilisateur" id="particulier" value="particulier">
            <label for="particulier">particulier</label></br>

            <label><b>Nom</b> <span class="obligatoire">*</span></label>
            <input type="text" placeholder="nom" name="nom" required>

            <label><b>Prénom</b> <span class="obligatoire">*</span></label>
            <input type="text" placeholder="prenom" name="prenom" required>

            <label><b>Pseudo</b> <span class="obligatoire">*</span></label>
            <input type="text" placeholder="pseudo" name="pseudo" required>

            <label><b>Adresse postale</b> <span class="obligatoire">*</span></label>
            <input type="text" placeholder="adresse" name="adresse" required>

            <label><b>Code postale</b> <span class="obligatoire">*</span></label>
            <input type="number" placeholder="code postale" name="code_postale"  oninput="if(value.length>5)value=value.slice(0,5)" required>

            <label><b>Ville</b> <span class="obligatoire">*</span></label>
            <input type="text" placeholder="ville" name="ville" required>

            <label><b>Pays</b> <span class="obligatoire">*</span></label>
            <select id="select_pays" name="pays"></select>

            <label><b>Mail</b> <span class="obligatoire">*</span></label>
            <input type="email" placeholder="mail" name="mail" required>

            <label><b>Numéro de téléphone</b> <span class="obligatoire">*</span></label>
            <input type="number" placeholder="numéro de téléphone" name="telephone"  oninput="if(value.length>10)value=value.slice(0,10)" required>

            <label><b>Date de naissance</b> <span class="obligatoire">*</span></label>
            <input type="date" id="date_naissance" name="date_naissance" min="1940-01-01" max="2018-12-31" required>

            <label><b>Mot de passe</b> <span class="obligatoire">*</span></label>
            <input type="password" placeholder="mot de passe" name="mot_de_passe" required>


            <input type="submit" id='enregistrer' value='ENREGISTRER'>
            <script>

            <input type="submit" id='enregistrer' value='ENREGISTRER' onclick="confirmer()">
                const enregistrer = document.getElementById("enregistrer"); // On recupere l'element du DOM


                enregistrer.addEventListener("click", function () { // On ajoute un event de type click sur l'element du DOM enregistrer

                    alert('Votre compte a bien été créer !');

                });


            </script>
        </form>
    </div>
</div>
<script src="../js/liste_deroulante.js"></script>
<?php
require("footer.php");
?>
<script src="../js/securite.js"></script>
</body>

</html>