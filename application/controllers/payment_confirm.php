<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class payment_confirm extends CI_Controller {
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
		$this->load->model('payment_confirm_model','ObjM',TRUE);
		$this->load->library('email');
 	}
	
	public function index()
	{
		$data['result']=$this->ObjM->get_pages_contain('payment_confirm');
		$data['table_list']=true;
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_add');
		$this->load->view('comman/footer');
	}

	function affiliatePayment()
	{
		$data['result']=$this->ObjM->get_pages_contain('payment_confirm');
		$data['table_list']=true;
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view('affiliate_payment_confirm',$data);
		$this->load->view('comman/footer');
	}
	
	function insertrecord()
	{
		$data	=	array();
		$data['usercode']	=	$this->session->userdata['logged_ol_member']['usercode'];
		$data['type']		=	'payment_confirm';
		$data['subject']	=	'Payment Confirmation';
		$data['msg']		=	'Payment Type : '.$this->input->post('paytype').'<br> Amount : '.$this->input->post('amount').'<br> Date : '.$this->input->post('date').'<br> Transaction Code: '.$this->input->post('transcode');
		$data['timedt']		=	date('Y-m-d h:i:s');
		$this->ObjM->addItem($data,'admin_message');
		//
		if($this->input->post('amount')>0){
			$data=array();
			$data['usercode']	=	$this->session->userdata['logged_ol_member']['usercode'];
			$data['status']		=	'Active';
			$data['st_view']	=	'N';
			$data['payment']	=	'Y';
			$data['type']	=	$this->input->post('paytype');
			$data['amount']	=	$this->input->post('amount');
			$data['txn_id']	=	$this->input->post('transcode');
			$data['payment_dt']		=	date('Y-m-d H:i:s',strtotime($this->input->post('date')));
			$data['timedt']		=	strtotime(date('d-m-Y H:i:s'));
			$this->ObjM->addItem($data,'paid_request_master');
		}
		
		$this->send_email_friend();
		
		$this->session->set_flashdata('show_msg', 'Payment Confirmation Request Send To admin');
		
		header('Location: '.base_url().'index.php/'.$this->uri->segment(1));
		exit;
	}

		
	
	protected function send_email_friend()
	{
		$arr=array();
		$arr_code=array();
		$code=$this->session->userdata['logged_ol_member']['usercode'];
		while(1){
			$r	=	$this->ObjM->get_upling_ref_member($code);
			
			if($r[0]['usercode']=='1'){
				$arr[]=$r[0]['emailid'];
				$arr_code[]=$r[0]['referralid_free'];
				break;	
			}
			if(!isset($r[0])){
				break;
			}
			
			if($r[0]['email_verification']=='Y' && $r[0]['subscribe']=='Y')
			{
				$arr[]=$r[0]['emailid'];
			}
			
			$arr_code[]=$r[0]['referralid_free'];
			
			$code=$r[0]['referralid_free'];
		}
		
		$message = get_email_cms_page_master('upgrade-membership-request')->result()[0]->textdt;
		$message = str_replace("[fullname]",$this->session->userdata['logged_ol_member']['fullname'],$message);

		$e_array=array("heading"=>"Upgrade Membership Request","msg"=>$message);
		$message=email_template_one($e_array);
		
		$noti_msg		=	$this->session->userdata['logged_ol_member']['fullname'].' is send request to upgrade membership';
		
		for($i=0;$i<count($arr);$i++)
		{
			sendemail(FROM_EMAIL,'Upgrade Membership Request',$arr[$i],$message);
			$this->send_notification($arr_code[$i],$noti_msg);
		}
	
	}
	// protected function send_email_friend()
	// {
	// 	$arr=array();
	// 	$arr_code=array();
	// 	$code=$this->session->userdata['logged_ol_member']['usercode'];
		
	// 	$arr_code[]=$this->session->userdata['logged_ol_member']['usercode'];
	// 	while(1){
	// 		$r	=	$this->ObjM->get_upling_ref_member($code);
			
	// 		if($r[0]['usercode']=='1'){
	// 			$arr[]=$r[0]['emailid'];
	// 			$arr_code[]=$r[0]['referralid_free'];
	// 			break;	
	// 		}
	// 		if(!isset($r[0])){
	// 			break;
	// 		}
			
	// 		if($r[0]['email_verification']=='Y' && $r[0]['subscribe']=='Y')
	// 		{
	// 			$arr[]=$r[0]['emailid'];
	// 		}
			
	// 		$arr_code[]=$r[0]['referralid_free'];
			
	// 		$code=$r[0]['referralid_free'];
	// 	}
		
	// 	$member	=	$this->ObjM->get_upling_ref_member($this->session->userdata['logged_ol_member']['usercode']);
		
	// 	$ref=($member[0]['status']=='Pending')? $member[0]['referralid_free'] :  $member[0]['referralid'];
		
	// 	$ref_dt	=	$this->ObjM->get_upling_ref_member($ref);

	// 	$message = get_email_cms_page_master('payment_confirmation')->result()[0]->textdt;
	// 	$message = str_replace("[fullname]",$this->session->userdata['logged_ol_member']['fullname'],$message);
	// 	$message = str_replace("[usercode]",$member[0]['usercode'],$message);
	// 	$message = str_replace("[username]",$member[0]['username'],$message);
	// 	$message = str_replace("[sponsor-fname]",$ref_dt[0]['fname'],$message);
	// 	$message = str_replace("[sponsor-lname]",$ref_dt[0]['lname'],$message);
	// 	$message = str_replace("[sponsor-usercode]",$ref_dt[0]['usercode'],$message);
	// 	$message = str_replace("[sponsor-username]",$ref_dt[0]['username'],$message);
		
	// 	$e_array=array("heading"=>"Payment Confirmation","msg"=>$message);
	// 	$noti_msg		=	$this->session->userdata['logged_ol_member']['fullname'].' has sent Payment Confirmation to Admin';
	// 	for($i=0;$i<count($arr);$i++)
	// 	{
	// 		sendemail(FROM_EMAIL,'Confirm Payment',$arr[$i],$message);
	// 		$this->send_notification($arr_code[$i],$noti_msg);
	// 	}
	// }
	
	protected function send_notification($code,$msg)
	{
		
		$data=array();
		$data['usercode']		=	$code;
		$data['by_usercode']	=	$this->session->userdata['logged_ol_member']['usercode'];
		$data['type']			=	'notification';
		$data['contain']		=	$msg;
		$data['timedt']			=	time();
		$data['status']			=	'Active';
		$this->ObjM->addItem($data,'notification_master');
	}
	
	public function report()
	{
		$data['result']=$this->ObjM->get_confirmation_report();
	
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_report',$data);
		$this->load->view('comman/footer');
	}


}

