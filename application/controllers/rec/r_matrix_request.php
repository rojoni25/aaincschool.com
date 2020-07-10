<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class r_matrix_request extends CI_Controller {
	
		
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		$this->file_setting();
		if($this->session->userdata[MATRIX_SESSION_ADMIN]['access']!='true'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('matrix_comman/r_matrix_request_model','ObjM',TRUE);
		
		$this->load->library('email');
			
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
	
	function request()
	{
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.MATRIX_FOLDER.'/admin/r_matrix_code_request');
		$this->load->view('comman/footer');	
	}
	
	function listing(){
		$result=$this->ObjM->get_request_list();
		$html='';
		for($i=0;$i<count($result);$i++){
				$html.='<tr>
				<td>'.$result[$i]['usercode'].'</td>
				<td>'.$result[$i]['username'].'</td>
				<td>'.$result[$i]['name'].'</td>
				<td>'.$result[$i]['msg'].'</td>
				<td>'.date('M d, Y  i:j',$result[$i]['timedt']).'</td>
				<td>
					<a class="open_popup" href="'.MATRIX_BASE.$this->uri->rsegment(1).'/access_code_popup/'.$result[$i]['id'].'"><span class="label label-success"> Code Generate</span></a>
					<a class="request_remove" href="'.MATRIX_BASE.$this->uri->rsegment(1).'/reject_request/'.$result[$i]['id'].'"><span class="label label-important">Delete</span></a>
				</td>
				</tr>';
        } 
		echo $html;
	} 
	
	function reject_request($id)
	{
		$data['status']	=	'Inactive';
		$this->ObjM->update($data,''.MATRIX_TABLE_PRE.'access_code_request','id',$id);
	}
	
	function access_code_popup($eid)
	{
		$data['result']=$this->ObjM->get_request_by_id($eid);
		$this->load->view(''.MATRIX_FOLDER.'/admin/r_access_code_popup',$data);	
	}
	
	
	
	
	function access_code_insert()
	{
		$result		=	$this->ObjM->get_request_by_id($_POST['id']);
	
		if(!isset($result[0])){
			$arr['vali']='false';
			$arr['msg']='Invailed Request';
			echo json_encode($arr);
			exit;
		}
		
		$chk=$this->ObjM->check_access_code($_POST['access_code']);	
		
		if(isset($chk[0]))
		{
			$arr['vali']='false';
			$arr['msg']=' Code "'.$_POST['access_code'].'" is Already Exist';
					
		}else{
			
			$data['access_code']	=	$_POST['access_code'];
			$data['usercode']	=	$result[0]['usercode'];
			$data['add_time']	=	time();
			$data['add_by']		=	$this->session->userdata['logged_ol_member']['usercode'];
			$id=$this->ObjM->addItem($data,''.MATRIX_TABLE_PRE.'access_code');
			$this->access_code_email($id);
			$arr['msg']=' code insert and email to member';
			$arr['vali']='true';
			
		}
		
		echo json_encode($arr);
		
	
	}
	
	function access_code_email($eid)
	{
		$member	=	$this->ObjM->get_access_code_by_usercode($eid);
		
		if(!$member[0]){
			echo 'Error';
			exit;
		}
		
		
		// $message='<p>Hello	: '.$member[0]['fname'].' '.$member[0]['lname'].' your  code is generate</p>';
		// $message.='<p>your  code	: '.$member[0]['access_code'].'</p>';
		$message = get_email_cms_page_master('access_code_generation_email')->result()[0]->textdt;
		$message = str_replace("[fname]",$member[0]['fname'],$message);
		$message = str_replace("[lname]",$member[0]['lname'],$message);
		$message = str_replace("[accesscode]",$member[0]['access_code'],$message);
		$e_array=array("heading"=>" Code Generate","msg"=>$message,"contain"=>'');	
		$message=email_template_one($e_array);
		
		
		// $this->email->from(FROM_EMAIL);
		// $this->email->to($member[0]['emailid']);
		// $this->email->subject(' Code Generate');
		// $this->email->message($message);
		// $p=$this->email->send();
			sendemail(FROM_EMAIL,'Code Generate',$member[0]['emailid'],$message);
		
		
	}
	
	
	function unuse()
	{
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.MATRIX_FOLDER.'/admin/r_matrix_code_unuse');
		$this->load->view('comman/footer');	
	}
	
	function unuse_listing(){
		$result=$this->ObjM->get_unuse_list();
		$html='';
		for($i=0;$i<count($result);$i++){
				$html.='<tr>
				<td>'.$result[$i]['usercode'].'</td>
				<td>'.$result[$i]['username'].'</td>
				<td>'.$result[$i]['name'].'</td>
				<td>'.$result[$i]['access_code'].'</td>
				
				</tr>';
        } 
		echo $html;
	} 
	
	
	
	
	
	
	
	
	
		
	
	

	
	

	
	

	
	
	
	
	 
}

