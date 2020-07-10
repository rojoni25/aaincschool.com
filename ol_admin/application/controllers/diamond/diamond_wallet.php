<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class diamond_wallet extends CI_Controller {
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('diamond/diamond_wallet_model','ObjM',TRUE);
		$this->load->library('diamond_class');
		$this->load->library('email');
 	}
	
	function view(){
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('diamond/dashboard_view');
		$this->load->view('comman/footer');
		
	}
	
	function payment_confirm() 
	{
		$data['result'] = $this->ObjM->get_payment_confirm();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('diamond/payment_confirm_view',$data);
		$this->load->view('comman/footer');	
	}
	
	function message()
	{
		$data['result'] = $this->ObjM->get_msg();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('diamond/message_view',$data);
		$this->load->view('comman/footer');	
	}
	
	function transaction($eid){
		
		if($eid!=''){		
			$data['result']  =  $this->comman_fun->get_table_data('membermaster',array('usercode'=>$eid));
			if(isset($data['result'][0])){
				$data['payment'] =  $this->diamond_class->main_balance($eid);
				
				$data['withdrawal_list']	=	$this->comman_fun->get_table_data('diamond_withdrawal',array('usercode'=>$eid,'status'=>'Confirm'));
				$data['payment_list']	=	$this->comman_fun->get_table_data('diamond_payment',array('usercode'=>$eid));
				
			}
		}
	
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('diamond/transaction_view',$data);
		$this->load->view('comman/footer');	
		
	}
	
	function insert(){
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{	
			
			if($_POST['transaction']=='credit'){
				$this->payment();
			}
			if($_POST['transaction']=='debit'){
				$this->withdrawal();
			}
		}
	}
	
	function withdrawal(){
		$payment	=	$this->diamond_class->main_balance($_POST['usercode']);
		$amount		=	(float)$_POST['amount'];	
		if($amount <= $payment['balance']){
			$data	=	array();
			$data['usercode']		=	$_POST['usercode'];
			$data['amount']			=	$_POST['amount'];
			$data['text_dt']		=	$_POST['txtdt'];
			$data['date_dt']		=	date('Y-m-d');
			$data['timedt']			=	time();
			$data['type']			=	1;
			$data['status']			=	'Confirm';
			$this->comman_fun->addItem($data,'diamond_withdrawal');
			
			$this->payment_withdrawal($_POST['usercode']);
			
			$msg='Withdrawal Successfully';
			
			
			
		}else{
			$msg='Balance Not Enough';
		}
		
		$this->session->set_flashdata('show_msg',$msg);
		
		header('Location: '.diamond_base().$this->uri->rsegment(1).'/transaction/'.$_POST['usercode'].'');
		exit;
	}
	
	protected function payment(){
		$data=array();
		$data['usercode']	=	$_POST['usercode'];
		$data['amount']		=	$_POST['amount'];
		$data['txtdt']		=	$_POST['txtdt'];
		$data['timedt']		=	date('Y-m-d');
		$this->comman_fun->addItem($data,'diamond_payment');
		
		$this->payment_notification($_POST['usercode']);
		
		
		$this->session->set_flashdata('show_msg','Member Payment Successfully');
		header('Location: '.diamond_base().$this->uri->rsegment(1).'/transaction/'.$_POST['usercode'].'');
		exit;
	}
	
	function delete1($eid){
		$data=array();
		$data['status']='Inactive';
		$this->comman_fun->update($data,'diamond_payment_confirmation',array('id'=>$eid));
		$this->session->set_flashdata('show_msg','Delete Successfully');
		header('Location: '.diamond_base().$this->uri->rsegment(1).'/payment_confirm/');
		exit;
	}
	
	function delete2($eid){
		$data=array();
		$data['status']='Inactive';
		$this->comman_fun->update($data,'diamond_payment_confirmation',array('id'=>$eid));
		$this->session->set_flashdata('show_msg','Delete Successfully');
		header('Location: '.diamond_base().$this->uri->rsegment(1).'/message/');
		exit;
	}
	
	function withdrawal_request() 
	{
		$data['result'] = $this->ObjM->withdrawal_request();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('diamond/withdrawal_request_view',$data);
		$this->load->view('comman/footer');	
	}
	
	function withdrawal_request_approve($eid){
			
		if($this->comman_fun->check_record('diamond_withdrawal',array('id'=>$eid,'status'=>'Process'))){
			$data=array();
			$data['status']	= 'Confirm';
			$this->comman_fun->update($data,'diamond_withdrawal',array('id'=>$eid));
			$this->session->set_flashdata('show_msg','Withdrawal Successfully');
			
			$record	=	$this->comman_fun->get_table_data('diamond_withdrawal',array('id'=>$eid));
			$this->payment_withdrawal($record[0]['usercode']);
		
				
		}
		
		header('Location: '.diamond_base().$this->uri->rsegment(1).'/withdrawal_request/');
	    exit;
	}
	
	function delete3($eid){
		if($this->comman_fun->check_record('diamond_withdrawal',array('id'=>$eid,'status'=>'Process'))){
			$data=array();
			$data['status']='Cancel';
			$this->comman_fun->update($data,'diamond_withdrawal',array('id'=>$eid));
			$this->session->set_flashdata('show_msg','Delete Successfully');
		}
		
		header('Location: '.diamond_base().$this->uri->rsegment(1).'/withdrawal_request/');
		exit;
	}
	
	
	protected function payment_notification($code){
		$member_dt=$this->comman_fun->get_table_data('membermaster',array('usercode'=>$code));
		
		$record_count=$this->comman_fun->get_table_data('diamond_payment',array('usercode'=>$code));
		
		
		
		if(count($record_count)==1){
			$msg=''.$member_dt[0]['fname'].' '.$member_dt[0]['lname'].' Just Purchased passive Diamond Residual Program';
		}
		else{
			$msg=''.$member_dt[0]['fname'].' '.$member_dt[0]['lname'].' Just Received Commission for Passive Diamond Residual Program';
		}
		
		$this->notification_email($msg,$code);
	}
	
	protected function payment_withdrawal($code){
		$member_dt=$this->comman_fun->get_table_data('membermaster',array('usercode'=>$code));
		$messages=''.$member_dt[0]['fname'].' '.$member_dt[0]['lname'].' Just withdraw Cash from the Passive Diamond Residual Program.';
		$this->notification_email($messages,$code);
	}
	
	
	
	protected function notification_email($message,$code){
		
		//upling_chain_opp
		
		$member_dt=$this->comman_fun->get_table_data('membermaster',array('usercode'=>$code));
	
	
		$result		=	$this->comman_fun->upling_chain_opp($code,'member_node_master_free');
		
		
		
		$email_list	=	array();
		for($i=0;$i<count($result);$i++){
			if($result[$i]['email_verification']=='Y'){
				$email_list[]=$result[$i]['emailid'];
			}
			$this->send_notification($result[$i]['usercode'],$message,$code);
		}
		
		
		
		if(isset($email_list[0]))
		{
			$email_list=implode(', ',$email_list);
			$e_array=array("heading"=>'Diamond Wallet',"msg"=>$message,"contain"=>'');	
			$message=email_template_one($e_array);
			
			$list = array($email_list);
			// $this->email->from(FROM_EMAIL);
			// $this->email->to($list);
			// $this->email->subject($msg);
			// $this->email->message($message);
			// $this->email->send();
			sendemail(FROM_EMAIL,$msg,$list,$message);
		}
			
	}
	
	protected function send_notification($code,$msg,$by)
	{
		
		$data=array();
		$data['usercode']		=	$code;
		$data['by_usercode']	=	$by;
		$data['type']			=	'notification';
		$data['contain']		=	$msg;
		$data['timedt']			=	time();
		$data['status']			=	'Active';
		$this->comman_fun->addItem($data,'notification_master');
	}
	
	
	function withdrawal_report()
	{
		$data['result']	=	$this->ObjM->withdrawal_report();
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('diamond/withdrawal_report_view',$data);
		$this->load->view('comman/footer');		
	}

	function payment_report()
	{
		$data['result']	=	$this->ObjM->payment_report();
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('diamond/payment_report_view',$data);
		$this->load->view('comman/footer');		
	}
	
	function member_list(){
		
		$data['result']	=	$this->ObjM->get_member_list();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('diamond/member_list',$data);
		$this->load->view('comman/footer');		
	}
	
}

