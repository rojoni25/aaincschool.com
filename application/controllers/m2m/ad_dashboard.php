<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ad_dashboard extends CI_Controller {

	protected $m2m_admin='123';
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 	
		$this->load->model('m2m/ad_module','ObjM',TRUE);
 	}
	
	public function index(){
		$this->view();
	}
	
	public function view(){
		
		$data['join_request']	=	$this->ObjM->count_join_request();
		$data['under_process']	=	$this->ObjM->count_under_process();
		$data['m2m_member']		=	$this->ObjM->count_m2m_member();
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('m2m/admin/dashboard',$data);
		$this->load->view('comman/footer');			
	}
	
	
	
	
	
	
	
	
   
	
	
	
	
	
	
	
	
}


