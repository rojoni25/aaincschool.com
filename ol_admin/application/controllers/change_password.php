<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class change_password extends CI_Controller {

	function __construct()
 	{
   		parent::__construct();
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		$this->load->model('change_password_model','',TRUE); 
 	}
	
	public function form()
	{

		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('change_password_add');
		$this->load->view('comman/footer');
	}
	function insertrecord()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$rd=$this->change_password_model->chack_old_pass($this->input->post('old_pass'));
			if($rd[0]['password']==$this->input->post('old_pass')){
				$data['password']=$this->input->post('new_pass');
				$this->change_password_model->update($data,'admin_login','usercode',$this->session->userdata['logged_in_visa']['usercode']);
				
				$data2['msg']='Password Change Successfully';
				$this->load->view('comman/topheader');
				$this->load->view('comman/header');
				$this->load->view('change_password_add',$data2);
				$this->load->view('comman/footer');	
			}
			else{
				$data2['msg']='Old Password Not Match';
				$this->load->view('comman/topheader');
				$this->load->view('comman/header');
				$this->load->view('change_password_add',$data2);
				$this->load->view('comman/footer');		
			}
			
		}
	}
	
}

