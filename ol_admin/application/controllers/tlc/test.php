<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
echo 'dsfsd';
class r_matrix_test extends CI_Controller {
	
	protected $upling_user		=	'';
	protected $upling_posi		=	'';
	protected $tot_downline		=	0;
	
	
	function __construct()
 	{
		
   		parent::__construct(); 
		
		$this->file_setting();
		//if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		//if($this->session->userdata[MATRIX_SESSION_ADMIN]['access']!='true'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('matrix_comman/r_matrix_model','ObjM',TRUE);
		$this->load->library('email');
		
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
	function dashboard()
	{
		$data['tot_member']				=	$this->ObjM->get_tot_count_active();
		$data['tot_request']			=	$this->ObjM->get_tot_count_request();	
		$data['tot_access_code_request']=	$this->ObjM->get_tot_count_access_code_request();	
		$data['unuse']					=	$this->ObjM->unuse_access_code();
		
		$data['send_pif']				=	$this->ObjM->get_tot_send_pif();
		$data['remaining_pif']			=	$this->ObjM->get_tot_remaining_pif();	
		
		$data['tot_extra_position']		=	$this->ObjM->count_request_extra_position();	
		$data['pif_request']			=	$this->ObjM->get_tot_pif_request();
		
		$data['tot_pending_withdrawal']	=	$this->ObjM->get_tot_pending_withdrawal();	
		
		$data['tot_msg']				=	$this->ObjM->get_tot_msg();	
		
		
		
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('tlc/admin/r_matrix_dashboard',$data);
		$this->load->view('comman/footer');	
	}
}
?>