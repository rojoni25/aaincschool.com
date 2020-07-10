<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class capture_page extends CI_Controller {
	protected $table		=	'capture_page_master';
	protected $primary_key	=	'capture_page_code';
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		$this->load->model('capture_page_model','ObjM',TRUE);
		$this->load->library('upload');
		$this->load->library('image_lib');
		$this->load->library('email');
 	}
	
	public function index()
	{
		$data['result']	=	$this->ObjM->get_page_record();
		$data['category']	=	$this->ObjM->get_page_type();
		$data['table_list']=true;

		$data['page_bg_video_autoplay'] = isset($_POST['page_bg_video_autoplay']) ? $_POST['page_bg_video_autoplay'] : "N";

			$data['page_bg_video_mute']	=	($_POST['page_bg_video_mute']=='Y' ? "Y" : "N"); 
			$data['page_bg_video_autoplay_2'] = isset($_POST['page_bg_video_autoplay_2']) ? $_POST['page_bg_video_autoplay_2'] : "N";
			$data['page_bg_video_autoplay_3'] = isset($_POST['page_bg_video_autoplay_3']) ? $_POST['page_bg_video_autoplay_3'] : "N";
			$data['after_reg_new_tab_op'] = isset($_POST['after_reg_new_tab_op']) ? $_POST['after_reg_new_tab_op'] : "N";
			
			$data['after_reg_new_tab'] = isset($_POST['after_reg_new_tab']) ? $_POST['after_reg_new_tab'] : "N";
			
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_view');
		$this->load->view('comman/footer');
	}
	
	public function view($id)
	{
		
		$data['result']		=	$this->ObjM->get_page_record($id);
		$data['category']	=	$this->ObjM->get_page_type();
		$data['table_list']=true;
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_view');
		$this->load->view('comman/footer');

	}
	function my_capture_page()
	{
		$data['table_list']=true;
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view('my_capture_page_view');
		$this->load->view('comman/footer');
	}
	
	function listing(){
		$result=$this->ObjM->getAll();
		//echo"<pre>"; print_r($result); exit();
		$html='';
		for($i=0;$i<count($result);$i++){
			if($result[$i]['status']=='Inactive'){
				$status='st_inactive';
			}
			else{
				$status='';
			}
			
			$html .='<tr class="'.$status.'">
						<td>'.$result[$i]['capture_page_code'].'</td>
						<td>'.$result[$i]['pagelable'].'</td>
						<td>'.$result[$i]['page_name'].'</td>
						<td>'.$result[$i]['pagecode'].'</td>
						<td>
						<a href="'.base_url().'index.php/'.$this->uri->segment(1).'/Addnew/Edit/'.$result[$i]['capture_page_code'].'" class="edit_rcd"><button class="btn-warning btncls" type="button">Edit</button></a>
						<a href="#" class="pageperview" value="'.$result[$i]['capture_page_code'].'"><button class="btn-danger btncls" type="button">Preview</button></a>
						<a href="#" class="delete" value="'.$result[$i]['capture_page_code'].'"><button class="btn-primary btncls" type="button">Delete</button></a>
						</td>
              		</tr>';
		}
		
			echo $html;
	}
	
	function capture_page_report()
	{
		$data['capture_page_list']=$this->ObjM->get_page_record();
				
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view('member_capture_page_view',$data);
		$this->load->view('comman/footer');
	}
	
	function capture_report_listing()
	{
		$data['txt_query']='http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		$this->ObjM->addItem($data,'test_query');
		

		
		$result=$this->ObjM->get_capture_report();
		$count=$this->ObjM->get_tot_count_active();
		
	
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $count[0]['tot'],
			"iTotalDisplayRecords" => ''.$count[0]['tot'].'',
			"aaData" => array()
		);
		for($i=0;$i<count($result);$i++){
			$edit='<a href="'.base_url().'index.php/'.$this->uri->segment(1).'/Addnew/Edit/'.$result[$i]['capture_page_code'].'" class="edit_rcd"><button class="btn-warning btncls" type="button">Edit</button></a>
					<a href="#" class="pageperview" value="'.$result[$i]['capture_page_code'].'"><button class="btn-danger btncls" type="button">Preview</button></a>
					<a href="#" class="delete" value="'.$result[$i]['capture_page_code'].'"><button class="btn-primary btncls" type="button">Delete</button></a>';
			$row = array(
					$result[$i]['capture_page_code'],
					$result[$i]['pagelable'],
					$result[$i]['page_name'],
					$result[$i]['fname'],
					$edit

			);
			$output['aaData'][] = $row;
		}
		echo json_encode( $output );
	}
	function addnew()
	{
		if($this->uri->segment(3)=='Edit')
		{
			$data['result']			=	$this->ObjM->get_record($this->uri->segment(4));
			$data['master_page']	=	$this->ObjM->get_mester_page_record_by_name($data['result'][0]['pagecode']);
		}
		if($this->uri->segment(3)=='Add')
		{
			$data['master_page']	=	$this->ObjM->get_mester_page_record_by_id($this->uri->segment(4));
		}
		$data['page_bg_video_mute']=($_POST['page_bg_video_mute']=='Y' ? "Y" : "N");
		$data['page_bg_video_autoplay'] = isset($_POST['page_bg_video_autoplay']) ? $_POST['page_bg_video_autoplay'] : "N";
		$data['page_bg_video_autoplay_2'] = isset($_POST['page_bg_video_autoplay_2']) ? $_POST['page_bg_video_autoplay_2'] : "N";
		$data['page_bg_video_autoplay_3'] = isset($_POST['page_bg_video_autoplay_3']) ? $_POST['page_bg_video_autoplay_3'] : "N";
		$this->ObjM->delete_capture_page_preview();
		$priview['page_name']='priview';
		$data['priview_code']=$this->ObjM->addItem($priview,'capture_page_preview');
			
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_add',$data);
		$this->load->view('comman/footer');
	}
	
	
	function capture_page_request_add($eid)
	{
		
		$data['result']			=	$this->ObjM->get_capture_page_request_by_id($eid);
		$data['master_page']	=	$this->ObjM->get_mester_page_record_by_name($data['result'][0]['pagecode']);

		$data['page_bg_video_mute']=($_POST['page_bg_video_mute']=='Y' ? "Y" : "N");
		$data['page_bg_video_autoplay'] = isset($_POST['page_bg_video_autoplay']) ? $_POST['page_bg_video_autoplay'] : "N";
		$data['page_bg_video_autoplay_2'] = isset($_POST['page_bg_video_autoplay_2']) ? $_POST['page_bg_video_autoplay_2'] : "N";
		$data['page_bg_video_autoplay_3'] = isset($_POST['page_bg_video_autoplay_3']) ? $_POST['page_bg_video_autoplay_3'] : "N";
		$this->ObjM->delete_capture_page_preview();
		$priview['page_name']='priview';
		$data['priview_code']=$this->ObjM->addItem($priview,'capture_page_preview');
			
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('capture_page_request_add',$data);
		$this->load->view('comman/footer');
	}

	
	/*
	
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
			
			if($_POST['page_for']=='particular'){
				
				$data['page_for']	=	'free';
				$data['usercode']	=	$_POST['user_code'];
				
			}
			
			$data['option_form']=($_POST['option_form']=='Y' ? "Y" : "N");
			
			$data['page_bg_video_mute']=($_POST['page_bg_video_mute']=='Y' ? "Y" : "N");
			$data['page_bg_video_autoplay'] = isset($_POST['page_bg_video_autoplay']) ? $_POST['page_bg_video_autoplay'] : "N";
			$data['page_bg_video_autoplay_2'] = isset($_POST['page_bg_video_autoplay_2']) ? $_POST['page_bg_video_autoplay_2'] : "N";
			$data['page_bg_video_autoplay_3'] = isset($_POST['page_bg_video_autoplay_3']) ? $_POST['page_bg_video_autoplay_3'] : "N";
			$data['after_reg_new_tab_op'] = isset($_POST['after_reg_new_tab_op']) ? $_POST['after_reg_new_tab_op'] : "N";

			$data['after_reg_new_tab'] = isset($_POST['after_reg_new_tab']) ? $_POST['after_reg_new_tab'] : "N";
			
			$data['headline_text']					=	$this->remove_ptag($this->make_safe($this->input->post('headline_text')));
			
			
			
			
			if($_POST['form_type']=='member_pages')
			{
				$data['usercode']			=	$this->input->post('user_code');	
				$data['page_section']		=	'member_page';	
			}
			
			if($this->input->post('mode')=="Add")
			{
				$data['pagecode']			=	$this->input->post('master_page_code');
			    $data['submit_button_title']=	$this->input->post('submit_button_title'); 
				$data['status']				=	'Active';
				$pagecode=$this->ObjM->addItem($data,'capture_page_master');	
			}
			if($this->input->post('mode')=="Edit"){
				$this->ObjM->update($data,'capture_page_master','capture_page_code',$this->input->post('eid'));		
			}
			
			if($_POST['form_type']=='member_pages')
			{
				header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'/member_pages_list');
				exit;
			}
			header('Location: '.base_url().'index.php/'.$this->uri->segment(1));
			exit;
			
		}
	}
	
	*/
	
	// New method insert recode 
	
	function insertrecord(){ if ($this->input->server('REQUEST_METHOD') === 'POST') 
	{ $now = time(); $nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds $data = array();  $field=$this->ObjM->table_fildld_name('capture_page_master'); for($p=1;$p<count($field);$p++) { if(isset($_POST[''.$field[$p].''])){ $data[''.$field[$p].'']= $_POST[''.$field[$p].'']; }  } if($_POST['page_for']=='particular'){ $data['page_for'] = 'free'; $data['usercode'] = $_POST['user_code']; } 
 
$data['option_form']=($_POST['option_form']=='Y' ? "Y" : "N"); 
 
$data['page_bg_video_mute']=($_POST['page_bg_video_mute']=='Y' ? "Y" : "N"); $data['page_bg_video_autoplay'] = isset($_POST['page_bg_video_autoplay']) ? $_POST['page_bg_video_autoplay'] : "N"; $data['page_bg_video_autoplay_2'] = isset($_POST['page_bg_video_autoplay_2']) ? $_POST['page_bg_video_autoplay_2'] : "N"; $data['page_bg_video_autoplay_3'] = isset($_POST['page_bg_video_autoplay_3']) ? $_POST['page_bg_video_autoplay_3'] : "N"; $data['after_reg_new_tab_op'] = isset($_POST['after_reg_new_tab_op']) ? $_POST['after_reg_new_tab_op'] : "N"; 
 
$data['after_reg_new_tab'] = isset($_POST['after_reg_new_tab']) ? $_POST['after_reg_new_tab'] : "N"; 
 
if($this->input->post('master_page_code') == 'page32'){ $data['headline_text'] = $this->input->post('headline_text'); 
 
}else{ 
$data['headline_text'] = $this->remove_ptag($this->make_safe($this->input->post('headline_text'))); } 
 
if($_POST['form_type']=='member_pages') { $data['usercode'] = $this->input->post('user_code'); $data['page_section'] = 'member_page'; } 
 
if($this->input->post('mode')=="Add") 
{ 
$data['pagecode'] =
$this->input->post('master_page_code');     $data['submit_button_title']= $this->input->post('submit_button_title');  $data['status'] = 'Active'; $pagecode=$this->ObjM->addItem($data,'capture_page_master'); } if($this->input->post('mode')=="Edit"){ 
$this->ObjM->update($data,'capture_page_master','capture_page_code',$this->input->post('eid')); } 
 
if($_POST['form_type']=='member_pages') { header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'/member_pages_list'); exit; } header('Location: '.base_url().'index.php/'.$this->uri->segment(1)); exit; 
 
} 
} 

