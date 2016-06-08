<?php 

class Drivertool_adapter extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->model('metier/drivertool_model');
		$this->load->database();
	}


	public function insertOrUpdate($idMatch, $idMembre, $cost){

		$query = $this->db->get_where('drivertool', array('id_match'=>$idMatch, 'id_membre'=>$idMembre));

		if ($query->num_rows() == 0) {
			try {
				//insert
				$this->db->insert('drivertool',array(
						'id_match'=>$idMatch,
						'id_membre'=>$idMembre,
						'isTookHisCar'=>true,
						'travelCost' => $cost
					));

			} catch (Exception $e) {
				echo $e->getMessage();
			}
		}else{
			try {
				//update
				$this->db->select('isTookHisCar');
				$this->db->from('drivertool');
				$this->db->where('id_membre', $idMembre);
				$this->db->where('id_match', $idMatch);
				$query = $this->db->get();
				$row = $query->row_array();

				$isTookHisCar = ($row['isTookHisCar'] ? "0" : "1");						

				$data = array(
    	           'isTookHisCar' => $isTookHisCar,
    	           'travelCost' => $cost
	            );

				$this->db->where('id_membre', $idMembre);
				$this->db->where('id_match', $idMatch);
				$this->db->update('drivertool', $data); 

			} catch (Exception $e) {
				echo $e->getMessage();
			}
		}		

	}


	public function isTookHisCar($idMatch, $idMembre){
		$returnArray = array(
				'isTookHisCar' => null,
				'travelCost' =>null
			);
		$query = $this->db->get_where('drivertool', array('id_membre'=>$idMembre,'id_match'=>$idMatch));
		
		$row = null;
		if ($query->num_rows() == 1) {
			$row = $query->row_array();
		}	

		$returnArray['isTookHisCar'] = $row['isTookHisCar'];
		$returnArray['travelCost'] = $row['travelCost'];

		return $returnArray;
	}

	public function getAllDriverTool(){
		$query = $this->db->get('drivertool');

		$liste = null;
		if($query->num_rows() > 0){			
			foreach ($query->result() as $row) {
				$liste[$row->id_drivertool] = new Drivertool_model($row->id_drivertool, $row->id_match, $row->id_membre, $row->isTookHisCar, $row->travelCost);
			}
		}

		return $liste;
	}



}