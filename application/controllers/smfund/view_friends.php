<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class view_friends extends CI_Controller {
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
		if(!$this->session->userdata('logged_smfund_member')){header('Location: '.base_url().'index.php/welcome');exit;} 
		$this->load->model('smfund/comman_modul','ObjM',TRUE);

 	}
	
	function friend(){
		
		$data['result']	=	$this->ObjM->get_friend_list();	
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('smfund/friend_view',$data);
		$this->load->view('comman/footer');	
		
	}
	
	function invite_friends_history(){
		$data['result']		=	$this->comman_fun->get_table_data('smfund_invite_friend_master',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']));
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('smfund/invite_friends_history',$data);
		$this->load->view('comman/footer');	
	}
	
	
	function invitefriends()
	{
		if($this->comman_fun->check_record('smfund_capture_page_master',array('capture_page_code'=>$_REQUEST['page']))){
			$data['b_url']	= base_url().'index.php/smfund_capture/page/'.$_REQUEST['page'].'/'.$this->session->userdata['logged_ol_member']['username'].'';
			$data['current_url']=$this->get_the_current_url();
			
			$this->load->view('comman/topheader');
			$this->load->view('comman/header');
			$this->load->view('smfund/invite_friend',$data);
			$this->load->view('comman/footer');
		}
		
		
	}
	
	
	function invitefriends_insertrecord()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{	
			$now = time();
			$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
			$data = array();
			
			$data['invite_emailid']	=	$this->input->post('invite_emailid');	
			$data['subject']		=	$this->input->post('subject');
			$data['message']		=	$this->input->post('message');
			$data['usercode']		=	$this->session->userdata['logged_ol_member']['usercode'];
			$data['timedt']			=	$nowdt;	
			$data['status']			=	'Active';
			$data['pagecode']		=	$this->input->post('pagecode');
			$data['send_url']		=	$this->input->post('current_url');
			$id=$this->comman_fun->addItem($data,'smfund_invite_friend_master');
		}
		
		$this->session->set_flashdata('show_msg', 'Request Send Successfully');
		
		header('Location: '.$_POST['current_url']);
		exit;
	}
	
	function remove_ptag($contain){
		return str_replace(array('<p>','</p>'),'',$contain);
	}
	
	
	function get_the_current_url() 
	{
		$protocol = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
		$base_url = $protocol . "://" . $_SERVER['HTTP_HOST'];
		$complete_url =   $base_url . $_SERVER["REQUEST_URI"];    
		return $complete_url;
    }	
	
	
	function msg_to_admin($eid){
		
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('smfund/member/msg_to_admin',$data);
		$this->load->view('comman/footer');	
	
		
	}
	
	function send_message(){
		
		if ($this->input->server('REQUEST_METHOD') === 'POST'){
			$data['send_by']		=	$this->session->userdata['logged_ol_member']['usercode'];
			$data['send_to']		=	0;
			$data['subject']		=	$_POST['subject'];
			$data['message']		=	$_POST['message'];
			$data['create_date']	=	date('Y-m-d h:i:s');
			$data['status']			=	'No_view'; 
			$this->comman_fun->addItem($data,'smfund_message');	
		}
		
		header('Location: '.smfund().$this->uri->rsegment(1).'/outbox/');
		exit;
	}
	
	function outbox(){
		$data['result']	=	$this->ObjM->get_outbox($this->session->userdata['logged_ol_member']['usercode']);	
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('smfund/member/outbox',$data);
		$this->load->view('comman/footer');
	}
	
	function inbox(){
		$data['result']	=	$this->ObjM->get_inbox($this->session->userdata['logged_ol_member']['usercode']);	
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('smfund/member/inbox',$data);
		$this->load->view('comman/footer');
	}
	
	function delete_outbox($eid){
		$data			=	array();
		$data['status']	=	'Delete';
		$this->comman_fun->update($data,'smfund_message',array('id'=>$eid,'send_by'=>$this->session->userdata['logged_ol_member']['usercode']));	
	}
	
	function delete_inbox($eid){
		$data			=	array();
		$data['status']	=	'Delete';
		$this->comman_fun->update($data,'smfund_message',array('id'=>$eid,'send_to'=>$this->session->userdata['logged_ol_member']['usercode']));
	}
	
	
	
}

