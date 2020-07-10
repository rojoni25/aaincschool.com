<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {

	function __construct()
 	{
   		parent::__construct();
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied?p=home');exit;} 
		$this->load->model('home_model','',TRUE); 
 	}

	public function index()
	{
		$data['surplus_balance']		= $this->home_model->get_surplus_balance();
		$data['admin_fees']				= $this->home_model->get_admin_fees();
		$data['tot_member']				= $this->home_model->get_all_member_count();
		$data['tot_paid_member']		= $this->home_model->get_all_paid_member_count();
		$data['tot_free_member']		= $this->home_model->get_all_free_member_count();
		$data['tot_withdrawal_request'] = $this->home_model->get_all_withdrawal_request();
		$data['tot_request_to_paid']	= $this->home_model->get_all_request_to_paid();
		if(isset($_GET['type']) && $_GET['type']=='free'){
			$data['level_summery3']			= $this->home_model->get_level_summery_free('system_level_3');
			$data['level_summery5'] 		= $this->home_model->get_level_summery_free('system_level_5');
			$data['level_summery10'] 		= $this->home_model->get_level_summery_free('system_level_10');
		} else{
			$data['level_summery3']			= $this->home_model->get_level_summery('system_level_3');
			$data['level_summery5'] 		= $this->home_model->get_level_summery('system_level_5');
			$data['level_summery10'] 		= $this->home_model->get_level_summery('system_level_10');
		}

		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('home_view',$data);
		$this->load->view('comman/footer');
	}
	
	
}

