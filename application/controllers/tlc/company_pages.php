<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class company_pages extends CI_Controller {
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		$this->file_setting();
		if($this->session->userdata[MATRIX_SESSION_MEMBER]['join']!='true'){header('Location: '.base_url().'index.php');exit;}
		$this->load->model('matrix_comman/company_model','ObjM',TRUE);
		
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
	
	public function view($id)
	{	
		$data['result']=$this->ObjM->get_all(true);	
	
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.MATRIX_FOLDER.'/member/company_view',$data);
		$this->load->view('comman/footer');
	}
	
	function detail($id){
		
		$data['result']=$this->ObjM->get_record_by_id($id,true);	
		
		if(isset($data['result'][0])){
			
			$this->ObjM->company_page_hit($data['result'][0]['company_code']);
			
			$this->load->view('comman/topheader');
			$this->load->view('comman/header');
			$this->load->view(''.MATRIX_FOLDER.'/member/company_detail',$data);
			$this->load->view('comman/footer');
		}else{
			header('location: '.MATRIX_BASE.''.$this->uri->rsegment(1).'/view');
			exit;
		}
		
		
	
	}
	
	
	
	
	
	
	
	
}

