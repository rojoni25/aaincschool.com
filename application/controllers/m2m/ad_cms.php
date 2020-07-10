<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ad_cms extends CI_Controller {

	protected $m2m_admin='123';
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 	
		if(!$this->comman_fun->check_record('m2m_admin',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']))){
			header('Location: '.base_url());exit;
		}
		
		$this->load->model('m2m/ad_module','ObjM',TRUE); 
 	}
	
	
	function view(){
		
		$data['result']=$this->comman_fun->get_table_data('cms_pages_master',array('page_type'=>'M2M','status'=>'Active'));
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('m2m/admin/cms_view',$data);
		$this->load->view('comman/footer');	
	}
	
	function edit($eid){
		
		$data['result']=$this->comman_fun->get_table_data('cms_pages_master',array('page_type'=>'M2M','status'=>'Active','cms_pages_code'=>$eid));
		
		if(isset($data['result'][0])){
			
			$this->load->view('comman/topheader');
			$this->load->view('comman/header');
			$this->load->view('m2m/admin/cms_add',$data);
			$this->load->view('comman/footer');	
			
		}else{
			
			$this->view();
			
		}
	
	}
	
	function insertrecord(){
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			
			$data['title']				=	(isset($_POST['title'])) ? $_POST['title'] : "";
			$data['textdt']				=	(isset($_POST['textdt'])) ? $_POST['textdt'] : "";
			$data['video_url']			=	(isset($_POST['video_url'])) ? $_POST['video_url'] : "";
			$data['bg_img_url']			=	(isset($_POST['bg_img_url'])) ? $_POST['bg_img_url'] : "";
				
			$this->comman_fun->update($data,'cms_pages_master',array('cms_pages_code'=>$_POST['eid'],'page_type'=>'M2M'));
			header('Location: '.base_url().'index.php/m2m/'.$this->uri->rsegment(1).'/view/');
			exit;
			
		}
	}
	
	
	
}


