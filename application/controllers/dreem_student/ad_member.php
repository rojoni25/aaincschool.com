<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ad_member extends CI_Controller {

	protected $admin='123';
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 	
		if(!$this->comman_fun->check_record('dreem_student_admin',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']))){
			header('Location: '.base_url());exit;
		}
		
		$this->load->model('dreem_student/ad_module','ObjM',TRUE); 
 	}
	
	
	function member_list(){
		
		$data['result']=$this->ObjM->member_list();
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('dreem_student/admin/member_list_view',$data);
		$this->load->view('comman/footer');	
	}
	
	
}


