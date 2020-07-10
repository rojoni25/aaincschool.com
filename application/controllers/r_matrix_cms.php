<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class r_matrix_cms extends CI_Controller {
	
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata["r_matrix_admin"]['access']!='true'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('r_matrix_model','ObjM',TRUE);
 	}
	
	public function view()
	{
		$data['result']		=	$this->ObjM->get_cms_page('r_matrix');
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('r_matrix/r_matrix_cms_add',$data);
		$this->load->view('comman/footer');
	
	}
	
	function insertrecord(){
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			 
		
			$data['title']		=	(isset($_POST['title'])) 		? 	$_POST['title'] 	: 	"";
			$data['textdt']		=	(isset($_POST['textdt'])) 		? 	$_POST['textdt'] 	: 	"";
			$data['textdt2']	=	(isset($_POST['textdt2'])) 		? 	$_POST['textdt2'] 	: 	"";
			$data['textdt3']	=	(isset($_POST['textdt3'])) 		? 	$_POST['textdt3'] 	: 	"";
			$data['textdt4']	=	(isset($_POST['textdt3'])) 		? 	$_POST['textdt4'] 	: 	"";
			$data['video_url']	=	(isset($_POST['video_url'])) 	? 	$_POST['video_url'] : 	"";
			$data['bg_img_url']	=	(isset($_POST['bg_img_url'])) 	? 	$_POST['bg_img_url']: 	"";
			
			
			$this->session->set_flashdata('show_msg','Member Dashboard CMS Update Successfully');
					
			$this->ObjM->update($data,'cms_pages_master','cms_pages_code',$this->input->post('eid'));
			header('Location: '.base_url().'index.php/r_matrix/dashboard');
			exit;
			
		}
	}
	
	


}
