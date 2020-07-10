<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class n_product_report extends CI_Controller {
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('n_product_report_model','ObjM',TRUE);
		
 	}
	
	public function under_review()
	{
		$data['result']=$this->ObjM->under_review();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('n_product_rp_review',$data);
		$this->load->view('comman/footer');
	}
	
	public function payment()
	{
	
		$data['result']=$this->ObjM->get_payment_list();
		
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('n_product_rp_payment',$data);
		$this->load->view('comman/footer');
	}
	
	public function payment_flase()
	{

		$data['result']=$this->ObjM->get_payment_flase();
	
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('n_product_rp_payment_flase',$data);
		$this->load->view('comman/footer');
	}
	
	
	
	
	
		
}

