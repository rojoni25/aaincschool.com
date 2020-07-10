<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ad_cms extends CI_Controller {
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		
		if(!$this->comman_fun->check_record('d2v_admin',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']))){
			header('Location: '.base_url().'index.php/d2v/page/view/');
			exit;
		}
		
		$this->load->model('d2v/ad_module','ObjM',TRUE); 
		
 	}
	
	public function index($eid){
		$this->view();
	}
	
	public function view($eid)
	{
		
		
		if($eid!=''){
			$data['result']		=	$this->comman_fun->get_table_data('d2v_pages_master',array('status !='=>'Delete','page_type'=>$eid));
		}else{
			$data['result']		=	$this->comman_fun->get_table_data('d2v_pages_master',array('status !='=>'Delete'));
		}
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('d2v/admin/pages_view',$data);
		$this->load->view('comman/footer');
	}
	
	
	
	
	function addnew($eid)
	{
		
		$data['result']	=	$this->comman_fun->get_table_data('d2v_pages_master',array('status !='=>'Delete','cms_pages_code'=>$eid));
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('d2v/admin/pages_add',$data);
		$this->load->view('comman/footer');
	}

	function insertrecord(){
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
		
			$data=array();
			$data['title']=isset($_POST['title'])? $_POST['title'] : "";
			$data['textdt']=isset($_POST['textdt'])? $_POST['textdt'] : "";
			$data['video_url']=isset($_POST['video_url'])? $_POST['video_url'] : "";
			
		
			$this->comman_fun->update($data,'d2v_pages_master',array('cms_pages_code'=>$this->input->post('eid')));
			header('Location: '.base_url().'index.php/d2v/'.$this->uri->rsegment(1).'/view/');
			exit;
			
		}
	}
	
	
	
	function remove_ptag($contain){
		return str_replace(array('<p>','</p>'),'',$contain);
	}
	function make_safe($contain) 
	{
		$contain = strip_tags(mysql_real_escape_string(trim($contain)));
		return $contain; 
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
}

