<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
    <link rel="stylesheet" href="../assets/css/styleContact.css"/>
</head>


<body>
<?php
// echo "session username : " . $_SESSION['username'];

if($_SESSION['username'] !== null){
    require("headerProfil.php");
}
else{
    require("headerConnect.php");

}

?>

<section class="fond">
    <div class="contactTitle">
        <h2>Contactez-nous</h2>
        <p>Des questions? Remplissez le formulaire et nous vous répondrons du mieux possible</p>
    </div>
    <div class="container">
        <form action="action_page.php">
            <div class="list">

            </div>
            <div>
                <table>
                    <label for="nCompte">Nom du compte:</label>
                    <input type="text"
                           id="nCompte"
                           name="nCompte"
                           required>

                    <label for="email">Email:</label>
                    <input type="email"
                           name="email"
                           id="email"
                           required>

                    <label for="question">Sujet:</label>
                    <input type="text"
                           name="question"
                           id="question"
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


            <label for="subject">Ton message:</label>
            <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>

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