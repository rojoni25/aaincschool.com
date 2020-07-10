<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Terms extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		$this->load->model('home_module','',TRUE);
		$this->load->model('capture_pages_model','',TRUE);
		$this->load->library('email');
   		
 	}
	public function index()
	{
		$data = array();
		$data['contain']=$this->capture_pages_model->get_pages_contain('terms');
		$this->load->view('public/public_header',$data);
		$this->load->view('public/terms_view',$data);
		$this->load->view('public/public_footer');
	}	
}


