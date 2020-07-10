<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class general extends CI_Controller {
	
	
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		if(!$this->comman_fun->check_record('vma_admin',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']))){header('Location: '.base_url().'index.php/vma/dashboard/view');exit;}
		$this->load->model('vma_ad/general_model','ObjM',TRUE);
 	}
	
	public function payment_confirm()
	{
		$data['result'] = $this->ObjM->get_payment_confirm();
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view('vma_ad/payment_confirm_list',$data);
		$this->load->view('comman/footer');
	}
	function payment_detail($eid)
	{
		$data['result'] = 	$this->comman_fun->get_table_data('vma_message',array('type'=>'payment_confirm','status'=>'Active','usercode'=>$eid));
		$data['member']	=	$this->comman_fun->get_table_data('membermaster',array('usercode'=>$eid));
			
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view('vma_ad/payment_confirm_detail',$data);
		$this->load->view('comman/footer');
	}
	
	function delete1($eid){
		$data=array();
		$data['status']='Inactive';
		$this->comman_fun->update($data,'vma_message',array('id'=>$eid));
		header('Location: '.vma_ad().$this->uri->rsegment(1).'/payment_confirm/');
		exit;
	}
	
	function delete2($eid){
		
		$result 	= 	$this->comman_fun->get_table_data('vma_message',array('id'=>$eid));
		
		$data=array();
		$data['status']='Inactive';
		$this->comman_fun->update($data,'vma_message',array('id'=>$eid));
		header('Location: '.vma_ad().$this->uri->rsegment(1).'/payment_detail/'.$result[0]['usercode'].'');
		exit;
	}
	
	
	
	
	
	
	
	
	
}

