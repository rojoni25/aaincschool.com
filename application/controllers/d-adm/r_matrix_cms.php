<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class r_matrix_cms extends CI_Controller {
	
	
	function __construct()
 	{
   		parent::__construct(); 
		$this->file_setting();
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata[MATRIX_SESSION_ADMIN]['access']!='true'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('matrix_comman/r_matrix_model','ObjM',TRUE);
		$this->load->library('email');
	
		
 	}
	
	protected function file_setting()
	{
		if(file_exists(APPPATH. 'config/matrix_const/'.$this->uri->segment(1).'/const.php')){
			include(APPPATH. 'config/matrix_const/'.$this->uri->segment(1).'/const.php');	
			if(!defined('MATRIX_TABLE_PRE')){ 	 echo 'Seting Not proper {1}'; exit;}
			if(!defined('MATRIX_CODE_LLB')){ 	 echo 'Seting Not proper {2}'; exit;}
			if(!defined('MATRIX_LLB')){ 		 echo 'Seting Not proper {3}'; exit;}
			if(!defined('MATRIX_SYSTEM_ADMIN')){ echo 'Seting Not proper {4}'; exit;}
		}
		else{
			echo 'File Not Set';
			exit;
		}
	}
	
	public function view()
	{
		
		$data['result']		=	$this->ObjM->get_cms_page(MATRIX_TABLE_PRE.'matrix');
		//var_dump($data['result']);
		//exit;
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.MATRIX_FOLDER.'/admin/r_matrix_cms_add',$data);
		$this->load->view('comman/footer');
	
	}
	
	function insertrecord(){
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$result		=	$this->ObjM->get_cms_page(MATRIX_TABLE_PRE.'matrix'); 
			
			$data['title']		=	(isset($_POST['title'])) 		? 	$_POST['title'] 	: 	"";
			$data['textdt']		=	(isset($_POST['textdt'])) 		? 	$_POST['textdt'] 	: 	"";
			$data['textdt2']	=	(isset($_POST['textdt2'])) 		? 	$_POST['textdt2'] 	: 	"";
			$data['textdt3']	=	(isset($_POST['textdt3'])) 		? 	$_POST['textdt3'] 	: 	"";
			$data['textdt4']	=	(isset($_POST['textdt3'])) 		? 	$_POST['textdt4'] 	: 	"";
			$data['video_url']	=	(isset($_POST['video_url'])) 	? 	$_POST['video_url'] : 	"";
			$data['bg_img_url']	=	(isset($_POST['bg_img_url'])) 	? 	$_POST['bg_img_url']: 	"";
			
			
			$this->session->set_flashdata('show_msg','Member Dashboard CMS Update Successfully');
					
			$this->ObjM->update($data,'cms_pages_master','cms_pages_code',$result[0]['cms_pages_code']);
			
			header('Location: '.MATRIX_BASE.'/r_matrix/dashboard/');
			exit;
		
			
		}
	}
	
	


}
