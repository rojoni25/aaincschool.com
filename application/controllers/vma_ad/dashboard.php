<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dashboard extends CI_Controller {
	
	
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		if(!$this->comman_fun->check_record('vma_admin',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']))){header('Location: '.base_url().'index.php/vma/dashboard/view');exit;}
		$this->load->model('vma_ad/general_model','ObjM',TRUE);
 	}
	
	public function view()
	{
		$data['result'] = $this->ObjM->get_payment_confirm();
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view('vma_ad/dashboard_view',$data);
		$this->load->view('comman/footer');
	}
	
	
	
	
	
	
	
	
	
	
}

