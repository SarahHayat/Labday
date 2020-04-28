<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Labday</title>
    <link rel="stylesheet" href="../assets/css/connect.css"/>
</head>


<body>
<?php
// echo "session username : " . $_SESSION['username'];

if(isset($_SESSION['username'])){
    require("headerProfil.php");
}
else{
    require("headerConnect.php");

}

?>
<form action="../controllers/request.php" method="post">
            <h1> Creation nouveau Evenement</h1>

            <label><b>Description</b></label></br>
            <textarea name="description" placeholder="Décrire votre évenement" required></textarea>

            <label>Date de l'évenement</label>
            <input type="date" name="date_evenement" required>

            <label><b>Titre</b></label>
            <input type="text" placeholder="titre" name="titre" required>

            <label><b>Lieux</b></label>
            <input type="text" placeholder="lieux" name="lieux" required>

            <input type="submit" id='enregistrer' value='ENREGISTRER' >
        </form>
