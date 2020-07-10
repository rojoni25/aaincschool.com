<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ad_report extends CI_Controller {
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata["logged_ol_member"]['usercode']!=PDL_SYSTEM_USER) { echo "Access Denied"; exit;}
		$this->load->model('pdl/admin/ad_report_model','ObjM',TRUE);
		$this->load->library('email');
 	}
	
	
	
	public function payment_flase()
	{	
		$data['result']=$this->ObjM->get_payment_flase();	
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('pdl_admin/report_payment_flase',$data);
		$this->load->view('comman/footer');
	}
	
	public function payment()
	{	
		$data['result']=$this->ObjM->get_payment_list();	
		
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('pdl_admin/report_payment',$data);
		$this->load->view('comman/footer');
	}
	
	
	
	
	
	
	
	
	
	
	
	
}

