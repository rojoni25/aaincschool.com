<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class request_approve extends CI_Controller {
	
	
	function __construct()
 	{
   		parent::__construct(); 
		$this->file_setting();
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		//if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		//if($this->session->userdata[MATRIX_SESSION_ADMIN]['access']!='true'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		//$this->load->model('matrix_comman/r_matrix_model','ObjM',TRUE);
		$this->load->library('email');
	
		
 	}
	
	protected function file_setting()
	{
		if(file_exists(APPPATH. 'config/matrix_const/'.$this->uri->segment(1).'/const.php')){
			include(APPPATH. 'config/matrix_const/'.$this->uri->segment(1).'/const.php');	
			if(!defined('MATRIX_TABLE_PRE')){ 	 echo 'Seting Not proper {1}'; exit;}
			if(!defined('MATRIX_CODE_LLB')){ 	 echo 'Seting Not proper {2}'; exit;}
			if(!defined('MATRIX_LLB')){ 		 echo 'Seting Not proper {3}'; exit;}
			if(!defined('MATRIX_SYSTEM_ADMIN')){ echo 'Seting Not proper {4}'; exit;}
		}
		else{
			echo 'File Not Set';
			exit;
		}
	}
	
	public function index()
	{
		//$data['result']		=	$this->ObjM->get_cms_page(MATRIX_TABLE_PRE.'matrix');
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.MATRIX_FOLDER.'/admin/r_matrix_request_approve',$data);
		$this->load->view('comman/footer');
	
	}
	
		


}
