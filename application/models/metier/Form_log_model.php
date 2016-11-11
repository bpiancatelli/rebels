<?php

class Form_log_model extends CI_Model{

	private $idFormLog;
	private $idFormFamille;
	private $idFormType;
	private $parametres;
	private $membre;
	private $dateRecord;
    private $idMembre;

	public function __construct($idFormLog='', $idFormFamille='', $idFormType='', $parametres='', $membre='', $idMembre='', $dateRecord=''){
		parent::__construct();

		$this->idFormLog = $idFormLog;;
		$this->idFormFamille = $idFormFamille;;
		$this->idFormType = $idFormType;;
		$this->parametres = $parametres;;
		$this->membre = $membre;;
		$this->dateRecord = $dateRecord;
        $this->idMembre = $idMembre;

	}

    public function hydrate($obj){
        $this->setIdFormLog($obj->id_form_log);
        $this->setIdFormFamille($obj->id_form_famille);
        $this->setIdFormType($obj->id_form_type);
        $this->setParametres($obj->parametres);
        $this->setMembre($obj->membre);
        $this->setDateRecord($obj->date_record);
        $this->setIdMembre($obj->id_membre);

        return $this;
    }

    /**
     * Gets the value of idFormLog.
     *
     * @return mixed
     */
    public function getIdFormLog()
    {
        return $this->idFormLog;
    }

    /**
     * Sets the value of idFormLog.
     *
     * @param mixed $idFormLog the id form log
     *
     * @return self
     */
    public function setIdFormLog($idFormLog)
    {
        $this->idFormLog = $idFormLog;

        return $this;
    }

    /**
     * Gets the value of idFormFamille.
     *
     * @return mixed
     */
    public function getIdFormFamille()
    {
        return $this->idFormFamille;
    }

    /**
     * Sets the value of idFormFamille.
     *
     * @param mixed $idFormFamille the id form famille
     *
     * @return self
     */
    public function setIdFormFamille($idFormFamille)
    {
        $this->idFormFamille = $idFormFamille;

        return $this;
    }

    /**
     * Gets the value of idFormType.
     *
     * @return mixed
     */
    public function getIdFormType()
    {
        return $this->idFormType;
    }

    /**
     * Sets the value of idFormType.
     *
     * @param mixed $idFormType the id form type
     *
     * @return self
     */
    public function setIdFormType($idFormType)
    {
        $this->idFormType = $idFormType;

        return $this;
    }

    /**
     * Gets the value of parametres.
     *
     * @return mixed
     */
    public function getParametres()
    {
        return $this->parametres;
    }

    /**
     * Sets the value of parametres.
     *
     * @param mixed $parametres the parametres
     *
     * @return self
     */
    public function setParametres($parametres)
    {
        $this->parametres = $parametres;

        return $this;
    }

    /**
     * Gets the value of membre.
     *
     * @return mixed
     */
    public function getMembre()
    {
        return $this->membre;
    }

    /**
     * Sets the value of membre.
     *
     * @param mixed $membre the membre
     *
     * @return self
     */
    public function setMembre($membre)
    {
        $this->membre = $membre;

        return $this;
    }

    /**
     * Gets the value of dateRecord.
     *
     * @return mixed
     */
    public function getDateRecord()
    {
        return $this->dateRecord;
    }

    /**
     * Sets the value of dateRecord.
     *
     * @param mixed $dateRecord the date record
     *
     * @return self
     */
    public function setDateRecord($dateRecord)
    {
        $this->dateRecord = $dateRecord;

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
}


