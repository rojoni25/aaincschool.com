<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class rm_matrix_notification extends CI_Controller { 
		
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata["r_matrix_join"]['join']!='true'){header('Location: '.base_url().'index.php');exit;} 
		$this->load->model('rm_matrix_notification_model','ObjM',TRUE);
		
		
 	}
	
	function view($usercode)
	{
		$data['result']=$this->ObjM->get_notification();
		$this->ObjM->read_notification();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('r_matrix_member/rm_matrix_notification_view',$data);
		$this->load->view('comman/footer');
	}
	
	function record_update($eid)
	{
		$data=array();
		$data['status_receiver']	=	'Delete';
		$this->ObjM->update($data,'rm_notification','id',$eid);
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
		
	
	

	
	

	
	

	
	
	
	
	 
}

