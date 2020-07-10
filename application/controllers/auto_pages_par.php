<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class auto_pages_par extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
		//---------------------smfund---------------------
		if(($smfund_admin_valid)||($this->session->userdata['logged_smfund_member'])){header('Location: '.smfund().'welcome/view');exit;}
		//---------------------smfund---------------------
		$this->load->model('pages_module','',TRUE);
   		
 	}
	
	public function page()
	{
		$data['result']=$this->pages_module->get_pages_contain($this->uri->segment(3));
		if(!isset($data['result'][0])){
			$data['result']=$this->pages_module->get_pages_contain('not_found');
		}
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view('auto_pages_view',$data);
		$this->load->view('comman/footer');
	
	}
	
}


