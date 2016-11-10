<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sidebar_adapter extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->model('dao/division_adapter');
	}

	public function generateSideBar(){
		$da = new Division_adapter();
		$data['divisions'] = $da->getAllDivisionsWherePlayed();
		$newdata = array(
					'divisions' =>$data['divisions'],                   	
              );
		$this->session->set_userdata($newdata);

		$this->load->view('tags/membre/home/sidebar');//,$data);
	}

}