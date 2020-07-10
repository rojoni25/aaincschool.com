<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class marketing_product extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;} 
		$this->load->model('marketing_product_module','ObjM',TRUE);
		
 	}
	
	public function one_time_payment($eid)
	{
		
		if($eid=='viral'){
			$data['title']='Viral Marketing Payment';
			$type='viral';
		}else{
			$data['title']='NDA Payment';
			$type='nda';
		}
		$data['result']=$this->ObjM->one_time_payment($type);	
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('marketing/one_time_payment_report',$data);
		$this->load->view('comman/footer');
	
	}
	
	function nda_agree()
	{
		$data['title']='NDA Agree Report';
		$data['result']=$this->ObjM->nda_agree();	
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('marketing/nda_agree',$data);
		$this->load->view('comman/footer');
	}
	
	
}


