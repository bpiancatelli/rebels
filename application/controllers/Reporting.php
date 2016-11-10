<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporting extends CI_Controller{


	public function __construct(){
		parent::__construct();
		$this->load->model('dao/calendrier_adapter');
		$this->load->model('dao/cotisation_adapter');	
		$this->load->model('dao/division_adapter');		
		$this->load->model('dao/equipe_adapter');
		$this->load->model('dao/form_log_adapter');
		$this->load->model('dao/membre_adapter');
		$this->load->model('dao/match_adapter');
		$this->load->model('dao/match_membre_adapter');
		$this->load->model('dao/membre_adapter');
		$this->load->model('dao/session_manager');
		$this->load->model('dao/sidebar_adapter');

		$sa = new Sidebar_adapter();
		$sa->generateSideBar();
		
	}


	/**
	*
	* Sending automatic updates with templated email
	*
	*/
	public function mailing(){



		$this->load->view('tags/header');		
		$this->load->view('tags/admin/email/mailing');
		$this->load->view('tags/footer');
		
	}

	public function preview(){
		$this->load->helper('date');

		$m = new Membre_adapter();
		$mma = new Match_membre_adapter();

		$lastWeek = date('Y-m-d',strtotime('-1 week'));		

		$data['top3']['avg'] = $mma->getTop3('avg',$lastWeek);
		$data['top3']['rbi'] = $mma->getTop3('rbi',$lastWeek);
		$data['top3']['runs'] = $mma->getTop3('runs',$lastWeek);

		$data['message'] = $this->load->view('tags/admin/email/report',$data,true);
		$data['receiver_email'] = $m->getEmails();
						
		$data['subject'] = "Rapport de match";

		$this->load->view('tags/header');		
		$this->load->view('tags/admin/email/preview',$data);
		$this->load->view('tags/footer');
		
		
	}

	public function sendMessage(){
		$m = new Membre_adapter();

		$message = $this->input->post('zone_message');

		$receiver_email = $m->getEmails();
		//$receiver_email = "b.piancatelli@gmail.com";
		
		$subject = "Breaking news";
				
		$this->load->library('email');		
		// Sender email address
		$this->email->set_newline("\r\n");
		$this->email->from('liegebaseballstats@gmail.com');
		// Receiver email address.for single email
		$this->email->to($receiver_email);
		//send multiple email
		
		// Subject of email
		$this->email->subject($subject);
		// Message in email
		$this->email->message($message);
		// It returns boolean TRUE or FALSE based on success or failure
		$this->email->send();

		$this->load->view('tags/header');
		redirect(base_url()."reporting/mailing",true);
		$this->load->view('tags/footer');


	}

	public function sendMail(){
		$this->load->helper('date');

		$m = new Membre_adapter();
		$mma = new Match_membre_adapter();

		$lastWeek = date('Y-m-d',strtotime('-1 week'));		

		$data['top3']['avg'] = $mma->getTop3('avg',$lastWeek);
		$data['top3']['rbi'] = $mma->getTop3('rbi',$lastWeek);
		$data['top3']['runs'] = $mma->getTop3('runs',$lastWeek);
				
		$receiver_email = $m->getEmails();
		//$receiver_email = "b.piancatelli@gmail.com";
		
		$subject = "Rapport de match";

		$message = $this->load->view('tags/admin/email/report',$data,true);
				
		$this->load->library('email');		
		// Sender email address
		$this->email->set_newline("\r\n");
		$this->email->from('liegebaseballstats@gmail.com');
		// Receiver email address.for single email
		$this->email->to($receiver_email);
		//send multiple email
		//$this->email->to(abc@gmail.com,xyz@gmail.com,jkl@gmail.com);
		// Subject of email
		$this->email->subject($subject);
		// Message in email
		$this->email->message($message);
		// It returns boolean TRUE or FALSE based on success or failure
		$this->email->send();

		$this->load->view('tags/header');
		redirect(base_url()."reporting/mailing",true);
		$this->load->view('tags/footer');
		
	}
}