<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class my_wallet extends CI_Controller {

	function __construct()
 	{
   		parent::__construct();
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		$this->load->model('my_wallet_model','ObjM',TRUE); 
 	}
	
	public function index()
	{
		$data['result']=$this->ObjM->get_balance();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('my_wallet_view',$data);
		$this->load->view('comman/footer');
	}
	
	

}

