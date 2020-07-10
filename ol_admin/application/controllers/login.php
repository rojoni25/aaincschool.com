<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		$this->load->model('login_module','',TRUE);
   		$this->load->library('form_validation');
   		$this->load->library('email');
 	}
	public function index()
	{
		if($this->session->userdata('logged_in_visa'))
   		{
			header('Location: '.base_url().'index.php/home');
			exit;
   		}
   		else
   		{
     		$this->load->view('login_view');
   		}
	}
	public function login_submit()
	{
		$now = time();
		$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
		
		if($this->session->userdata('logged_in_visa'))
	 	{
	 		header('Location: '.base_url());
			exit;
	    }
		
		$this->form_validation->set_rules('username', 'Username', 'required');
	 	$this->form_validation->set_rules('password', 'Password', 'required');
	 	
		if ($this->form_validation->run() == FALSE)
	 	{
		 	$data['error']='Invalid Username or password';
         	$this->load->view('login_view',$data);	
		}
		else{
			
			$username 	= 	$this->input->post('username');
		 	$password	=	$this->input->post('password');
     	 	$result 	= 	$this->login_module->loginsub($username, $password);
			if(count($result)> 0){
				$sess_array = array();
				$sess_array['usercode']		=	$result[0]['usercode'];
				$sess_array['user_type_id']	=	$result[0]['user_type_id'];
				$sess_array['fullname']		=	$result[0]['fname'].' '.$result[0]['lname'];
				$sess_array['emailid']		=	$result[0]['emailid'];
				$sess_array['mobileno']		=	$result[0]['mobileno'];
				$sess_array['phone_no']		=	$result[0]['phone_no'];
				
				$data['usercode']		=	$result[0]['usercode'];
				$data['ip']				=	$_SERVER['REMOTE_ADDR'];
				$data['browserdt']		=	$_SERVER["HTTP_USER_AGENT"];
				$data['timedt']			=	$nowdt;
				$data['status']			=	'Sucess';
				$data['availeble']		=	'Y';
				
				$login_code					=	$this->login_module->addItem($data,'login_info');
				$sess_array['login_code']	=	$login_code;
				$this->session->set_userdata('logged_in_visa', $sess_array);
				header('Location: '.base_url().'index.php/home');
				
			}
			else{
				$data['username']		=	$this->input->post('username');
				$data['password']		=	$this->input->post('password');
				$data['timedt']			=	$nowdt;
				$data['status']			=	'Failed';
				$data['ip']				=	$_SERVER['REMOTE_ADDR'];
				$data['browserdt']		=	$_SERVER["HTTP_USER_AGENT"];
				$data['availeble']		=	'N';
				
				
				$login_code					=	$this->login_module->addItem($data,'login_info');
				$data['error']='Invalid Username or password';
         		$this->load->view('login_view',$data);	
			}
			
		}
	
	}
	
	function logout()
 	{
		$now = time();
		$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
		$data['availeble']		=	'N';
		$data['logout_time']	=	$nowdt;
		$this->login_module->update($data,'login_info','login_code',$this->session->userdata['logged_in_visa']['login_code']);	
		$this->session->sess_destroy();
		header('Location: '.base_url().'index.php/login');
		exit;
    }

}


