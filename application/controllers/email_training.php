<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class email_training extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		$this->load->model('cmspages_module','',TRUE);
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
   		//---------------------smfund---------------------
		//if(($smfund_admin_valid)||($this->session->userdata['logged_smfund_member'])){header('Location: '.smfund().'welcome/view');exit;}
		//---------------------smfund---------------------
 	}
	public function index()
	{
		$data['contain']=$this->cmspages_module->get_pages_contain($this->uri->segment(1));
		if(!isset($data['contain'][0])){
			$data['contain'] = $this->cmspages_module->get_pages_contain('not_found');
		}

		if($data['contain']['pagelable']=="leaders_board")
		{
			$data['recent_monthly_members'] = $this->cmspages_module->get_recent_monthly_members($this->session->userdata('logged_ol_member')['usercode']);
		}

		if($data['contain'][0]['pagelable']=="leaders_board"){
			$data['get_top_referal_list']=$this->cmspages_module->get_top_referal_list('Active');
			$data['get_top_month_referal_list']=$this->cmspages_module->get_top_month_referal_list('Active');
			$data['get_top_week_referal_list']=$this->cmspages_module->get_top_week_referal_list('Active');
		} elseif($data['contain'][0]['pagelable']=="leaders_board_free"){
			$data['get_top_referal_list']=$this->cmspages_module->get_top_referal_list(); //'Pending'
			$data['get_top_month_referal_list']=$this->cmspages_module->get_top_month_referal_list();
			$data['get_top_week_referal_list']=$this->cmspages_module->get_top_week_referal_list();
		}

		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('cmspages_view',$data);
		$this->load->view('comman/footer');

	}
}