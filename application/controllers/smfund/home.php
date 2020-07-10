<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
 	}
	
	public function index()
	{
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('smfund/home_view');
		$this->load->view('comman/footer');
	}
	
	
}

