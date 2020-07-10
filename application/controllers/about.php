<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		$this->load->model('home_module','',TRUE);
		$this->load->library('email');
   		
 	}
	public function index()
	{
		$data = array();
		$this->load->view('public/public_header',$data);
		$this->load->view('public/about_view',$data);
		$this->load->view('public/public_footer');
	}	
}


