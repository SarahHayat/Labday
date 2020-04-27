<?php
class Account
{
    private $_prenom;
    private $_nom;
    private $_date_de_naissance;
    private $_adresse;
    private $_code_postal;
    private $_pays;
    private $_telephone;
    private $_mail;
    private $_pseudo;
    private $_mot_de_passe;


    public function __construct($_monPrenom, $_monNom, $_maDateDeNaissance, $_monAdresse, $_monCodePostal, $_monPays, $_monTelephone, $_monMail, $_monPseudo, $_monMotDePasse)
    {
        $this->_prenom = $_monPrenom;
        $this->_nom = $_monNom;
        $this->_date_de_naissance = $_maDateDeNaissance;
        $this->_adresse = $_monAdresse;
        $this->_code_postal = $_monCodePostal;
        $this->_pays = $_monPays;
        $this->_telephone = $_monTelephone;
        $this->_mail = $_monMail;
        $this->_pseudo = $_monPseudo;
        $this->_mot_de_passe = $_monMotDePasse;

    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->_prenom;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->_nom;
    }

    /**
     * @return mixed
     */
    public function getDateDeNaissance()
    {
        return $this->_date_de_naissance;
    }

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->_adresse;
    }

    /**
     * @return mixed
     */
    public function getCodePostal()
    {
        return $this->_code_postal;
    }

    /**
     * @return mixed
     */
    public function getPays()
    {
        return $this->_pays;
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->_telephone;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->_mail;
    }

    /**
     * @return mixed
     */
    public function getPseudo()
    {
        return $this->_pseudo;
    }

    /**
     * @return mixed
     */
    public function getMotDePasse()
    {
        return $this->_mot_de_passe;
    }


}

?>