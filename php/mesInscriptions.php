<div>
    <div>
        <h2>Mes inscriptions</h2>
    </div>
    <div>
        <?php
        require ("../controllers/bdd.php");
        $reponse = $bdd->query('SELECT ie.* , e.*, u.* FROM inscription_evenements as ie left join evenements as e on ie.id_evenement = e.id_evenement LEFT join utilisateurs as u on e.id_utilisateur = u.id_utilisateur where ie.id_utilisateur ="' . $_SESSION['id_name'] . '"');
        // On affiche chaque entrée une à une
        while ($donnees = $reponse->fetch()) {
            ?>

            <div class="listOfEvent">
                <ul class="collectionItem">
                    <div class="pictureEvent">
                        <img class="imgTree" src="../assets/images/arbre_icon.png"/>
                    </div>
                    <div class="pictureEvent">
                        <h3 class="titleOfEvent"><?php echo $donnees['titre_evenement']; ?> </h3>
                        <p><?php echo $donnees['type_utilisateur']; ?></p>
                        <p><?php echo $donnees['date_evenement']; ?></p>
                        <a class="inputListOfEvent" href="../controllers/desinscription.php?id_evenement= <?php echo $donnees['id_evenement']; ?>">se désincrire</a>


                    </div>
                </ul>
            </div>
            <?php
        }
        ?>
    </div>
</div>