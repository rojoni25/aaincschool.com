<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cornjob_send_email extends CI_Controller {

	protected $today_time		=	'';
	
	function __construct()
 	{
   		parent::__construct();
		$this->load->model('cornjob_send_email_model','ObjM',TRUE); 
		$this->load->library('email');
		$this->today_time = strtotime(date('d-m-Y'));
 	}
	
	public function index()
	{
		$this->daily_email_free();
		//$this->send_email_varification();
		
		
		//send mail to all members
		$this->email_to_all();
		
	}
	
	function daily_email_free()
	{
		
		$email_type				=	$this->ObjM->get_email_type('after_rg');
		
		for($i=0;$i<count($email_type);$i++){
			
			$intry=$this->check_last_entry($email_type[$i]['email_code']);	
			
			$after_day=strtotime(date('d-m-Y', strtotime("-".$email_type[$i]['after_day']." days")));
			
			$member		=	$this->ObjM->get_free_member_by_add_time($after_day,$intry['total_send'],$email_type[$i]['email_code']);
			
			for($m=0;$m<count($member);$m++){
				
				$this->ObjM->free_member_total_send($intry['code'],'total_send');
				
				$this->email_send_free($member[$m],$email_type[$i]);
				
			}
			
		}
					
	}
	
	function send_email_varification(){
		///****Get Email Request****///
		$record=$this->ObjM->get_email_varification_request();
		if(!isset($record[0])){
			return false;
		}
		
		///****Get 3 Member****///
		$member=$this->ObjM->get_member_varification($record[0]['id']);
		///****Request Inactive (If Email Send To All Member )****///
		if(!isset($member[0])){
			$data=array();
			$data['status']='Done';
			$this->ObjM->update($data,'send_email_verification_all','id',$record[0]['id']);
			return false;
			
		}
		
		///Send Email Varification To Memebr Email//
		for($i=0;$i<count($member);$i++)
		{
			$this->send_verification($member[$i],$record[0]['id']);	
			$this->ObjM->varification_total_send($record[0]['id'],'tot_send');
		}
		
		
	}
	
	//Send Email Varification to Membet//
	protected function send_verification($result,$send_to_all){
		
				$refCode	=	($result["status"]=='Active') ? $result["referralid"] : $result["referralid_free"];
				$arr		=	array('access_name'=>'after_registration','usercode'=>$refCode);
				
				$email_html	=	$this->ObjM->get_email_html_by_access_name($arr);
				
				$b_url	= base_url();
				$b_url = str_replace("ol_admin/", "", $b_url);
				
				$now = time();
				$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
				
				$key=rand(1000,100000000).time();
				// $message='';
				// $message.='<p>Name		:'.$result['fname'].' '.$result['lname'].'</p>';
				// $message.='<p>Username	:'.$result['username'].'</p>';
				// $message.='<p>Email		:'.$result['emailid'].'</p>';
				// $message.='<p><a href="'.$b_url.'index.php/home/email_verification/'.$key.'">Click here To Email Verify</a></p>';
				$message = get_email_cms_page_master('cornjob_email_Verification')->result()[0]->textdt;
				$message = str_replace("[fname]",$result[0]['fname'],$message);
				$message = str_replace("[lname]",$result[0]['lname'],$message);
				$message = str_replace("[username]",$result[0]['username'],$message);
				$message = str_replace("[email]",$result['emailid'],$message);
				$message = str_replace("[baseurl]",$b_url,$message);
				$message = str_replace("[key]",$key,$message);
				
				$e_array=array("heading"=>$email_html['subject'],"msg"=>$message,"contain"=>$email_html['html']);
				$message=email_template_one($e_array);
				
				// $this->email->from(FROM_EMAIL);
				
				
				// $this->email->to($result['emailid']);
				// $this->email->subject('Email Verification');
				// $this->email->message($message);
				$returncode = sendemail(FROM_EMAIL,'Email Verification',$result['emailid'],$message);
				$data=array();
				if($returncode < 300)
				{
					$data['admin_email_status']	=	'Y';	
				}
				else{
					$data['admin_email_status']	=	'N';		
				}
				
			
				$data['usercode']	=	$result['usercode'];
				$data['emailid']	=	$result['emailid'];
				$data['v_key']		=	$key;
				$data['verification_send_date']	= $nowdt;
				$data['send_to_all']    =   $send_to_all;
				$this->ObjM->addItem($data,'email_verification');
				$show_msg="Send Successfully";
								
		}
	
	
	
	protected function email_send_free($member, $email_html){
		///////////
		
		
		$coded				=	$this->ObjM->get_coded_residual_id($a=array('coded','coded_residual_free',$member['usercode']));
		$coded_match		=	$this->ObjM->get_coded_residual_id($a=array('coded_match','coded_residual_free',$member['usercode']));
			
		$coded				=	$coded[0]['tot']*$coded_pay[0]['setting_value'];
		$coded_match		=	$coded_match[0]['tot']*$coded_match_pay[0]['setting_value'];
		
		
		$email_subject 		= 	($member['ref_email']=='0')? $email_html['email_subject'] : $member['subject'];
		$email_text			=	($member['ref_email']=='0')? $email_html['email_text'] : $member['email_html'];
		$email_text.=			'<br><br>'.$email_html['admin_contain'];
		
		$message .='<table width="100%" style="border:#333 solid 1px;">';
		$message .='<tr><th>Name</th><td>:</td><td>'.$member['fname'].' '.$member['lname'].'</td></tr>';
		$message .='<tr><th>Username</th><td>:</td><td>'.$member['username'].'</td></tr>';
		$message .='<tr><th>Password</th><td>:</td><td>'.$member['password'].'</td></tr>';
		$message .='<tr><th>Status</th><td>:</td><td>Free</td></tr>';
		$message .='<tr><th>Coded</th><td>:</td><td>'.$coded.'</td></tr>';
		$message .='<tr><th>Coded Match</th><td>:</td><td>'.$coded_match.'</td></tr>';
		$message .='<tr><th>Unsubscribe</th><td>:</td><td><a href="'.base_url().'index.php/home/unsubscribe/'.$member['username'].'">Unsubscribe</a></td></tr></table>';
		
		
		
		$e_array=array("heading"=>$email_subject,"msg"=>$message,"contain"=>$email_text);	
		$message	=	email_template_one($e_array);
		
		// $this->email->from(FROM_EMAIL);
		// $this->email->to($member['emailid']);
		
		// $this->email->subject($email_subject);
		// $this->email->message($message);
		// $this->email->send();	
		///////////
		sendemail(FROM_EMAIL,$email_subject,$member['emailid'],$message);
	}
	
	protected function check_last_entry($email_code){
			
		$record		=	$this->ObjM->check_last_entry($email_code,$this->today_time);
		if(!isset($record[0])){
			$data=array();
			$data['email_code']=$email_code;
			$data['timedt']=$this->today_time;
			$code=$this->ObjM->addItem($data,'email_daily_status');
			
			$arr['code']		=	$code;
			$arr['total_send']	=	0;	
		}
		else{
			$arr['code']		=	$record[0]['idcode'];
			$arr['total_send']	=	$record[0]['total_send'];
		}
		return $arr;
	}
	
	
	function email_to_all(){
		$result = $this -> ObjM -> get_send_all_member_email();
		
		if(isset($result[0])){
			$member = $this->ObjM->get_member_for_all($result[0]['total_send']);
			//var_dump($member);
			//exit;
			if(!isset($member[0])){
				$data=array();
				$data['status']	=	'Complete';
				$this->comman_fun->update($data,'send_email_to_add',array('email_code'=>$result[0]['email_code']));
			}

			$message_all = get_email_cms_page_master('cornjob_email_to_all')->result()[0]->textdt;
			
			for($i=0;$i<count($member);$i++){
				//Email Code//
					//code for email
					
					//$e_array=array("heading"=>$email_html['subject'],"msg"=>$message,"contain"=>$email_html['html']);
					
				
					// $message='';
					// $message.='<p>Name		:'.$member[$i]['fname'].' '.$member[$i]['lname'].'</p>';
					// $message.='<p>Username	:'.$member[$i]['username'].'</p>';
					// $message.='<p>Email		:'.$member[$i]['emailid'].'</p>';
					$message = $message_all;
					$message = str_replace("[fname]",$member[$i]['fname'],$message);
					$message = str_replace("[lname]",$member[$i]['lname'],$message);
					$message = str_replace("[email]",$member[$i]['emailid'],$message);
					$message = str_replace("[username]",$member[$i]['username'],$message);
					
					$e_array=array("heading"=>$result[0]['subject'],"msg"=>$message,"contain"=>$result[0]['msg']);
					
					$message=email_template_one($e_array);
					
					
					//$this->email->from(FROM_EMAIL);
				
					//$this->email->from('tigerjohn143@gmail.com');
						
					 //$this->email->to($member[$i]['emailid']);
					//$this->email->to('tigerjohn143@gmail.com');
					
					//$this->email->subject($result[0]['subject']);
					//$this->email->message($message);
					//$this->email->send();
					//echo $this->email->print_debugger();
					//exit;	
					//End Email Code//
					sendemail(FROM_EMAIL,$result[0]['subject'],$member[$i]['emailid'],$message);
				$this->ObjM->update_for_all_email_member($result[0]['email_code']);
			}
			
		}
	}
	
	
	//function test()
	//{	
		//echo 'hello';
	//}
	
}



