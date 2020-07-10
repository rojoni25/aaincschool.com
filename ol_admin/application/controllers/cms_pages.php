<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cms_pages extends CI_Controller {
	protected $table		=	'cms_pages_master';
	protected $primary_key	=	'cms_pages_code';
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		$this->load->model('cms_pages_model','ObjM',TRUE);
		
 	}
	
	public function view($eid)
	{
		$data['page_type']	=	$this->ObjM->get_page_type();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_view',$data);
		$this->load->view('comman/footer');
	}
	
	
	function listing($eid)
	{
		$result=$this->ObjM->getAll($eid);
		$html='';
		for($i=0;$i<count($result);$i++){
			
			
			$html .='<tr class="'.$status.'">
						<td>'.$result[$i]['pagename'].'</td>
						<td>'.$result[$i]['title'].'</td>
						<td>
						<a href="'.base_url().'index.php/'.$this->uri->segment(1).'/Addnew/Edit/'.$result[$i]['cms_pages_code'].'" class="edit_rcd"><button class="btn-warning btncls" type="button">Edit</button></a>
						</td>
              		</tr>';
		}
		
			echo $html;
	}
	
	function addnew()
	{
		if($this->uri->segment(3)=='Edit'){
			$data['result']=$this->ObjM->get_record($this->uri->segment(4));
		}

		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_add',$data);
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
					
			$this->ObjM->update($data,'cms_pages_master','cms_pages_code',$this->input->post('eid'));
			header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'/view/'.$_POST['page_type']);
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
	
	function record_update()
	{
		$data=array();
		$data['status']='Delete';	
		$this->ObjM->update($data,'capture_page_master','cms_pages_code',$this->uri->segment(3));	
	}
	
	function custom_page()
	{
		$data['result']	=	$this->ObjM->get_custom_page();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('custom_cms_page_view',$data);
		$this->load->view('comman/footer');
	}
	
	function custom_page_edit($eid)
	{
		$data['result']	=	$this->ObjM->get_custom_page_by_id($eid);
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('custom_cms_page_add',$data);
		$this->load->view('comman/footer');
	}
	
	function custom_page_insert(){
		
		$data = array();	
		
		$data['title']		=	$_POST['title'];
		$data['textdt']		=	$_POST['textdt'];
		$data['video_url']	=	$_POST['video_url'];
		$data['textdt2']	=	$_POST['textdt2'];
		
		
		
		$this->ObjM->update($data,'custom_cms_page','pagecode',$this->input->post('eid'));
		header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'/custom_page/'.$_POST['page_type']);
		exit;
	}
	
	function custom_page_permission($eid)
	{
		
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			if($_POST['search']=='Y'){
				$data['search']=$this->search_member();
			}
			if($_POST['get_permission']=='Y'){
				$this->permission_insert();
			}
			
		}
		
		$data['result']	=	$this->ObjM->get_custom_page_by_id($eid);	
		
		$data['result_list']	=	$this->ObjM->get_permition_member_list($eid);	
		

		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('custom_cms_page_permission',$data);
		$this->load->view('comman/footer');	
	}
	
	
	protected function search_member(){
		
		$memberdt=$this->ObjM->search_member($_POST['membercode']);
	
		if(!isset($memberdt[0])){
			$arr['vali']	=	false;
			$arr['msg']		=	"Invailed Search";	
			return $arr;		
		}
		
		
		$chk_permission = $this->ObjM->check_member($memberdt[0]['usercode'],$_POST['pagecode']);
		
		if(isset($chk_permission[0])){
			$arr['vali']=false;
			$arr['msg']		=	"".$memberdt[0]['fname']." ".$memberdt[0]['lname']." is Already  Permission";			
			return $arr;
		}
			
			$arr['vali'] = true;
			$arr['dt']  = $memberdt[0];
			return $arr;
			
	}
	
	protected function permission_insert()
	{
		$data['pagecode']	=	$_POST['pagecode'];
		$data['usercode']	=	$_POST['usercode'];
		
		$this->ObjM->addItem($data,'custom_cms_page_permission');
		
		$this->session->set_flashdata('show_msg','Permission Insert Successfully');	
		header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'/custom_page_permission/'.$_POST['pagecode'].'');
		exit;
		
	}
	
	function remove_permission($eid,$pagecode){
		$this->ObjM->remove_permission($eid);
		$this->session->set_flashdata('show_msg','Permission Remove Successfully');	
		header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'/custom_page_permission/'.$pagecode);
	}
	
	
	
	
}

