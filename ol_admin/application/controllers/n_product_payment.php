<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class n_product_payment extends CI_Controller {
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('n_product_tree_model','ObjM',TRUE);
		
 	}
	
	public function manual_payment($eid)
	{
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			if($_POST['search']=='Y'){
				if($_POST['membercode']!=''){
					$data['result']=$this->search_member();	
				}
			}
			if($_POST['get_payment']=='Y'){
				$r=$this->payment_insert();
				
				$msg=($r) ? "Member Payment Successfully" :"Payment Failed";;
	
				$this->session->set_flashdata('show_msg',$msg);	
				header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'/manual_payment/');
				
			}
			
		}
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('n_product_manual_payment',$data);
		$this->load->view('comman/footer');
	}
	
	
	protected function search_member(){
		
		$memberdt=$this->ObjM->search_member($_POST['membercode']);
		
		if(!isset($memberdt[0])){
			$arr['vali']	=	false;
			$arr['msg']		=	"Invailed Search";	
			return $arr;		
		}
		
		$arr['vali'] = true;
		$arr['dt']  = $memberdt[0];
		return $arr;
			
	}
	
	
	function remove_blog_permission($eid){
		$this->ObjM->remove_blog_permission($eid);
		
	}
	
	protected function payment_insert(){
		
		if(isset($_POST['usercode'],$_POST['product_type'])){
			$member_dt = $this->ObjM->get_member_by_usercode($_POST['usercode']);
			
			$result = $this->ObjM->product_member_dt($member_dt[0]['usercode']);
			
			if(!isset($result[0]))
			{
				$this->first_time_ams_product($member_dt[0]);	
			}
			$paymentcode	=	$this->member_payment_insert($member_dt[0]);
			
			if($paymentcode){
				return true;
			}
			
		}
		else{
			return false;
		}
		
		
	}
	
	
	//****Member Payment Intry****//
	protected function member_payment_insert($arr)
	{	
		
		$info_product	=	array();

		$member_record = $this->ObjM->product_member_dt($arr['usercode']);
		
		$data=array();
		
		if($_POST['product_type']=='2'){
			$amount=100;
		}else{
			$amount=15;
		}
		
		
		
		$last_due_time =	time();
		
		if(isset($member_record[0]))
		{
			if($member_record[0]['due_time']>time())
			{
				$last_due_time =	$member_record[0]['due_time'];
				
			}
		}
		
		if($amount==100)
		{
			$info_product['product_type']	=	'2';
			$info_product['due_time']		=	strtotime('+6 month',$last_due_time);
			
		}else
		{
			$info_product['product_type']	=	'1';
			$info_product['due_time']		=	strtotime('+1 month',$last_due_time);
		}
		
		$this->ObjM->update($info_product,'n_product_member','usercode',$arr['usercode']);
		

		$data['usercode']			=	$arr['usercode'];
		$data['amount']				=	$amount;
		$data['txn_id']				=	0; 
		$data['time_dt']			=	time();
		$data['option']				=	json_encode($_POST);
		$data['pay_type']			=	'Manual Payment';
		$id = $this->ObjM->addItem($data,'n_product_monthly_payment');
		return $id;
	}
	
	
	protected function first_time_ams_product($arr){
		//****get tree level****//
		
		$data=array();
		$data['usercode']			=	$arr['usercode'];
		$data['join_time']			=	time();
		$data['join_date']			=	strtotime(date('d-m-Y'));
		$data['due_time']			=	strtotime('+1 month',time());
		$data['upling']				=	$this->upling_user;
		$data['side']				=	$this->upling_posi;
		$this->ObjM->addItem($data,'n_product_member');
	}
	
	
	
	
	
	
		
		
		//****Next Level Member Get******//
		
	
	
	function blog_permission($id)
	{
	
		$data['result']	=	$this->ObjM->get_ams_member($id);	
		$data['member']	=	$this->ObjM->get_member_by_blog(2,$id);
		
		if(isset($data['result'][0])){
			$data['permission']=$this->ObjM->get_blog_permission($id);
		}
		
	
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('n_product_blog_permission',$data);
		$this->load->view('comman/footer');	
	
	}
	
	function blog_permission_insert()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$data=array();
			$data['usercode']		=	$_POST['usercode'];
			$data['permission_to']	=	$_POST['permission_to'];
			
			$this->ObjM->addItem($data,'n_product_blog_permission');
			
			header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'/blog_permission/'.$_POST['usercode'].'/');
		}
	}
	
	
		
}

