<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ad_product extends CI_Controller {
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		$this->file_setting();
		if($this->session->userdata[MATRIX_SESSION_ADMIN]['access']!='true'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('kdk1/ad_product_model','ObjM',TRUE);	
 	}
	
	protected function file_setting()
	{
		if(file_exists(APPPATH. 'config/matrix_const/'.$this->uri->segment(1).'/const.php'))
		{
			include(APPPATH. 'config/matrix_const/'.$this->uri->segment(1).'/const.php');	
			if(!defined('MATRIX_TABLE_PRE')){ 		echo 'Seting Not proper {1}'; exit;}
			if(!defined('MATRIX_CODE_LLB')){ 		echo 'Seting Not proper {2}'; exit;}
			if(!defined('MATRIX_LLB')){ 			echo 'Seting Not proper {3}'; exit;}
			if(!defined('MATRIX_SYSTEM_ADMIN')){ 	echo 'Seting Not proper {4}'; exit;}
		}
		else{
			echo 'File Not Set';
			exit;
		}
	}
	
	public function view()
	{	
		$data['result']=$this->ObjM->get_all();	
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.MATRIX_FOLDER.'/admin/ad_product_view',$data);
		$this->load->view('comman/footer');
	}
	
	public function addnew($mode,$eid)
	{	
		
		$segment_set['mode']	=	($mode=='Edit') ? "Edit" : "Add";
		$segment_set['eid']		=	$eid;
		$data['segment_set']	=	$segment_set;
	
		if($segment_set['mode']=='Edit'){
			$data['result']=$this->ObjM->get_record_by_id($segment_set['eid']);	
		}
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.MATRIX_FOLDER.'/admin/ad_product_add',$data);
		$this->load->view('comman/footer');
	}
	
	
	
	
	function insert(){
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$now = time();
			$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
			$data = array();
				
			$data['product_name']		=	$_POST['product_name'];
			$data['description']		=	$_POST['description'];
			$data['status']				=	$_POST['status'];
			
		
			if($this->input->post('mode')=="Add")
			{
				$data['create_date']	=	$nowdt;	
				$data['create_by']		=	$this->session->userdata['logged_ol_member']['usercode'];	
				$this->ObjM->addItem($data,MATRIX_TABLE_PRE.'product');
				$msg='Product Page Add Successfully';
			}
			if($this->input->post('mode')=="Edit")
			{
				
				
				$data['update_date']	=	$nowdt;	
				$data['update_date']	=	$this->session->userdata['logged_ol_member']['usercode'];	
				$this->ObjM->update($data,MATRIX_TABLE_PRE.'product','product_code',$this->input->post('eid'));	
				$msg='Product Page Update Successfully';
			}
			
		}
		
		$this->session->set_flashdata('show_msg',$msg);
		
		header('Location: '.MATRIX_BASE.$this->uri->rsegment(1).'/view');
		exit;
		
				
	}
	
		
	
	
}

