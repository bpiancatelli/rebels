<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendrier_adapter extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function dateToSql($date){
		$date = explode('/',$date);		
		return $date[2]."-".$date[1]."-".$date[0];

	}

	public function sqlToDate($date){
		$date = explode('-',$date);		
		return $date[2]."/".$date[1]."/".$date[0];
	}

	public function suppressMidnight($date){
		$date = explode(' ', $date);
		return $date[0];
	}

}