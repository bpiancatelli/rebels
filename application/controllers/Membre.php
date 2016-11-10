<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Membre extends CI_Controller{	

	public function __construct(){
		parent::__construct();
		$this->load->model('dao/calendrier_adapter');
		$this->load->model('dao/cotisation_adapter');	
		$this->load->model('dao/division_adapter');
		$this->load->model('dao/drivertool_adapter');		
		$this->load->model('dao/equipe_adapter');
		$this->load->model('dao/form_log_adapter');
		$this->load->model('dao/membre_adapter');
		$this->load->model('dao/match_adapter');
		$this->load->model('dao/match_membre_adapter');
		$this->load->model('dao/membre_adapter');
		$this->load->model('dao/sidebar_adapter');
		$this->load->model('dao/session_manager');		
		$this->load->model('metier/curl_model');
		$this->load->helper('simple_html_dom');
		
	}

	public function synchroCalendrier($division){
		$cm = new Curl_model();
		$ma = new Match_adapter();

		$deux='';
		if ($division == '4BB') {
			$deux='+2';
		}

        $page = utf8_encode($cm->post_data(FRBBS_CALENDRIER,'division='.$division.'&pdf=true&team=Li%E8ge+Rebel+Foxes'.$deux));
		$html = str_get_html($page);

		$table = $html->find('table', 1);
		$rowData = array();
		foreach($table->find('tr') as $row) {
		    // initialize array to store the cell data from each row
		    $flight = array();
		    foreach($row->find('td') as $cell) {
		        // push the cell's text to the array
		        $flight[] = $cell->plaintext;
		    }
		    $rowData[] = $flight;
		}		


		foreach ($rowData as $value) {			
			foreach ($value as $k => $v) {
				$check = $ma->compareCurlVsDb($value);
			}
		}
		
		
	}

	public function index(){

		$m = new Match_adapter();
		$mma = new Match_membre_adapter();
        $cm = new Curl_model();
        $year = date('Y',now());
        $page = utf8_encode($cm->grab_page(FRBBS_CLASSEMENT.$year));
        $sa = new Sidebar_adapter();
       	
/*
|--------------------------------------------------------------------------
| Generate calendar
|--------------------------------------------------------------------------
|
*/
        //$data['adversaires'] = $m->getMatchsOfNextWeek();

/*
|--------------------------------------------------------------------------
| Generate championship
|--------------------------------------------------------------------------
|
*/
		$html = str_get_html($page);		
		$i = 0;
		$championships = array();
		$headerName = array('Club','G','W','L','T','NP','FF','AVG','Pts');
		while ($i < sizeof($html->find('table[width="375"]'))) {						
			$table = $html->find('table[width="375"]', $i);			
			$rowData = array();
			$rowHeader = array();			
			foreach($table->find('tr') as $row) {
			    // initialize array to store the cell data from each row
			    $flight = array();		
			    $header = strip_tags($row->find('th',0));
			    $j=0;
			    foreach($row->find('td') as $cell) {
			        // push the cell's text to the array
			        //echo $cell->plaintext."<br>";
			  		$flight[$headerName[$j]] = $cell->plaintext;
			        $j++;
			    }
			    $rowHeader[] = $header;
			    $rowData[] = $flight;
			    $championships[$rowHeader[0]] = $rowData;
			} 
			$i++;
		}
		$club = array();
		foreach ($championships as $key => $value) {
			foreach ($value as $k => $v) {
				foreach ($v as $a => $z) {
					if(strpos($z, 'Liege Rebel Foxes') !== false){
						$club[$key] = $value;
					}
				}
			}
		}
		$data['championships'] = $club;  

/*
|--------------------------------------------------------------------------
| Generate TOP3
|--------------------------------------------------------------------------
|
*/

		
		//$data['top3']['sb'] = $mma->getTop3('sb');
		//$data['top3']['runs'] = $mma->getTop3('runs');
		//$data['top3']['rbi'] = $mma->getTop3('rbi');
		//$data['top3']['Strikouts'] = $mma->getTop3('k');

/*
|--------------------------------------------------------------------------
| Generate charts
|--------------------------------------------------------------------------
|
*/		

		//$data['chartsMatchList'] = $m->getAllMatchsOfThisYearByMembre($this->session->userdata('idMembre'));
	    //$data['chartsAvg'] = $mma->getMatchsByIdJoueurOfThisYear($this->session->userdata('idMembre'));
		//$data['chartsSumOut'] = $mma->getSumOuts($this->session->userdata('idMembre'));
		//$data['matchsPlayed'] = $mma->getMatchsByIdJoueurOfThisYear($this->session->userdata('idMembre'));
		/*$data['stats'] = array(
					'Division' =>'Division',
					'Date match'=>'Date',
					'Adversaire' =>'Adversaire',
					'Plate Appearance' =>'PA',
					'At Bat' =>'AB',
					'Hit'=>'H',
					'Runs Batted In'=>'RBI',
					'Average'=>'AVG',
					'Strikeout'=>'K',
					'Strikeout %'=>'K%',
					'Base on Ball'=>'BB',
					'Base on Ball %'=>'BB%',
					'On Base Percentage'=>'OBP',
					'Slugging %'=>'SLUG%',
					'Stolen Base %'=>'SB%'
			);

		*/
		$this->load->view('tags/header');		
		$sa->generateSideBar();
		$this->load->view('tags/membre/home/homepage',$data);
		$this->load->view('tags/footer');
	}

	public function annonce(){
		$this->load->view('tags/header');
		$sa = new Sidebar_adapter();
		$sa->generateSideBar();
		$this->load->view('tags/membre/home/annonce');
		$this->load->view('tags/footer');
	}

	public function login(){

		$this->form_validation->set_rules('pseudo','Pseudo','required');
		$this->form_validation->set_rules('password','Mot de passe','required');
		$this->form_validation->set_rules('confimer','Confirmation requise','required');

		
		$login = $this->input->post('pseudo');
		$pass = $this->input->post('password');
		$pass = md5($pass);

		$ma = new Membre_adapter();

		$query = $ma->getMembreByCredentials($login,$pass);

		if($query->num_rows() == 1){

			$row = $query->row_array();
			//$sm = new Session_manager();
			$m = new Membre_model($row['id_membre'], $row['nom'], $row['prenom'], $row['email'], $row['licence'], $row['login'], 
				$row['password'], $row['date_inscription'], $row['derniere_connexion'], $row['is_actif'], $row['is_administrateur']);


			$newdata = array(
					'nom' =>$row['nom'],
                   	'prenom'  => $row['prenom'],
                   	'email'=>$row['email'],
                   	'licence'=>$row['licence'],
                   	'login'=>$row['login'],
                   	'password'=>$row['password'],
                   	'dateInscription'=>$row['date_inscription'],
                   	'derniereConnexion'=>$row['derniere_connexion'],
                   	'actif'=>$row['is_actif'],
                   	'administrateur' => $row['is_administrateur'],
                   	'idMembre' =>$row['id_membre'],
                   	'logged_in' => TRUE
               );
			$this->session->set_userdata($newdata);
			
			$ma->updateDerniereConnexion($row['id_membre']);

			//'id_form_famille','id_form_type','parametres','membre'
			//LOG
			//$fl = new Form_log_adapter();
			// $membre = $row['prenom']." ".$row['nom'];
			// $params = array('login'=>$row['login'],'password'=>$row['password']);
			// $parametres = json_encode($params);	
			// $idMembre = $this->session->userdata('idMembre');	
			//$fl->insertLog(1,1,$parametres,$membre,$idMembre);

			$this->index();

		}else{
			$this->load->view('welcome_message.php');
		}		
	}

	public function logout(){
		// //LOG
		// $fl = new Form_log_adapter();
		// $membre = $this->session->userdata('prenom')." ".$this->session->userdata('nom');		
		// $params = array('deconnexion'=>$membre);
		// $parametres = json_encode($params);		
		// $idMembre = $this->session->userdata('idMembre');		
		//$fl->insertLog(6,23,$parametres,$membre,$idMembre);

		$this->session->sess_destroy();
		redirect(base_url(),true);
	}

	public function update($data){			

		$this->load->view('tags/header');
		$sa = new Sidebar_adapter();
		$sa->generateSideBar();
		$this->load->view('tags/membre/update/data',$data);
		$this->load->view('tags/footer');

	}

	public function updateMdp(){		
		$id_membre = $this->session->userdata('idMembre');
		
		$data['erreur'] = null;
		$old = $new  = $confirm = null;

		$old = $this->input->post('ancien_mdp');
		$new = $this->input->post('nouveau_mdp');
		$confirm = $this->input->post('confirmation_mdp');

		$old = md5($old);
		$new = md5($new);
		$confirm = md5($confirm);

		if(($new == $confirm) && ($new != $old) && ($old == $this->session->userdata('password'))){

			$ma = new Membre_adapter();
			$ma->updatePassword($id_membre,$new);

			$m = new Membre_model($this->session->userdata('idMembre'), 
				$this->session->userdata('nom'), 
				$this->session->userdata('prenom'), 
				$this->session->userdata('email'), 
				$this->session->userdata('login'),
				$new, 
				$this->session->userdata('dateInscription'), 
				$this->session->userdata('derniereConnexion'), 
				$this->session->userdata('actif'), 
				$this->session->userdata('administrateur')
				);

			
			//LOG
			//$fl = new Form_log_adapter();
			//$membre = $this->session->userdata('prenom')." ".$this->session->userdata('nom');		
			//$params = array('password'=>$new);
			//$parametres = json_encode($params);		
			//$idMembre = $this->session->userdata('idMembre');		
			//$fl->insertLog(6,21,$parametres,$membre,$idMembre);
			
			$data['succes']['mdp'] = "Modification effectuées avec succès";		
			$this->update($data);			
			

		}else{
			if($old != $this->session->userdata('password')){
				$data['erreur']['mdp'] = 'l\'ancien mot de passe n\'est pas correct';					
			}else{
				if($new != $confirm){
					$data['erreur']['mdp'] = 'nouveau mot de passe et confirmation sont différents';						
				}
			}
			
			$this->update($data);
		}	
	}

	public function updateEmail(){
		$id_membre = $this->session->userdata('idMembre');
		
		$data['erreur'] = null;
		$email = null;

		$oldMail = $this->session->userdata('email');
		$email = $this->input->post('adresse_email');

		if(filter_var($email, FILTER_VALIDATE_EMAIL) && ($email != $this->session->userdata('email'))){			

			$ma = new Membre_adapter();
			$ma->updateEmail($id_membre,$email);

			$m = new Membre_model($this->session->userdata('idMembre'), 
				$this->session->userdata('nom'), 
				$this->session->userdata('prenom'), 
				$email, 
				$this->session->userdata('login'),
				$this->session->userdata('password'),
				$this->session->userdata('dateInscription'), 
				$this->session->userdata('derniereConnexion'), 
				$this->session->userdata('actif'), 
				$this->session->userdata('administrateur')
			);

			//LOG
			// $fl = new Form_log_adapter();
			// $membre = $this->session->userdata('prenom')." ".$this->session->userdata('nom');		
			// $params = array('new_email'=>$email,'old_email'=>$oldMail);
			// $parametres = json_encode($params);				
			// $idMembre = $this->session->userdata('idMembre');
			//$fl->insertLog(6,22,$parametres,$membre,$idMembre);

			$data['succes']['email'] = "Modification effectuées avec succès";
			$this->update($data);
			
		}else{			
			if($email == $this->session->userdata('email')){
				$data['erreur']['email'] = 'la même adresse email est déjà encodée';
			}else{
				$data['erreur']['email'] = 'format d\'email incorrect';	
			}
			
			$this->update($data);
		}
	}

	public function show($what,$data=''){

		switch ($what) {
			case 'calendrier':
				
				$da = new Division_adapter();
				$data['divisions'] = $da->getAllDivisions();

				$ea = new Equipe_adapter();
				$data['equipes'] = $ea->getAllEquipes();

				$ma = new Match_adapter();
				$data['calendrier'] = $ma->getAllMatchsOfThisYear();
				

				break;
			case 'match':
				
				$ma = new Match_adapter();
				$data['matchs'] = $ma->getAllMatchsOfThisYearNotUpdatedYet();

				break;
			case 'membre':

				$m = new Membre_adapter();
				$data['membres'] = $m->getAllMembre();						

				break;

			case 'cotisation':
				$m = new Membre_adapter();
				$data['membres'] = $m->getAllActiveMembre();
				$data['infos'] = array('id_membre'=>'Membre', 'cotisation_paye'=>'A déjà payé','cotisation_total'=>'Total à payer','reste'=>'Reste à payer');

				break;

			case 'log':
				$f = new Form_log_adapter();
				$data['formLogs'] = $f->getAllFormLog();		

				break;

			case 'drivertool':
				$d = new Drivertool_adapter();
				$data['driverLog'] = $d->getAllDriverTool();				

				break;

			case 'curlcalendrier':
				$ma = new Match_adapter();
				$data['calendrier'] = $ma->getAllMatchsOfThisYear();
				
				break;
		}

		$this->load->view('tags/header');
		$sa = new Sidebar_adapter();
		$sa->generateSideBar();
		$this->load->view('tags/admin/manage/'.$what,$data);
		$this->load->view('tags/footer');
	}

	public function add($what,$data=''){
		switch ($what) {
			case 'calendrier':
				$division =  $this->input->post('division');
				$adversaire = $this->input->post('adversaire');
				$date = $this->input->post('date');
				$reference =  $this->input->post('reference');
				$localisation =  $this->input->post('localisation');
				$ma = new Match_adapter();
				$ca = new Calendrier_adapter();

				$date = $ca->dateToSql($date);
				$ma->addCalendar($division,$adversaire,$date,$reference,$localisation);

				//LOG
				// $fl = new Form_log_adapter();
				// $membre = $this->session->userdata('prenom')." ".$this->session->userdata('nom');		
				// $params = array('id_division'=>$division,'id_adversaire'=>$adversaire,'date'=>$date,'reference'=>$reference,'localisation'=>$localisation);
				// $parametres = json_encode($params);		
				// $idMembre = $this->session->userdata('idMembre');		
				//$fl->insertLog(5,11,$parametres,$membre,$idMembre);

				$data['succes']['calendrier'] = "Match ajouté avec succès";		
				$this->show('calendrier',$data);
				
				break;

			case 'membre':
				$nom = $this->input->post('nom');
				$prenom = $this->input->post('prenom');
				$email = $this->input->post('email');

				$ma = new Membre_adapter();
				$ma->insertMembre($nom,$prenom,$email);

				$coa = new Cotisation_adapter();
				$coa->insertMembreIntoCotisation($nom,$prenom);


				//LOG
				// $fl = new Form_log_adapter();
				// $membre = $this->session->userdata('prenom')." ".$this->session->userdata('nom');		
				// $params = array('nom'=>$nom,'prenom'=>$prenom,'email'=>$email);
				// $parametres = json_encode($params);	
				// $idMembre = $this->session->userdata('idMembre');			
				//$fl->insertLog(5,8,$parametres,$membre,$idMembre);

				$data['succes']['membre'] = "Membre ajouté avec succès";		
				$this->show('membre',$data);				
										
				break;

			case 'cotisation':

				$apayer = $this->input->post('cotisation_paye');
				$total = $this->input->post('cotisation_total');
				$idMembre = $data;
				$data = null;
				if($apayer <= $total){
					$coa = new Cotisation_adapter();
					$coa->updateCotisationByMembre($idMembre,$apayer,$total);															
					$data['succes']['cotisation'] = "Modifications effectuées avec succès";
				}else{
					$data['erreur']['cotisation'] = "Le montant total est inféreur au montant déjà payé";
				}

				$this->show('cotisation',$data);


				break;

			case 'curlcalendrier':
				$division = $this->input->post('division');				
				$this->synchroCalendrier($division);
				$data = null;
				$this->show('curlcalendrier',$data);
				
				break;
		}
	}

	

	public function active($idMembre){

		$ma = new Membre_adapter();
		$ma->activeMembre($idMembre);
		$this->show('membre');

	}
	public function deactive($idMembre){

		$ma = new Membre_adapter();
		$ma->deactiveMembre($idMembre);
		$this->show('membre');
		
	}

	



}