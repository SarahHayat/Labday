<?php
session_start();
require("../../controllers/bdd/AllRequest.php");
$resultat = new AllRequest();

$id_sujet = $_GET['id_sujet'];
$date = date('Y-m-d H:i:s');
if(isset($_SESSION['id_name'], $date, $id_sujet)) {
    $req = $resultat->addNewMessage($date, $_SESSION['id_name'], $_POST['message'], $id_sujet);

    $req->closeCursor();
    header('Location:' . $_SERVER['HTTP_REFERER']);
}else{
    header('Location:' . $_SERVER['HTTP_REFERER']);
}
