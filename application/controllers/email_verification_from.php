<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class email_verification_from extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		$this->load->model('email_verification_model','ObjM',TRUE);
   		$this->load->library('form_validation');
   		$this->load->library('email');
 	}
	public function index()
	{
		
		if($this->session->userdata['email_verification']['status']!='true'){
			exit;
		}
		
	
		
		$data['result']=$this->ObjM->get_member_dt();
		
		$this->load->view('public/public_header');
     	$this->load->view('public/email_verification_from',$data);
		$this->load->view('public/public_footer');
	}
	
	function from_submit(){
	
		$form_submit=true;	
		if(!isset($_POST['emailid'])){
			$msg="Invalid Email Id";
			$form_submit=false;
		}
		if(!$this->isValidEmail($_POST['emailid'])){
			$msg="Invalid Email Id";
			$form_submit=false;
		}
		if($this->ObjM->check_email_id($_POST['emailid'])){
		
			$msg="Email Id Is Already Exist";
			$form_submit=false;
		}
		
		if($form_submit){
			
			$this->send_verify_code();
			header('Location: '.base_url().'index.php/email_verification_from/send');
			exit;
		}
		else{
			$data['error']=$msg;
			$data['result']=$this->ObjM->get_member_dt();
			$this->load->view('public/public_header');
     		$this->load->view('public/email_verification_from',$data);
			$this->load->view('public/public_footer');	
		}
		
		
		
	}
	
	protected function send_verify_code(){
		
		$smtp_protocol = $this->config->item('smtp_protocol');
		$smtp_port = $this->config->item('smtp_port');
		$smtp_host = $this->config->item('smtp_host');
		$smtp_user = $this->config->item('smtp_user');
		$smtp_pass = $this->config->item('smtp_pass');
		$smtp_from = $this->config->item('smtp_from');
		$smtp_from_name = $this->config->item('smtp_from_name');

		$config['protocol']    = $smtp_protocol;
        $config['smtp_host']    = $smtp_host;
        $config['smtp_port']    = $smtp_port;
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = $smtp_user;
        $config['smtp_pass']    = $smtp_pass;
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $config['validation'] = TRUE;
        $this->email->initialize($config);
		
		$data=array();
		$data['emailid']	= $_POST['emailid'];
		$this->ObjM->update($data,'membermaster','usercode',$this->session->userdata['email_verification']['usercode']);
		
		$result	=	$this->ObjM->get_member_dt();
		
		$now 	= 	time();
		$nowdt	=	unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
		$key	=	rand(1000,100000000).time();
						
		// $message='<p>Name	:'.$result[0]['fname'].' '.$result[0]['lname'].'</p>';
		// $message.='<p>Email	:'.$_POST['emailid'].'</p>';
		// $message.='<p><a href="'.base_url().'index.php/home/email_verification/'.$key.'">Click here To Email Verify</a></p>';
		$message = get_email_cms_page_master('email_verification')->result()[0]->textdt;
		$message = str_replace("[fname]",$result[0]['fname'],$message);
		$message = str_replace("[lname]",$result[0]['lname'],$message);
		$message = str_replace("[email]",$_POST['emailid'],$message);
		$message = str_replace("[username]",'***',$message);
		$message = str_replace("[baseurl]",base_url(),$message);
		$message = str_replace("[key]",$key,$message);

		
		$e_array=array("heading"=>"Email Verification","msg"=>$message,"contain"=>'');	
	
		$message=email_template_one($e_array);
		
		// $this->email->from($smtp_from);
	 //    $this->email->to($_POST['emailid']);
		
		// $this->email->subject('Email Verification');
		// $this->email->message($message);
		// $r=$this->email->send();

		$r = sendemail($smtp_from,'Email Verification',$_POST['emailid'],$message);
		if (!$r){
			$this->email->print_debugger();
		}
		
		$data=array();
		$data['usercode']	=	$this->session->userdata['email_verification']['usercode'];
		$data['emailid']	=	$_POST['emailid'];
		$data['v_key']		=	$key;
		$data['verification_send_date']	= $nowdt;
		$data['send_ip']    =   $_SERVER['REMOTE_ADDR'];
		
		$this->ObjM->addItem($data,'email_verification');
		
		$this->session->sess_destroy();
		
		
	}
	
	function send(){
		$this->load->view('public/public_header');
     	$this->load->view('public/email_verification_send',$data);
		$this->load->view('public/public_footer');
	}
	
	function isValidEmail($email){ 
    	return filter_var($email, FILTER_VALIDATE_EMAIL);
	}
	
	
	
	
	

}


