<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('dao/sidebar_adapter');
		$this->load->model('dao/membre_adapter');
		$this->load->model('metier/curl_model');
		$this->load->helper('simple_html_dom');
	}

	public function curlmembre(){

		$ma = new Membre_adapter();

        $cm = new Curl_model();
        $page = utf8_encode($cm->post_data(FRBBS_LICENCE,'club=Li%E8ge_Rebel_Foxes&pdf=true&tri=Nom'));        
//die(var_dump($page));
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

		$data['players'] = $rowData;

		$players = $rowData;
        $formattedPlayer = array();

        foreach ($players as $key => $player) {
                    
			// get the header out
			if (count(array_keys($player)) > 0) {
	                        
	        	// consider that string in capital letter is the lastname
				$fullName = $player[1];
	        	$formattedPlayer[$key]['licence'] = preg_replace("/ /","",$player[2]);
	        	$splitName = explode(' ', $fullName);

		        foreach ($splitName as $value) {                                
			        if (strlen($value) > 0) {                                 
			            if(preg_match("/[A-Z]$/", $value)){			            			            
			            	$value = substr($value,0,1). strtolower(substr($value,1));			            

			                if (isset($formattedPlayer[$key]['lastname'])){
			                    $formattedPlayer[$key]['lastname'] = $formattedPlayer[$key]['lastname']." ".$value;
			                }else{
			                    $formattedPlayer[$key]['lastname'] = $value;
			                }                            

			            }else{
			                if (isset($formattedPlayer[$key]['firstname'])){
			                    $formattedPlayer[$key]['firstname'] = $formattedPlayer[$key]['firstname']." ".$value;
			                }else{
			                    $formattedPlayer[$key]['firstname'] = $value;
			                }                                        
			            }                                    
			        }
		       	}
				$ma->isExistingMember($formattedPlayer[$key]['lastname'], $formattedPlayer[$key]['firstname'], $formattedPlayer[$key]['licence']);
				        	
			}
        }

        $data['membres'] = $ma->getAllActiveMembre();

		$this->load->view('tags/header');
		$sa = new Sidebar_adapter();
		$sa->generateSideBar();				
		$this->load->view('tags/admin/manage/curlmembre',$data);
		$this->load->view('tags/footer');

	}

	public function active($idMembre){

		$ma = new Membre_adapter();
		$ma->activeAdmin($idMembre);
		$this->curlmembre();

	}
	public function deactive($idMembre){

		$ma = new Membre_adapter();
		$ma->deactiveAdmin($idMembre);
		$this->curlmembre();
		
	}

}