<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class request extends CI_Controller {
	
	protected $upling_user	=	'';
	protected $upling_posi	=	'';
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		if(!$this->comman_fun->check_record('vma_admin',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']))){header('Location: '.base_url().'index.php/vma/dashboard/view');exit;}
		$this->load->model('vma_ad/request_model','ObjM',TRUE);
		$this->load->library('vma_ad/vma_payment');
		$this->load->library('vma_ad/vma_class');
		
		
		
 	}
	
	public function view($eid)
	{
		$data['result'] = $this->ObjM->get_list();
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view('vma_ad/request_view',$data);
		$this->load->view('comman/footer');
	}
	
	function payment_confirm($eid){
		$result=$this->comman_fun->get_table_data('vma_request',array('request_code'=>$eid));
		if(isset($result[0])){
			$tree=$this->comman_fun->get_table_data('vma_member',array('usercode'=>$result[0]['usercode']));
			if(!isset($tree[0])){
				$data=array();
				$data['usercode'] 	= $result[0]['usercode'];
				$data['amount'] 	= '25';
				$data['date_dt'] 	= date('Y-m-d');
				$data['time_dt'] 	= time();
				$this->comman_fun->addItem($data,'vma_monthly_payment');
			}
		}
		
		header('Location: '.vma_ad().$this->uri->rsegment(1).'/view');
		exit;
	}
	
	function approve($eid){
		$result=$this->ObjM->get_request_by_id($eid);	
		if(isset($result[0])){
			$payment=$this->comman_fun->get_table_data('vma_monthly_payment',array('usercode'=>$result[0]['usercode']));
			if(isset($payment[0])){
				$this->first_lavel_set(1);
				
				$data['position_user']	=	$this->upling_user;
				
				$data['upling_chain']	=	$this->vma_class->upling_chain($data['position_user']);
				
				
				
				$data['member']=$this->ObjM->get_member_list();
				$data['result']=$result[0];
				$this->load->view('comman/topheader');
				$this->load->view('comman/header');
				$this->load->view('vma_ad/approve_add',$data);
				$this->load->view('comman/footer');	
			}
		}
	}
	
	function approve_insert(){
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$result=$this->ObjM->get_request_by_id($_POST['request_code']);	
			if(isset($result[0])){
				$payment=$this->comman_fun->get_table_data('vma_monthly_payment',array('usercode'=>$result[0]['usercode']));
				if(isset($payment[0])){
					$id		=	$this->_approve_insert($result[0]);
					$this->vma_payment->payment($result[0]['usercode'],$payment[0]['id']);
					$msg='Member approve successfully';	
				}
				else{
					$msg='Payment not confirm';	
				}
			}else{
				$msg='Invaid Request';	
			}
			$this->session->set_flashdata('show_msg',$msg);
		}
		
		header('Location: '.vma_ad().$this->uri->rsegment(1).'/view/');
		exit;		
	}
	
	protected function _approve_insert($result){
		
		
		if($_POST['downline']=='select_postion')
		{
			if($_POST['selected_user_code']=='')
			{
				$this->session->set_flashdata('show_msg','Error: Referral Not Select');
				header('Location: '.vma_ad().$this->uri->rsegment(1).'/view/');
				exit;		
			}else{
				$referral=$_POST['selected_user_code'];
			}
		}else{
			$referral='1';
		}
		
		$this->first_lavel_set($referral);
		$data=array();
		$data['usercode']	=	$result['usercode'];
		$data['upling']		=	$this->upling_user;
		$data['side']		=	$this->upling_posi;
		$data['referral']	=	$referral;
		$data['timedt']		=	date('Y-m-d');
		$data['due_time']	=	strtotime("+1 months", time());
		$new_code			=	$this->comman_fun->addItem($data,'vma_member');
		return $new_code;
		
	}
	
	
	
	protected function first_lavel_set($eid){
		
		$result	=	$this->ObjM->get_downline($eid);	
		///level One Setting///
		if(count($result)<3){
			$this->upling_user = $eid;
			$this->upling_posi = count($result)+1;
			return;	
		}
		
		for($i=0;$i<count($result);$i++){
			$arr[]=$result[$i]['usercode'];
		}
		
		$this->tree_check_postion($arr);
	}
	
	
	
	protected function tree_check_postion($arr_mem){
		
		for($pos=0;$pos<3;$pos++){
			
			for($i=0;$i<count($arr_mem);$i++){
				
				$result=$this->ObjM->get_count_downline($arr_mem[$i]);
				
				if($result[0]['tot']<$pos+1){
				
					$this->upling_user = $arr_mem[$i];
					$this->upling_posi = $result[0]['tot']+1;
					return;		
				}
			
			}
		}
		
		
		
		/////
		$child_mem=array();
		for($i=0;$i<count($arr_mem);$i++){
			
			$child_mem[]=$this->ObjM->get_downline($arr_mem[$i]);			
			
		}
		
		
		$re_arr=array();
		for($pos=0;$pos<5;$pos++){
			
			for($i=0;$i<count($child_mem);$i++){
				
				$re_arr[]=$child_mem[$i][$pos]['usercode'];					
			
			}
		}
		
		$this->tree_check_postion($re_arr);
		
	}
	
	
	
	
	
	
	
	
}

