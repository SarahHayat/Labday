<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ShareEventTogether - create event</title>
    <link rel="stylesheet" href="../assets/css/connect.css"/>
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
<form action="../controllers/request.php" method="post" class="container fond">
    <h1> Creation nouveau Evenement</h1>

    <label><b>Titre</b></label>
    <input type="text" placeholder="titre" name="titre" required>

    <label><b>Lieux</b></label>
    <input type="text" placeholder="lieux" name="lieux" required>

    <label>Date de l'évenement</label>
    <input type="datetime-local" name="date_evenement" required>

    <label><b>Description</b></label></br>
    <textarea name="description" placeholder="Décrire votre évenement" required></textarea>

    <input type="submit" id='enregistrer' value='ENREGISTRER' >
        </form>

