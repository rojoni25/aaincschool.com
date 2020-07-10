<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dashboard extends CI_Controller {
	
	function __construct()
 	{
   		parent::__construct(); 
		
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
	
		if($this->session->userdata["logged_ol_member"]['usercode']!=PDL_SYSTEM_USER) { echo "Access Denied"; exit;}
		
		$this->load->model('pdl/admin/dashboard_model','ObjM',TRUE);
 	}
	

	function view(){
		
		$data['tot_member']	 		=	$this->ObjM->count_all_member();
		$data['payment']	 		=	$this->ObjM->sum_all_payment();
		$data['under_review']	 	=	$this->ObjM->count_under_review();
		$data['withdrawal_request']	=	$this->ObjM->count_withdrawal_request();
		$data['unread_message']		=	$this->ObjM->count_unread_message();
		
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('pdl_admin/dashboard_view',$data);
		$this->load->view('comman/footer');
	}
	
	
	
	
	
		
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}

