<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cms_pages_member extends CI_Controller {
	protected $table		=	'cms_pages_master';
	protected $primary_key	=	'cms_pages_code';
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		
		//if(!$this->comman_fun->check_record('smfund_member',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode'],'admin'=>'Yes'))){
//			header('Location: '.smfund().'welcome/view');
//			exit;
//		}
	
		$this->load->model('smfund/comman_modul','ObjM',TRUE);
		
 	}

	//add by hardik
	
	public function cms_view($eid)
	{
		$data['contain']	=	$this->comman_fun->get_table_data('smfund_cms_pages_master',array('pagelable'=>$eid));
		//var_dump($data['contain']);
		//exit;
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('smfund/cms_pages_member_view',$data);
		$this->load->view('comman/footer');
	}
	
	//add by hardik
	
}

