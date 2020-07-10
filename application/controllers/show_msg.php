<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class show_msg extends CI_Controller {

	function __construct()
 	{
   		parent::__construct();
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		
 	}
	
	public function payment_done()
	{
		$data['title']='Monthly Payment Successfully';
		$data['html']='<p>Your Monthly Payment Received Successfully</p>';
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_view',$data);
		$this->load->view('comman/footer');
	}
	
	
}

