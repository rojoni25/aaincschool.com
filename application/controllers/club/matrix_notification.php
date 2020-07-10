<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class matrix_notification extends CI_Controller { 
		
	function __construct()
 	{
	
   		parent::__construct(); 
		$this->file_setting();
		if($this->session->userdata[MATRIX_SESSION_MEMBER]['join']!='true'){header('Location: '.base_url().'index.php');exit;} 
		$this->load->model('matrix_comman/matrix_notification_model','ObjM',TRUE);
		
		
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
	
	function view($usercode)
	{
		$data['result']=$this->ObjM->get_notification();
		$this->ObjM->read_notification();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.MATRIX_FOLDER.'/member/matrix_notification_view',$data);
		$this->load->view('comman/footer');
	}
	
	function record_update($eid)
	{
		$data=array();
		$data['status_receiver']	=	'Delete';
		$this->ObjM->update($data,''.MATRIX_TABLE_PRE.'notification','id',$eid);
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
		
	
	

	
	

	
	

	
	
	
	
	 
}

