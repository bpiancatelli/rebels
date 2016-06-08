<?php

class Cotisation_model extends CI_Model{

	private $idCoti;
	private $idMembre;
	private $cotiPaye;
	private $cotiTotal;

	public function __construct($idCoti ='', $idMembre ='', $cotiPaye ='', $cotiTotal =''){
		parent::__construct();
		$this->idCoti = $idCoti;
		$this->idMembre = $idMembre;
		$this->cotiPaye = $cotiPaye;
		$this->cotiTotal = $cotiTotal;

	}



    /**
     * Gets the value of idCoti.
     *
     * @return mixed
     */
    public function getIdCoti()
    {
        return $this->idCoti;
    }

    /**
     * Sets the value of idCoti.
     *
     * @param mixed $idCoti the id coti
     *
     * @return self
     */
    public function setIdCoti($idCoti)
    {
        $this->idCoti = $idCoti;

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
     * Gets the value of cotiPaye.
     *
     * @return mixed
     */
    public function getCotiPaye()
    {
        return $this->cotiPaye;
    }

    /**
     * Sets the value of cotiPaye.
     *
     * @param mixed $cotiPaye the coti paye
     *
     * @return self
     */
    public function setCotiPaye($cotiPaye)
    {
        $this->cotiPaye = $cotiPaye;

        return $this;
    }

    /**
     * Gets the value of cotiTotal.
     *
     * @return mixed
     */
    public function getCotiTotal()
    {
        return $this->cotiTotal;
    }

    /**
     * Sets the value of cotiTotal.
     *
     * @param mixed $cotiTotal the coti total
     *
     * @return self
     */
    public function setCotiTotal($cotiTotal)
    {
        $this->cotiTotal = $cotiTotal;

        return $this;
    }
}