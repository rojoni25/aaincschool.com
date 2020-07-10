<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class daily_call extends CI_Controller {

	function __construct()
 	{
   		parent::__construct();
		$this->load->model('daily_call_model','',TRUE); 
 	}
	
	public function index()
	{
		
	}
	
	function notification_send()
	{
		$day	=	$this->daily_call_model->get_setting_value_by_lable('active_member_day');
		$day=(int)$day[0]['setting_value'];
		$today_stam = strtotime(date('d-m-Y'));
	    $timestamp = strtotime('-'.$day.' days',$today_stam);
		$member	=	$this->daily_call_model->get_send_request_member($timestamp);
		
		for($i=0;$i<count($member);$i++)
		{
			$result	 = $this->daily_call_model->get_member_by_code($member[$i]['usercode']);
			
			$code=$result[0]['referralid_free'];
			
			/////////////
			while(1)
			{
				$result=$this->daily_call_model->get_member_by_code($code);
				if(!isset($result[0]) || $result[0]['referralid_free']=='1')
				{
					$this->send_mail_notif($result[0],$member[$i]);
					break;
				}
				$record=$this->daily_call_model->check_request_by_usercode($result[0]['referralid_free']);
				if(!isset($record[0]))
				{
					$this->send_mail_notif($result[0],$member[$i]);
				}
				$code=$result[0]['referralid_free'];
			}
			/////////////
		}
		
	}
	
	
	protected function send_mail_notif($result, $sender)
	{
		
		
		$message='<p><strong>'.$sender['fname'].' '.$sender['lname'].'</strong></p>';
		$message.='<p>send to request to upgrade membership</p>';
		
		$e_array=array("heading"=>"Upgrade Membership Request","msg"=>$message);
		$message=email_template_one($e_array);
		
		$title	  =	'NLLSYS Upgrade Membership';
		$subject  =	'Upgrade Membership Request';

		$headers  = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
		$headers .= 'From: '.$title.' <'.$sender['emailid'].'>' . "\r\n";
		
		mail($result['emailid'],$subject,$message,$headers);
		
		
		$data=array();
		$data['usercode']		=	$result['usercode'];
		$data['by_usercode']	=	$sender['usercode'];
		$data['type']			=	'notification';
		$data['contain']		=	$sender['fname'].' '.$sender['lname'].' is send request to upgrade membership';
		$data['timedt']			=	time();
		$data['status']			=	'Active';
		$this->daily_call_model->addItem($data,'notification_master');		
	}
	
	
	
	
}

