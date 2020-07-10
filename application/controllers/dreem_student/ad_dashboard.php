<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ad_dashboard extends CI_Controller {

	protected $admin='123';
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 	
		//---------------change--------------------------//
		if(!$this->comman_fun->check_record('dreem_student_admin',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode'])))
		{header('Location: '.base_url().'index.php/dashboard');exit;}
		//---------------change--------------------------//
		
		$this->load->model('dreem_student/ad_module','ObjM',TRUE);
 	}
	
	public function index(){
		$this->view();
	}
	
	public function view(){
		
		$data['join_request']	=	$this->ObjM->count_join_request();
		$data['under_process']	=	$this->ObjM->count_under_process();
		$data['count_member']	=	$this->ObjM->count_member();
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('dreem_student/admin/dashboard',$data);
		$this->load->view('comman/footer');			
	}
	
	
	
	
   
	
	
	
	
	
	
	
	
}


