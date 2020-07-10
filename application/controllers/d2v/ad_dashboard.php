<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ad_dashboard extends CI_Controller {
	
	protected $upling_user	=	'';
	protected $upling_posi	=	'';
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 	
		$this->load->model('d2v/ad_module','ObjM',TRUE); 
		$this->load->library('email');
		
		if(!$this->comman_fun->check_record('d2v_admin',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']))){
			header('Location: '.base_url().'index.php/d2v/page/view/');
			exit;
		}
 	}
	
	function index(){
		$this->view();
	}
	
	function view(){
		
		$data['count_request']	=	$this->ObjM->count_request();	
		$data['count_member']	=	$this->ObjM->count_member();	
		$data['count_msg']		=	$this->ObjM->count_msg();			
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('d2v/admin/dashboard',$data);
		$this->load->view('comman/footer');	
	}

	
	
	
	
	
	
	
   
	
	
	
	
	
	
	
	
}


