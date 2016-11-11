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
						//'tookhiscar'=>true,
						'tookhiscar'=>1,
						'travelcost' => $cost
					));

			} catch (Exception $e) {
				echo $e->getMessage();
			}
		}else{
			try {
				//update
				$this->db->select('tookhiscar');
				$this->db->from('drivertool');
				$this->db->where('id_membre', $idMembre);
				$this->db->where('id_match', $idMatch);
				$query = $this->db->get();
				$row = $query->row_array();

				$isTookHisCar = ($row['tookhiscar'] ? "0" : "1");						

				$data = array(
    	           'tookhiscar' => $isTookHisCar,
    	           'travelcost' => $cost
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
				'tookhiscar' => null,
				'travelcost' =>null);
		
		$query = $this->db->get_where('drivertool', array('id_membre'=>$idMembre,'id_match'=>$idMatch));
		
		$row = null;
		if ($query->num_rows() == 1) {
			$row = $query->row_array();
		}	

		$returnArray['isTookHisCar'] = $row['tookhiscar'];
		$returnArray['travelCost'] = $row['travelcost'];

		return $returnArray;
	}

	public function getAllDriverTool(){
		$query = $this->db->get('drivertool');

		$liste = null;
		if($query->num_rows() > 0){
			foreach ($query->result() as $row) {
				$dm = new Drivertool_model();
				//$liste[$row->id_drivertool] = new Drivertool_model($row->id_drivertool, $row->id_match, $row->id_membre, $row->isTookHisCar, $row->travelCost);
				$liste[$row->id_driver_tool] = $dm->hydrate($row);
			}
		}

		return $liste;
	}



}