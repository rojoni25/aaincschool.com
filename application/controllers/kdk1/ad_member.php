<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ad_member extends CI_Controller {
	
	protected $upling_user		=	'';
	protected $upling_posi		=	'';
	protected $tot_downline		=	0;
	
	
	function __construct()
 	{
   		parent::__construct(); 
		$this->file_setting();
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata[MATRIX_SESSION_ADMIN]['access']!='true'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('kdk1/ad_dashboard_model','ObjM',TRUE);
		$this->load->library('email');
		
 	}
	
	protected function file_setting()
	{
		if(file_exists(APPPATH. 'config/matrix_const/'.$this->uri->segment(1).'/const.php')){
			include(APPPATH. 'config/matrix_const/'.$this->uri->segment(1).'/const.php');	
			if(!defined('MATRIX_TABLE_PRE')){ 		echo 	'Seting Not proper {1}'; exit;}
			if(!defined('MATRIX_CODE_LLB')){ 		echo 	'Seting Not proper {2}'; exit;}
			if(!defined('MATRIX_LLB')){ 			echo 	'Seting Not proper {3}'; exit;}
			if(!defined('MATRIX_SYSTEM_ADMIN')){ 	echo 	'Seting Not proper {4}'; exit;}
		}
		else{
			echo 'File Not Set';
			exit;
		}
	}
	
	function member_view()
	{
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.MATRIX_FOLDER.'/admin/ad_member_list',$data);
		$this->load->view('comman/footer');	
	}
	
	function listing_active(){
	
		$result=$this->ObjM->getAll_active();
		$count=$this->ObjM->get_tot_count_active();
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $count[0]['tot'],
			"iTotalDisplayRecords" => ''.$count[0]['tot'].'',
			"aaData" => array()
		);
		
		for($i=0;$i<count($result);$i++){
					
				$btn='<div class="btn-group">
				<button data-toggle="dropdown" class="btn btn-success dropdown-toggle"><strong>Action</strong><span class="caret"></span></button>
				<ul class="dropdown-menu">
				<li><a href="'.MATRIX_BASE.'ad_account/member_ac/'.$result[$i]['usercode'].'"><strong>Account</strong></a></li>
				</ul>
				</div>';
			
			$row = array(
					$result[$i]['idcode'],
					$result[$i]['usercode'],
					$result[$i]['name'],
					$result[$i]['tot_pos'],
					$result[$i]['emailid'],
					date('d-M-Y', $result[$i]['add_time']),
					$btn,
			);
			$output['aaData'][] = $row;
		}
		echo json_encode( $output );
	}
	
	function join_request()
	{
		$data['result_list']=$this->ObjM->get_join_request();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.MATRIX_FOLDER.'/admin/ad_member_request',$data);
		$this->load->view('comman/footer');		
	}
	
	function reject_request($eid)
	{
		$result=$this->ObjM->get_request_by_id($eid);
	
		
		$data=array();
		$data['status']='C';
		$this->ObjM->update($data,MATRIX_TABLE_PRE.'matrix_request','request_code',$eid);
		$this->session->set_flashdata('show_msg', 'Request Reject Successfully');
		

		if($result['req_type']=='Request'){
			$this->session->set_flashdata('show_msg','Delete Successfully');	
			header('Location: '.MATRIX_BASE.$this->uri->rsegment(1).'/join_request/');
			exit;
		}
		if($result['req_type']=='Multi'){
			$this->session->set_flashdata('show_msg','Delete Successfully');	
			header('Location: '.MATRIX_BASE.$this->uri->rsegment(1).'/request_extra/');
			exit;
		}
		if($result['req_type']=='PIF'){
			$this->session->set_flashdata('show_msg','Delete Successfully');	
			header('Location: '.MATRIX_BASE.$this->uri->rsegment(1).'/pif/');
			exit;
		}
		
	}
	
	function request_approve($eid){
		$result=$this->ObjM->check_request($eid);	
		
		$data=array();
		if(isset($result[0]))
		{
			$data['usercode']		=	$result[0]['usercode'];
			$data['add_time']		=	time();
			$data['create_dt']		=	date('Y-m-d');
			$data['request_code']	=	$result[0]['request_code'];
				
			$this->ObjM->addItem($data,MATRIX_TABLE_PRE.'matrix');
			$this->session->set_flashdata('show_msg', 'Successfully');
			
		}
		else
		{
			$this->session->set_flashdata('show_msg', 'Invalid');		
		}
		
		if($result[0]['req_type']=='Request'){
			header('Location: '.MATRIX_BASE.$this->uri->rsegment(1).'/join_request/');
			exit;
		}
		if($result[0]['req_type']=='Multi'){
			header('Location: '.MATRIX_BASE.$this->uri->rsegment(1).'/request_extra/');
			exit;
		}
		
	}
	
	
	//***ACCESS CODE****//
	function access_code(){
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			if($_POST['search']=='Y'){
				$data['result']=$this->search_member();
			}
			if($_POST['get_permission']=='Y'){
				
				$chk=$this->ObjM->check_access_code($_POST['access_code']);
				
				if(isset($chk[0])){
					
					$this->session->set_flashdata('show_msg',' Code "'.$_POST['access_code'].'" is Already Exist');	
					
					header('Location: '.MATRIX_BASE.$this->uri->rsegment(1).'/access_code/');
					
					exit;
					
				}else{
					
					$this->access_code_insert();
					
				}
				
			}
			
		}
		
		$data['result_list']=$this->ObjM->getcode_list();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.MATRIX_FOLDER.'/admin/generate_access_code',$data);
		$this->load->view('comman/footer');
		
	}
	
	protected function search_member(){
		
		$memberdt=$this->ObjM->search_member($_POST['membercode']);
		if(!isset($memberdt[0])){
			$arr['vali']	=	false;
			$arr['msg']		=	"Invailed Search";	
			return $arr;		
		}
		
		$product_member=$this->ObjM->member_dt($memberdt[0]['usercode']);
		
		if(isset($product_member[0])){
			$arr['vali']=false;
			$arr['msg']		=	"".$memberdt[0]['fname']." ".$memberdt[0]['lname']." is Already Add";			
			return $arr;
		}
		
			
			$arr['vali'] = true;
			$arr['dt']  = $memberdt[0];
			return $arr;
			
	}
	protected function access_code_insert()
	{
		
		$data['access_code']	=	$_POST['access_code'];
		$data['usercode']	=	$_POST['usercode'];
		$data['add_time']	=	time();
		$data['add_by']	=	$this->session->userdata['logged_ol_member']['usercode'];
		$id=$this->ObjM->addItem($data,''.MATRIX_TABLE_PRE.'access_code');
		
		
		if($_POST['join_request']=='Y'){
			$this->insert_join_request();
		}
		
		$this->access_code_email($id);
		
		$this->session->set_flashdata('show_msg','Insert Successfully');	
		header('Location: '.MATRIX_BASE.$this->uri->rsegment(1).'/access_code/');
		exit;
		
	}
	
	protected function insert_join_request($result){
		
		$data=array();
		$data['usercode']		=	$_POST['usercode'];
		$data['request_time']	=	time();
		$data['status']			=	'P';
		$this->ObjM->addItem($data,''.MATRIX_TABLE_PRE.'matrix_request');	
	}
	
	protected function access_code_email($eid)
	{
		$member	=	$this->ObjM->get_access_code_by_usercode($eid);
		if(!$member[0]){
			return false;
		}
		
		
		// $message='<p>Hello	: '.$member[0]['fname'].' '.$member[0]['lname'].' your  code is generate</p>';
		// $message.='<p>your  code	: '.$member[0]['access_code'].'</p>';
		$message = get_email_cms_page_master('access_code_generation_email')->result()[0]->textdt;
		$message = str_replace("[fname]",$member[0]['fname'],$message);
		$message = str_replace("[lname]",$member[0]['lname'],$message);
		$message = str_replace("[accesscode]",$member[0]['access_code'],$message);
		$e_array=array("heading"=>"".MATRIX_CODE_LLB." Code Generate","msg"=>$message,"contain"=>'');	
		$message=email_template_one($e_array);
		
		
		// $this->email->from(FROM_EMAIL);
		// $this->email->to($member[0]['emailid']);
		// $this->email->subject(''.MATRIX_CODE_LLB.' Code Generate');
		// $this->email->message($message);
		// $p=$this->email->send();
		sendemail(FROM_EMAIL,''.MATRIX_CODE_LLB.' Code Generate',$member[0]['emailid'],$message);
		
	}
	
	
	function request_extra()		
	{
		$data['result_list']=$this->ObjM->get_request_list_extra();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.MATRIX_FOLDER.'/admin/request_extra',$data);
		$this->load->view('comman/footer');	
	} 
	
	
	
	
	
	
	

	 
}

