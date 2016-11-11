<?php

class Match_membre_adapter extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->model('metier/match_membre_model');
		$this->load->model('metier/membre_model');
	}

	public function getThisYear(){
		$this->load->helper('date');
		$year = date('Y',now());

		$this->db->like('match.date_match',$year);
	}

	public function insertJoueurToMatch($idMatch,$idMembre,$simpleHit,$doubleHit,$tripleHit,$hr,$roe,$hbp,$gofo,$sac,$bb,$k,$rbi,$runs,$sb,$cs){

		$mm = new Match_membre_model();
		$pa =  $mm->calculPA($simpleHit,$doubleHit,$tripleHit,$hr,$roe,$hbp,$gofo,$sac,$bb,$k);
		$ab = $mm->calculAB($pa,$hbp,$bb);
		$hit = $mm->calculHits($simpleHit,$doubleHit,$tripleHit,$hr);

		try {
			$this->db->insert('match_membre',array('id_membre'=>$idMembre,
													'id_match'=>$idMatch,
													'pa'=>$pa,
													'ab'=>$ab,
													'hit'=>$hit,
													'simplehit'=>$simpleHit,
													'doublehit'=>$doubleHit,
													'triplehit'=>$tripleHit,
													'hr'=>$hr,
													'roe'=>$roe,
													'hbp'=>$hbp,
													'gofo'=>$gofo,
													'sac'=>$sac,
													'bb'=>$bb,
													'k'=>$k,
													'rbi'=>$rbi,
													'runs'=>$runs,
													'sb'=>$sb,
													'cs'=>$cs

													)
			);
		} catch (Exception $e) {
			echo $e->getMessage();
		}

	}

	public function updateJoueurToMatch($idMatch,$idMembre,$simpleHit,$doubleHit,$tripleHit,$hr,$roe,$hbp,$gofo,$sac,$bb,$k,$rbi,$runs,$sb,$cs){
		$mm = new Match_membre_model();
		$pa =  $mm->calculPA($simpleHit,$doubleHit,$tripleHit,$hr,$roe,$hbp,$gofo,$sac,$bb,$k);
		$ab = $mm->calculAB($pa,$hbp,$bb);
		$hit = $mm->calculHits($simpleHit,$doubleHit,$tripleHit,$hr);

		$data = array(
			'pa'=>$pa,
			'ab'=>$ab,
			'hit'=>$hit,
			'simplehit'=>$simpleHit,
			'doublehit'=>$doubleHit,
			'triplehit'=>$tripleHit,
			'hr'=>$hr,
			'roe'=>$roe,
			'hbp'=>$hbp,
			'gofo'=>$gofo,
			'sac'=>$sac,
			'bb'=>$bb,
			'k'=>$k,
			'rbi'=>$rbi,
			'runs'=>$runs,
			'sb'=>$sb,
			'cs'=>$cs
            );

		$this->db->where('id_match', $idMatch);
		$this->db->where('id_membre', $idMembre);
		$this->db->update('match_membre', $data); 

	}
	public function getAllJoueursByIdMatch($idMatch){

		$query = $this->db->get_where('match_membre',array('id_match'=>$idMatch));
		$liste = null;
		if ($query->num_rows() > 0) {			
			$liste = null;
			foreach ($query->result() as $row) {
				$mmm = new Match_membre_model();
				$liste[$row->id_match_membre] = $mmm->hydrate($row);
				
			}	
		}		
		return $liste;
	}

	public function getMatchsByIdJoueurOfThisYear($idMembre){
		$this->load->helper('date');
		$year = date('Y',now());

		$this->db->select('match_membre.*');
		$this->db->from('match_membre');
		$this->db->join('match','match.id_match = match_membre.id_match');
		$this->db->where('match_membre.id_membre',$idMembre);
		$this->db->like('match.date_match',$year);
		

		$query = $this->db->get();
		$liste = null;

		if($query->num_rows() > 0){

			foreach ($query->result() as $row) {
				$mmm = new Match_membre_model();
				$liste[$row->id_match_membre] = $mmm->hydrate($row);			
			}

		}

		return $liste;

	}

	public function getMatchsByIdJoueur($idMembre){
		$query = $this->db->get_where('match_membre',array('id_membre'=>$idMembre));
		$liste = null;

		if($query->num_rows() > 0){

			foreach ($query->result() as $row) {
				$mmm = new Match_membre_model();
				$liste[$row->id_match_membre] = $mmm->hydrate($row);			
			}

		}

		return $liste;

	}

	public function getJoueurByIdMatch($idMatch,$idMembre){
		$membre = null;
		$query = $this->db->get_where('match_membre',array('id_match'=>$idMatch,'id_membre'=>$idMembre));

		if($query->num_rows() == 1){			
			$mmm = new Match_membre_model();
			$membre = $mmm->hydrate($query->result()[0]);
		}

		return $membre;
	}

	public function getAllByDivisionOfThisYear($idDivision){
		$this->load->helper('date');
		$year = date('Y',now());

		$this->db->select('*');
		$this->db->from('match_membre');
		$this->db->join('match','match_membre.id_match = match.id_match');
		$this->db->like('match.date_match',$year);

		if ($idDivision == '') {
			$query = $this->db->get();	
		}else{

			$this->db->where('id_division',$idDivision);
			$q = $this->db->get();

			$array = array();
			foreach ($q->result() as $row) {
				$array[$row->id_match] = $row->id_match;
			}

			$this->db->from('match_membre');
			$this->db->where_in('id_match',$array);

			$query = $this->db->get();			

		}

		
		$liste = null;
		if ($query->num_rows() > 0) {			
			$liste = null;
			foreach ($query->result() as $row) {
				$mmm = new Match_membre_model();
				$liste[$row->id_match_membre] = $mmm->hydrate($row);
				
			}	
		}		
		return $liste;

	}

	public function getSearchEngine($joueur,$adversaire,$annee,$division){
		$search = array(
				'match_membre.id_membre' => $joueur,
				'match.id_adversaire' =>$adversaire,
				'match.date_match' => $annee,
				'match.id_division' => $division
			);		
		$this->db->select('match_membre.*');
		$this->db->from('match_membre');
		$this->db->join('match','match.id_match = match_membre.id_match');
		
		foreach ($search as $key => $value) {
			if($value != 'na' && $key != 'match.date_match'){
				$this->db->where($key, $value);
			}else{
				if($value != 'na' && $key == 'match.date_match'){
					$this->db->like($key, $value);	
				}
				
			}
		}

		$query = $this->db->get();
		$liste = null;

		if ($query->num_rows() > 0) {			
			$liste = null;
			foreach ($query->result() as $row) {
				$mmm = new Match_membre_model();
				$liste[$row->id_match_membre] = $mmm->hydrate($row);			
				
			}	
		}		
		return $liste;
	}

	public function getTop3($what, $lastWeek = null){
		$this->load->helper('date');
		$year = date('Y',now());
		
		$liste = array();
		$top = null;

		switch ($what) {
			case 'avg':
				$this->db->select('id_membre, (sum(hit)/sum(ab)) as s');				
				break;

			case 'runs':
				$this->db->select('id_membre, sum(runs) as s');
				break;		

			case 'rbi':
				$this->db->select('id_membre, sum(rbi) as s');
				break;

			case 'k':
				$this->db->select('id_membre, sum(k) as s');
				break;
			
			case 'sb':
				$this->db->select('id_membre, sum(sb) as s');
				break;		

			case 'bb':
				$this->db->select('id_membre, sum(bb) as s');
				break;							

			case 'sac':
				$this->db->select('id_membre, sum(sac) as s');
				break;	

			case 'gofo':
				$this->db->select('id_membre, sum(gofo) as s');
				break;

			case 'hbp':
				$this->db->select('id_membre, sum(hbp) as s');
				break;

			case 'roe':
				$this->db->select('id_membre, sum(roe) as s');
				break;

			case 'hr':
				$this->db->select('id_membre, sum(hr) as s');
				break;

			case 'tripleHit':
				$this->db->select('id_membre, sum(tripleHit) as s');
				break;

			case 'doubleHit':
				$this->db->select('id_membre, sum(doubleHit) as s');
				break;

			case 'simpleHit':
				$this->db->select('id_membre, sum(simpleHit) as s');
				break;

			case 'hit':
				$this->db->select('id_membre, sum(hit) as s');
				break;

			case 'ab':
				$this->db->select('id_membre, sum(ab) as s');
				break;

			case 'pa':			
				$this->db->select('id_membre, sum(pa) as s');
				break;

			case 'cs':			
				$this->db->select('id_membre, sum(cs) as s');
				break;
			case 'obp':
				$this->db->select('id_membre, (sum(hit)+sum(hbp)+sum(bb)) / (sum(ab)+sum(bb)+sum(hbp)) as s');
				break;
			case 'slug':
				$this->db->select('id_membre, (sum(hit) + (2*sum(doublehit)) + (3*sum(triplehit)) + (4*sum(hr))) /sum(ab) as s');
				break;
		}		

		$this->db->from('match_membre');
		$this->db->join ('match','match.id_match = match_membre.id_match');	
		if($lastWeek != null){
			$today = date('Y-m-d',now());
		 	$this->db->where('match.date_match >=',$lastWeek);
		 	$this->db->where('match.date_match <=',$today);
		}else{
		 	$this->db->like('match.date_match',$year);	
		}
		
		$this->db->group_by('id_membre');
		$this->db->order_by('2','desc');
		$this->db->limit(3);
		$query = $this->db->get();		

		if($query->num_rows() > 0){			

			foreach ($query->result() as $row) {
				if(isset($top[$row->s])){
					$top[$row->s] .= ",".$row->id_membre;
				}else{
					$top[$row->s] = $row->id_membre;
				}						
			}
								
			foreach ($top as $key => $value) {
				$a = $value;
				if(preg_match('/,/',$value)){
					$a = explode(',',$value);					
				}
				
				$this->db->select('*');
				$this->db->from('membre');
				$this->db->where_in('id_membre',$a);
				$query = $this->db->get();
				if($query->num_rows() > 0){
					foreach ($query->result() as $row) {
						
						$mm = new Membre_model();
						$liste[$what][$key][$row->id_membre] = $mm->hydrate($row);
						//$liste[$what][$key][$row->id_membre] = new Membre_model($row->id_membre,$row->nom,$row->prenom,$row->email,$row->login,$row->password,$row->date_inscription,$row->derniere_connexion,$row->is_actif,$row->is_administrateur);													
					}
				}
						
			}
			
		}
	
		return $liste;
	}

	public function getSumOuts($idMembre){


		$this->load->helper('date');
		$year = date('Y',now());		
		$liste = null;

		$this->db->select('match_membre.id_membre, sum(gofo) as sgofo, sum(sac) as ssac, sum(k) as sk, sum(cs) as scs');
		$this->db->from('match_membre');
		$this->db->join('match','match.id_match = match_membre.id_match');
		$this->db->where('match_membre.id_membre', $idMembre);
		$this->db->like('match.date_match',$year);

		$query = $this->db->get();

		if($query->num_rows() > 0){		
			$row = $query->row_array();
			$liste = array(
					'gofo' => $row['sgofo'],
					'sac'=>$row['ssac'],
					'k'=>$row['sk'],
					'cs'=>$row['scs']
				);
		}

		return $liste;
	}

}