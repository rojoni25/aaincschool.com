<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class join_request extends CI_Controller {

	protected $admin='123';
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 	
		//---------------change--------------------------//
		if(!$this->comman_fun->check_record('dreem_student_member',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode'])))
		{header('Location: '.base_url().'index.php/dashboard');exit;}
		//---------------change--------------------------//
		$this->load->model('dreem_student/me_module','ObjM',TRUE); 
 	}
	
	
	function under_process(){
		
		$data['result']			=	$this->ObjM->under_process();
		$data['contain']		=	$this->comman_fun->get_table_data('dreem_student_pages_master',array('pagelable'=>'under_process'));
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('dreem_student/member/under_process_view',$data);
		$this->load->view('comman/footer');	
	}
	
	
	

	function payment_view($eid){

		$data['result']	 =	$this->ObjM->under_process_by_id($eid);
		if(isset($data['result'][0])){
			$data['list']	 =	$this->comman_fun->get_table_data('dreem_student_payment_confirmation',array('usercode'=>$eid));	
			$this->load->view('comman/topheader');
			$this->load->view('comman/header');
			$this->load->view('dreem_student/member/under_process_payment',$data);
			$this->load->view('comman/footer');	
		}
		
	}
	
	function insert_tree($eid){
		$result	 =	$this->ObjM->under_process_by_id($eid);
		if(isset($result[0])){
			$data=array();
			$data['usercode']	=	$result[0]['usercode'];
			$data['upling']		=	$result[0]['upling'];
			$data['payto']		=	$result[0]['payto'];
			$data['create_date']=	date('Y-m-d h:i:s');
			$data['type']		=	$result[0]['type'];
			$this->comman_fun->addItem($data,'dreem_student_member');
			$this->session->set_flashdata('show_msg', 'Approve Successfully');
			
			header('Location: '.base_url().'index.php/dreem_student/'.$this->uri->rsegment(1).'/under_process/');
			exit;
			
		}
	}
	
}


