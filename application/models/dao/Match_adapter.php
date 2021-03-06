<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Match_adapter extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->model('metier/match_model');
		$this->load->model('dao/calendrier_adapter');
		$this->load->database();
	}

	public function getThisYear(){
		$this->load->helper('date');
		$year = date('Y',now());

		return $year;
	}

	public function getAllYears(){
		
		$this->db->select('substring(date_match from 1 for 4) as date');
		$this->db->from('match');
		$this->db->group_by('1');

		$query = $this->db->get();		

		$liste = null;
		if($query->num_rows() > 0){			
			foreach ($query->result() as $row) {				
				$liste[$row->date] = $row->date;					
			}
		}		

		return $liste;
	}

	public function getMatchById($idMatch){
		$query = $this->db->get_where('match',array('id_match'=>$idMatch));
		$match = null;
		if($query->num_rows() == 1){
			$match = null;
			$row = $query->row_array();
			$match = new Match_model($row['id_match'],
				$row['reference'],
				$row['date_match'],
				$row['id_adversaire'],
				$row['id_division'],
				$row['is_domicile'],
				$row['score_home'],
				$row['score_away']
				);
		}

		return $match;
	}


	public function getAllMatchsOfThisYear(){
		$year = $this->getThisYear();
		
		$this->db->select('*');
		$this->db->from('match');
		$this->db->like('date_match',$year);		
		$query = $this->db->get();

		//$query = $this->db->query("select id_division from match where extract(year from now()::date)::text ilike '".$year."'");

		$liste = null;
		if($query->num_rows() > 0){
			$liste = null;
			foreach($query->result() as $row){
				$liste[$row->id_match] = new Match_model($row->id_match,
					$row->reference,
					$row->date_match,
					$row->id_adversaire,
					$row->id_division,
					$row->is_domicile,
					$row->score_home,
					$row->score_away
					);
			}
		}

		return $liste;
	}


	public function getAllMatchsOfThisYearByMembre($idMembre){
		$this->load->helper('date');
		$year = date('Y',now());

		$this->db->select('match.*');
		$this->db->from('match');
		$this->db->join('match_membre','match.id_match = match_membre.id_match');
		$this->db->where('match_membre.id_membre',$idMembre);
		$this->db->like('match.date_match',$year);

		$query = $this->db->get();

		$liste = null;
		if($query->num_rows() > 0){
			$liste = null;
			foreach($query->result() as $row){
				$liste[$row->id_match] = new Match_model($row->id_match,
					$row->reference,
					$row->date_match,
					$row->id_adversaire,
					$row->id_division,
					$row->is_domicile,
					$row->score_home,
					$row->score_away
					);
			}
		}

		return $liste;
	}

	public function getAllMatchsOfThisYearNotUpdatedYet(){
		$this->load->helper('date');

		$lastWeek = date('Y-m-d',strtotime('-1 week'));		
		$nextWeek = date('Y-m-d',strtotime('+1 week'));	

		$year = $this->getThisYear();

		//$query = $this->db->query("select * from match where extract(year from now()::date)::text ilike '".$year."' and score_home = 0 and score_away = 0");
		$this->db->select('*')
			->from('match')
			->where('score_home',0)
			->where('score_away',0)
			->where('date_match >',$lastWeek)
			->where('date_match <',$nextWeek);
		$query = $this->db->get();
		
		$liste = null;

		if($query->num_rows() > 0){
			$liste = null;
			foreach($query->result() as $row){
				$liste[$row->id_match] = new Match_model($row->id_match,
					$row->reference,
					$row->date_match,
					$row->id_adversaire,
					$row->id_division,
					$row->is_domicile,
					$row->score_home,
					$row->score_away
					);
			}
		}

		return $liste;
	}

	public function getMatchsOfNextWeek(){
		$this->load->helper('date');
	
		$nextWeek = date('Y-m-d',strtotime('+1 week'));
		$thisWeek = date('Y-m-d',now());

		$this->db->from('match');
		$this->db->where('date_match >=',$thisWeek);
		$this->db->where('date_match <',$nextWeek);

		$query = $this->db->get();
		$liste = null;

		if($query->num_rows() > 0){			
			$liste = null;
			foreach($query->result() as $row){
				$liste[$row->id_match] = new Match_model($row->id_match,
					$row->reference,
					$row->date_match,
					$row->id_adversaire,
					$row->id_division,
					$row->is_domicile,
					$row->score_home,
					$row->score_away
					);
			}
		}

		return $liste;

	}

	public function addCalendar($division,$adversaire,$date,$reference,$domicile){		
			$result = $this->db->insert('match',array('id_division'=>$division,
													'id_adversaire'=>$adversaire,
													'date_match'=>$date,
													'reference'=>$reference,
													'is_domicile'=>$domicile)
			);
			
			if (!$result) {				
				return $this->db->error();
			}		
	}

	public function updateScore($idMatch,$scoreHome,$scoreAway){
		$data = array(
               'score_home' => $scoreHome,
               'score_away' => $scoreAway
            );

		$this->db->where('id_match', $idMatch);
		$this->db->update('match', $data); 
	}

	//0 - date
	//1 - heure
	//2 - reference
	//3 - lieu
	//4 - equipe a domicile
	//5 - equipe en deplacement
	//6 - ""
	public function compareCurlVsDb($data){
		$ca = new Calendrier_adapter();
		$domicile = 1;
		
		if($data[3] !== 'Seraing' || ($data[3] === 'Seraing' && (strpos($data[5],'Liege') === 0))){
			$domicile = 0;
		}

		$adversaire = ($domicile === 0 ? $data[4] : $data[5]);				
		$onlyTeam = explode(' ',$adversaire);	
		if(is_numeric((end($onlyTeam)))){
			$slice = array_slice($onlyTeam, 0 , -1);
			$adversaire = implode(' ', $slice);

		}else{
			$adversaire = implode(' ', $onlyTeam);			
		}	
		$adversaire = $this->getEquipeByNomLong($adversaire);

		$date = $ca->dateToSql($data[0]);
		$division = substr($data[2], 1, 1);		
		$reference = $data[2];
		
		$ca->dateToSql($data[0]);
		$query = $this->db->get_where('match',array(
				'date_match' => $date,
				'reference'  => $reference,
				'domicile'   => $domicile
			));
		
		if ($query->num_rows() == 0) {			
			$this->addCalendar($division,$adversaire,$date,$reference,$domicile);	
		}
	}

	public function getEquipeByNomLong($nom){
		$retVal = 0;
		$this->db->select('*');
		$this->db->from('equipe');
		$this->db->like('nom_long',$nom);
		$query = $this->db->get();

		if($query->num_rows() === 1){
			$row = $query->row_array();
			$retVal = $row['id_equipe'];
		}

		return $retVal;

	}


}