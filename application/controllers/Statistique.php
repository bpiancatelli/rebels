<?php

class Statistique extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->database();	
		$this->load->model('dao/calendrier_adapter');				
		$this->load->model('dao/division_adapter');		
		$this->load->model('dao/equipe_adapter');
		$this->load->model('dao/form_log_adapter');
		$this->load->model('dao/match_adapter');
		$this->load->model('dao/match_membre_adapter');
		$this->load->model('dao/membre_adapter');
		$this->load->model('dao/session_manager');

	}

	public function generateSideBar(){		

		$da = new Division_adapter();
		$data['divisions'] = $da->getAllDivisionsWherePlayed();
		$newdata = array(
					'divisions' =>$data['divisions'],                   	
               );
		$this->session->set_userdata($newdata);

		$this->load->view('tags/membre/home/sidebar',$data);

	}

	/**
	*
	* ajoute des joueurs a un match et leur statistiques
	*
	*/
	public function update($idMatch){
		$ea = new Equipe_adapter();
		$ma = new Match_adapter();

		$data['display'] = false;
		$data['equipe'] = $ea->getAdversaireByIdMatch($idMatch);
		$data['match'] = $ma->getMatchById($idMatch);

		if(($data['match']->getScoreHome() + $data['match']->getScoreAway()) > 0 ){						
			$this->load->model('metier/match_membre_model');
			$m = new Membre_adapter();
			$mma = new Match_membre_adapter();

			$data['matchMembre'] = $mma->getAllJoueursByIdMatch($idMatch);			
			$data['display'] = true;
			$data['joueurs'] = $m->getAllActiveMembre();

			$data['stats'] = array(
				'simpleHit'=>'1',
				'doubleHit'=>'2',
				'tripleHit'=>'3',
				'hr'=>'hr',
				'roe'=>'roe',
				'hbp'=>'hbp',
				'gofo'=>'gf',
				'sac'=>'sac',
				'bb'=>'bb',
				'k'=>'k',
				'rbi'=>'rbi',
				'runs'=>'r',
				'sb'=>'sb',
				'cs'=>'cs'
			);

			$data['statsJoueurs'] = array(
				'id_membre'=>'Membre',
				'id_division'=>'Division',
				'id_adversaire'=>'Adversaire',
				'pa'=>'PA',
				'ab'=>'AB',
				'h'=>'H',
				'rbi'=>'RBI',
				'avg'=>'AVG',
				'k'=>'K',
				'k%'=>'(%)',
				'bb'=>'BB',  
				'bb%'=>'(%)',
				'obp'=>'OBP',
				'slug'=>'SLUG%',
				'sb'=>'SB%',
				'modifier'=>'M'

			);



		}
		
		$this->load->view('tags/header');
		$this->generateSideBar();		
		$this->load->view('tags/admin/statistiques/updatematch',$data);
		$this->load->view('tags/footer');

	}

	public function setscore($idMatch){
		$scoreHome = $this->input->post('scoreHome');
		$scoreAway = $this->input->post('scoreAway');

		//LOG
		$fl = new Form_log_adapter();
		$membre = $this->session->userdata('prenom')." ".$this->session->userdata('nom');		
		$params = array('id_match'=>$idMatch,'scoreHome'=>$scoreHome,'scoreAway'=>$scoreAway);
		$parametres = json_encode($params);		
		$idMembre = $this->session->userdata('idMembre');
		//$fl->insertLog(5,18,$parametres,$membre,$idMembre);

		$ma = new Match_adapter();
		$ma->updateScore($idMatch,$scoreHome,$scoreAway);
		$this->update($idMatch);

	}

	public function setjoueur($idMatch){
		$idMembre = $this->input->post('joueur');
		$simpleHit= $this->input->post('simpleHit');
		$doubleHit= $this->input->post('doubleHit');
		$tripleHit= $this->input->post('tripleHit');
		$hr= $this->input->post('hr');
		$roe= $this->input->post('roe');
		$hbp= $this->input->post('hbp');
		$gofo= $this->input->post('gofo');
		$sac= $this->input->post('sac');
		$bb= $this->input->post('bb');
		$k= $this->input->post('k');
		$rbi= $this->input->post('rbi');
		$runs= $this->input->post('runs');
		$sb= $this->input->post('sb');
		$cs= $this->input->post('cs');

		//LOG
		$fl = new Form_log_adapter();
		$membre = $this->session->userdata('prenom')." ".$this->session->userdata('nom');		
		$params = array(
			'id_match'=>$idMatch,
			'id_membre'=>$idMembre,
			'1B'=>$simpleHit,
			'2B'=>$doubleHit,
			'3B'=>$tripleHit,
			'HR'=>$hr,
			'ROE'=>$roe,
			'HBP'=>$hbp,
			'GOFO'=>$gofo,
			'SAC'=>$sac,
			'BB'=>$bb,
			'K'=>$k,
			'RBI'=>$rbi,
			'RUNS'=>$runs,
			'SB'=>$sb,
			'CS'=>$cs
			);
		$parametres = json_encode($params);
		$idMembreLog = $this->session->userdata('idMembre');			
		//$fl->insertLog(5,19,$parametres,$membre,$idMembreLog);

		$mma = new Match_membre_adapter();

		$mma->insertJoueurToMatch($idMatch,$idMembre,$simpleHit,$doubleHit,$tripleHit,$hr,$roe,$hbp,$gofo,$sac,$bb,$k,$rbi,$runs,$sb,$cs);
		$this->update($idMatch);

	}

	public function updateJoueur($idMatch, $idMembre){

		$mma = new Match_membre_adapter();	
		$data['matchMembre'] = $mma->getJoueurByIdMatch($idMatch,$idMembre);

		$data['stats'] = array(
				'simpleHit'=>'1B',
				'doubleHit'=>'2B',
				'tripleHit'=>'3B',
				'hr'=>'hr',
				'roe'=>'roe',
				'hbp'=>'hbp',
				'gofo'=>'gofo',
				'sac'=>'sac',
				'bb'=>'bb',
				'k'=>'k',
				'rbi'=>'rbi',
				'runs'=>'runs',
				'sb'=>'sb',
				'cs'=>'cs'
				);

		$this->load->view('tags/header');
		$this->generateSideBar();		
		$this->load->view('tags/admin/statistiques/updatejoueur',$data);
		$this->load->view('tags/footer');
	}

	public function launchUpdate($idMatch, $idMembre){
		
		$simpleHit= $this->input->post('simpleHit');
		$doubleHit= $this->input->post('doubleHit');
		$tripleHit= $this->input->post('tripleHit');
		$hr= $this->input->post('hr');
		$roe= $this->input->post('roe');
		$hbp= $this->input->post('hbp');
		$gofo= $this->input->post('gofo');
		$sac= $this->input->post('sac');
		$bb= $this->input->post('bb');
		$k= $this->input->post('k');
		$rbi= $this->input->post('rbi');
		$runs= $this->input->post('runs');
		$sb= $this->input->post('sb');
		$cs= $this->input->post('cs');


		//LOG
		$fl = new Form_log_adapter();
		$membre = $this->session->userdata('prenom')." ".$this->session->userdata('nom');		
		$params = array(
			'id_match'=>$idMatch,
			'id_membre'=>$idMembre,
			'1B'=>$simpleHit,
			'2B'=>$doubleHit,
			'3B'=>$tripleHit,
			'HR'=>$hr,
			'ROE'=>$roe,
			'HBP'=>$hbp,
			'GOFO'=>$gofo,
			'SAC'=>$sac,
			'BB'=>$bb,
			'K'=>$k,
			'RBI'=>$rbi,
			'RUNS'=>$runs,
			'SB'=>$sb,
			'CS'=>$cs
			);
		$parametres = json_encode($params);		
		$idMembre = $this->session->userdata('idMembre');		
		//$fl->insertLog(5,19,$parametres,$membre,$idMembre);

		$mma = new Match_membre_adapter();
		$mma->updateJoueurToMatch($idMatch,$idMembre,$simpleHit,$doubleHit,$tripleHit,$hr,$roe,$hbp,$gofo,$sac,$bb,$k,$rbi,$runs,$sb,$cs);

		$this->update($idMatch);
	}

	public function division($idDivision=''){
		$mma = new Match_membre_adapter();		

		$data['stats'] = array(
			'simpleHit'=>'1B',
			'doubleHit'=>'2B',
			'tripleHit'=>'3B',
			'hr'=>'hr',
			'roe'=>'roe',
			'hbp'=>'hbp',
			'gofo'=>'gofo',
			'sac'=>'sac',
			'bb'=>'bb',
			'k'=>'k',
			'rbi'=>'rbi',
			'runs'=>'runs',
			'sb'=>'sb',
			'cs'=>'cs'
		);

		$data['resultats'] =  $mma->getAllByDivisionOfThisYear($idDivision);

		//'id_form_famille','id_form_type','parametres','membre'
		//LOG
		$fl = new Form_log_adapter();
		$membre = $this->session->userdata('prenom')." ".$this->session->userdata('nom');
		if ($idDivision == '') {
			$idDivision = 'null';
		}
		$params = array('division'=>$idDivision);
		$parametres = json_encode($params);		
		$idMembre = $this->session->userdata('idMembre');			
		//$fl->insertLog(2,2,$parametres,$membre,$idMembre);

		
		$this->load->view('tags/header');
		$this->generateSideBar();		
		$this->load->view('tags/membre/statistique/search',$data);
		$this->load->view('tags/footer');
	}

	public function search(){
		$mma = new Match_membre_adapter();
		$m = new Membre_adapter();
		$e = new Equipe_adapter();
		$d = new Division_adapter();
		$ma = new Match_adapter();

		$data['stats'] = array(
			'id_membre'=>'Membre',
			'id_adversaire'=>'Adversaire',
			'date_match'=>'Année',
			'id_division'=>'Division'

		);

		$data['membres'] = $m->getAllActiveMembre();
		$data['equipes'] = $e->getAllEquipes();
		$data['saisons'] = $ma->getAllYears();		
		$data['champtionnats'] = $d->getAllDivisionsWherePlayedOfAllTime();

		$joueur = $this->input->post('membre');
		$adversaire = $this->input->post('adversaire');
		$annee = $this->input->post('annee');		
		$division = $this->input->post('division');


		//LOG
		$fl = new Form_log_adapter();
		$membre = $this->session->userdata('prenom')." ".$this->session->userdata('nom');		
		$params = array('id_membre'=>$joueur,'id_adversaire'=>$adversaire,'date_match'=>$annee,'division'=>$division);
		$parametres = json_encode($params);	
		$idMembre = $this->session->userdata('idMembre');			
		//$fl->insertLog(2,4,$parametres,$membre,$idMembre);

		$data['resultats'] = null;
		$data['resultats'] = $mma->getSearchEngine($joueur,$adversaire,$annee,$division);

		$this->load->view('tags/header');
		$this->generateSideBar();
		$this->load->view('tags/membre/statistique/engine',$data);		
		$this->load->view('tags/footer');

	}


}