<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class member_inactive extends CI_Controller {
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('member_inactive_model','ObjM',TRUE);
		$this->load->library('upload');
		$this->load->library('image_lib');
 	}
	

	function index()
	{
		if($_POST['user_code']!=''){
			$data['result'] = $this->ObjM->get_member_by_id($_POST['user_code']);
			$data['child']  = $this->ObjM->get_child_member_by_code($_POST['user_code']);
		}
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('member_inactive_add',$data);
		$this->load->view('comman/footer');
	}
	
	function remove_to_paid()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{	
			$now = time();
			$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
			
			if($_POST['usercode']==''){
				header('Location: '.base_url().'index.php/'.$this->uri->segment(1));
				exit;	
			}
			
			$mem_chk = $this->ObjM->get_member_by_id($_POST['usercode']);
			if(!isset($mem_chk[0])){
				header('Location: '.base_url().'index.php/'.$this->uri->segment(1));
				exit;	
			}
			$child= $this->ObjM->get_child_member_by_code($_POST['usercode']);
			if(!isset($child[0])){
				$this->remove_process();
			}
		}
		
	}
	
	protected function remove_process(){
		
		
		
		$payment			= 	$this->ObjM->get_all_payment($_POST['usercode']);
		$member				= 	$this->ObjM->get_member_by_id($_POST['usercode']);
		$payment_paid		= 	$this->ObjM->get_all_payment_paid($_POST['usercode']);
		for($i=0;$i<count($payment);$i++){
			if($payment[$i]['type']=='3by3'){
				$balance_type='3by3';
			}
			elseif($payment[$i]['type']=='5by3'){
				$balance_type='5by3';
			}
			elseif($payment[$i]['type']=='10by3'){
				$balance_type='10by3';
			}
			else{
				$balance_type='main_balance';
			}
			$this->ObjM->balance_update($balance_type,$payment[$i]['usercode'],$payment[$i]['amount']);
		}
		
		
		$this->member_level_track_update(3);
		$this->member_level_track_update(5);
		$this->member_level_track_update(10);
		
		$this->ObjM->row_delete('ref_code',$_POST['usercode'],'payment_monthly');
		$this->ObjM->row_delete('usercode',$_POST['usercode'],'coded_residual');
		$this->ObjM->row_delete('usercode',$_POST['usercode'],'daily_payment_level');
		$this->ObjM->row_delete('usercode',$_POST['usercode'],'member_level_track_master');
		$this->ObjM->row_delete('usercode',$_POST['usercode'],'member_node_master');
		$this->ObjM->row_delete('usercode',$_POST['usercode'],'master_balance_sheet');
		$this->ObjM->row_delete('usercode',$_POST['usercode'],'paid_request_master');
		$this->ObjM->row_delete('usercode',$_POST['usercode'],'product_access_permission');
		
		
		$data=array();
		$data['status']		=	'Pending';
		$data['active_dt']	=	'0';
		$data['due_time']	=	'0';
		$data['referralid']	=	$member[0]['referralid_free'];
		$this->ObjM->update($data,'membermaster','usercode',$_POST['usercode']);
		
		$data=array();
		$data['usercode']				=	$_POST['usercode'];
		$data['payment_dt']				=	json_encode($payment_paid);
		$data['payment_update_dt']		=	json_encode($payment);
		$data['timedt']					=	time();
		$this->ObjM->addItem($data,'inactive_member_dt');
		
		//*****	member_level_track_master Update*****//
		$field1	=	array('level_one3','level_two3','level_three3');
		$field2	=	array('active_level_one3','active_level_two3','active_level_three3');
		
		header('Location: '.base_url().'index.php/'.$this->uri->segment(1));
		exit;
		
		
		
	}
	
	function member_level_track_update($level)
	{
		$field1	=	array('level_one'.$level.'','level_two'.$level.'','level_three'.$level.'');
		$field2	=	array('active_level_one'.$level.'','active_level_two'.$level.'','active_level_three'.$level.'');
		for($p=0;$p<=2;$p++){
			$rt=$this->ObjM->get_member_upling_level('uplingmember'.$level.'_3',$code);
			if(!isset($rt[0]['code'])){
				break;
			}
			$code=$rt[0]['code'];
			$this->ObjM->member_level_update($field1[$p],$field2[$p],$code);
		}
	}
	
	
}

