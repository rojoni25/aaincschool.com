<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class withdrawal extends CI_Controller {

	function __construct()
 	{
   		parent::__construct();
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		$this->load->library('diamond_class');
 	}
	
	
	
	public function request()
	{
	
		
		$data['payment']			=	$this->diamond_class->main_balance();
		$data['withdrawal_list']	=	$this->comman_fun->get_table_data('diamond_withdrawal',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode'],'status'=>'Confirm'));
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('diamond/withdrawal_request',$data);
		$this->load->view('comman/footer');
	}
	
	function insert(){
		if($this->input->server('REQUEST_METHOD') === 'POST'){
			
			$payment	=	$this->diamond_class->main_balance();
			$amount		=	(float)$_POST['amount'];
			
			if(!$this->comman_fun->check_record('diamond_withdrawal',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode'],'status'=>'process'))){
				if($amount <= $payment['balance']){
					$data	=	array();
					$data['usercode']		=	$this->session->userdata['logged_ol_member']['usercode'];
					$data['amount']			=	$_POST['amount'];
					$data['text_dt']		=	$_POST['text_dt'];
					$data['date_dt']		=	date('Y-m-d');
					$data['timedt']			=	time();
					$data['type']			=	1;
					$data['status']			=	'process';
					$this->comman_fun->addItem($data,'diamond_withdrawal');
					
					$msg='Request Send Successfully';
					
				}else{
					$msg='Balance Not Enough';
				}
				
			}else{
				$msg='One Request Already Pending';
			}	
		}
		
		$this->session->set_flashdata('show_msg',$msg);
		
		header('Location: '.diamond_base().$this->uri->rsegment(1).'/request');
		exit;
		
		
	}
	
	
	
	
	
	
	
	
	

}

