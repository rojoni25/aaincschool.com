<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ad_dashboard extends CI_Controller {
	
	protected $upling_user		=	'';
	protected $upling_posi		=	'';
	protected $tot_downline		=	0;
	
	
	function __construct()
 	{
   		parent::__construct(); 
		$this->file_setting();
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata[MATRIX_SESSION_ADMIN]['access']!='true'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('kdk1/ad_dashboard_model','ObjM',TRUE);
		$this->load->library('email');
		
 	}
	
	protected function file_setting()
	{
		if(file_exists(APPPATH. 'config/matrix_const/'.$this->uri->segment(1).'/const.php')){
			include(APPPATH. 'config/matrix_const/'.$this->uri->segment(1).'/const.php');	
			if(!defined('MATRIX_TABLE_PRE')){ 		echo 	'Seting Not proper {1}'; exit;}
			if(!defined('MATRIX_CODE_LLB')){ 		echo 	'Seting Not proper {2}'; exit;}
			if(!defined('MATRIX_LLB')){ 			echo 	'Seting Not proper {3}'; exit;}
			if(!defined('MATRIX_SYSTEM_ADMIN')){ 	echo 	'Seting Not proper {4}'; exit;}
		}
		else{
			echo 'File Not Set';
			exit;
		}
	}
	
	function dashboard()
	{
		$data['tot_member']		=	$this->ObjM->count_member();
		$data['join_request']	=	$this->ObjM->count_join_request();
		$data['code_request']	=	$this->ObjM->count_code_request();
		$data['count_msg']		=	$this->ObjM->count_unread_msg();
		$data['extra_position']	=	$this->ObjM->count_extra_position();
		$data['total_position']	=	$this->ObjM->get_total_position();
		$data['withdrawal_request']	=	$this->ObjM->count_withdrawal_request();
			
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.MATRIX_FOLDER.'/admin/ad_dashboard',$data);
		$this->load->view('comman/footer');	
	}
	
	
	
	
	
	
	
	
	
	

	 
}

