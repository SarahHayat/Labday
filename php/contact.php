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

if (isset($_SESSION['username'])) {
    require("headerConnect.php");
} else {
    require("headerDisconnect.php");

}

?>

<section class="fond">
    <div class="contactTitle">
        <h2>Contactez-nous</h2>
        <p>Des questions? Remplissez le formulaire et nous vous répondrons du mieux possible</p>
    </div>
    <div class="container_contact">
        <form action="#" class="contact" method="post">
            <div class="list">

            </div>
            <div>
                <table>
                    <label for="pseudo">Pseudo: </label>
                    <input type="text"
                           id="pseudo"
                           name="pseudo"
                           required>

                    <label for="mail">Email: <span class="obligatoire">*</span></label>
                    <input type="email"
                           name="mail"
                           id="mail"
                           required>

                    <label for="sujet">Sujet: <span class="obligatoire">*</span></label>
                    <input type="text"
                           name="sujet"
                           id="sujet"
                           required>


                    <label for="mdpCompte">Mot de passe: </label>
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


            <label for="message">Ton message: <span class="obligatoire">*</span></label>
            <textarea id="message" name="message" placeholder="Ecrivez un message.." style="height:200px"></textarea>


            <input type="submit" class="button_submit" value="Envoyer ->">

        </form>
        <?php
        if (isset($_SESSION['id_name'])) {
            $reponse = $bdd->query('SELECT * FROM utilisateurs WHERE id_utilisateur = "' . $_SESSION['id_name'] . '" ');
            $donnees = $reponse->fetch();
            if (isset($_POST['mail']) && isset($_POST['mdpCompte']) && isset($_POST['cMdpCompte']) && isset($_POST['pseudo'])) {
                if ($donnees['pseudo'] == $_POST['pseudo'] && $donnees['mail'] == $_POST['mail'] && $donnees['mot_de_passe'] == $_POST['mdpCompte'] && $donnees['mot_de_passe'] == $_POST['cMdpCompte']) {
                    ini_set('display_errors', 1);
                    error_reporting(E_ALL);
                    $from = $_POST['mail'];
                    $to = "shareeventtogether@gmail.com";
                    $subject = $_POST['sujet'];
                    $message = $_POST['message'];
                    $headers = "From: " . $from;
                    mail($to, $subject, $message, $headers);
                    ?>
                    <script>alert("<?php echo ('Votre message à été envoyé !'); ?>")</script>
                <?php

                }else {
                ?>
                    <script>alert("<?php echo ('Mail ou mot de passe incorrect, veuillez reesayer !'); ?>")</script>
                    <?php
                }
            }
        }else {
                    ?>
            <script>alert("<?php echo ("Vous n'êtes pas connecté !"); ?>")</script>
            <?php
//            header('Location : index.php');
        }
        ?>

    </div>
</section>


<?php
require("footer.php");
?>
</body>


</html>