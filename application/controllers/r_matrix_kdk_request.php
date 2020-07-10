<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class r_matrix_kdk_request extends CI_Controller {
		
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata["r_matrix_admin"]['access']!='true'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('r_matrix_kdk_request_model','ObjM',TRUE);
		
		$this->load->library('email');
		
 	}
	
	function request()
	{
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('r_matrix/r_matrix_kdk_request');
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
					<a class="open_popup" href="'.base_url().'index.php/'.$this->uri->segment(1).'/kdk_code_popup/'.$result[$i]['id'].'"><span class="label label-success">KDK Code Generate</span></a>
					<a class="request_remove" href="'.base_url().'index.php/'.$this->uri->segment(1).'/reject_request/'.$result[$i]['id'].'"><span class="label label-important">Delete</span></a>
					<a class="notification_link" href="'.base_url().'index.php/r_matrix_notification/popup/'.$result[$i]['usercode'].'"><i class="icon-bell-alt"></i></a>
				</td>
				</tr>';
        } 
		echo $html;
	} 
	
	function reject_request($id)
	{
		$data['status']	=	'Inactive';
		$this->ObjM->update($data,'rm_kdk_code_request','id',$id);
	}
	
	function kdk_code_popup($eid)
	{
		$data['result']=$this->ObjM->get_request_by_id($eid);
		$this->load->view('r_matrix/r_kdk_code_popup',$data);	
	}
	
	
	
	
	function kdk_code_insert()
	{
		$result		=	$this->ObjM->get_request_by_id($_POST['id']);
	
		if(!isset($result[0])){
			$arr['vali']='false';
			$arr['msg']='Invailed Request';
			echo json_encode($arr);
			exit;
		}
		
		$chk=$this->ObjM->check_kdk_code($_POST['kdk_code']);	
		
		if(isset($chk[0]))
		{
			$arr['vali']='false';
			$arr['msg']='KDK Code "'.$_POST['kdk_code'].'" is Already Exist';
					
		}else{
			
			$data['kdk_code']	=	$_POST['kdk_code'];
			$data['usercode']	=	$result[0]['usercode'];
			$data['add_time']	=	time();
			$data['add_by']		=	$this->session->userdata['logged_ol_member']['usercode'];
			$id=$this->ObjM->addItem($data,'rm_kdk_code');
			$this->kdk_code_email($id);
			$arr['msg']='kdk code insert and email to member';
			$arr['vali']='true';
			
		}
		
		echo json_encode($arr);
		
	
	}
	
	function kdk_code_email($eid)
	{
		$member	=	$this->ObjM->get_kdk_code_by_usercode($eid);
		
		if(!$member[0]){
			echo 'Error';
			exit;
		}
		
		
		// $message='<p>Hello	: '.$member[0]['fname'].' '.$member[0]['lname'].' your kdk code is generate</p>';
		// $message.='<p>your kdk code	: '.$member[0]['kdk_code'].'</p>';
		$message = get_email_cms_page_master('kdk_code_generation_email')->result()[0]->textdt;
		$message = str_replace("[fname]",$member[0]['fname'],$message);
		$message = str_replace("[lname]",$member[0]['lname'],$message);
		$message = str_replace("[kdkcode]",$member[0]['kdk_code'],$message);
		$e_array=array("heading"=>"KDK Code Generate","msg"=>$message,"contain"=>'');	
		$message=email_template_one($e_array);
		
		
		// $this->email->from(FROM_EMAIL);
		// $this->email->to($member[0]['emailid']);
		// $this->email->subject('KDK Code Generate');
		// $this->email->message($message);
		// $p=$this->email->send();
		sendemail(FROM_EMAIL,'KDK Code Generate',$member[0]['emailid'],$message);
		
		
	}
	
	
	function unuse()
	{
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('r_matrix/r_matrix_kdk_unuse');
		$this->load->view('comman/footer');	
	}
	
	function unuse_listing(){
		$result=$this->ObjM->get_unuse_kdk_list();
		$html='';
		for($i=0;$i<count($result);$i++){
				$html.='<tr>
				<td>'.$result[$i]['usercode'].'</td>
				<td>'.$result[$i]['username'].'</td>
				<td>'.$result[$i]['name'].'</td>
				<td>'.$result[$i]['kdk_code'].'</td>
				<td><a class="notification_link" href="'.base_url().'index.php/r_matrix_notification/popup/'.$result[$i]['usercode'].'"><i class="icon-bell-alt"></i></a></td>
				</tr>';
        } 
		echo $html;
	} 
	
	function pending()
	{
		$data['result']	=	$this->ObjM->get_pending_request();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('r_matrix/r_matrix_kdk_pending_req',$data);
		$this->load->view('comman/footer');	
	}
	
	
	
	
	
	
	
	
	
		
	
	

	
	

	
	

	
	
	
	
	 
}

