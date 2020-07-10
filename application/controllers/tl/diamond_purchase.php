<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class diamond_purchase extends CI_Controller {
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		$this->file_setting(); 
		if($this->session->userdata[MATRIX_SESSION_MEMBER]['join']!='true'){header('Location: '.base_url().'index.php');exit;} 
		$this->load->model('matrix_comman/martix_module','ObjM',TRUE);
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
	
	public function purchase()
	{
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.MATRIX_FOLDER.'/member/diamond_purchase_view',$data);
		$this->load->view('comman/footer');
	}
	
	function payment()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			
			$amount= (float)$_POST['amount'];
			
			if(is_numeric($amount))
			{
				$data['amount']=$amount;
				
				$this->load->view(''.MATRIX_FOLDER.'/member/diamond_purchase_online',$data);
			}
		}
	}	
	
	
	
	
		
}


