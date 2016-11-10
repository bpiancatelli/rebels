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
			$liste = new Membre_model($row['id_membre'],$row['nom'],$row['prenom'],$row['email'], $row['licence'], $row['login'],$row['password'],$row['date_inscription'],$row['derniere_connexion'],$row['is_actif'],$row['is_administrateur']);
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
		$query = $this->db->get_where('membre',array('is_actif'=>true));

		$liste = null;
		if($query->num_rows() > 0){
			
			foreach($query->result() as $row){
				$liste[$row->id_membre] = new Membre_model($row->id_membre,$row->nom,$row->prenom,$row->email,$row->licence,$row->login,$row->password,$row->date_inscription,$row->derniere_connexion,$row->is_actif,$row->is_administrateur);
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
				$liste[$row->id_membre] = new Membre_model($row->id_membre,$row->nom,$row->prenom,$row->email,$row->licence,$row->login,$row->password,$row->date_inscription,$row->derniere_connexion,$row->is_actif,$row->is_administrateur);
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
		$this->db->update('membre', $data); 
	}

	public function updateDerniereConnexion($idMembre){
		$this->load->helper('date');
		$today = date('Y-m-d',now());

		$data = array(
               'derniere_connexion' => $today
            );

		$this->db->where('id_membre', $idMembre);
		$this->db->update('membre', $data); 
	}

	public function activeMembre($idMembre){
		$data = array(
				'is_actif' => true
			);
		$this->db->where('id_membre',$idMembre);
		$this->db->update('membre',$data);
	}

	public function deactiveMembre($idMembre){
		$data = array(
				'is_actif' => false
			);
		$this->db->where('id_membre',$idMembre);
		$this->db->update('membre',$data);
	}

	public function activeAdmin($idMembre){
		$data = array(
				'is_administrateur' => true
			);
		$this->db->where('id_membre',$idMembre);
		$this->db->update('membre',$data);
	}

	public function deactiveAdmin($idMembre){
		$data = array(
				'is_administrateur' => false
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
													'is_actif'=>true,
													'is_administrateur'=>false
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
		
		$idMembre = $query->result()[0]->id_membre;		

		// num_rows = 0 : member does not exists on db -> have to create it
		if ($query->num_rows() == 0) {
			$this->insertMembre($nom, $prenom, '');
		}

		$this->updateLicence($idMembre, $licence);		
	}

	public function updateLicence($id_membre, $licence){
		$data = array(
               'licence' => $licence
        );

		$this->db->where('id_membre', $id_membre);
		$this->db->update('membre', $data); 
	}

}