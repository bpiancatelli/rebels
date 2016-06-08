<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forum_adapter extends CI_Model{

	public function __construct(){
		parent::__construct();		
		$this->load->database();
		$this->load->model('metier/forum_dossier_model');
		$this->load->model('metier/forum_thematique_model');
		$this->load->model('metier/forum_sujet_model');
		$this->load->helper('date');
	}


	public function getAllForumDossier(){
		$query = $this->db->get('forum_dossier');
		$liste = null;

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$liste[$row->id_forum_dossier] = new Forum_dossier_model($row->id_forum_dossier, $row->nom_dossier);
			}
		}

		return $liste;
	}

	public function getAllThematiqueByDossier($idForumDossier){
		$query = $this->db->get_where('forum_thematique', array('id_forum_dossier' => $idForumDossier));
		$liste = null;

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$liste[$row->id_forum_thematique] = new Forum_thematique_model(
																			$row->id_forum_thematique, 
																			$row->nom_thematique, 
																			$row->id_forum_dossier, 
																			$row->sujet,
																			$row->reponse,
																			$row->isLocked																		
																		);
			}
		}

		return $liste;
	}

	public function getAllSujetByThematique($idForumThematique){
		$query = $this->db->get_where('forum_sujet', array('id_forum_thematique' => $idForumThematique));
		$liste = null;

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$liste[$row->id_forum_sujet] = new Forum_sujet_model(
																			$row->id_forum_sujet, 
																			$row->nom_sujet, 
																			$row->sujet, 
																			$row->id_forum_thematique,
																			$row->id_membre,
																			$row->date_creation,
																			$row->reponse,
																			$row->isLocked,
																			$row->isImportant
																		);
			}
		}

		return $liste;
	}

	public function insertNewDossier($nomDossier){
		try {
			$this->db->insert('forum_dossier',array('nom_dossier'=>$nomDossier));
		} catch (Exception $e) {
			echo $e->getMessage();
		}		
	}

	public function insertNewThematique($nomDossier, $idForumDossier){
		try {
			$this->db->insert('forum_thematique',array(
												'nom_thematique'=>$nomDossier,
												'id_forum_dossier'=>$idForumDossier
												));
		} catch (Exception $e) {
			echo $e->getMessage();
		}		
	}

	public function insertNewSujet($idThematique, $titreMessage, $message){
		$date = date('Y-m-d H:i:s',now());
		try{
			$this->db->insert('forum_sujet', array(
												'nom_sujet' => $titreMessage,
												'sujet'=>$message,
												'id_forum_thematique'=>$idThematique,
												'id_membre'=> $this->session->userdata('idMembre'),
												'date_creation' => $date
				));
		}catch (Exception $e){
			echo $e->getMessage();
		}
	}

}