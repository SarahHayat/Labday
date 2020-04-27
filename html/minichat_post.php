<?php
require('controllers/bdd.php');
$pseudo = $_POST['pseudo'];
$message = $_POST['message'];
if(isset($pseudo) && isset($message)){
    $req = $bdd->prepare("INSERT INTO miniChat(nom,message) VALUES(:pseudo, :message)");
    $req->execute(array(
        'pseudo' => $pseudo,
        'message' => $message
    ));
}
header('Location: minichat.php');