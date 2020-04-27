<html>
<body>

<form method="post" action="#">
</form>

<?php
if (!empty($_POST)){
    var_dump($_POST);
    $createaccount = new Account ($_POST["prenom"], $_POST["name"], $_POST["date_naissance"], $_POST["adresse"],$_POST["code_postale"], $_POST["pays"], $_POST["telepohone"], $_POST["mail"], $_POST["pseudo"],$_POST["mot_de_passe"]);
    echo "votre compte à été créer" .$createaccount->getPrenom()."";
}

?>


<form method="post" action="#">
</form>

<?php


?>
</body>
</html>
