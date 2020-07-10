<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class access_denied extends CI_Controller {

	function __construct()
 	{
   		parent::__construct();
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		
 	}
	
	public function index()
	{
		

		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('access_denied_view');
		$this->load->view('comman/footer');
	}
	
	
}

