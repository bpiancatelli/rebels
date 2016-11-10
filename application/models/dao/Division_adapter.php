<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Division_adapter extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->model('metier/division_model');
		$this->load->database();
	}

	public function getThisYear(){
		$this->load->helper('date');
		$year = date('Y',now());

		$this->db->select('*');
		$this->db->from('match');
		$this->db->like('date_match',$year);
	}

	public function getDivisionByIdDivision($idDivision){
		$query = $this->db->get_where('division',array('id_division'=>$idDivision));

		$liste = null;
		if($query->num_rows() == 1){
			$row = $query->row_array();
			$liste = new Division_model($row['id_division'],$row['nom']);
		}

		return $liste;

	}

	public function getAllDivisions(){		

		$query = $this->db->get('division');
		$liste = null;
		if ($query->num_rows() > 0) {			
			$liste = null;
			foreach ($query->result() as $row) {
				$liste[$row->id_division] = new Division_model($row->id_division, $row->nom);
				
			}	
		}		
		return $liste;
	}

	public function getAllDivisionsWherePlayed(){
		$this->load->helper('date');
		$year = date('Y',now());

		/*$this->db->select('id_division');
		$this->db->from('match');
		$this->db->like('date_match',$year);
		$this->db->group_by('id_division');*/

		$query = $this->db->query("select id_division from match where extract(year from now()::date)::text ilike '".$year."'");

		//$query = $this->db->get();
		
		$liste = null;
		if($query->num_rows() > 0 ){
			$divisions = array();
			foreach ($query->result() as $row) {
				$divisions[$row->id_division] = $row->id_division;
			}
			
			
			$this->db->select('*');
			$this->db->from('division');
			$this->db->where_in('id_division',$divisions);
			$query = $this->db->get();

			$liste = null;
			if ($query->num_rows() > 0) {			
				$liste = null;
				foreach ($query->result() as $row) {
					$liste[$row->id_division] = new Division_model($row->id_division, $row->nom);
					
				}	
			}		
		}
		return $liste;
	}

	public function getAllDivisionsWherePlayedOfAllTime(){

		$this->db->select('id_division');
		$this->db->from('match');
		$this->db->group_by('id_division');
		$query = $this->db->get();
		
		$liste = null;
		if($query->num_rows() > 0 ){
			$divisions = array();
			foreach ($query->result() as $row) {
				$divisions[$row->id_division] = $row->id_division;
			}
			
			
			$this->db->select('*');
			$this->db->from('division');
			$this->db->where_in('id_division',$divisions);
			$query = $this->db->get();

			$liste = null;
			if ($query->num_rows() > 0) {			
				$liste = null;
				foreach ($query->result() as $row) {
					$liste[$row->id_division] = new Division_model($row->id_division, $row->nom);
					
				}	
			}		
		}
		return $liste;
	}

}