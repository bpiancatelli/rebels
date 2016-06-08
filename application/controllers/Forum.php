<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forum extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('dao/division_adapter');
		$this->load->model('dao/forum_adapter');
		$this->load->model('dao/membre_adapter');
	}


/*
|--------------------------------------------------------------------------
| Forum's home page
|--------------------------------------------------------------------------
|
*/	

/*
|--------------------------------------------------------------------------
| Show content
|--------------------------------------------------------------------------
|
*/
	public function show($what, $idContent=''){
		$this->load->view('tags/header');
		$this->generateSideBar();

		$fa = new Forum_adapter();		
		$data['content'] = null;
		switch ($what) {
			case 'thematique':
				$data['titre'] = $what;
				$data['content'] = $fa->getAllThematiqueByDossier($idContent);
				break;
			case 'sujet':
				$data['titre'] = $what;
				$data['content'] = $fa->getAllSujetByThematique($idContent);
				break;
			case 'message':
				$data['titre'] = $what;
				$data['content'] = $fa->getAllMessageBySujet($idContent);
				break;
			case 'dossier':
			default:
				$data['titre'] = $what;
				$data['content'] = $fa->getAllForumDossier();
				break;	
		}

		$this->load->view('tags/forum/page', $data);
		$this->load->view('tags/footer');

	}
/*
|--------------------------------------------------------------------------
| Add content
|--------------------------------------------------------------------------
|
*/
	public function add($what){
		$this->load->view('tags/header');
		$this->generateSideBar();
		$this->load->view('tags/forum/add/form_'.$what);		
		$this->load->view('tags/footer');
	}

/*
|--------------------------------------------------------------------------
| Chack content
|--------------------------------------------------------------------------
|
*/
	public function check($what, $id=''){		
		$fa = new Forum_adapter();
		switch ($what) {
			
			case 'thematique':
				$nomThematique =  $this->input->post('nom_thematique');			
				$fa->insertNewThematique($nomThematique, $id);
				//$this->show('thematique');
				redirect('/forum/show/dossier/');
				break;

			case 'sujet':
				$titreMessage = $this->input->post('titre_sujet');
				$message = $this->input->post('sujet');
				$fa->insertNewSujet($id, $titreMessage, $message);
				redirect('/forum/show/dossier');
				break;

			case 'dossier':
			default:
				$nomDossier =  $this->input->post('nom_dossier');				
				$fa->insertNewDossier($nomDossier);
				//$this->show('dossier');
				redirect('/forum/show/dossier/');

				break;
		}
	}

/*
|--------------------------------------------------------------------------
| Sidebar
|--------------------------------------------------------------------------
|
*/	
	public function generateSideBar(){
		$da = new Division_adapter();
		$data['divisions'] = $da->getAllDivisionsWherePlayed();
		$newdata = array(
					'divisions' =>$data['divisions'],                   	
               );
		$this->session->set_userdata($newdata);

		$this->load->view('tags/membre/home/sidebar',$data);
	}

}
?>