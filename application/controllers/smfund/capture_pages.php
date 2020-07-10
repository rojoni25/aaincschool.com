<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class capture_pages extends CI_Controller {
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
	
	public function view($id)
	{
		
		$data['result']		=	$this->ObjM->get_page_record($id);
		$data['category']	=	$this->comman_fun->get_table_data('capture_filter_type');
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('smfund/page_thum_list_view',$data);
		$this->load->view('comman/footer');
	}
	
	function list_view(){
		
		$data['result']=$this->ObjM->get_capture_page_list();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('smfund/capture_pages_list',$data);
		$this->load->view('comman/footer');
		
	}
	
	
	function add_new_page($mode,$eid){
		
		$data['set']=array('mode'=>'add','eid'=>$eid);
	
		$this->comman_fun->delete('smfund_capture_page_preview',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']));
		
		$priview['page_name']	=	'priview';
		$data['priview_code']	=	$this->comman_fun->addItem($priview,'smfund_capture_page_preview');
		$data['master_page']	=	$this->comman_fun->get_table_data('capture_page_record',array('pagecode'=>$eid));
		

		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('smfund/capture_pages_add',$data);
		$this->load->view('comman/footer');
	}
	
	
	function edit_page($mode,$eid){
		
		$data['set']=array('mode'=>'edit','eid'=>$eid);
		
		$data['result']=$this->comman_fun->get_table_data('smfund_capture_page_master',array('capture_page_code'=>$eid));
		
		$this->comman_fun->delete('smfund_capture_page_preview',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']));
		
		$priview['page_name']	=	'priview';
		$data['priview_code']	=	$this->comman_fun->addItem($priview,'smfund_capture_page_preview');
		$data['master_page']	=	$this->comman_fun->get_table_data('capture_page_record',array('pagecode'=>$data['result'][0]['pagecode']));
		

		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('smfund/capture_pages_add',$data);
		$this->load->view('comman/footer');
	}
	
	
	function insertrecord(){
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$now = time();
			$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
			$data = array(); 
			
			$field=$this->ObjM->table_fildld_name('capture_page_master');	
			
			for($p=1;$p<count($field);$p++)
			{
				if(isset($_POST[''.$field[$p].''])){
					
					$data[''.$field[$p].'']= $_POST[''.$field[$p].''];
				}
				
			}
			$data['headline_text']					=	$this->remove_ptag($this->make_safe($this->input->post('headline_text')));
			
			
			
			if($this->input->post('mode')=="add"){
				$data['pagecode']			=	$this->input->post('master_page_code');
				$data['usercode']			=	$this->session->userdata['logged_ol_member']['usercode'];
				$data['status']				=	'Active';
				$data['page_section']		=	'my_page';
				$data['change']				=	'Y';
				
				
				
				$this->comman_fun->addItem($data,'smfund_capture_page_master');	
			}
			if($this->input->post('mode')=="edit"){
				$this->comman_fun->update($data,'smfund_capture_page_master',array('capture_page_code'=>$this->input->post('eid')));		
			}
		
			header('Location: '.smfund().$this->uri->rsegment(1).'/view');
			exit;
			
		}
	}
	
	
	function insert_priview(){
	
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$now = time();
			$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
			$data = array(); 
			
			$field=$this->ObjM->table_fildld_name('capture_page_master');	
			
			for($p=1;$p<count($field);$p++)
			{
				if(isset($_POST[''.$field[$p].''])){
					
					$data[''.$field[$p].'']= $_POST[''.$field[$p].''];
				}
				
			}
			$data['pagecode']				=	$this->input->post('master_page_code');	
			
			$data['headline_text']			=	$this->remove_ptag($this->make_safe($this->input->post('headline_text')));
		
			$this->comman_fun->update($data,'smfund_capture_page_preview',array('capture_page_code'=>$this->input->post('priview_code')));	
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
	
	public function openpopup($eid)
	{
		
		if($eid=='mp4' || $eid=='youtube'){
			$data['mediatype']='video';
		}
		else{
			$data['mediatype']='images';
		}
		$data['mediatype']=$_REQUEST['type'];
	
		$data['result']	=	$this->capture_pages_model->get_media_for_popup($_REQUEST['type']);
		
		$this->load->view('media_file_popup_view',$data);
	}
	
	public function report_issue_popup()
	{
		//$data['result']		=	$this->capture_pages_model->get_page_record($pagecode);
		$this->load->view('report_issue_popup_view',$data);
	}
	
	
	function report_issue_insert(){
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$now = time();
			$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
			$data = array(); 
			$data['issue_url_code']			=	$this->input->post('issue_url_code');
			$data['issue_url']			=	$this->input->post('issue_url');
			$data['contain']			=	$this->input->post('contain');	
			$this->capture_pages_model->addItem($data,'report_issue_master');	
			
			header('Location: '.base_url().'index.php/'.$this->uri->segment(1));
			exit;
		}
	}
	
	function show_video($eid)
	{
		$data['video_link']	=	$this->capture_pages_model->get_media_gallery($eid);
		$this->load->view('z_show_video',$data);
	}
	
	
	
	
	
	
	
	function capture_pages_request_insert(){
	
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$now = time();
			$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
			$data = array(); 
			
			$field=$this->capture_pages_model->table_fildld_name('capture_page_master');	
			
			for($p=1;$p<count($field);$p++)
			{
				if(isset($_POST[''.$field[$p].''])){
					
					$data[''.$field[$p].'']= $_POST[''.$field[$p].''];
				}
				
			}
			$data['usercode']   	=  $this->session->userdata['logged_ol_member']['usercode'];
			$data['status'] 		=  'Active';
			$data['request_dt'] 	=  $nowdt;
			$code=$this->capture_pages_model->addItem($data,'capture_page_request');
			$admin_email	=	$this->capture_pages_model->get_admin_email();
			// $message='<p><h3>Capture Page Request</h3></p>';
			// $message.='<p>Member Name	:'.$this->session->userdata['logged_ol_member']['fullname'].'</p>';
			// $message.='<p>Username	:'.$this->session->userdata['logged_ol_member']['username'].'</p>';
			// $message.='<p>Username	:'.$this->session->userdata['logged_ol_member']['usercode'].'</p>';
			// $message.='<p>Request Page Code	:'.$code.'</p>';
			$message = get_email_cms_page_master('capture_page_request_insert')->result()[0]->textdt;
			$message = str_replace("[fullname]",$this->session->userdata['logged_ol_member']['fullname'],$message);
			$message = str_replace("[username]",$this->session->userdata['logged_ol_member']['username'],$message);
			$message = str_replace("[usercode]",$this->session->userdata['logged_ol_member']['usercode'],$message);
			$message = str_replace("[requestedpagecode]",$code,$message);
	
			$e_array=array("heading"=>"Capture Page Request","msg"=>$message,"msg"=>$message,"contain"=>"");
			$message=email_template_one($e_array);
			
			// $this->email->from(FROM_EMAIL);
			// $this->email->to($admin_email[0]['emailid']);
			// $this->email->subject('Capture Page Request');
			// $this->email->message($message);
			// $this->email->send();
			
			sendemail(FROM_EMAIL,'Capture Page Request',$admin_email[0]['emailid'],$message);
			
			header('Location: '.base_url().'index.php/'.$this->uri->segment(1));
			exit;
						
		}
	}
	
	
	
}

