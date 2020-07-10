<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class scompany extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
		//---------------------smfund---------------------
		if(($smfund_admin_valid)||($this->session->userdata['logged_smfund_member'])){header('Location: '.smfund().'welcome/view');exit;}
		//---------------------smfund---------------------
		$this->load->model('scompany_module','ObjM',TRUE);
		$this->load->library('email');
   		
 	}
	
	function index(){
		
		$data['contain']=$this->ObjM->get_pages_cms('team_build');
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('scompany_page_find',$data);
		$this->load->view('comman/footer');
	}
	
	public function view()
	{
	
		$data['contain']=$this->ObjM->get_pages_contain($_REQUEST['page_key']);
		
		
		
		if($data['contain'][0]['page_type']=='kdk_page')
		{
			
			$this->kdk_page();
			
		}
		elseif($data['contain'][0]['page_type']=='c3_page')
		{
			
			$this->cm_page();
			
		}
		
		elseif($data['contain'][0]['page_type']=='tl_page')
		{
			
			$this->tl_page();
			
		}
		//----------TLC-----------
		elseif($data['contain'][0]['page_type']=='tlc_page')
		{
			
			$this->tlc_page();
			
		}
		//----------TLC-----------
		elseif($data['contain'][0]['page_type']=='ang_page')
		{
			
			$this->ang_page();
			
		}
		
		elseif($data['contain'][0]['page_type']=='rec_page')
		{
			
			$this->rec_page();
			
		}
		
		elseif($data['contain'][0]['page_type']=='gcp_page')
		{
			
			$this->gcp_page();
			
		}
		
		elseif($data['contain'][0]['page_type']=='kdk1_page')
		{
			
			$this->kdk1_page();
			
		}
		elseif($data['contain'][0]['page_type']=='nda_page')
		{
			
			$this->nda_page();
			
		}
		elseif($data['contain'][0]['page_type']=='m2m_page'){
			$this->m2m_page();
		}
		
		elseif($data['contain'][0]['page_type']=='dreem_student'){
			$this->dreem_student();
		}
		
		else
		{
				
			$this->view_page();
			
		}
		
	}
	
	protected function view_page(){
		
		$data['contain']	=	$this->ObjM->get_pages_contain($_REQUEST['page_key']);
		
		if(!isset($data['contain'][0])){
			
			$this->session->set_flashdata('show_msg', 'Invalid Page Code');
			
			header('Location: '.base_url().'index.php/scompany');
			
			exit;
		}
		else{
			
			$data['permission']=$this->ObjM->get_permission($data['contain'][0]['secret_page_code']);
			
		}
		
		$this->load->view('comman/topheader');
		
		$this->load->view('comman/header');
		
		$this->load->view('scompany_view',$data);
		
		$this->load->view('comman/footer');
		
	}
	
	protected function kdk_page()
	{
		
		header('Location: '.base_url().'index.php/rm_page/view/?page_key='.$_REQUEST['page_key']);
		
		exit;
	}
	
	protected function cm_page(){
		
		header('Location: '.base_url().'index.php/club/page/view/?page_key='.$_REQUEST['page_key']);
		
		exit;
	}
	protected function tl_page(){
		
		header('Location: '.base_url().'index.php/tl/page/view/?page_key='.$_REQUEST['page_key']);
		
		exit;
	}	
	//------------hp--------
   protected function tlc_page(){
		
		header('Location: '.base_url().'index.php/tlc/page/view/?page_key='.$_REQUEST['page_key']);
		
		exit;
	}	
   protected function ang_page(){
		
		header('Location: '.base_url().'index.php/ang/page/view/?page_key='.$_REQUEST['page_key']);
		
		exit;
	}
	
	protected function rec_page(){
		
		header('Location: '.base_url().'index.php/rec/page/view/?page_key='.$_REQUEST['page_key']);
		
		exit;
	}	
	
	protected function gcp_page(){
		
		header('Location: '.base_url().'index.php/gcp/page/view/?page_key='.$_REQUEST['page_key']);
		
		exit;
	}	
	
	protected function kdk1_page(){
		
		header('Location: '.base_url().'index.php/kdk1/page/view/?page_key='.$_REQUEST['page_key']);
		
		exit;
	}	
	
	protected function nda_page(){
		
		header('Location: '.base_url().'index.php/nda/page/?page_key='.$_REQUEST['page_key']);
		
		exit;
	
	}
	
	protected function m2m_page(){
		
		header('Location: '.base_url().'index.php/m2m/page/view/');
		
		exit;
	
	}
	
	protected function dreem_student(){
		
		header('Location: '.base_url().'index.php/dreem_student/page/view/');
		
		exit;
	
	}
	
	
	
	
	public function show($page_key)
	{
		$data['contain']=$this->ObjM->get_pages_contain($page_key);
		
		if(!isset($data['contain'][0])){
			header('Location: '.base_url().'index.php/scompany');
			exit;
		}
		else{
			$data['permission']=$this->ObjM->get_permission($data['contain'][0]['secret_page_code']);
		}
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('scompany_view',$data);
		$this->load->view('comman/footer');
	
	}
	
	function edit_page($secret_page_code){
		$permission=$this->ObjM->get_permission($secret_page_code);
		if(!isset($permission[0])){
			header('Location: '.base_url().'index.php/scompany');
			exit;
		}
		$data['result']=$this->ObjM->get_pages_contain_by_id($secret_page_code);
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('scompany_add',$data);
		$this->load->view('comman/footer');
	}
	
	function insertrecord(){
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{	
			$permission=$this->ObjM->get_permission($this->input->post('eid'));
			if(isset($permission[0]))
			{
				$now = time();
				$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
				$data = array();
		
				$data['page_title']		=	$this->input->post('page_title');
				$data['video_link']		=	$this->input->post('video_link');
				$data['contain']		=	$this->input->post('contain');
			
				$data['update_date']	=	$nowdt;	
				$data['update_by']		=	$this->session->userdata['logged_ol_member']['usercode'];
			
				$this->ObjM->update($data,'compay_secret_page','secret_page_code',$this->input->post('eid'));	
			}
			
			header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'/view/?page_key='.$this->input->post('page_key'));
			exit;	
			
		}
	}
	
	
	function join_pdl()
	{
		$this->_join_pdl();
	}
	
	
	protected function _join_pdl()
	{
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('pdl_member/pdl_subscribe_add',$data);
		$this->load->view('comman/footer');	
	}
	
	
	
}


