<?php
require("bdd.php");



class AllRequest

{
    public $bdd = null;


    public function __construct()
    {
        try {
            $this->bdd = new PDO('mysql:host=localhost;dbname=ShareEventTogether', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            // echo "connexion réussi <br/> ";
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function isAllSet($tab)
    {
        for ($i = 0; $i < count($tab); $i++) {
            if (isset($tab[$i])) {
            } else {
                return false;
            }
        }
        return true;
    }

//    public function selectFromBdd($table,$champs, $value){
//        if($champs) {
//            return "SELECT * FROM " . $table . " WHERE " . $champs . "  =  " . $value;
//        }else{
//            return "SELECT * FROM " . $table;
//        }
//    }
//
//    public function insertToBdd($table, $champs, $value){
//        return ("INSERT INTO ".$table[($champs)]."VALUES".[$value]);
//    }

    public function verifConnect($username, $password)
    {
        $req = $this->bdd->prepare('SELECT pseudo, mot_de_passe FROM utilisateurs WHERE pseudo = :pseudo AND mot_de_passe = :password');
        $req->execute(array(
            'pseudo' => $username,
            'password' => $password
        ));
        $resultat = $req->fetch();
        return $resultat;
    }

    public function getUserId($bdd, $username)
    {
        $req = $bdd->query('SELECT * from utilisateurs where pseudo="' . $username . '"');
        return $req;
    }

    public function getKarmaByEvent($bdd, $id_evenement)
    {
        $reponse = $bdd->query('SELECT e.*, ce.* FROM evenements as e left join categorie_evenements as ce
on e.id_categorie = ce.id_categorie
where id_evenement = "' . $id_evenement . '"');
        return $reponse;
    }

    public function startKarma($bdd, $id_name)
    {
        $req = $bdd->prepare('INSERT INTO karma(id_utilisateur, note) VALUES(:id_utilisateur, :note)');
        $req->execute(array(
            'id_utilisateur' => $id_name,
            'note' => 5,
        ));
        return $req;
    }

    public function averageKarma($bdd, $id_name)
    {
        $requete = $bdd->query('SELECT AVG(note) as moyenne FROM karma WHERE id_utilisateur ="' . $id_name . '"');
        return $requete;
    }

    public function updateAverageKarma($bdd, $moyenne, $id_name)
    {
        $reponse = $bdd->query('UPDATE utilisateurs SET karma="' . $moyenne . '" WHERE id_utilisateur ="' . $id_name . '"');
        return $reponse;
    }

    public function addKarma($bdd, $note, $id_utilisateur, $id_evenement)
    {
        $req = $bdd->prepare('INSERT INTO karma(note, id_utilisateur, id_evenement) VALUES(:note, :id_utilisateur, :id_evenement)');
        $req->execute(array(
            'note' => $note,
            'id_utilisateur' => $id_utilisateur,
            'id_evenement' => $id_evenement,

        ));
        return $req;
    }

    public function existAccount($bdd, $pseudo, $mail)
    {
        $reponse = $bdd->query('SELECT pseudo from utilisateurs where pseudo = "' . $pseudo . '" OR mail = "' . $mail . '"');
        return $reponse;
    }

    public function createAccount($bdd, $prenom, $nom, $date_naissance, $adresse, $code_postale, $pays, $telephone, $mail, $pseudo, $mot_de_passe, $type_utilisateur, $ville)
    {
        $req = $bdd->prepare('INSERT INTO utilisateurs(prenom, nom, date_naissance, adresse, code_postale, pays, telephone, mail, pseudo, mot_de_passe, type_utilisateur, ville) VALUES(:prenom, :nom, :date_naissance, :adresse, :code_postale, :pays, :telephone, :mail, :pseudo, :mot_de_passe, :type_utilisateur, :ville)');
        $req->execute(array(
            'prenom' => $prenom,
            'nom' => $nom,
            'date_naissance' => $date_naissance,
            'adresse' => $adresse,
            'code_postale' => $code_postale,
            'pays' => $pays,
            'telephone' => $telephone,
            'mail' => $mail,
            'pseudo' => $pseudo,
            'mot_de_passe' => $mot_de_passe,
            'type_utilisateur' => $type_utilisateur,
            'ville' => $ville,

        ));
        return $req;
    }

    public function getFavorite($bdd, $id_name)
    {
        $sql = $bdd->query('SELECT f.* , e.*, u.*, ce.* FROM favoris as f left join evenements as e on f.id_evenement = e.id_evenement 
    LEFT join utilisateurs as u on e.id_utilisateur = u.id_utilisateur 
    left join categorie_evenements as ce on ce.id_categorie = e.id_categorie 
    where f.id_utilisateur ="' . $id_name . '"');
        return $sql;
    }

    public function addFavorite($bdd, $id_name, $id_evenement)
    {
        $req = $bdd->prepare('INSERT INTO favoris (id_utilisateur, id_evenement) VALUES ( :id_utilisateur, :id_evenement)');
        $req->execute(array(
            'id_utilisateur' => $id_name,
            'id_evenement' => $id_evenement,
        ));
        return $req;
    }

    public function deleteFavorite($bdd, $id_evenement, $id_name)
    {
        $req = $bdd->prepare('DELETE FROM favoris WHERE id_evenement = :id_evenement AND id_utilisateur = :id_utilisateur');
        $req->execute(array(
            'id_evenement' => $id_evenement,
            'id_utilisateur' => $id_name,
        ));
        return $req;
    }

    public function createEvent($bdd, $id_name, $description, $date_evenement, $titre, $adresse, $code_postal, $commune, $categorie, $x, $y)
    {
        $req = $bdd->prepare('INSERT INTO evenements(id_utilisateur, description, date_evenement, titre_evenement, adresse, code_postal, commune, id_categorie, x, y) VALUES(:utilisateur, :description, :date_evenement, :titre, :adresse, :code_postal, :commune, :categorie, :x, :y)');
        $req->execute(array(
            'utilisateur' => $id_name,
            'description' => $description,
            'date_evenement' => $date_evenement,
            'titre' => $titre,
            'adresse' => $adresse,
            'code_postal' => $code_postal,
            'commune' => $commune,
            'categorie' => $categorie,
            'x' => $y,
            'y' => $x,

        ));
        return $req;

    }

    public function deleteEvent($bdd, $id_evenement)
    {
        $req = $bdd->prepare('DELETE FROM evenements WHERE id_evenement = :id_evenement');
        $req->execute(array(
            'id_evenement' => $id_evenement,
        ));

        return $req;
    }

    public function deleteUser($bdd, $id_name)
    {
        $req = $bdd->prepare('DELETE FROM utilisateurs WHERE id_utilisateur = :id_utilisateur');
        $req->execute(array(
            'id_utilisateur' => $id_name,
        ));
        return $req;
    }

    public function subscribeEvent($bdd, $id_name, $id_evenement)
    {
        $req = $bdd->prepare('INSERT INTO inscription_evenements (id_utilisateur, id_evenement) VALUES ( :id_utilisateur, :id_evenement)');
        $req->execute(array(
            'id_utilisateur' => $id_name,
            'id_evenement' => $id_evenement,
        ));
        return $req;
    }

    public function unsubscribeEvent($bdd, $id_evenement)
    {
        $req = $bdd->prepare('DELETE FROM inscription_evenements WHERE id_evenement = :id_evenement');
        $req->execute(array(
            'id_evenement' => $id_evenement,
        ));
        return $req;
    }

    public function getUser($bdd, $id_name)
    {
        $reponse = $bdd->query('SELECT * FROM utilisateurs WHERE id_utilisateur = "' . $id_name . '" ');
        return $reponse;
    }

    public function getAllSubjectForum($bdd)
    {
        $reponse = $bdd->query("SELECT sj.nom_sujet, m.message, sj.id_sujet, u.pseudo,m.date_message FROM sujets_forum as sj 
left join utilisateurs as u 
on sj.id_utilisateur = u.id_utilisateur
left join messages as m
on sj.id_sujet = m.id_sujet
GROUP BY sj.id_sujet
ORDER BY `m`.`date_message` DESC LIMIT 10");
        return $reponse;
    }

    public function getEvent($bdd, $id_evenement)
    {
        $reponse = $bdd->query('SELECT ut.* ,ev.id_evenement, ev.titre_evenement, ev.id_utilisateur,  ev.adresse, ev.code_postal, ev.commune,  ev.date_evenement,DATE(ev.date_poste) as date_poste
    ,ev.description, ce.* FROM evenements as ev left join utilisateurs as ut
    on ev.id_utilisateur= ut.id_utilisateur left join categorie_evenements as ce on ce.id_categorie = ev.id_categorie
    where ev.id_evenement ="' . $id_evenement . '"');
        return $reponse;
    }

    public function isRegistered($bdd, $id_name, $id_evenement)
    {
        $req = $bdd->prepare('SELECT id_utilisateur, id_evenement FROM inscription_evenements WHERE id_utilisateur = "'.$id_name.'" AND id_evenement = "'.$id_evenement.'"');

        return $req;
    }

    public function isFavorite($bdd, $id_evenement, $id_name)
    {
        $reponse = $bdd->prepare('SELECT id_utilisateur, id_evenement FROM favoris where id_utilisateur = "'.$id_name.'" AND id_evenement = "'.$id_evenement.'"');

        return $reponse;
    }

    public function getSubjectById($bdd, $id_sujet)
    {
        $req = $bdd->query('SELECT nom_sujet FROM sujets_forum  WHERE id_sujet ="' . $id_sujet . '" ');
        return $req;
    }

    public function getMessageBySubject($bdd, $id_sujet)
    {
        $reponse = $bdd->query('SELECT m.id_utilisateur, m.message, sf.nom_sujet, u.pseudo,m.date_message FROM sujets_forum as sf join messages as m on sf.id_sujet = m.id_sujet
left join utilisateurs as u on m.id_utilisateur = u.id_utilisateur WHERE m.id_sujet ="' . $id_sujet . '" ');
        return $reponse;
    }

    public function getAllEvent($bdd)
    {
        $reponse = $bdd->query('SELECT ut.* ,ev.id_evenement, ev.titre_evenement, ev.id_utilisateur,  ev.adresse, ev.code_postal, ev.commune,  ev.date_evenement,DATE(ev.date_poste) as date_poste
 ,ev.description, ce.* FROM evenements as ev left join utilisateurs as ut  
        on ev.id_utilisateur= ut.id_utilisateur left join categorie_evenements as ce on ce.id_categorie = ev.id_categorie 
        where DATE(ev.date_evenement) >= DATE(now()) order by DATE(ev.date_evenement) ASC');
        return $reponse;
    }

    public function getUserPicture($bdd, $id_name)
    {
        $req = $bdd->query('SELECT * FROM photo_utilisateurs where id_utilisateur= "' . $id_name . '" LIMIT 1');
        return $req;
    }

    public function deleteUserPicture($bdd, $id_name){
        $req = $bdd->query('DELETE FROM photo_utilisateurs WHERE id_utilisateur ="' . $id_name. '"');
        return $req;
    }

    public function getBestUser($bdd)
    {
        $req = $bdd->query('SELECT u.*, pu.url
    FROM utilisateurs as u
    LEFT JOIN photo_utilisateurs as pu
    ON u.id_utilisateur = pu.id_utilisateur
    GROUP BY u.id_utilisateur
    ORDER by u.karma DESC LIMIT 3');
        return $req;
    }

    public function getEventByUser($bdd, $id_name)
    {
        $sql = $bdd->query('SELECT ut.* , ev.*, ce.* FROM evenements as ev left join utilisateurs as ut 
        on ev.id_utilisateur= ut.id_utilisateur 
        left join categorie_evenements as ce on ce.id_categorie = ev.id_categorie where ut.id_utilisateur = "' . $id_name . '"');
        return $sql;

    }

    public function getEventRegistered($bdd, $id_name)
    {
        $sql = $bdd->query('SELECT ie.* , e.*, u.*, ce.* FROM inscription_evenements as ie left join evenements as e on ie.id_evenement = e.id_evenement 
    LEFT join utilisateurs as u on e.id_utilisateur = u.id_utilisateur 
    left join categorie_evenements as ce on ce.id_categorie = e.id_categorie 
    where ie.id_utilisateur ="' . $id_name . '"');
        return $sql;
    }

    public function getEventPassed($bdd, $id_name)
    {
        $sql = $bdd->query('SELECT ie.* , e.*, u.*, ce.* FROM inscription_evenements as ie 
left join evenements as e on ie.id_evenement = e.id_evenement 
LEFT join utilisateurs as u on e.id_utilisateur = u.id_utilisateur 
left join categorie_evenements as ce on ce.id_categorie = e.id_categorie 
where ie.id_utilisateur ="' . $id_name . '" AND e.date_evenement < now()');
        return $sql;
    }

    public function isNoted($bdd, $id_evenement)
    {
        $req = $bdd->query('SELECT id_karma, id_evenement FROM karma WHERE id_evenement = "' . $id_evenement . '"');
        return $req;
    }

    public function deleteUserProfil($bdd, $id_name)
    {
        $req = $bdd->query('DELETE FROM photo_utilisateurs WHERE id_utilisateur ="' . $id_name . '"');
        return $req;
    }

    public function addNewUserPicture($bdd, $id_name, $photo)
    {
        $req = $bdd->prepare('INSERT INTO photo_utilisateurs(id_utilisateur, url) VALUES(:id_utilisateur, :url)');
        $req->execute(array(
            'id_utilisateur' => $id_name,
            'url' => $photo,

        ));
        return $req;
    }

    public function addNewMessage($bdd, $date, $id_name, $message, $id_sujet)
    {
        $req = $bdd->prepare("INSERT INTO messages(id_utilisateur, message, id_sujet, date_message) VALUES(:id_utilisateur, :message, :id_sujet, :date_message)");
        $req->execute(array(
            'date_message' => $date,
            'id_utilisateur' => $id_name,
            'message' => $message,
            'id_sujet' => $id_sujet,
        ));
        return $req;
    }

    public function getPseudo($bdd, $pseudo)
    {
        $sql = $bdd->query('SELECT * FROM utilisateurs WHERE pseudo ="' . $pseudo . '"');
        return $sql;
    }

    public function getMail($bdd, $mail)
    {
        $req = $bdd->query('SELECT * FROM utilisateurs WHERE mail ="' . $mail . '"');
        return $req;
    }

    public function getEventForUpdate($bdd, $id_evenement)
    {
        $reponse = $bdd->query('SELECT * FROM evenements as e join categorie_evenements as ce 
on e.id_categorie = ce.id_categorie where e.id_evenement = "' . $id_evenement . '"');
        return $reponse;
    }

    public function updateEvent($bdd, $description, $date, $titre, $adresse, $commune, $code_postal, $categorie, $id_evenement)
    {
        $req = $bdd->prepare('UPDATE evenements SET description = :description, date_evenement = :date_evenement
, titre_evenement = :titre_evenement, adresse = :adresse, commune = :commune, code_postal = :code_postal, id_categorie = :categorie WHERE id_evenement = "' . $id_evenement . '"');
        $req->execute(array(
            'description' => $description,
            'date_evenement' => $date,
            'titre_evenement' => $titre,
            'adresse' => $adresse,
            'commune' => $commune,
            'code_postal' => $code_postal,
            'categorie' => $categorie,
        ));
        return $req;
    }
}

