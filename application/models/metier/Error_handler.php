<?php

class Error_handler extends CI_Model{

    private $id;
	private $code;
	private $message;

    /*
        Possible error code : 
        1292, Message : Incorrect datetime value: '' for column 'date_match' at row 1 
        1048, Message : Column 'is_domicile' cannot be null 
        1062, Message : Duplicate entry '' for key 'reference_UNIQUE' 


    */

	public function hydrate($obj){
        
        $this->setId($obj->id_error_handler);
        $this->setCode($obj->code);
        $this->setMessage($obj->message);

        return $this;
	}

    /**
     * Gets the value of code.
     *
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Sets the value of code.
     *
     * @param mixed $code the code
     *
     * @return self
     */
    public function setCode($code)
    {
        $this->code = $code;

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
     * Gets the value of id.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the value of id.
     *
     * @param mixed $id the id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
