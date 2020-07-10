<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pay_report extends CI_Controller {
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('pay_report_model','ObjM',TRUE);
 	}
	
	public function software_licance()
	{
		$data['table_list']=true;
		$data['html']=$this->list_due_payment_report();
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view('report_due_payment');
		$this->load->view('comman/footer');
	}

	public function affiliate_payment()
	{
		
	}

}