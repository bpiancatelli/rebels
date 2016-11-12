<?php 

class Error_handler_adapter extends CI_Model{

	public function __construct(){
		parent::__construct();	
		$this->load->model('metier/error_handler');
		$this->load->database();
	}

	public function getMessageById($code){

		$query = $this->db->select('*')
				->from('error_handler')
				->where('code',$code)
				->get();

		
		$eh = new Error_handler();
		return $eh->hydrate($query->result()[0]);

	}


}