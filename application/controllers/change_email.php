<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class change_email extends CI_Controller {

	function __construct()
 	{
   		parent::__construct();
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		$this->load->model('change_password_model','ObjM',TRUE);
		$this->load->library('email'); 
 	}
	
	public function form()
	{

		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('change_email_add');
		$this->load->view('comman/footer');
	}
	function insertrecord()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			if (!filter_var($_POST['emailid'], FILTER_VALIDATE_EMAIL)) {
    			$msg='Invailed Email';	
				$p=array($msg);
				echo json_encode($p);
				exit;	
			}
			
			if($this->session->userdata['logged_ol_member']['emailid']==$_POST['emailid']){
				$msg='Email Id Same as Existing Email Id';	
				$p=array($msg);
				echo json_encode($p);
				exit;
			}
			
			$rd=$this->ObjM->chack_old_pass();
			if($rd[0]['password']==$this->input->post('txtpassword')){
				$chk_username=$this->ObjM->chack_email($_POST['emailid']);
				if(!isset($chk_username[0])){
					
					$data['emailid']			=	$_POST['emailid'];
					$data['email_verification']	=	'N';
					$this->ObjM->update($data,'membermaster','usercode',$this->session->userdata['logged_ol_member']['usercode']);
					
					$usersession=$this->session->userdata['logged_ol_member'];
					$usersession['emailid']				=	$_POST['emailid'];
					$usersession['email_verification']	=	'N';
					
					$this->session->set_userdata('logged_ol_member', $usersession); 
					$this->send_verify_code();		
					$msg='Email Id Change Successfully <br> Verification Email Send To Your Email Id <br> Please Verify Email Id ';
					
				}
				else{
					$msg='Email Id Already Exist !';
				}
			}
			else{
				$msg='Password Not Match';	
			}
			$p=array($msg);
			echo json_encode($p);
			
			exit;	
		}
	}
	
	
	function send_verify_code(){
		$email_html	=	$this->ObjM->get_email_html_by_access_name('after_registration');

		$now 	= 	time();
		$nowdt	=	unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
		$key	=	rand(1000,100000000).time();
					
		$message='<p>Your Email Id Change </p>';
		$message.='<p><a href="'.base_url().'index.php/home/email_verification/'.$key.'">Click here To Email Verify</a></p>';
		$e_array=array("heading"=>"Email Id Change","msg"=>$message,"contain"=>$email_html[0]['email_text']);	
		$message=email_template_one($e_array);
		
		// $this->email->from(FROM_EMAIL);
		// $this->email->to($_POST['emailid']);
		// $this->email->subject($email_html[0]['email_subject']);
		// $this->email->message($message);
		// $this->email->send();
		sendemail(FROM_EMAIL,$email_html[0]['email_subject'],$_POST['emailid'],$message);
		
		$data=array();
		$data['usercode']	=	$this->session->userdata['logged_ol_member']['usercode'];
		$data['emailid']	=	$_POST['emailid'];
		$data['v_key']		=	$key;
		$data['verification_send_date']	= $nowdt;
		$data['send_ip']    =   $_SERVER['REMOTE_ADDR'];
		
		$this->ObjM->addItem($data,'email_verification');
		
	}
	
}

