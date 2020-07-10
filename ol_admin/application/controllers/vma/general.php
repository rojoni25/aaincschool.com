<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class general extends CI_Controller {
	
	
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('vma/general_model','ObjM',TRUE);
 	}
	
	public function payment_confirm()
	{
		$data['result'] = $this->ObjM->get_payment_confirm();
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view(VMA_FOLDER.'payment_confirm_list',$data);
		$this->load->view('comman/footer');
	}
	function payment_detail($eid)
	{
		$data['result'] = 	$this->comman_fun->get_table_data('vma_message',array('type'=>'payment_confirm','status'=>'Active','usercode'=>$eid));
		$data['member']	=	$this->comman_fun->get_table_data('membermaster',array('usercode'=>$eid));
			
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view(VMA_FOLDER.'payment_confirm_detail',$data);
		$this->load->view('comman/footer');
	}
	
	function delete1($eid){
		$data=array();
		$data['status']='Inactive';
		$this->comman_fun->update($data,'vma_message',array('id'=>$eid));
		header('Location: '.vma_base().$this->uri->rsegment(1).'/payment_confirm/');
		exit;
	}
	
	function delete2($eid){
		
		$result 	= 	$this->comman_fun->get_table_data('vma_message',array('id'=>$eid));
		
		$data=array();
		$data['status']='Inactive';
		$this->comman_fun->update($data,'vma_message',array('id'=>$eid));
		header('Location: '.vma_base().$this->uri->rsegment(1).'/payment_detail/'.$result[0]['usercode'].'');
		exit;
	}
	
	function vma_admin($eid){
		
		if($eid!=''){		
			$data['result']  =  $this->comman_fun->get_table_data('membermaster',array('usercode'=>$eid));
			if(isset($data['result'][0])){
				$data['check']  =  $this->comman_fun->check_record('vma_admin',array('usercode'=>$eid));	
			}
		}
		
		$data['list']=$this->ObjM->get_vma_admin();
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(VMA_FOLDER.'vma_admin_view',$data);
		$this->load->view('comman/footer');	
		
	}
	
	function add_admin(){
		$data=array();
		if($_POST['usercode']!=''){
				$data['usercode']	=	$_POST['usercode'];	
				$this->comman_fun->addItem($data,'vma_admin');	
		}
	
		header('Location: '.vma_base().$this->uri->rsegment(1).'/vma_admin/');
		exit;
	}
	
	function delete_admin($eid){
		$data=array();
		$data['id']	=	$eid;	
		$this->comman_fun->delete('vma_admin',$data);
		header('Location: '.vma_base().$this->uri->rsegment(1).'/vma_admin/');
		exit;	
	}
	
	
	
	
	
	
	
}

