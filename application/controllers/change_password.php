<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class change_password extends CI_Controller {

	function __construct()
 	{
   		parent::__construct();
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		$this->load->model('change_password_model','',TRUE); 
		
		$this->load->driver('cache'); 
		$this->cache->clean();
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
        $this->output->set_header('Pragma: no-cache');
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
				$this->change_password_model->update($data,'membermaster','usercode',$this->session->userdata['logged_ol_member']['usercode']);
				
				$data2['msg']='Password Change Successfully';
				$this->load->view('comman/topheader');
				$this->load->view('comman/header');
				$this->load->view('change_password_add',$data2);
				$this->load->view('comman/footer');	
			}
			else{
				$data2['msg']='Old Password Incorrect';
				$this->load->view('comman/topheader');
				$this->load->view('comman/header');
				$this->load->view('change_password_add',$data2);
				$this->load->view('comman/footer');		
			}
			
		}
	}
	
}

