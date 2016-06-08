<?php

class Forum_sujet_model extends CI_Model{
 
	private $idForumSujet;
	private $nomSujet;
	private $sujet;
	private $idForumThematique;
	private $idMembre;
	private $dateCreation;
	private $reponse;
	private $isLocked;
	private $isImportant;

 	public function __construct($idForumSujet ='', $nomSujet ='', $sujet ='', $idForumThematique ='', $idMembre ='', $dateCreation ='', $reponse ='', $isLocked ='', $isImportant =''){
		parent::__construct();
		$this->idForumSujet = $idForumSujet;
		$this->nomSujet = $nomSujet;
		$this->sujet = $sujet;
		$this->idForumThematique = $idForumThematique;
		$this->idMembre = $idMembre;
		$this->dateCreation = $dateCreation;
		$this->reponse = $reponse;
		$this->isLocked = $isLocked;
		$this->isImportant = $isImportant;
	}


    /**
     * Gets the value of idForumSujet.
     *
     * @return mixed
     */
    public function getIdForumSujet()
    {
        return $this->idForumSujet;
    }

    /**
     * Sets the value of idForumSujet.
     *
     * @param mixed $idForumSujet the id forum sujet
     *
     * @return self
     */
    public function setIdForumSujet($idForumSujet)
    {
        $this->idForumSujet = $idForumSujet;

        return $this;
    }

    /**
     * Gets the value of nomSujet.
     *
     * @return mixed
     */
    public function getNomSujet()
    {
        return $this->nomSujet;
    }

    /**
     * Sets the value of nomSujet.
     *
     * @param mixed $nomSujet the nom sujet
     *
     * @return self
     */
    public function setNomSujet($nomSujet)
    {
        $this->nomSujet = $nomSujet;

        return $this;
    }

    /**
     * Gets the value of sujet.
     *
     * @return mixed
     */
    public function getSujet()
    {
        return $this->sujet;
    }

    /**
     * Sets the value of sujet.
     *
     * @param mixed $sujet the sujet
     *
     * @return self
     */
    public function setSujet($sujet)
    {
        $this->sujet = $sujet;

        return $this;
    }

    /**
     * Gets the value of idForumThematique.
     *
     * @return mixed
     */
    public function getIdForumThematique()
    {
        return $this->idForumThematique;
    }

    /**
     * Sets the value of idForumThematique.
     *
     * @param mixed $idForumThematique the id forum thematique
     *
     * @return self
     */
    public function setIdForumThematique($idForumThematique)
    {
        $this->idForumThematique = $idForumThematique;

        return $this;
    }

    /**
     * Gets the value of idMembre.
     *
     * @return mixed
     */
    public function getIdMembre()
    {
        return $this->idMembre;
    }

    /**
     * Sets the value of idMembre.
     *
     * @param mixed $idMembre the id membre
     *
     * @return self
     */
    public function setIdMembre($idMembre)
    {
        $this->idMembre = $idMembre;

        return $this;
    }

    /**
     * Gets the value of dateCreation.
     *
     * @return mixed
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Sets the value of dateCreation.
     *
     * @param mixed $dateCreation the date creation
     *
     * @return self
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Gets the value of reponse.
     *
     * @return mixed
     */
    public function getReponse()
    {
        return $this->reponse;
    }

    /**
     * Sets the value of reponse.
     *
     * @param mixed $reponse the reponse
     *
     * @return self
     */
    public function setReponse($reponse)
    {
        $this->reponse = $reponse;

        return $this;
    }

    /**
     * Gets the value of isLocked.
     *
     * @return mixed
     */
    public function getIsLocked()
    {
        return $this->isLocked;
    }

    /**
     * Sets the value of isLocked.
     *
     * @param mixed $isLocked the is locked
     *
     * @return self
     */
    public function setIsLocked($isLocked)
    {
        $this->isLocked = $isLocked;

        return $this;
    }

    /**
     * Gets the value of isImportant.
     *
     * @return mixed
     */
    public function getIsImportant()
    {
        return $this->isImportant;
    }

    /**
     * Sets the value of isImportant.
     *
     * @param mixed $isImportant the is important
     *
     * @return self
     */
    public function setIsImportant($isImportant)
    {
        $this->isImportant = $isImportant;

        return $this;
    }
}