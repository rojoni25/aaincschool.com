<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class change_username extends CI_Controller {

	function __construct()
 	{
   		parent::__construct();
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		$this->load->model('change_password_model','ObjM',TRUE); 
 	}
	
	public function form()
	{

		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('change_username_add');
		$this->load->view('comman/footer');
	}
	function insertrecord()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$username_len=strlen($_POST['username']);
			if($username_len < 4){
				$msg='Password Not Match';
				$p=array($msg);
				echo json_encode($p);
				exit;
			}
			$rd=$this->ObjM->chack_old_pass();
			if($rd[0]['password']==$this->input->post('txtpassword')){
				$chk_username=$this->ObjM->chack_username($_POST['username']);
				if(!isset($chk_username[0])){
					$data['username']=$_POST['username'];
					$this->ObjM->update($data,'membermaster','usercode',$this->session->userdata['logged_ol_member']['usercode']);
					
					$usersession=$this->session->userdata['logged_ol_member'];
					$usersession['username']=$_POST['username'];
					$this->session->set_userdata('logged_ol_member', $usersession); 
					
					$msg='Username Change Successfully';
					
				}
				else{
					$msg='Username Already Exist !';
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
	
}

