<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ad_join_request extends CI_Controller {

	protected $m2m_admin='123';
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 	
		if(!$this->comman_fun->check_record('m2m_admin',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']))){
			header('Location: '.base_url());exit;
		}
		$this->load->model('m2m/ad_module','ObjM',TRUE); 
 	}
	
	public function index(){
		$this->view();
	}
	
	public function view(){
		
		$data['result']=$this->ObjM->get_join_request();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('m2m/admin/join_request_view',$data);
		$this->load->view('comman/footer');			
	}
	
	function process($eid){
		
		$data['result']=$this->ObjM->get_join_request_by_id($eid);
		$data['member']=$this->ObjM->member_list();
		
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('m2m/admin/join_request_process',$data);
		$this->load->view('comman/footer');				
	}
	
	function request_approve(){
		
		$data=array();
	
		$result=$this->ObjM->get_join_request_by_id($_POST['usercode']);
	
		if(isset($result[0])){
			$count_member		=	$this->comman_fun->count_record('m2m_member',array('upling'=>$_POST['downline_of']));
			
			
			if($count_member<2){
				$upling_record	=	$this->comman_fun->get_table_data('m2m_member',array('usercode'=>$_POST['downline_of']));
				
				
				
				$payment_to     =  ($upling_record[0]['upling']=='0') ? $this->m2m_admin : $upling_record[0]['upling'];
				
				$data['type']	=	'resiual';
				
			}else{
				$payment_to 	=	$_POST['downline_of'];
				$data['type']	=	'member';
			}
			
			
			
			$data['upling']		=	$_POST['downline_of'];
			$data['payto']		=	$payment_to;
			
		
			
			
			$this->comman_fun->update($data,'m2m_request',array('usercode'=>$_POST['usercode']));
			$this->session->set_flashdata('show_msg', 'Request Approve Successfully');
			header('Location: '.base_url().'index.php/m2m/'.$this->uri->rsegment(1).'/view/');
			exit;
		}else{
			echo 'invalid Request';
		}
	}
	
	function under_process(){
		$data['result']=$this->ObjM->under_process();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('m2m/admin/under_process_view',$data);
		$this->load->view('comman/footer');	
	}
	
	function payment_view($eid){

		$data['result']	 =	$this->ObjM->under_process_by_id($eid);
		if(isset($data['result'][0])){
			$data['list']	 =	$this->comman_fun->get_table_data('m2m_payment_confirmation',array('usercode'=>$eid));	
			$this->load->view('comman/topheader');
			$this->load->view('comman/header');
			$this->load->view('m2m/admin/under_process_payment',$data);
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
			
			$this->comman_fun->addItem($data,'m2m_member');
			$this->session->set_flashdata('show_msg', 'Approve Successfully');
			
			header('Location: '.base_url().'index.php/m2m/'.$this->uri->rsegment(1).'/under_process/');
			exit;
			
		}
	}
	
	
	
	
   
	
	
	
	
	
	
	
	
}