/*
	
	function insertrecord_capture_request(){

		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$now = time();
			$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
			$data = array(); 
			if($_POST['approve']=='Yes'){
				$field=$this->ObjM->table_fildld_name('capture_page_master');
			}
			else{
				$field=$this->ObjM->table_fildld_name('capture_page_request');	
			}
			
			
			for($p=1;$p<count($field);$p++)
			{
				if(isset($_POST[''.$field[$p].''])){
					
					$data[''.$field[$p].'']= $_POST[''.$field[$p].''];
					
				}
				
			}
			
			$data['option_form']		=	($_POST['option_form']=='Y' ? "Y" : "N");
			$data['page_bg_video_mute']	=	($_POST['page_bg_video_mute']=='Y' ? "Y" : "N");
			$data['headline_text']		=	$this->remove_ptag($this->make_safe($this->input->post('headline_text')));
			$data['after_reg_new_tab_op'] = isset($_POST['after_reg_new_tab_op']) ? $_POST['after_reg_new_tab_op'] : "N";
			$data['after_reg_new_tab'] = isset($_POST['after_reg_new_tab']) ? $_POST['after_reg_new_tab'] : "N";
			if($_POST['approve']=='Yes'){
				
			
				
				$data['page_for']			=	'both';	
				$data['usercode']			=	'0';
				$data['page_section']		=	'capture_page';
				$data['pagecode']			=	$this->input->post('master_page_code');
				$data['status']				=	'Active';	
				$id=$this->ObjM->addItem($data,'capture_page_master');
				
				$info=array();
				$info['status']			=	'Done';
				$info['master_code']	=	$id;
				$this->ObjM->update($info,'capture_page_request','request_code',$_POST['request_code']);
				$this->send_email($id);
				
			}
			else{
				$this->ObjM->update($data,'capture_page_request','request_code',$_POST['request_code']);
			}
			
			
			header('Location: '.base_url().'index.php/capture_page/capture_page_request');
			exit;
			
		}
	}
	*/
	
	// New page record method
	
	function  insertrecord_capture_request(){ 
 
if ($this->input->server('REQUEST_METHOD') === 'POST') { $now = time(); $nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds $data = array();  if($_POST['approve']=='Yes'){ $field=$this->ObjM->table_fildld_name('capture_page_master'); } else{ $field=$this->ObjM->table_fildld_name('capture_page_request'); } 
 
 
for($p=1;$p<count($field);$p++) { if(isset($_POST[''.$field[$p].''])){ 
 
$data[''.$field[$p].'']= $_POST[''.$field[$p].'']; 
 
} 
 
} 
 
$data['option_form'] = ($_POST['option_form']=='Y' ? "Y" : "N"); $data['page_bg_video_mute'] = ($_POST['page_bg_video_mute']=='Y' ? "Y" : "N"); if($this->input->post('master_page_code') == 'page32'){ $data['headline_text'] = $this->input->post('headline_text'); }else{ $data['headline_text'] = $this->remove_ptag($this->make_safe($this->input->post('headline_text'))); } $data['after_reg_new_tab_op'] = isset($_POST['after_reg_new_tab_op']) ? $_POST['after_reg_new_tab_op'] : "N"; $data['after_reg_new_tab'] = isset($_POST['after_reg_new_tab']) ? $_POST['after_reg_new_tab'] : "N"; if($_POST['approve']=='Yes'){ 
 
 
 
$data['page_for'] = 'both'; $data['usercode'] = '0'; $data['page_section'] = 'capture_page'; $data['pagecode'] =
$this->input->post('master_page_code'); 
$data['status'] = 'Active'; $id=$this->ObjM->addItem($data,'capture_page_master'); 

 $info=array(); $info['status'] = 'Done'; $info['master_code'] = $id; $this->ObjM->update($info,'capture_page_request','request_code',$_POST['request_code']); $this->send_email($id); 
 
} else{ 
$this->ObjM->update($data,'capture_page_request','request_code',$_POST['request_code']); 
} 
 
 
header('Location: '.base_url().'index.php/capture_page/capture_page_request'); exit; 
 
} 
} 
	
	
	
	protected function send_email($id){
		$member_dt=$this->ObjM->get_member_by_id($_POST['user_code']);
		
		if($member_dt[0]['email_verification']!='Y' && $member_dt[0]['subscribe']!='Y'){
			return;	
		}
		
		$path_url=str_replace('ol_admin','index.php/capture/page/'.$id.'',base_url());
		
		// $msg='<p>hello, <strong>'.$member_dt[0]['fname'].' '.$member_dt[0]['lname'].'</strong><br> 
		// Your capture page requesr is approve<br>
		// Page Name <strong>'.$_POST['page_name'].'</strong> <br> 
		// Apporove Time '.date('d-m-y H:i:s').'<br>
		// <a href="'.$path_url.'">Click Here</a>
		// </p>';
		$message = get_email_cms_page_master('approve_your_capture_page_request')->result()[0]->textdt;
		$message = str_replace("[fname]",$member_dt[0]['fname'],$message);
		$message = str_replace("[lname]",$member_dt[0]['lname'],$message);
		$message = str_replace("[pagename]",$_POST['page_name'],$message);
		$message = str_replace("[date]",date('d-m-y H:i:s'),$message);
		$message = str_replace("[pathurl]",$path_url,$message);
				
		$e_array=array("heading"=>'Approve Your Capture Page Request',"msg"=>$message,"contain"=>'');
		$message	=  	email_template_one($e_array);
		// $this->email->from(FROM_EMAIL);
		// $this->email->subject('Approve Your Capture Page Request');
		// $this->email->message($message);
		// $this->email->to($member_dt[0]['emailid']);
  		// $this->email->send();
		sendemail(FROM_EMAIL,'Approve Your Capture Page Request',$member_dt[0]['emailid'],$message);
	}
	
	
	/*
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
			//$data['headline_text']		=	$this->remove_ptag($this->make_safe($this->input->post('headline_text')));
			$data['headline_text']		=	$this->input->post('headline_text');
			$data['pagecode']			=	$this->input->post('master_page_code');
			$data['submit_button_title']=	$this->input->post('submit_button_title');
			$data['page_bg_video_autoplay'] = isset($_POST['page_bg_video_autoplay']) ? $_POST['page_bg_video_autoplay'] : "N";
			$data['page_bg_video_mute']	=	($_POST['page_bg_video_mute']=='Y' ? "Y" : "N"); 
			$data['page_bg_video_autoplay_2'] = isset($_POST['page_bg_video_autoplay_2']) ? $_POST['page_bg_video_autoplay_2'] : "N";
			$data['page_bg_video_autoplay_3'] = isset($_POST['page_bg_video_autoplay_3']) ? $_POST['page_bg_video_autoplay_3'] : "N";
			$data['after_reg_new_tab_op'] = isset($_POST['after_reg_new_tab_op']) ? $_POST['after_reg_new_tab_op'] : "N";
			
			$data['after_reg_new_tab'] = isset($_POST['after_reg_new_tab']) ? $_POST['after_reg_new_tab'] : "N";
			
			$data['head_bg']			=	$this->input->post('head_bg')==''?'N':$this->input->post('head_bg');

			
			$this->ObjM->update($data,'capture_page_preview','capture_page_code',$this->input->post('priview_code'));
		
		}
	}
	*/
	
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
//$data['headline_text'] = $this->remove_ptag($this->make_safe($this->input->post('headline_text'))); 
$data['headline_text'] = $this->input->post('headline_text'); 
$data['pagecode'] = $this->input->post('master_page_code'); 
$data['form_title']= $this->input->post('form_title'); //Added this line of code 
$data['submit_button_title']= $this->input->post('submit_button_title'); 
$data['page_bg_video_autoplay'] = isset($_POST['page_bg_video_autoplay']) ? $_POST['page_bg_video_autoplay'] : "N"; 
$data['page_bg_video_mute'] = ($_POST['page_bg_video_mute']=='Y' ? "Y" : "N");  
$data['page_bg_video_autoplay_2'] = isset($_POST['page_bg_video_autoplay_2']) ? $_POST['page_bg_video_autoplay_2'] : "N"; 
$data['page_bg_video_autoplay_3'] = isset($_POST['page_bg_video_autoplay_3']) ? $_POST['page_bg_video_autoplay_3'] : "N"; 
$data['after_reg_new_tab_op'] = isset($_POST['after_reg_new_tab_op']) ? $_POST['after_reg_new_tab_op'] : "N"; 
$data['after_reg_new_tab'] = isset($_POST['after_reg_new_tab']) ? $_POST['after_reg_new_tab'] : "N"; 
$data['head_bg'] = $this->input->post('head_bg')==''?'N':$this->input->post('head_bg'); 
 
