<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cms_pages extends CI_Controller {
	protected $table		=	'cms_pages_master';
	protected $primary_key	=	'cms_pages_code';
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		
		if(!$this->comman_fun->check_record('smfund_member',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode'],'admin'=>'Yes'))){
			header('Location: '.smfund().'welcome/view');
			exit;
		}
		
		$this->load->model('smfund/comman_modul','ObjM',TRUE);
		
 	}
	
	public function view($eid)
	{
		
		
		
		if($eid!=''){
			$data['result']		=	$this->comman_fun->get_table_data('smfund_cms_pages_master',array('status !='=>'Delete','page_type'=>$eid));
			
		}else{
			$data['result']		=	$this->comman_fun->get_table_data('smfund_cms_pages_master',array('status !='=>'Delete'));
		
		}
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('smfund/cms_pages_view',$data);
		$this->load->view('comman/footer');
	}
	
	
	
	
	
	//add by hardik
	
	//public function cms_view($eid)
//	{
//		$data['contain']	=	$this->comman_fun->get_table_data('smfund_cms_pages_master',array('pagelable'=>$eid));
//	
//		$this->load->view('comman/topheader');
//		$this->load->view('comman/header');
//		$this->load->view('smfund/welcome_view',$data);
//		$this->load->view('comman/footer');
//	}
	
	//add by hardik
	
	
	
	function addnew($eid)
	{
		
		$data['result']	=	$this->comman_fun->get_table_data('smfund_cms_pages_master',array('status !='=>'Delete','cms_pages_code'=>$eid));
		

		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('smfund/cms_pages_add',$data);
		$this->load->view('comman/footer');
	}

	function insertrecord(){
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			
			if(isset($_POST['title']))
			{
				$data['title']				=	$_POST['title'];
			}
			else{
				$data['title']				=	'';
			}
			
			if(isset($_POST['textdt']))
			{
				$data['textdt']				=	$_POST['textdt'];
			}
			else{
				$data['textdt']				=	'';
			}
			
			if(isset($_POST['textdt2']))
			{
				$data['textdt2']				=	$_POST['textdt2'];
			}
			else{
				$data['textdt2']				=	'';
			}
			
			if(isset($_POST['textdt3']))
			{
				$data['textdt3']				=	$_POST['textdt3'];
			}
			else{
				$data['textdt3']				=	'';
			}
			
			if(isset($_POST['textdt4']))
			{
				$data['textdt4']				=	$_POST['textdt4'];
			}
			else{
				$data['textdt4']				=	'';
			}
			
			if(isset($_POST['video_url']))
			{
				$data['video_url']			=	$_POST['video_url'];
			}
			else{
				$data['video_url']			=	$_POST['video_url'];
			}
			
			if(isset($_POST['bg_img_url']))
			{
				$data['bg_img_url']			=	$_POST['bg_img_url'];
			}
			else{
				$data['bg_img_url']			=	$_POST['bg_img_url'];
			}
			
		
					
			$this->comman_fun->update($data,'smfund_cms_pages_master',array('cms_pages_code'=>$this->input->post('eid')));
			header('Location: '.smfund().$this->uri->rsegment(1).'/view/');
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

