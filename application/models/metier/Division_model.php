<?php

class Division_model extends CI_Model{

	private $idDivision;
	private $nom;

	public function __construct($id='',$nom=''){
		parent::__construct();
		$this->idDivision = $id;
		$this->nom = $nom;
	}

    /**
     * Gets the value of id.
     *
     * @return mixed
     */
    public function getIdDivision()
    {
        return $this->idDivision;
    }

    /**
     * Sets the value of id.
     *
     * @param mixed $id the id
     *
     * @return self
     */
    public function setIdDivision($id)
    {
        $this->id = $idDivision;

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
}