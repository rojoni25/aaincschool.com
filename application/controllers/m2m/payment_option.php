<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class payment_option extends CI_Controller {
	
	protected $m2m_admin='123';
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		//---------------------smfund---------------------
		if(($smfund_admin_valid)||($this->session->userdata['logged_smfund_member'])){header('Location: '.smfund().'welcome/view');exit;}
		//---------------------smfund---------------------
		
 	}
	
	public function index()
	{
		$data['result']		=	$this->comman_fun->get_table_data('payment_account_option',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode'],'status !='=>'Delete'));
		$data['contain']	=	$this->comman_fun->get_table_data('cms_pages_master',array('pagelable'=>'payment_receiving_option'));
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('m2m/member/payment_option',$data);
		$this->load->view('comman/footer');
	}
	
	
	
	
	
	function insertrecord(){
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{	
			$now = time();
			$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
			$data = array();
    		$data['name']			=	$_POST['name'];	
			$data['account_detail']	=	$_POST['account_detail'];
			$data['usercode']		=	$this->session->userdata['logged_ol_member']['usercode'];
			
			$this->comman_fun->addItem($data,'payment_account_option');
		}
		header('Location: '.base_url().'index.php/m2m/'.$this->uri->rsegment(1));
		exit;
	}
	
	function delete($eid){
		
		$data = array();
    	$data['status']			=	'Delete';	
		$this->comman_fun->update($data,'payment_account_option',array('id'=>$eid,'usercode'=>$this->session->userdata['logged_ol_member']['usercode']));
		header('Location: '.base_url().'index.php/m2m/'.$this->uri->rsegment(1));
		exit;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}

