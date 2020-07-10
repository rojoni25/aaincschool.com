<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class capture_master extends CI_Controller {

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
	
	
	function view($mode,$eid){
		
		$data['result'] = $this->comman_fun->get_table_data('m2m_capture_master',array('status !='=>'Delete'));
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('m2m/admin/capture_page_view',$data);
		$this->load->view('comman/footer');	
	}
	
	
	function add($mode,$eid){
		
		$data['mode'] = $mode;
		$data['eid'] = $eid;
		
		if($mode=='edit'){
			$data['result'] = $this->comman_fun->get_table_data('m2m_capture_master',array('status !='=>'Delete','page_code'=>$eid));	
		}
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('m2m/admin/capture_pages_add',$data);
		$this->load->view('comman/footer');	
	}
	
	function insertrecord(){
		
		
		if ($this->input->server('REQUEST_METHOD') === 'POST'){
			$data=array();
			
			$data['page_name']		=	$_POST['page_name'];
			$data['headline_text']	=	$_POST['headline_text'];
			$data['main_body_text']	=	$_POST['main_body_text'];
			$data['video_url']		=	$_POST['video_url'];
			$data['video_frame']	=	$_POST['video_frame'];
			$data['page_bg_img']	=	$_POST['page_bg_img'];
			$data['form_align']		=	$_POST['form_align'];
			$data['form_bg_color']	=	$_POST['form_bg_color'];
			$data['bg_color']		=	$_POST['bg_color'];
			
			//----------------dfsm-----------------------
			$data['after_rg_status']	=	$_POST['after_rg_status'];
			$data['after_rg_link']		=	$_POST['after_rg_link'];
			$data['after_rg_text']		=	$_POST['after_rg_text'];
			
			//----------------dfsm-----------------------
			
			
			
			$data['create_date']	=	date('Y-m-d H:i:s');		
			
			if($_POST['mode']=='edit'){
				$this->ObjM->update($data,'m2m_capture_master','page_code',$_POST['eid']);
			}else{
				$this->ObjM->addItem($data,'m2m_capture_master');
			}
			
		}
		
		header('Location: '.base_url().'index.php/m2m/'.$this->uri->rsegment(1).'/view/');
		exit;
		
	}
	

	//-------------------------dfsm---------------------------
	 function cp_delete($eid)
	{
		$data['eid'] = $_POST['page_code'];	
		$data['result']=$this->ObjM->get_capture_page_record_by_id($eid);
		$this->ObjM->delete('m2m_capture_master',array('page_code'=>$eid));
		//var_dump($data['result']);
		header('Location: '.base_url().'index.php/m2m/'.$this->uri->rsegment(1).'/view/');
		exit;
	}
	
	//-------------------------dfsm---------------------------
	
	
}


