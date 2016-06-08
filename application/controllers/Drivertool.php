<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Drivertool extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('dao/calendrier_adapter');
		$this->load->model('dao/division_adapter');		
		$this->load->model('dao/drivertool_adapter');	
		$this->load->model('dao/equipe_adapter');
		$this->load->model('dao/form_log_adapter');
		$this->load->model('dao/membre_adapter');
		$this->load->model('dao/match_adapter');
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



	public function show(){

		$ma = new Match_adapter();
		$data['matchs'] = $ma->getAllMatchsOfThisYear();

		$this->load->view('tags/header');
		$this->generateSideBar();		
		$this->load->view('tags/membre/drivertool/drivertool',$data);
		$this->load->view('tags/footer');
		
	}

	public function save(){
		
		//$this->form_validation->set_rules('travelCost','Coût','required');

		$dt = new Drivertool_adapter();		
		$cost = $this->input->post('cout');
		$idMatch = $this->input->post('id_match');
		$idMembre = $this->input->post('id_membre');


		if(strpos($cost, ',') !== false){
			$cost = str_replace(',','.',$cost);
		}


		$dt->insertOrUpdate($idMatch,$idMembre,$cost);

		$isTookHisCar = $dt->isTookHisCar($idMatch,$idMembre);

		//LOG
		$fl = new Form_log_adapter();
		$membre = $this->session->userdata('prenom')." ".$this->session->userdata('nom');		
		$params = array('id_match'=>$idMatch,'id_membre'=>$idMembre,'car'=>$isTookHisCar);
		$parametres = json_encode($params);	
		$idMembre = $this->session->userdata('idMembre');			
		//$fl->insertLog(3,5,$parametres,$membre,$idMembre);

		$this->show();
	}




}

			