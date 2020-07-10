<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pdl_online_payment extends CI_Controller {
	
	protected $upling_user		=	'';
	protected $upling_posi		=	'';
	protected $first_pay		=	false;
	function __construct()
 	{
   		parent::__construct(); 
		
		$this->load->model('pdl_online_payment_module','ObjM',TRUE);
		$this->load->library('email');
 	}
	
	
	
	
	function monthly_subscription_rep()
	{
		$data=array();
		
		$data['datadt']		=	json_encode($_POST);
		$data['type']		=	"Real_Req";
	
		$this->ObjM->addItem($data,'api_test');
		
		if($_POST)
    	{
        	if(isset($_POST['x_subscription_id'])){
				
				if($_POST['x_response_code']=='1'){
					$this->monthly_subscription_payment();	
				}
				else{
					$this->subscription_flase();
					echo 'Desline';
				}
			}	
    	}		
	}
	
	protected function subscription_flase(){
		
		$detail=$this->ObjM->get_subscription_record($_POST['x_subscription_id']);
		
		$data['usercode']			=	$detail[0]['usercode'];
		
		$data['x_response_code']	=	$_POST['x_response_code'];
		
		$data['post_data']			=	json_encode($_POST);
		
		$data['time_dt']			=	time();
		
		$this->ObjM->addItem($data,'pdl_payment_false');
	}
	
	protected function monthly_subscription_payment()
	{
			$detail=$this->ObjM->get_subscription_record($_POST['x_subscription_id']);
			
			if(isset($detail[0])){
				
				$result = $this->ObjM->check_member_in_tree($detail[0]['usercode']);
				
				if(!isset($result[0]))
				{
					$this->first_time_payment($detail[0]);
					$first_pay=true;
				}
				else{
					$first_pay=false;
				}
				$paymentcode	=	$this->member_payment_insert($detail[0]);				
				
				$this->upling_member_payment($detail[0],$paymentcode);
				
				$this->referral_payment($detail[0],$paymentcode);
				
				$this->send_email_to_admin($detail[0],$first_pay);
				
			}	
						
	}
	
	//****Member Payment Intry****//
	protected function member_payment_insert($arr){	
	
		$data=array();
		$data['usercode']			=	$arr['usercode'];
		$data['amount']				=	$_POST['x_amount'];
		$data['txn_id']				=	$_POST['x_trans_id'];
		$data['date_dt']			=	strtotime(date('d-m-Y'));
		$data['time_dt']			=	strtotime('+1 month',time());
		$data['option']				=	json_encode($_POST);
		$data['pay_type']			=	'Monthly Subscription';
		$id = $this->ObjM->addItem($data,'pdl_monthly_payment');
		return $id;
	}
	
	//****Three Level Member Payment****//
	protected function upling_member_payment($result, $paymentcode)
	{	
		$usercode	= $result['usercode'];
		
		$arr=array(10,5,5);
		$arr_wallet_type	=	array('pdl_1','pdl_1','pdl_2');
		
		for($i=0;$i<=2;$i++)
		{
			$upling	=	$this->ObjM->tree_user_by_usercode($usercode);
			$data['paymentcode']	=	$paymentcode;
			$data['usercode']		=	$upling;
			$data['ref_code']		=	$result['usercode'];
			$data['amount']			=	$arr[$i];
			$data['timedt']			=	time();
			$data['type']			=	'monthly';
			$data['level_pay']		=	$i+1;
			$data['wallet_type']		=		$arr_wallet_type[$i];
			$this->ObjM->addItem($data,'pdl_member_payment');
			$usercode=$upling;
		}
		
		
	}
	
	protected function referral_payment($result, $paymentcode){
		
		$member_dt		=	$this->ObjM->get_member_usercode($result['usercode']);
		
		$ref_dode		=	($member_dt['status']=='Active')? $member_dt['referralid'] : $member_dt['referralid_free'];
		
		$ref_in_tree	=	$this->ObjM->check_member_in_tree($ref_dode);
		
		$usercode	=	(isset($ref_in_tree[0])) ? $ref_dode  : PDL_SYSTEM_USER;
		
	
		$data=array();
		$data['paymentcode']	=	$paymentcode;
		$data['usercode']		=	$usercode;
		$data['ref_code']		=	$result['usercode'];
		$data['amount']			=	5;
		$data['timedt']			=	time();
		$data['type']			=	'monthly';
		$data['level_pay']		=	0;
		$data['wallet_type']	=	'Opp_wallet';
		$this->ObjM->addItem($data,'pdl_member_payment');
		
		
	}
	
	//****Entry In Tree****//
	protected function first_time_payment($arr){
		
		//****get tree level****//
		
		$this->first_lavel_set();
		
		$data=array();
		$data['usercode']			=	$arr['usercode'];
		$data['join_time']			=	time();
		$data['join_date']			=	strtotime(date('d-m-Y'));
		$data['due_time']			=	strtotime('+1 month',time());
		$data['upling']				=	$this->upling_user;
		$data['side']				=	$this->upling_posi;
		$data['subscription_id']	=	$arr['subscription_id'];

		$this->ObjM->addItem($data,'pdl_member');
		
	}
	
	
	
	protected function first_lavel_set(){
		
		$result			=	$this->ObjM->get_child_member(PDL_SYSTEM_USER);
		
		//****Level First Check****//
		if(count($result)< 3){
			
			$this->upling_user = PDL_SYSTEM_USER;
			
			$this->upling_posi = count($result)+1;
			
			return;	
		}
		
		//****Set Member For Second Level****//
		for($i=0;$i<count($result);$i++){
			
			$arr[]=$result[$i]['usercode'];
			
		}
		//****Call Function To Check Next Level****//
		$this->tree_check_postion($arr);
	}
	
	
	//****Check Position******//
	protected function tree_check_postion($arr_mem){
		
		//****Check Position******//
		
		for($pos=0;$pos<3;$pos++){
			
			for($i=0;$i<count($arr_mem);$i++){
			
				$result=$this->ObjM->get_count_child_member($arr_mem[$i]);
				
				if($result[0]['tot']<$pos+1){
				
					$this->upling_user = $arr_mem[$i];
					
					$this->upling_posi = $result[0]['tot']+1;
					
					return;		
					
				}
			
			}
		}
		
		
		//****Next Level Member Get******//
		$child_mem=array();
		
		for($i=0;$i<count($arr_mem);$i++){
			
			$child_mem[]=$this->ObjM->get_child_member($arr_mem[$i]);			
			
		}
		
		
		//****Next Level Member Set By Position******//
		$re_arr=array();
		
		for($pos=0;$pos<3;$pos++){
			
			for($i=0;$i<count($child_mem);$i++){
				
				$re_arr[]=$child_mem[$i][$pos]['usercode'];					
			
			}
		}
		
		//****Function Call To Check Again******//
		$this->tree_check_postion($re_arr);
		
	}
	
	
	
	function send_email_to_admin($info,$first_pay)
	{
			$member_dt	=	$this->ObjM->get_member_usercode($info['usercode']);
			
			$admin_email=$this->ObjM->get_admin_email();
				
			if($first_pay)
			{
				$admin_message ='<p style="line-height:27px;font-family:Verdana, Geneva, sans-serif;">Member Name : '.$member_dt['fname'].' '.$member_dt['lname'].' ( '.$member_dt['usercode'].' )</p>';
				$admin_message.='<p style="line-height:27px;font-family:Verdana, Geneva, sans-serif;">Above Member has been ADDED successfully in PDL Subscription Matrix.</p>';
				
				$member_message ='<p style="line-height:27px;font-family:Verdana, Geneva, sans-serif;">Hello,  '.$member_dt['fname'].' '.$member_dt['lname'].'</p>';
				$member_message ='<p style="line-height:27px;font-family:Verdana, Geneva, sans-serif;">Congratulation !!!<br>Dear Member You have been Successfully Added on PDL Subscription Matrix.<br>Please Login your Backoffice for more Details.<br>Thanks</p>';
				
				$upling_message ='<p style="line-height:27px;font-family:Verdana, Geneva, sans-serif;">Member Name : '.$member_dt['fname'].' '.$member_dt['lname'].'</p>';
				$upling_message.='<p style="line-height:27px;font-family:Verdana, Geneva, sans-serif;">Above Member has been ADDED successfully in PDL Subscription Matrix.</p>';
				$message = get_email_cms_page_master('pdl_subscribe_day_first')->result()[0]->textdt;
				
			}else{
				$admin_message ='<p style="line-height:27px;font-family:Verdana, Geneva, sans-serif;">Member Name : '.$member_dt['fname'].' '.$member_dt['lname'].' ( '.$member_dt['usercode'].' )</p>';
				$admin_message.='<p style="line-height:27px;font-family:Verdana, Geneva, sans-serif;">Above Member has been Renewed auto subscription for PDL Matrix</p>';
				
				$member_message ='<p style="line-height:27px;font-family:Verdana, Geneva, sans-serif;">Hello,  '.$member_dt['fname'].' '.$member_dt['lname'].'</p>';
				$member_message ='<p style="line-height:27px;font-family:Verdana, Geneva, sans-serif;">Dear Member <br>Thanks for Auto Renewal PDL Membership. You have been renewal in PDL successfully.</p>';
				
				$upling_message ='<p style="line-height:27px;font-family:Verdana, Geneva, sans-serif;">Member Name : '.$member_dt['fname'].' '.$member_dt['lname'].'</p>';
				$upling_message.='<p style="line-height:27px;font-family:Verdana, Geneva, sans-serif;">Above Member has been ADDED successfully in PDL Subscription Matrix.</p>';
				// $message = get_email_cms_page_master('pdl_subscribe_day_other')->result()[0]->textdt;
			}
		
			// $message = str_replace("[fname]",$member_dt['fname'],$message);
			// $message = str_replace("[lname]",$member_dt['lname'],$message);
			// $message = str_replace("[usercode]",$member_dt['usercode'],$message);
			
			$e_array=array("heading"=>"PDL Subscribe","msg"=>$admin_message,"contain"=>'');	
			$admin_message=email_template_one($e_array);
		
			// $this->email->from(FROM_EMAIL);
			// $this->email->to($admin_email['emailid']);
			// $this->email->subject('PDL Subscribe');
			// $this->email->message($admin_message);
			// $p=$this->email->send();
			sendemail(FROM_EMAIL,'PDL Subscribe',$admin_email['emailid'],$admin_message);
			
			
			if($member_dt['email_verification']=='Y'){
				
				$e_array=array("heading"=>"PDL Subscribe","msg"=>$member_message,"contain"=>'');	
				$member_message=email_template_one($e_array);
				
				// $this->email->from(FROM_EMAIL);
				// $this->email->to($member_dt['emailid']);
				// $this->email->subject('PDL Subscribe');
				// $this->email->message($member_message);
				// $p=$this->email->send();	
				sendemail(FROM_EMAIL,'PDL Subscribe',$member_dt['emailid'],$member_message);
			}	
			
			$upling_email=$this->ObjM->upling_member_email($info['usercode']);
			
			
			
			if($upling_email){
				$e_array=array("heading"=>"PDL Subscribe","msg"=>$upling_message,"contain"=>'');	
				$upling_message=email_template_one($e_array);
				
				// $this->email->from(FROM_EMAIL);
				// $this->email->to($upling_email);
				// $this->email->subject('PDL Subscribe');
				// $this->email->message($upling_message);
				// $this->email->send();	
				sendemail(FROM_EMAIL,'PDL Subscribe',$upling_email,$upling_message);
			}
			
	 }
	
	
	
	
	
	
	
}

