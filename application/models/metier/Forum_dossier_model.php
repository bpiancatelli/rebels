<?php

class Forum_dossier_model extends CI_Model{

	private $idForumDossier;
	private $nomDossier;

	public function __construct($idForumDossier = '', $nomDossier = ''){
		parent::__construct();
		$this->idForumDossier = $idForumDossier;;
		$this->nomDossier = $nomDossier;;
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
     * Gets the value of nomDossier.
     *
     * @return mixed
     */
    public function getNomDossier()
    {
        return $this->nomDossier;
    }

    /**
     * Sets the value of nomDossier.
     *
     * @param mixed $nomDossier the nom dossier
     *
     * @return self
     */
    public function setNomDossier($nomDossier)
    {
        $this->nomDossier = $nomDossier;

        return $this;
    }
}