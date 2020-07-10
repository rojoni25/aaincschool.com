<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class capture_pages_list extends CI_Controller {
	function __construct()
 	{
   		parent::__construct();
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
		if(!$this->session->userdata('logged_smfund_member')){header('Location: '.base_url().'index.php/welcome');exit;} 
		$this->load->model('smfund/comman_modul','ObjM',TRUE);
 	}
	
	
	function index(){
		
		$data['result']=$this->ObjM->get_capture_page_list();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('smfund/capture_pages_list',$data);
		$this->load->view('comman/footer');
		
	}
	
	
	
	

	
}

