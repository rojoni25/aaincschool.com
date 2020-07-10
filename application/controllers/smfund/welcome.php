<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class welcome extends CI_Controller {
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
		if(!$this->session->userdata('logged_smfund_member')){header('Location: '.base_url().'index.php/welcome');exit;} 
 	}
	
	public function view()
	{
		$data['contain']	=	$this->comman_fun->get_table_data('smfund_cms_pages_master',array('pagelable'=>'welcome'));
	
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('smfund/welcome_view',$data);
		$this->load->view('comman/footer');
	}
	
	
}

