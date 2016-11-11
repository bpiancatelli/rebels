<?php 

class Cotisation_adapter extends CI_Model{

	public function __construct(){
		parent::__construct();	
		$this->load->model('metier/cotisation_model');
		$this->load->database();
	}

	public function insertMembreIntoCotisation($nom,$prenom){

		$query = $this->db->get_where('membre',array('nom'=>$nom,'prenom'=>$prenom));

		if($query->num_rows() == 1){
			$row = $query->row_array();
			try {
				$this->db->insert('cotisation',array('id_membre'=>$row['id_membre'],
														'cotisation_paye'=>0,
														'cotisation_total'=>0)
				);
			} catch (Exception $e) {
				echo $e->getMessage();
			}

		}

	}

	public function getCotisationByMembre($idMembre){
		$query = $this->db->get_where('cotisation',array('id_membre'=>$idMembre));

		if($query->num_rows() == 1){		
			$row = $query->row_array();
			$cm = new Cotisation_model();
			return $cm->hydrate($query->result());
			//return new Cotisation_model($row['id_cotisation'],$row['id_membre'], $row['cotisation_paye'],$row['cotisation_total']);	
		}else{
			return null;
		}

	}

	public function updateCotisationByMembre($idMembre,$apayer,$total){
		$data = array(
               'cotisation_paye'=>$apayer,
               'cotisation_total'=>$total
        );

		try {

		$this->db->where('id_membre', $idMembre);
		$this->db->update('cotisation', $data); 
			
		} catch (Exception $e) {
			echo $e->getMessage();
		}

	}

	public function getAllByActiveMembre(){
		$liste = null;
		$this->db->select('cotisation.*');
		$this->db->from('cotisation');
		$this->db->join('membre','membre.id_membre = cotisation.id_membre');
		$this->db->where('membre.actif',1);

		$query = $this->db->get();

		if($query->num_rows() > 0){
			$cm = new Cotisation_model();
			foreach ($query->result() as $row) {
				//$liste[$row->id_cotisation] = new Cotisation_model($row->id_cotisation,$row->id_membre, $row->cotisation_paye,$row->cotisation_total);				
				$liste[$row->id_cotisation] = $cm->hydrate($row);
			}
		}
			
		return $liste;
	}

}