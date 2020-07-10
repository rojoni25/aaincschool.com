<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pdl_member_home extends CI_Controller {
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		$this->load->model('pdl/pdl_member_home_model','ObjM',TRUE);		
		
 	}
	

	function view($eid){
		
	
		if($this->ObjM->check_in_tree())
		{
			$this->load->library('pdl_member_class');	
			
			$data['unread_message']		=	$this->ObjM->count_unread_message();
			
			$this->load->view('comman/topheader');
			$this->load->view('comman/header');
			$this->load->view('pdl_member/pdl_member_home',$data);
			$this->load->view('comman/footer');
		}
		else{
			echo "Access Denied";
			exit;
		}
	
	}
	

		
	
	
	
}

