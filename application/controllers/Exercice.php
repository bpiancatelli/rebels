<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exercice extends CI_Controller{


	public function __construct(){
		parent::__construct();
		$this->load->model('dao/division_adapter');		
	}

	public function index(){		

		$data['difficultyLevel'] = array('0' => 'Facile','1' => 'Moyen','2' => 'Difficile');

		$this->load->view('tags/header');
		$this->generateSideBar();
		$this->load->view('tags/membre/exercice/exercice', $data);
		$this->load->view('tags/footer');


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

	public function retrieveLevel(){

		$level = $this->input->post('level');
		$this->showQuestions($level);
	}


	public function showQuestions($difficultyLevel){

		$data['difficultyLevel'] = array('0' => 'Facile','1' => 'Moyen','2' => 'Difficile');
		$data['level'] = $difficultyLevel;

		$data['questions'] = $this->generateQuestions();


		$this->load->view('tags/header');
		$this->generateSideBar();
		$this->load->view('tags/membre/exercice/question', $data);
		$this->load->view('tags/footer');


	}

	public function generateQuestions(){

		$retVal = array();
		$quest = array();

		$nbOuts = array(0,1,2);
		
		$first = false;
		$second = false;
		$third = false;

		$frappeArray = array(
				0 =>'en l\'air',
				1 =>'au sol',
				2 =>'derrière'
			);
		$options = array(
				0 => 'No play',
				1 => '1ère base',
				2 => '2ème base',
				3 => '3ème base',
				4 => 'Home plate',
				5 => 'Change field'
			);

        for($i = 1; $i <= 10; $i++) { 
			$out = rand(0, sizeof($nbOuts)-1);
			
			$typeDeFrappe = rand(0, sizeof($frappeArray)-1);
			$frappe = $frappeArray[$typeDeFrappe];

			$firstIn = rand(0,1);
			$secondIn = rand(0,1);
			$thirdIn = rand(0,1);

			if ($firstIn == 1) {
				$first = true;
			}
			if($secondIn == 1) {
				$second = true;
			}
			if($thirdIn == 1){
				$thrid = true;				
			}

						

			$retVal['out'] = $out;
			$retVal['bases'] = array($first,$second,$third);
			$retVal['frappe'] = $frappe;
			$retVal['options'] = $options;
			$retVal['reponse'] = '';

			$quest[$i] = $retVal;
		}

		return $quest;
	}

	public function checkReponse(){

	}

}