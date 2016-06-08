<?php

class Forum_thematique_model extends CI_Model{

	private $idForumThematique;
	private $nomThematique;
	private $idForumDossier;
	private $sujet;
	private $reponse;
	private $isLocked;

	public function __construct($idForumThematique = '', $nomThematique = '', $idForumDossier = '',	$sujet = '', $reponse = '', $isLocked = ''){
		parent::__construct();
		$this->idForumThematique = $idForumThematique;
		$this->nomThematique = $nomThematique;
		$this->idForumDossier = $idForumDossier;
		$this->sujet = $sujet;
		$this->reponse = $reponse;
		$this->isLocked = $isLocked;
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
     * Gets the value of nomThematique.
     *
     * @return mixed
     */
    public function getNomThematique()
    {
        return $this->nomThematique;
    }

    /**
     * Sets the value of nomThematique.
     *
     * @param mixed $nomThematique the nom thematique
     *
     * @return self
     */
    public function setNomThematique($nomThematique)
    {
        $this->nomThematique = $nomThematique;

        return $this;
    }

    /**
     * Gets the value of idForumDossier.
     *
     * @return mixed
     */
    public function getIdForumDossier()
    {
        return $this->idForumDossier;
    }

    /**
     * Sets the value of idForumDossier.
     *
     * @param mixed $idForumDossier the id forum dossier
     *
     * @return self
     */
    public function setIdForumDossier($idForumDossier)
    {
        $this->idForumDossier = $idForumDossier;

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
}