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
			$liste = new Membre_model($row['id_membre'],$row['nom'],$row['prenom'],$row['email'], $row['licence'], $row['login'],$row['password'],$row['date_inscription'],$row['derniere_connexion'],$row['actif'],$row['administrateur']);
		}

		return $liste;
	}

	public function getEmails(){
		$this->db->select('email');
		$this->db->from('membre');
		$this->db->where('email <>',null);
		$this->db->where('email <>','');
		$this->db->where('actif',1);
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
		$query = $this->db->get_where('membre',array('actif'=>1));

		$liste = null;
		if($query->num_rows() > 0){
			
			foreach($query->result() as $row){
				$liste[$row->id_membre] = new Membre_model($row->id_membre,$row->nom,$row->prenom,$row->email,$row->licence,$row->login,$row->password,$row->date_inscription,$row->derniere_connexion,$row->actif,$row->administrateur);
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
				$liste[$row->id_membre] = new Membre_model($row->id_membre,$row->nom,$row->prenom,$row->email,$row->licence,$row->login,$row->password,$row->date_inscription,$row->derniere_connexion,$row->actif,$row->administrateur);
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
				'actif' => 1
			);
		$this->db->where('id_membre',$idMembre);
		$this->db->update('membre',$data);
	}

	public function deactiveMembre($idMembre){
		$data = array(
				'actif' => 0
			);
		$this->db->where('id_membre',$idMembre);
		$this->db->update('membre',$data);
	}

	public function insertMembre($nom,$prenom,$email){
		$this->load->helper('date');
		$today = date('Y-m-d',now());

		$login = strtolower(substr($prenom,0,1).strtolower($nom));			
		$password = md5($login);


		try {
			$this->db->insert('membre',array('nom'=>$nom,
													'prenom'=>$prenom,
													'email'=>$email,
													'login'=>$login,
													'password'=>$password,
													'date_inscription'=>$today,
													'derniere_connexion'=>$today,
													'actif'=>1,
													'administrateur'=>0
													)
			);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

}