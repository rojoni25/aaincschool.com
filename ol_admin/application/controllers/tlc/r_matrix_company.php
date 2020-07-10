<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class r_matrix_company extends CI_Controller {
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		//if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		$this->file_setting();
		//if($this->session->userdata[MATRIX_SESSION_ADMIN]['access']!='true'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('matrix_comman/company_model','ObjM',TRUE);
		
		$this->load->library('upload');
		$this->load->library('image_lib');
		
 	}
	
	protected function file_setting()
	{
		if(file_exists(APPPATH. 'config/matrix_const/'.$this->uri->segment(1).'/const.php')){
			include(APPPATH. 'config/matrix_const/'.$this->uri->segment(1).'/const.php');	
			if(!defined('MATRIX_TABLE_PRE')){ 	echo 'Seting Not proper {1}'; exit;}
			if(!defined('MATRIX_CODE_LLB')){ 	echo 'Seting Not proper {2}'; exit;}
			if(!defined('MATRIX_LLB')){ 		echo 'Seting Not proper {3}'; exit;}
			if(!defined('MATRIX_SYSTEM_ADMIN')){ echo 'Seting Not proper {4}'; exit;}
		}
		else{
			echo 'File Not Set';
			exit;
		}
	}
	
	public function view()
	{	
		$data['result']=$this->ObjM->get_all();	
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.MATRIX_FOLDER.'/admin/r_matrix_company_view',$data);
		$this->load->view('comman/footer');
	}
	
	public function addnew($mode,$eid)
	{	
		
		$segment_set['mode']	=	($mode=='Edit') ? "Edit" : "Add";
		$segment_set['eid']		=	$eid;
		$data['segment_set']	=	$segment_set;
	
		if($segment_set['mode']=='Edit'){
			$data['result']=$this->ObjM->get_record_by_id($segment_set['eid']);	
		}
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.MATRIX_FOLDER.'/admin/r_matrix_company_add',$data);
		$this->load->view('comman/footer');
	}
	
	
	
	
	function insert(){
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$now = time();
			$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
			$data = array();
				
			$data['company_name']		=	$_POST['company_name'];
			$data['description']		=	$_POST['description'];
			$data['status']				=	$_POST['status'];
			$data['section']			=	$_POST['section'];
			
			if($_FILES['upload_logo']['name']!='')
			{
				$data['company_logo']   =	$this->upload_img($_FILES['upload_logo']);
				$img_exist=true;
			}
		
			
			if($this->input->post('mode')=="Add")
			{
				$data['create_date']	=	$nowdt;	
				$data['create_by']		=	$this->session->userdata['logged_ol_member']['usercode'];	
				$this->ObjM->addItem($data,MATRIX_TABLE_PRE.'company');
				$msg='Company Add Successfully';
			}
			if($this->input->post('mode')=="Edit")
			{
				if($img_exist){
					$this->delete_old_img($this->input->post('eid'));
				}
				
				$data['update_date']	=	$nowdt;	
				$data['update_date']	=	$this->session->userdata['logged_ol_member']['usercode'];	
				$this->ObjM->update($data,MATRIX_TABLE_PRE.'company','company_code',$this->input->post('eid'));	
				$msg='Company Update Successfully';
			}
			
		}
		
		$this->session->set_flashdata('show_msg',$msg);
		
		header('Location: '.MATRIX_BASE.$this->uri->rsegment(1).'/view');
		exit;
		
				
	}
	
	
	function delete_old_img($eid)
	{
		$result		=	$this->ObjM->get_record_by_id($eid);
		$url	=	'./upload/company/'.$result[0]['company_logo'];
		unlink($url);
	}
	
	protected function upload_img($file)
	{
			if($file['name']!=''){
					$config = array();
					$config['upload_path'] 				= 	'./upload/company/';
					$config['allowed_types'] 			= 	'gif|jpg|png';
					$config['max_size']      			= 	'0';
					$config['overwrite']     			= 	TRUE;
					$_FILES['userfile']['name'] 		= 	$file['name'];
					$_FILES['userfile']['type'] 		= 	$file['type'];
					$_FILES['userfile']['tmp_name']		= 	$file['tmp_name'];
					$_FILES['userfile']['error']		= 	$file['error'];
					$_FILES['userfile']['size']			= 	$file['size'];
					$rand=rand(100000,10000000);
					$fileName=$rand.$file['name'];
					$fileName = str_replace(" ","",$fileName);
					$config['file_name'] = $fileName;
					$this->upload->initialize($config);
					$this->upload->do_upload();
					
					$upload_data = $this->upload->data();
					$image_config["image_library"] = "gd2";
					$image_config["source_image"] = $upload_data["full_path"];
					$image_config['create_thumb'] = FALSE;
					$image_config['maintain_ratio'] = TRUE;
					$image_config['new_image'] = './upload/company/'.$fileName;
					$image_config['quality'] = "80%";
					$image_config['width'] = 150;
					$image_config['height'] = 150;
					$this->load->library('image_lib');
					$this->image_lib->initialize($image_config);
					$this->image_lib->resize();
					return	$fileName;		
			}	
				
	}
	
	
	function delete_inbox($eid){
		$data=array();
		$data['status_to']	=	'Delete';
		$this->ObjM->update($data,''.MATRIX_TABLE_PRE.'message','id',$eid);	
	}
	
	
	
	
	
	
	
}

