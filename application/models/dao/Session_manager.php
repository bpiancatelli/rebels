<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Session_manager extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->model('metier/membre_model');

		 if(!isset($_SESSION)){          
            //session_start();
        }
	}

	public function close(){
     
        session_destroy(); //ferme la session
        unset($_SESSION); //supprime la session

    }

    public function saveMembre(Membre_model $m){//si on lui passe un utilisateur, on génere tout ce qu'il faut faire pour que cet utilisateur soit maintenu en session dans la base de donnée en faisant attention a l'adresse ip, et au fait qu'il génère une nouvelle session et pas sur base d'une ancienne
        session_regenerate_id();                                          //évite de repartir avec un vieil identifiant de session
        
        $_SESSION["membre"]=$m;                                 //stockage de l'utilisateur
        //$_SESSION["administrateur"]["IP"] = $_SERVER["REMOTE_ADDR"];    //stockage de l'adresse ip
    }

    public function verifMembre(){
        return isset($_SESSION["membre"]) && is_a($_SESSION["membre"], "Mmembre");//&& $_SERVER["REMOTE_ADDR"] == $_SESSION["IP"];
        //le Administrateur de (is_a($_SESSION["administrateur"], "Administrateur") fait référence à la classe Administrateur
    }

    public function getMembre(){
    
        $retVal = null;
        
        if($this->verifMembre()){
            $retVal = $_SESSION["membre"];
        }else{
            $retVal = new Membre_model(0, "Anonymous", null, null);
        }

        return $retVal;
    }

    public function generate_token(){
        $_SESSION["token"]= uniqid(); //génère id unique
        $_SESSION["token_time"]=new DateTime(); //le moment où le token a été créé
        return $_SESSION["token"];
    }
    
    public function validateAction($t){
        $valide = $t==$_SESSION["token"];
        //TODO valider si l'écart de temps est inférieur à 1 minute
        unset($_SESSION["token"]);
        unset($_SESSION["token_time"]);
    }

}