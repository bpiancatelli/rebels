<?php

class Membre_model extends CI_Model{

	private $idMembre;
	private $nom;
	private $prenom;
	private $email;
    private $licence;
	private $login;
    private $password;
	private $dateInscription;
	private $derniereConnexion;
	private $isActif;
	private $isAdministrateur;

	public function __construct($id_membre='',$nom='',$prenom='',$email='',$licence='',$login='',$password='', $date_inscription='',$derniere_connexion='',$isActif='',$isAdministrateur=''){
		parent::__construct();
		$this->idMembre = $id_membre;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->licence = $licence;
        $this->login = $login;        
        $this->password = $password;
        $this->dateInscription = $date_inscription;
        $this->derniereConnexion = $derniere_connexion;
        $this->isActif = $isActif;
        $this->isAdministrateur = $isAdministrateur;
	}

    /**
     * Gets the value of id_membre.
     *
     * @return mixed
     */
    public function getIdMembre()
    {
        return $this->idMembre;
    }

    /**
     * Sets the value of id_membre.
     *
     * @param mixed $id_membre the id_membre
     *
     * @return self
     */
    public function setIdMembre($id_membre)
    {
        $this->idMembre = $id_membre;

        return $this;
    }

    /**
     * Gets the value of nom.
     *
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Sets the value of nom.
     *
     * @param mixed $nom the nom
     *
     * @return self
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Gets the value of prenom.
     *
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Sets the value of prenom.
     *
     * @param mixed $prenom the prenom
     *
     * @return self
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Gets the value of email.
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the value of email.
     *
     * @param mixed $email the email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Gets the value of login.
     *
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Sets the value of login.
     *
     * @param mixed $login the login
     *
     * @return self
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Gets the value of isActif.
     *
     * @return mixed
     */
    public function getIsActif()
    {
        return $this->isActif;
    }

    /**
     * Sets the value of isActif.
     *
     * @param mixed $isActif the is actif
     *
     * @return self
     */
    public function setIsActif($isActif)
    {
        $this->isActif = $isActif;

        return $this;
    }

    /**
     * Gets the value of isAdministrateur.
     *
     * @return mixed
     */
    public function getIsAdministrateur()
    {
        return $this->isAdministrateur;
    }

    /**
     * Sets the value of isAdministrateur.
     *
     * @param mixed $isAdministrateur the is administrateur
     *
     * @return self
     */
    public function setIsAdministrateur($isAdministrateur)
    {
        $this->isAdministrateur = $isAdministrateur;

        return $this;
    }



    /**
     * Gets the value of password.
     *
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Sets the value of password.
     *
     * @param mixed $password the password
     *
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Gets the value of dateInscription.
     *
     * @return mixed
     */
    public function getDateInscription()
    {
        return $this->dateInscription;
    }

    /**
     * Sets the value of dateInscription.
     *
     * @param mixed $dateInscription the date inscription
     *
     * @return self
     */
    public function setDateInscription($dateInscription)
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    /**
     * Gets the value of derniereConnexion.
     *
     * @return mixed
     */
    public function getDerniereConnexion()
    {
        return $this->derniereConnexion;
    }

    /**
     * Sets the value of derniereConnexion.
     *
     * @param mixed $derniereConnexion the derniere connexion
     *
     * @return self
     */
    public function setDerniereConnexion($derniereConnexion)
    {
        $this->derniereConnexion = $derniereConnexion;

        return $this;
    }
}