$data['background_bg'] = $this->input->post('background_bg')==''?'N':$this->input->post('background_bg'); 
 
$data['video_bg'] = $this->input->post('video_bg')==''?'N':$this->input->post('video_bg'); 
 
$data['form_bg'] = $this->input->post('form_bg')==''?'N':$this->input->post('form_bg'); 
 
$data['submit_bg'] = $this->input->post('submit_bg')==''?'N':$this->input->post('submit_bg'); 
 
$this->ObjM->update($data,'capture_page_preview','capture_page_code',$this->input->post('priview_code')); 
 
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
		$this->ObjM->update($data,'capture_page_master','capture_page_code',$this->uri->segment(3));	
	}
	
	public function openpopup()
	{
		if($eid=='mp4' || $eid=='youtube'){
			$data['mediatype']='video';
		}
		else{
			$data['mediatype']='images';
		}
		$data['mediatype']=$_REQUEST['type'];
		$data['result']	=	$this->auto_load_model->get_media_for_popup($_REQUEST['type']);
		$this->load->view('media_file_popup_view',$data);
	}
	
	function member_pages_list()
	{
		$data['result']	=	$this->ObjM->get_member_pages();
		$data2['table_list']=true;
		$this->load->view('comman/topheader',$data2);
		$this->load->view('comman/header');
		$this->load->view('member_pages_view',$data);
		$this->load->view('comman/footer');
	}
	
	function member_page_add()
	{
		$this->ObjM->delete_capture_page_preview();
		$priview['page_name']='priview';
		$data['priview_code']=$this->ObjM->addItem($priview,'capture_page_preview');
		if($this->uri->segment(3)=='Edit')
		{
			$data['result']			=	$this->ObjM->get_record($this->uri->segment(4));
			$data['membername']		=	$this->ObjM->get_member_by_id($data['result'][0]['usercode']);
			
		}
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('member_pages_add',$data);
		$this->load->view('comman/footer');
	}
	
	function show_video($eid)
	{
		$data['video_link']	=	$this->ObjM->get_media_gallery($eid);
		$this->load->view('z_show_video',$data);
	}
	
	function capture_page_request()
	{
		$data['email']		=	$this->ObjM->email_verification();
		//var_dump($data['email']);
		if($this->uri->segment(3)=='Delete'){
		$data['result']		=	$this->ObjM->get_capture_page_request_delete();

		}
		else if($this->uri->segment(3)=='Done'){
		$data['result']		=	$this->ObjM->get_capture_page_request_done();

		}
		else{
			$data['result']		=	$this->ObjM->get_capture_page_request();
		}
		
		
		$data2['table_list']=true;
		$this->load->view('comman/topheader',$data2);
		$this->load->view('comman/header');
		$this->load->view('capture_page_request_view',$data);
		$this->load->view('comman/footer');
	}
	
	function capture_page_request_view($id)
	{
		$data['result']		=	$this->ObjM->get_capture_page_request_by_id($id);
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('capture_page_request_show',$data);
		$this->load->view('comman/footer');
	}
	
	function capture_page_status($eid, $status){
		$result=$this->ObjM->get_capture_page_request_by_id($eid);
		$data=array();
		$data['status']=$status;
		$this->ObjM->update($data,'capture_page_request','request_code',$eid);
		
		
		if($result[0]['email_verification']!='Y' && $result[0]['subscribe']!='Y'){
			header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'/capture_page_request');
			exit;	
		}
		
		// $msg='<p>hello, <strong>'.$result[0]['fname'].' '.$result[0]['lname'].'</strong><br> 
		// Your capture page requesr is rejected<br>
		// Page Name <strong>'.$result[0]['page_name'].'</strong> <br>
		// </p>';
		$message = get_email_cms_page_master('capture_page_request')->result()[0]->textdt;
		$message = str_replace("[fname]",$result[0]['fname'],$message);
		$message = str_replace("[lname]",$result[0]['lname'],$message);
		$message = str_replace("[pagename]",$result[0]['page_name'],$message);
				
		$e_array=array("heading"=>'capture page request is rejected',"msg"=>$message,"contain"=>'');
		$message	=  	email_template_one($e_array);
		// $this->email->from(FROM_EMAIL);
		// $this->email->subject('Capture Page Request');
		// $this->email->message($message);
		// $this->email->to($result[0]['emailid']);
  //       $this->email->send();
		sendemail(FROM_EMAIL,'Capture Page Request',$result[0]['emailid'],$message);
		
		header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'/capture_page_request');
		exit;	
	}
	
	function email_to_member()
	{
		$data['result']		=	$this->ObjM->email_to_member($this->uri->segment(3));
		//var_dump($data['result']);
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('email_to_member_add',$data);
		$this->load->view('comman/footer');
	}
	function send_email_member()
	{
		$msg=$_POST["textdt"];;
				
		$e_array=array("heading"=>$_POST["email_subject"],"msg"=>$msg,"contain"=>'');
		$message	=  	email_template_one($e_array);
		// $this->email->from(FROM_EMAIL);
		// $this->email->subject($_POST["email_subject"]);
		// $this->email->message($message);
		// $this->email->to($_POST["emailto"]);
  //       $this->email->send();
		sendemail(FROM_EMAIL,$_POST["email_subject"],$_POST["emailto"],$message);
			
		header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'/capture_page_request');
		exit;
			
		
	}
	
	function capture_issue_report()
	{
		$data['result']	=	$this->ObjM->get_report_issue_pages();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('capture_report_issue_view',$data);
		$this->load->view('comman/footer');
	}
	function issue_report_update()
	{
		$data=array();
		$data['status']='Delete';	
		$this->ObjM->update($data,'report_issue_master','report_issue_code',$this->uri->segment(3));	
	}
}

