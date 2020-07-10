<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class member_pages extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
		//---------------------smfund---------------------
		//if(($smfund_admin_valid)||($this->session->userdata['logged_smfund_member'])){header('Location: '.smfund().'welcome/view');exit;}
		//---------------------smfund---------------------
		
		$this->load->model('member_pages_module','',TRUE);
   		
 	}
	
	public function index()
	{
		
		$data['contain']=$result=$this->member_pages_module->get_pages_contain('member_page_contain');
		$data['html']=$this->listing();
		$data2['table_list']=true;
		$this->load->view('comman/topheader',$data2);
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_view',$data);
		$this->load->view('comman/footer');
	
	}
	
	
	function listing(){
		$result=$this->member_pages_module->getAll('member_page');
		
		$html='';
		for($i=0;$i<count($result);$i++){
			
			
			
			
			$html .='<tr>
						<td>'.$result[$i]['page_name'].'</td>
						<td>'.base_url().'index.php/capture/page/'.$result[$i]['capture_page_code'].'/'.$this->session->userdata['logged_ol_member']['username'].'</td>
						<td>
						<div class="btn-group">
							<button data-toggle="dropdown" class="btn btn-danger btn-xs dropdown-toggle" type="button" id="btnGroupDrop1">Operation
							<span class="caret"></span></button>
							<ul aria-labelledby="btnGroupDrop1" role="menu" class="dropdown-menu">
								<li><a href="'.base_url().'index.php/'.$this->uri->segment(1).'/member_page_add/Edit/'.$result[$i]['capture_page_code'].'" class="edit_rcd">Edit</a></li>
								<li><a href="#" class="pageperview" value="'.$result[$i]['capture_page_code'].'">Preview</a></li>
								<li><a href="'.base_url().'index.php/view_friends/invitefriends/?page='.$result[$i]['capture_page_code'].'">Send</a></li>
							</ul>
							</div>
						</td>
						
						
						
              		</tr>';
		}
		
		
		return $html;
	}
	
	function insertrecord(){
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$now = time();
			$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
			$data = array();
			$field=$this->member_pages_module->table_fildld_name('capture_page_master');
			
			for($p=1;$p<count($field);$p++)
			{
				if(isset($_POST[''.$field[$p].''])){
					$data[''.$field[$p].'']= $_POST[''.$field[$p].''];
				}
				
			}
			$data['headline_text']		=	$this->remove_ptag($this->make_safe($this->input->post('headline_text')));
			
			$data['option_form']=($_POST['option_form']=='Y' ? "Y" : "N");
				
			$data['page_bg_video_mute']=($_POST['page_bg_video_mute']=='Y' ? "Y" : "N");
			
			if($this->input->post('mode')=="Add")
			{	
				$data['usercode']		=	$this->session->userdata['logged_ol_member']['usercode'];
				$data['page_section']	=	'member_page';
				$data['pagecode']		=	'page15';
				
				$this->member_pages_module->addItem($data,'capture_page_master');
			}
			if($this->input->post('mode')=="Edit")
			{
				$this->member_pages_module->update($data,'capture_page_master','capture_page_code',$this->input->post('eid'));			
			}
			
			
			header('Location: '.base_url().'index.php/'.$this->uri->segment(1));
			exit;
			
		}
	}
	
	function insert_priview(){
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			
			$now = time();
			$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
			$data = array();
			
			$field=$this->member_pages_module->table_fildld_name('capture_page_master');	
			
			for($p=1;$p<count($field);$p++)
			{
				if(isset($_POST[''.$field[$p].''])){
					
					$data[''.$field[$p].'']= $_POST[''.$field[$p].''];
				}
				
			}
			$data['headline_text']		=	$this->remove_ptag($this->make_safe($this->input->post('headline_text')));
			$data['pagecode']			=	$this->input->post('master_page_code'); 
			
			$this->member_pages_module->update($data,'capture_page_preview','capture_page_code',$this->input->post('priview_code'));	
			
		
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
	
	function member_page_add()
	{
		$this->member_pages_module->delete_capture_page_preview();
		$priview['page_name']='priview';
		$data['priview_code']=$this->member_pages_module->addItem($priview,'capture_page_preview');
		
		if($this->uri->segment(3)=='Edit')
		{
			$data['result']			=	$this->member_pages_module->get_record($this->uri->segment(4));
			if(!isset($data['result'][0])){
				header('Location: '.base_url().'index.php/'.$this->uri->segment(1));
				exit;
			}
		}
		else{
			if($this->uri->segment(3)=='Add')
			{
				if($this->session->userdata['logged_ol_member']['status']!='Active'){
					header('Location: '.base_url().'index.php/'.$this->uri->segment(1));
					exit;
				}
			}	
			
		}
			

		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('member_pages_add',$data);
		$this->load->view('comman/footer');
	}
	
}


