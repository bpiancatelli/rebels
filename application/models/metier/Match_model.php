<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Match_model extends CI_Model{

	private $idMatch;
	private $idDivision;
	private $idAdversaire;
	private $dateMatch;
	private $reference;
	private $isDomicile;
    private $scoreHome;
    private $scoreAway;

	public function __construct($idMatch='', $reference='',  $dateMatch='', $idAdversaire='',$idDivision='', $isDomicile='',$scoreHome='',$scoreAway=''){
		parent::__construct();
		$this->idMatch = $idMatch;
        $this->reference = $reference;
        $this->dateMatch = $dateMatch;
        $this->idAdversaire = $idAdversaire;
        $this->idDivision = $idDivision;
		$this->isDomicile = $isDomicile;				
        $this->scoreHome = $scoreHome;
        $this->scoreAway = $scoreAway;

	}

    public function hydrate($obj){
        $this->setIdMatch($obj->id_match);
        $this->setIdDivision($obj->id_division);
        $this->setIdAdversaire($obj->id_adversaire);
        $this->setDateMatch($obj->date_match);
        $this->setReference($obj->reference);
        $this->setIsDomicile($obj->is_domicile);
        $this->setScoreHome($obj->score_home);
        $this->setScoreAway($obj->score_away);
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
     * Gets the value of idDivision.
     *
     * @return mixed
     */
    public function getIdDivision()
    {
        return $this->idDivision;
    }

    /**
     * Sets the value of idDivision.
     *
     * @param mixed $idDivision the id division
     *
     * @return self
     */
    public function setIdDivision($idDivision)
    {
        $this->idDivision = $idDivision;

        return $this;
    }

    /**
     * Gets the value of idAdversaire.
     *
     * @return mixed
     */
    public function getIdAdversaire()
    {
        return $this->idAdversaire;
    }

    /**
     * Sets the value of idAdversaire.
     *
     * @param mixed $idAdversaire the id adversaire
     *
     * @return self
     */
    public function setIdAdversaire($idAdversaire)
    {
        $this->idAdversaire = $idAdversaire;

        return $this;
    }

    /**
     * Gets the value of dateMatch.
     *
     * @return mixed
     */
    public function getDateMatch()
    {
        return $this->dateMatch;
    }

    /**
     * Sets the value of dateMatch.
     *
     * @param mixed $dateMatch the date match
     *
     * @return self
     */
    public function setDateMatch($dateMatch)
    {
        $this->dateMatch = $dateMatch;

        return $this;
    }

    /**
     * Gets the value of reference.
     *
     * @return mixed
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Sets the value of reference.
     *
     * @param mixed $reference the reference
     *
     * @return self
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Gets the value of isDomicile.
     *
     * @return mixed
     */
    public function getIsDomicile()
    {
        return $this->isDomicile;
    }

    /**
     * Sets the value of isDomicile.
     *
     * @param mixed $isDomicile the is domicile
     *
     * @return self
     */
    public function setIsDomicile($isDomicile)
    {
        $this->isDomicile = $isDomicile;

        return $this;
    }

    /**
     * Gets the value of scoreHome.
     *
     * @return mixed
     */
    public function getScoreHome()
    {
        return $this->scoreHome;
    }

    /**
     * Sets the value of scoreHome.
     *
     * @param mixed $scoreHome the score home
     *
     * @return self
     */
    public function setScoreHome($scoreHome)
    {
        $this->scoreHome = $scoreHome;

        return $this;
    }

    /**
     * Gets the value of scoreAway.
     *
     * @return mixed
     */
    public function getScoreAway()
    {
        return $this->scoreAway;
    }

    /**
     * Sets the value of scoreAway.
     *
     * @param mixed $scoreAway the score away
     *
     * @return self
     */
    public function setScoreAway($scoreAway)
    {
        $this->scoreAway = $scoreAway;

        return $this;
    }
}