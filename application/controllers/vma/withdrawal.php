<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class withdrawal extends CI_Controller {
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
		$this->load->library('vma_class');
		if(!$this->vma_class->check_in_tree()){
			header('Location: '.base_url().'/index.php/welcome');
			exit;	
		}
 	}
	
	public function add()
	{
		$data['payment']=$this->vma_class->main_balance();
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view(VMA_FOLDER.'withdrawal_add',$data);
		$this->load->view('comman/footer');	
	}
	
	function insert(){
		if($this->input->server('REQUEST_METHOD') === 'POST'){
			
			$payment	=	$this->vma_class->main_balance();
			$amount		=	(float)$_POST['amount'];
			
			if(!$this->comman_fun->check_record('vma_withdrawal',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode'],'status'=>'process'))){
				if($amount <= $payment['balance']){
					$data	=	array();
					$data['usercode']		=	$this->session->userdata['logged_ol_member']['usercode'];
					$data['amount']			=	$_POST['amount'];
					$data['text_dt']		=	$_POST['text_dt'];
					$data['date_dt']		=	date('Y-m-d');
					$data['timedt']			=	time();
					$data['type']			=	1;
					$data['status']			=	'process';
					$this->comman_fun->addItem($data,'vma_withdrawal');
					
					$msg='Request Send Successfully';
					
				}else{
					$msg='Balance Not Enough';
				}
				
			}else{
				$msg='One Request Already Pending';
			}	
		}
		
		$this->session->set_flashdata('show_msg',$msg);
		
		header('Location: '.vma_base().$this->uri->rsegment(1).'/add');
		exit;
		
		
	}
	
	
	
	
 	
	
}

