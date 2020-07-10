<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pages extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		$this->load->model('pages_module','',TRUE);
   		
 	}
	public function index()
	{
		$this->load->view('public/public_header');
		$this->load->view('public/home_view');
		$this->load->view('public/public_footer');
	}

	public function p()
	{
		$data['result']=$this->pages_module->get_pages_contain($this->uri->segment(3));
		
		if(!isset($data['result'][0])){
			$data['result']=$this->pages_module->get_pages_contain('not_found');
		}
		
		$this->load->view('public/public_header');
		$this->load->view('public/pages_view',$data);
		$this->load->view('public/public_footer');
	
	}

	public function reg($pagecoed)
	{
		$data['result']=$this->pages_module->get_pages_contain('success');
		$data['after_reg']=$this->pages_module->get_after_reg_contain($pagecoed);
		
	
		if(!isset($data['result'][0])){
			$data['result']=$this->pages_module->get_pages_contain('not_found');
		}
		$this->load->view('public/public_header');
		
		if($data['after_reg'][0]['after_rg_status']=='Y')
		{
				$this->load->view('public/after_reg_custom',$data);
		}
		else{
				$this->load->view('public/after_reg_default',$data);
		}
	
		$this->load->view('public/public_footer');
	
	}
	
	
	//----------------------------------------dfsm-----------------------------------
	
	public function reg_new($pagecode)
	{
		
		
		$data['result']=$this->pages_module->get_pages_dfsm_contain('success');
		$data['after_reg']=$this->pages_module->get_after_reg_dfsm_contain($pagecode);
		
	
		if(!isset($data['result'][0])){
			$data['result']=$this->pages_module->get_pages_dfsm_contain('not_found');
		}
		$this->load->view('public/public_header');
		
		if($data['after_reg'][0]['after_rg_status']=='Y')
		{
				$this->load->view('public/after_reg_custom',$data);
		}
		else{
				$this->load->view('public/after_reg_default',$data);
		}
	
		$this->load->view('public/public_footer');
	
	}
	
	//----------------------------------------dfsm-----------------------------------
	
	
	public function reg_preview($pagecoed)
	{
		$data['result']=$this->pages_module->get_pages_contain('success');
		$data['after_reg']=$this->pages_module->get_reg_preview($pagecoed);
		$this->load->view('public/public_header');
		$this->load->view('public/after_reg_custom',$data);
		$this->load->view('public/public_footer');
	
	}
	public function after_reg_preview($pagecoed)
	{
		$data['result']=$this->pages_module->get_pages_contain('success');
		$data['after_reg']=$this->pages_module->get_after_reg_contain($pagecoed);
		
		$this->load->view('public/public_header');
		$this->load->view('public/after_reg_custom',$data);
		$this->load->view('public/public_footer');
	
	}
	
	function verify_sucess()
	{
	    $page=$this->pages_module->get_pages_contain('email_verification_success');
	    $data["video_url"]=$page[0]["video_url"];
		$this->load->view('public/public_header');
		$this->load->view('public/email_verify_sucess',$data);
		$this->load->view('public/public_footer');
	}
	
	
}


