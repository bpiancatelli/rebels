<?php

class Form_log_adapter extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('metier/form_log_model');
		$this->load->helper('date');
	}

	public function insertLog($idFormFamille, $idFormType, $parametres, $membre, $idMembre){

		$dateRecord = date('Y-m-d H:i:s',now());

		try {
			
			$this->db->insert('form_log',array('id_form_famille'=>$idFormFamille,
													'id_form_type'=>$idFormType,
													'parametres'=>$parametres,
													'membre'=>$membre,
													'id_membre'=>$idMembre,
													'date_record'=>$dateRecord)
			);


		} catch (Exception $e) {
			echo $e->getMessage();
		}

	}

	public function getAllFormLog(){		
		$query = $this->db->get('form_log');

		$liste = null;
		if($query->num_rows() > 0){			
			foreach ($query->result() as $row) {
				$liste[$row->id_form_log] = new Form_log_model($row->id_form_log, $row->id_form_famille, $row->id_form_type, $row->parametres, $row->membre, $row->id_membre, $row->date_record);				
			}
		}

		return $liste;
	}

	

}