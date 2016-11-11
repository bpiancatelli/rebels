<?php

class Drivertool_model extends CI_Model{

	private $idDriverTool;
	private $idMatch;
	private $idMembre;
	private $tookHisCar;
    private $travelCost;

	public function __construct($idDriverTool ='', $idMatch ='', $idMembre ='', $tookHisCar ='',$travelCost=''){
		parent::__construct();
		$this->idDriverTool = $idDriverTool;
		$this->idMatch = $idMatch;
		$this->idMembre = $idMembre;
		$this->tookHisCar = $tookHisCar;
        $this->travelCost = $travelCost;
	}

    public function hydrate($obj){
    
        $this->setIdDriverTool($obj->id_driver_tool);
        $this->setIdMatch($obj->id_match);
        $this->setIdMembre($obj->id_membre);
        $this->setTookHisCar($obj->tookhiscar);
        $this->setTravelCost($obj->travelcost);

        return $this;
    }

    /**
     * Gets the value of idDriverTool.
     *
     * @return mixed
     */
    public function getIdDriverTool()
    {
        return $this->idDriverTool;
    }

    /**
     * Sets the value of idDriverTool.
     *
     * @param mixed $idDriverTool the id driver tool
     *
     * @return self
     */
    public function setIdDriverTool($idDriverTool)
    {
        $this->idDriverTool = $idDriverTool;

        return $this;
    }

    /**
     * Gets the value of idMatch.
     *
     * @return mixed
     */
    public function getIdMatch()
    {
        return $this->idMatch;
    }

    /**
     * Sets the value of idMatch.
     *
     * @param mixed $idMatch the id match
     *
     * @return self
     */
    public function setIdMatch($idMatch)
    {
        $this->idMatch = $idMatch;

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
     * Gets the value of tookHisCar.
     *
     * @return mixed
     */
    public function getTookHisCar()
    {
        return $this->tookHisCar;
    }

    /**
     * Sets the value of tookHisCar.
     *
     * @param mixed $tookHisCar the took his car
     *
     * @return self
     */
    public function setTookHisCar($tookHisCar)
    {
        $this->tookHisCar = $tookHisCar;

        return $this;
    }

    /**
     * Gets the value of travelCost.
     *
     * @return mixed
     */
    public function getTravelCost()
    {
        return $this->travelCost;
    }


    /**
     * Sets the value of travelCost.
     *
     * @param mixed $travelCost
     *
     * @return self
     */
    public function setTravelCost($travelCost)
    {
        $this->travelCost = $travelCost;

        return $this;
    }

}