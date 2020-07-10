<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class welcome extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
		$this->load->model('welcome_model','ObjM',TRUE);
		$this->load->model('upgrade_membership_model','',TRUE);
		$this->load->library('email');
		//print_r($this->session->userdata('logged_ol_member'));
		//print_r($this->session->userdata('loggedolmember'));
 	}

	public function index()
	{
		$data['cms']	=	$this->ObjM->get_page_contain();
		$data['pay_type'] = $this->ObjM->getType();
		$data["sub_status"] = $this->ObjM->getSubscriptionStatus();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_view',$data);
		$this->load->view('comman/footer');
	}

	function active_member_panel()
	{
		$this->load->view('active_member_panel');	
	}
	function email_verification()
	{
			
			if($this->session->userdata["logged_ol_member"]["email_verification"]=='N')
			{
				
				$link_acount=$this->ObjM->get_account_send_link();
				
				if($link_acount > 3)
				{
					header('Location: '.base_url().'index.php/welcome?show_msg=Email Verification Link Already Send To Your Email Id');
					exit;				
				}
				
				
				
				$refCode	=	($this->session->userdata["logged_ol_member"]["status"]=='Active') ? $this->session->userdata["logged_ol_member"]["ref_by"] : $this->session->userdata["logged_ol_member"]["referralid_free"];
				$arr		=	array('access_name'=>'after_registration','usercode'=>$refCode);
				
				$email_html		=	$this->ObjM->get_email_html_by_access_name($arr);
				
				$now = time();
				$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
				$key=rand(1000,100000000).time();
				
				// $message='<p><h3>Email Verification</h3></p>';
				// $message.='<p>Name		:'.$this->session->userdata["logged_ol_member"]["fullname"].'</p>';
				// $message.='<p>Username	:'.$this->session->userdata["logged_ol_member"]["username"].'</p>';
				// $message.='<p>Email		:'.$this->session->userdata["logged_ol_member"]["emailid"].'</p>';
				// $message.='<p><a href="'.base_url().'index.php/home/email_verification/'.$key.'">Click here To Email Verify</a></p>';
				$message = get_email_cms_page_master('email_verification')->result()[0]->textdt;
				$message = str_replace("[fname]",$this->session->userdata["logged_ol_member"]["fullname"],$message);
				$message = str_replace("[lname]","",$message);
				$message = str_replace("[email]",$this->session->userdata["logged_ol_member"]["emailid"],$message);
				$message = str_replace("[username]",$this->session->userdata["logged_ol_member"]["username"],$message);
				$message = str_replace("[baseurl]",base_url(),$message);
				$message = str_replace("[key]",$key,$message);
				
				$e_array=array("heading"=>$email_html['subject'],"msg"=>$message,"contain"=>$email_html['html']);
				
				$message=email_template_one($e_array);
			
				$to  = 	$this->session->userdata["logged_ol_member"]["emailid"];
				// $this->email->from(FROM_EMAIL);
				// $this->email->to($to);
				// $this->email->subject('Email Verification');
				// $this->email->message($message);
				
				if(sendemail(FROM_EMAIL,'Email Verification',$to,$message) < 300)
				{
					$data=array();
					$data['usercode']	=	$this->session->userdata["logged_ol_member"]["usercode"];
					$data['emailid']	=	$this->session->userdata["logged_ol_member"]["emailid"];
					$data['v_key']		=	$key;
					$data['verification_send_date']	= $nowdt;
					$data['send_time']	= time();
					
					$data['send_ip']    =   $_SERVER['REMOTE_ADDR'];
					$this->ObjM->addItem($data,'email_verification');
					$show_msg="Email Verification Link Send To Your Email Id";
				}
				else{
					$show_msg="Email Verification Link Send Failed";
				}
				header('Location: '.base_url().'index.php/welcome?show_msg='.$show_msg.'');
				exit;				
			}
			
	}
	
	function email_test(){
		$refCode=($this->session->userdata["logged_ol_member"]["status"]=='Active') ? $this->session->userdata["logged_ol_member"]["ref_by"] : $this->session->userdata["logged_ol_member"]["referralid_free"];
		$arr=array('access_name'=>'after_registration','usercode'=>$refCode);
		$result=$this->rg_model->get_email_html_by_access_name2($arr);
	}


	function open_popup_free(){
		$res=$this->ObjM->get_master_page_by_pagecode('open_popup_free');
		$data['html']=$res[0]['textdt'];
		$this->load->view('open_popup_free', $data);
	}

	function open_popup_paid(){
		$res=$this->ObjM->get_master_page_by_pagecode('open_popup_paid');
		$data['html']=$res[0]['textdt'];
		$this->load->view('open_popup_paid', $data);
	}
	
	public function getfreesample()
	{
		$data['cms']	=	$this->ObjM->get_page_contain();
		$data['pay_type'] = $this->ObjM->getType();
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('getfreesample_view',$data);
		$this->load->view('comman/footer');
	}
}


