<?php
session_start();
require ("bdd.php");

$mail = $_GET['mail'];
$pseudo = $_GET['pseudo'];
$reponse = $bdd->query('SELECT pseudo, mail from utilisateurs where pseudo = "' . $pseudo . '" OR mail = "' . $mail . '"');
 if($reponse){
     ?>
     <script>alert("deja pris")</script>
<?php
 }
 ?>