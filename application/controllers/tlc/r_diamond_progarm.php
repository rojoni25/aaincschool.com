<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class r_diamond_progarm extends CI_Controller {
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		$this->file_setting();
		if($this->session->userdata[MATRIX_SESSION_ADMIN]['access']!='true'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('matrix_comman/ad_comman','ObjM',TRUE);
		
		$this->load->library('upload');
		$this->load->library('image_lib');
		
 	}
	
	protected function file_setting()
	{
		if(file_exists(APPPATH. 'config/matrix_const/'.$this->uri->segment(1).'/const.php')){
			include(APPPATH. 'config/matrix_const/'.$this->uri->segment(1).'/const.php');	
			if(!defined('MATRIX_TABLE_PRE')){ 	echo 'Seting Not proper {1}'; exit;}
			if(!defined('MATRIX_CODE_LLB')){ 	echo 'Seting Not proper {2}'; exit;}
			if(!defined('MATRIX_LLB')){ 		echo 'Seting Not proper {3}'; exit;}
			if(!defined('MATRIX_SYSTEM_ADMIN')){ echo 'Seting Not proper {4}'; exit;}
		}
		else{
			echo 'File Not Set';
			exit;
		}
	}
	
	public function view($eid)
	{	
		
		
		$data['result']			=	$this->ObjM->get_diamond_report('True');
		$data['result2']			=	$this->ObjM->get_diamond_report('False');
			
		$data['count_true']		=	$this->ObjM->count_diamond_payment('True');
		$data['count_false']	=	$this->ObjM->count_diamond_payment('False');	
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.MATRIX_FOLDER.'/admin/r_diamond_progarm_report',$data);
		$this->load->view('comman/footer');
	}
	
	
	
	
	
	
	
	
}

