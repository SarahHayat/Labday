<?php
session_start();
require("../controllers/bdd.php");


$reponse = $bdd->query('SELECT * FROM utilisateurs WHERE id_utilisateur = "'.$_SESSION['id_name'].'" ');
$donnees = $reponse->fetch();
echo'Pseudo: '. $_POST['pseudo'];
//if(isset($_POST['mail']) && isset( $_POST['mdpCompte']) && isset($_POST['cMdpCompte']) && isset($_POST['pseudo'])) {
    if ($donnees['pseudo'] == $_POST['pseudo'] && $donnees['mail'] == $_POST['mail'] && $donnees['mot_de_passe'] == $_POST['mdpCompte'] && $donnees['mot_de_passe'] == $_POST['cMdpCompte']) {
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        $from = $_POST['mail'];
        $to = "shareeventtogether@gmail.com";
        $subject = $_POST['sujet'];
        $message = $_POST['message'];
        $headers = "From: " . $from;
        mail($to, $subject, $message, $headers);
        echo "L'email a été envoyé.";
        echo $to;
        echo  $subject;
        echo $message;
        echo $headers;

}
?>