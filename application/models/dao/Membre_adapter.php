<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Membre_adapter extends CI_Model{

	public function __construct(){
		parent::__construct();		
		$this->load->database();
		$this->load->model('metier/membre_model');
	}	


	/**
	*
	* Login 
	*
	*/
	public function getMembreByCredentials($login, $pass){
		return $this->db->get_where('membre', array('login'=>$login,'password'=>$pass));
	}

	public function getMembreById($idMembre){
		$query = $this->db->get_where('membre',array('id_membre'=>$idMembre));

		$liste = null;
		if($query->num_rows() == 1){
			$row = $query->row_array();
			$mm = new Membre_model();
			$liste = $mm->hydrate($query->result()[0]);
		}

		return $liste;
	}

	public function getEmails(){
		$this->db->select('email');
		$this->db->from('membre');
		$this->db->where('email <>',null);
		$this->db->where('email <>','');
		$this->db->where('is_actif',1);
		$query = $this->db->get();

		$liste = null;
		if($query->num_rows() > 0){
			$i = 0;			
			foreach($query->result() as $row){
				$liste[$i] = $row->email;
				$i++;
			}
		}

		return $liste;

	}

	public function getAllActiveMembre(){
		//$query = $this->db->get_where('membre',array('is_actif'=>true));
		$query = $this->db->get_where('membre',array('is_actif'=>1));

		$liste = null;
		if($query->num_rows() > 0){
			
			foreach($query->result() as $row){
				$mm = new Membre_model();
				$liste[$row->id_membre] = $mm->hydrate($row);
			}
		}

		return $liste;
	}
	

	public function getAllMembre(){
		$query = $this->db->get('membre');

		$liste = null;
		if($query->num_rows() > 0){
			$liste = null;
			foreach($query->result() as $row){
				$mm = new Membre_model();
				$liste[$row->id_membre] = $mm->hydrate($row);
			}
		}


		return $liste;
	}

	public function updateEmail($id_membre,$email){
		
		$data = array(
               'email' => $email
            );

		$this->db->where('id_membre', $id_membre);
		$this->db->update('membre', $data); 
	}

	public function updatePassword($id_membre,$password){
		$data = array(
               'password' => $password
            );

		$this->db->where('id_membre', $id_membre);
		$result = $this->db->update('membre', $data);					
			
		if (!$result) {				
			return $this->db->error();
		}	

	}

	public function updateDerniereConnexion($idMembre){
		$this->load->helper('date');
		$today = date('Y-m-d h:i:s',now());

		$data = array(
               'derniere_connexion' => $today
            );

		$this->db->where('id_membre', $idMembre);
		$this->db->update('membre', $data); 
	}

	public function activeMembre($idMembre){
		$data = array(
				//'is_actif' =>true
				'is_actif' => 1
			);
		$this->db->where('id_membre',$idMembre);
		$this->db->update('membre',$data);
	}

	public function deactiveMembre($idMembre){
		$data = array(
				//'is_actif' =>false
				'is_actif' => 0
			);
		$this->db->where('id_membre',$idMembre);
		$this->db->update('membre',$data);
	}

	public function activeAdmin($idMembre){
		$data = array(
				//'is_administrateur' =>true
				'is_administrateur' => 1
			);
		$this->db->where('id_membre',$idMembre);
		$this->db->update('membre',$data);
	}

	public function deactiveAdmin($idMembre){
		$data = array(
				//'is_administrateur' =>false
				'is_administrateur' => 0
			);
		$this->db->where('id_membre',$idMembre);
		$this->db->update('membre',$data);
	}

	

	public function insertMembre($nom,$prenom,$email){
		$this->load->helper('date');
		$today = date('Y-m-d',now());

		$login = strtolower(substr($prenom,0,1).strtolower($nom));
		$login = preg_replace('/ /','',$login);
		$password = md5($login);


		try {
			$this->db->insert('membre',array('nom'=>$nom,
													'prenom'=>$prenom,
													'email'=>$email,
													'login'=>$login,
													'password'=>$password,
													'date_inscription'=>$today,
													'derniere_connexion'=>$today,
													'is_actif'=>1,
													'is_administrateur'=>0
													)
			);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function isExistingMember($nom, $prenom, $licence){
		
		$query = $this->db->select('*')
			->from('membre')
			->where(array('nom'=>$nom,'prenom'=>$prenom))
			->get();
		
		if ($query->num_rows() > 0) {
			$idMembre = $query->result()[0]->id_membre;
			$this->updateLicence($idMembre, $licence);		
		}		

		// num_rows = 0 : member does not exists on db -> have to create it
		if ($query->num_rows() == 0) {
			$this->insertMembre($nom, $prenom, '');
		}		
	}

	public function updateLicence($id_membre, $licence){
		$data = array(
               'licence' => $licence
        );

		$this->db->where('id_membre', $id_membre);
		$this->db->update('membre', $data); 
	}

}