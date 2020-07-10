<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class nda extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
		$this->load->model('nda_module','ObjM',TRUE);
		$this->load->library('email');
   		
 	}
	
	function page(){
		
		$data['result']=$this->ObjM->get_pages_contain($_REQUEST['page_key']);
		
		if($data['result'][0]['page_type']=='nda_page')
		{
			$data['agree']=$this->ObjM->check_agree();
			
			$this->load->view('comman/topheader');
			$this->load->view('comman/header');
			$this->load->view('nda_page_view',$data);
			$this->load->view('comman/footer');	
		}
		else{
			header('Location: '.base_url().'index.php/scompany');
			exit;
		}
		
	}
	
	function agree(){
		$r=$this->ObjM->check_agree();
		
		if(!isset($r[0])){
			$data				=	array();
			$data['usercode']	=	$this->session->userdata['logged_ol_member']['usercode'];
			$data['ip']			=	$_SERVER['REMOTE_ADDR'];
			$data['browserdt']	=	$_SERVER["HTTP_USER_AGENT"];
			$this->ObjM->addItem($data,'nda_agree');
		}
		
		header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'/page?page_key='.$_REQUEST['page_key']);
		exit;
		
	}
	
	
}


