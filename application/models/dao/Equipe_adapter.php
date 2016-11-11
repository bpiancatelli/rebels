<?php

class Equipe_adapter extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('metier/equipe_model');
	}

	public function getAllEquipes(){

		$query = $this->db->get('equipe');
		$liste = null;
		if ($query->num_rows() > 0) {			
			$liste = null;

			foreach ($query->result() as $row) {
			// 	//$liste[$row->id_equipe] = new Equipe_model($row->id_equipe, $row->nom_long, $row->nom_court, $row->logo, $row->is_active, $row->adresse, $row->adresse_numero, $row->code_postal, $row->ville);
			// 	echo $query->result()[0]->id_equipe;
			 	$em = new Equipe_model();
			 	$liste[$row->id_equipe] = $em->hydrate($row);

			}
		}		
		
		return $liste;
	}

	public function getAdversaireById($idAdversaire){
		$query = $this->db->get_where('equipe',array('id_equipe'=>$idAdversaire));
		$row = $query->row_array();
		$em = new Equipe_model();

		return $em->hydrate($query->result()[0]);
		//return new Equipe_model($row['id_equipe'], $row['nom_long'], $row['nom_court'], $row['logo'], $row['is_active'], $row['adresse'], $row['adresse_numero'], $row['code_postal'], $row['ville']);

	}

	public function getAdversaireByIdMatch($idMatch){
		$query = $this->db->get_where('match',array('id_match'=>$idMatch));
		$row = $query->row_array();
		$idAdversaire = $row['id_adversaire'];
		return $this->getAdversaireById($idAdversaire);

	}

	public function getAdversaireByIdMatchMembre($idMatchMembre){
		$query = $this->db->get_where('match_membre',array('id_match'=>$idMatchMembre));
		$row = $query->row_array();
		$idMatch = $row['id_match'];
		return $this->getAdversaireByIdMatch($idMatch);
	}

}

