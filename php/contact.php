<?php
session_start();
require("../controllers/bdd.php");

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ShareEventTogether - Contact</title>
    <link rel="stylesheet" href="../assets/css/styleContact.css"/>
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
    <div class="contactTitle">
        <h2>Contactez-nous</h2>
        <p>Des questions? Remplissez le formulaire et nous vous répondrons du mieux possible</p>
    </div>
    <div class="container">
        <form action="emailEnvoi.php" class="contact" method="post">
            <div class="list">

            </div>
            <div>
                <table>
                    <label for="pseudo">Pseudo:</label>
                    <input type="text"
                           id="pseudo"
                           name="pseudo"
                           required>

                    <label for="mail">Email:</label>
                    <input type="email"
                           name="mail"
                           id="mail"
                           required>

                    <label for="sujet">Sujet:</label>
                    <input type="text"
                           name="sujet"
                           id="sujet"
                           required>


                    <label for="mdpCompte">Mot de passe:</label>
                    <input type="password"
                           id="mdpCompte"
                           name="mdpCompte"
                           required>
                    <label for="cMdpCompte">Confirmation du mot de passe:</label>
                    <input type="password"
                           id="cMdpCompte"
                           name="cMdpCompte"
                           required>


                </table>
            </div>


            <label for="message">Ton message:</label>
            <textarea id="message" name="message" placeholder="Ecrivez un message.." style="height:200px"></textarea>


            <input type="submit" value="Envoyer ->">


        </form>
    </div>
</section>


<footer>
    <div>

    </div>

</footer>
</body>


</html>