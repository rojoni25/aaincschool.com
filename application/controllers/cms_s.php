<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cms_s extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		$this->load->model('cms_s_module','ObjM',TRUE);
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
   		
 	}
	public function page($eid)
	{
		$data['contain']=$this->ObjM->get_custom_page($eid);
		
		
		
		if(isset($data['contain'][0])){
			$data['permistion']=$this->ObjM->ger_permistion($data['contain'][0]['pagecode']);
		}
		
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('cms_s_view',$data);
		$this->load->view('comman/footer');
	
	}
	

}


