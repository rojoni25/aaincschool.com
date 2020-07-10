<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class coded_residual_details extends CI_Controller {
	protected $table		=	'country_master';
	protected $primary_key	=	'country_code';
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
		$this->load->model('coded_residual_details_model','',TRUE);
 	}
	
	public function index()
	{
		$data2['table_list']=true;
		$data['coded']=$this->coded_residual_details_model->get_coded_residual_by_type('coded');
		$data['coded_match']=$this->coded_residual_details_model->get_coded_residual_by_type('coded_match');
		$data['residual']=$this->coded_residual_details_model->get_coded_residual_by_type('residual');
		$data['residual_match']=$this->coded_residual_details_model->get_coded_residual_by_type('residual_match');
		
		$this->load->view('comman/topheader',$data2);
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_view',$data);
		$this->load->view('comman/footer');
	}
	
}

