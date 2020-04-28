<?php
session_start();

require ("bdd.php");
class Event{

    private $_titre_event;
    private $_description_event;
    private $_date_event;
    private $_lieu_event;

    /**
     * Triceratops constructor.
     */
    public function __construct($titre,$description,$date,$lieu)
    {
        $this -> _titre_event = $titre;
        $this -> _description_event = $description;
        $this -> _date_event = $date;
        $this -> _lieu_event = $lieu;
    }
}

//function getEvenement($bdd)
//{
//    $req = $bdd->query('SELECT * from evenements ');
//    while ($donnees = $req->fetch()) {
//       $event = {
//          $titre = $donnees['titre_evenement'];
//           $description = $donnees['description'];
//           $date =  $donnees['date_evenement'];
//           $lieu = $donnees['lieu'];
//       }
//
//
//        $_SESSION['titre_event'] = $event;
//    }
//    $req->closeCursor();
//}
?>