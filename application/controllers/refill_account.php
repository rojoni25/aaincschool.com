<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class refill_account extends CI_Controller {
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
		$this->load->model('view_friends_model','',TRUE);
		$this->load->library('upload');
		$this->load->library('image_lib');
		
 	}
	
	public function index()
	{
		
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view('refill_account_add');
		$this->load->view('comman/footer');
	}
	
	function insertrecord(){
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{	
			$refill_amount	=	(float)$_POST['refill_amount'];
			
			if (is_numeric($refill_amount)) {
				
        		$this->load->view('active_member_refill');
				
    		} else {
				
        		echo 'Invalid Amount';
				
   			}
		}
	}
	
	
	
	
	
	
	
}

