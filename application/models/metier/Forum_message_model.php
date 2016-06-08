<?php

class Forum_message_model extends CI_Model{
	
	private $idForumMessage;
	private $nomMessage;
	private $message;
	private $idForumSujet;
	private $idMembre;
	private $dateCreation;

	public function __construct($idForumMessage ='', $nomMessage ='', $message ='', $idForumSujet ='', $idMembre ='', $dateCreation =''){
		parent::__construct();
		$this->idForumMessage = $idForumMessage;
		$this->nomMessage = $nomMessage;
		$this->message = $message;
		$this->idForumSujet = $idForumSujet;
		$this->idMembre = $idMembre;
		$this->dateCreation = $dateCreation;
	}


    /**
     * Gets the value of idForumMessage.
     *
     * @return mixed
     */
    public function getIdForumMessage()
    {
        return $this->idForumMessage;
    }

    /**
     * Sets the value of idForumMessage.
     *
     * @param mixed $idForumMessage the id forum message
     *
     * @return self
     */
    public function setIdForumMessage($idForumMessage)
    {
        $this->idForumMessage = $idForumMessage;

        return $this;
    }

    /**
     * Gets the value of nomMessage.
     *
     * @return mixed
     */
    public function getNomMessage()
    {
        return $this->nomMessage;
    }

    /**
     * Sets the value of nomMessage.
     *
     * @param mixed $nomMessage the nom message
     *
     * @return self
     */
    public function setNomMessage($nomMessage)
    {
        $this->nomMessage = $nomMessage;

        return $this;
    }

    /**
     * Gets the value of message.
     *
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Sets the value of message.
     *
     * @param mixed $message the message
     *
     * @return self
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
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
}