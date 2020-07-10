<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class monthly_payment_by_admin extends CI_Controller {
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('monthly_payment_by_admin_model','ObjM',TRUE);
		$this->load->library('upload');
		$this->load->library('image_lib');
 	}
	

	function index()
	{
		if($_POST['user_code']!=''){
			$data['result'] = $this->ObjM->get_member_by_id($_POST['user_code']);
			$data['current_balance'] = $this->ObjM->get_current_balance($_POST['user_code']);
			$data['payment_level'] = $this->ObjM->get_payment_level($_POST['user_code']);
		}
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('monthly_payment_by_admin_add',$data);
		$this->load->view('comman/footer');
	}
	
	
	
	
	
	
	
	
}

