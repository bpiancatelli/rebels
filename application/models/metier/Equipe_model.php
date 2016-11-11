<?php 

class Equipe_model extends CI_Model{

	private $idEquipe;
	private $nomLong;
	private $nomCourt;
	private $logo;
	private $isActive;
    private $adresse;
    private $adresseNumero;
    private $codePostal;
    private $ville;



	public function __construct($id_equipe='',$nom_long='',$nom_court='',$logo='',$active='', $adresse = '', $adresseNumero = '', $codePostal = '', $ville = ''){
		parent::__construct();
		$this->idEquipe = $id_equipe;
		$this->nomLong = $nom_long;
		$this->nomCourt = $nom_court;
		$this->logo = $logo;
		$this->isActive = $active;
        $this->adresse = $adresse;;
        $this->adresseNumero = $adresseNumero;;
        $this->codePostal = $codePostal;;
        $this->ville = $ville;;

	}

    public function hydrate($obj){
           
        $this->setIdEquipe($obj->id_equipe);
        $this->setNomLong($obj->nom_long);
        $this->setNomCourt($obj->nom_court);
        $this->setLogo($obj->logo);
        $this->setAdresse($obj->adresse);
        $this->setAdresseNumero($obj->adresse_numero);
        $this->setCodePostal($obj->code_postal);
        $this->setVille($obj->ville);

        return $this;

    }


    /**
     * Gets the value of idEquipe.
     *
     * @return mixed
     */
    public function getIdEquipe()
    {
        return $this->idEquipe;
    }

    /**
     * Sets the value of idEquipe.
     *
     * @param mixed $idEquipe the id equipe
     *
     * @return self
     */
    public function setIdEquipe($idEquipe)
    {
        $this->idEquipe = $idEquipe;

        return $this;
    }

    /**
     * Gets the value of nomLong.
     *
     * @return mixed
     */
    public function getNomLong()
    {
        return $this->nomLong;
    }

    /**
     * Sets the value of nomLong.
     *
     * @param mixed $nomLong the nom long
     *
     * @return self
     */
    public function setNomLong($nomLong)
    {
        $this->nomLong = $nomLong;

        return $this;
    }

    /**
     * Gets the value of nomCourt.
     *
     * @return mixed
     */
    public function getNomCourt()
    {
        return $this->nomCourt;
    }

    /**
     * Sets the value of nomCourt.
     *
     * @param mixed $nomCourt the nom court
     *
     * @return self
     */
    public function setNomCourt($nomCourt)
    {
        $this->nomCourt = $nomCourt;

        return $this;
    }

    /**
     * Gets the value of logo.
     *
     * @return mixed
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Sets the value of logo.
     *
     * @param mixed $logo the logo
     *
     * @return self
     */

    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Gets the value of isActive.
     *
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Sets the value of isActive.
     *
     * @param mixed $isActive the is active
     *
     * @return self
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Gets the value of adresse.
     *
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    public function setAdresse($adresse){
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Gets the value of adresseNumero.
     *
     * @return mixed
     */
    public function getAdresseNumero()
    {
        return $this->adresseNumero;
    }

    public function setAdresseNumero($adresseNumero){
        $this->adresseNumero = $adresseNumero;

        return $this;
    }

    /**
     * Gets the value of codePostal.
     *
     * @return mixed
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    public function setCodePostal($codePostal){
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Gets the value of ville.
     *
     * @return mixed
     */
    public function getVille()
    {
        return $this->ville;
    }

    public function setVille($ville){
        $this->ville = $ville;
        return $this;
    }


}