<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ad_msg extends CI_Controller {
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		
		if(!$this->comman_fun->check_record('d2v_admin',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']))){
			header('Location: '.base_url().'index.php/d2v/page/view/');
			exit;
		}
		
		$this->load->model('d2v/ad_module','ObjM',TRUE); 
		
 	}
	
	public function index($eid){
		$this->view();
	}
	
	public function view($eid){
		
		$data['result']	=	$this->ObjM->get_admin_msg();
		$this->view_all_msg();
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('d2v/admin/ad_msg',$data);
		$this->load->view('comman/footer');	
	}
	
	function delete($id){
		$data				=	array();	
		$data['to_status']	=	'0';
		$this->comman_fun->update($data,'d2v_message',array('id'=>$id));
	} 
	
	function view_all_msg(){
		$data				=	array();	
		$data['to_status']	=	'2';
		$this->comman_fun->update($data,'d2v_message',array('to_status'=>'1','send_to'=>'0'));
	}
	
}

