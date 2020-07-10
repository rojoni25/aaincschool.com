<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class page extends CI_Controller {
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
		//---------------------smfund---------------------
		//if(($smfund_admin_valid)||($this->session->userdata['logged_smfund_member'])){header('Location: '.smfund().'welcome/view');exit;}
		//---------------------smfund---------------------
		$this->load->library('vma_class');
		$this->load->library('email');
 	}
	
	public function view()
	{
		
		if($this->vma_class->check_in_tree()){
			header('Location: '.vma_base().'dashboard/view');
			exit;	
		}
		
		if($this->vma_class->check_request()){
			if($this->vma_class->check_payment())
			{
				$this->after_join(true);
				
			}else{
				$this->after_join(false);
			}	
		}
		else{
			$this->before_join();
		}
	}
	
 	protected function before_join()
	{
		$data['result']		=	$this->comman_fun->get_table_data('cms_pages_master',array('pagelable'=>'viral_marketing'));
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view(VMA_FOLDER.'pages_view');
		$this->load->view('comman/footer');
	}
	
	protected function after_join($status)
	{
		if($status){
			$data['result']		=	$this->comman_fun->get_table_data('cms_pages_master',array('pagelable'=>'vma_after_payment'));
		}else{
			$data['result']		=	$this->comman_fun->get_table_data('cms_pages_master',array('pagelable'=>'vma_after_request'));
		}
		$data['payment'] = $status;
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view(VMA_FOLDER.'pages_view');
		$this->load->view('comman/footer');
	}
	
	function send_request(){
		
		$rt=$this->comman_fun->get_table_data('membermaster',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']));
		
		if($rt[0]['email_verification']=='N'){
			echo '<h4>Please Varify Your Emailid</h4>';
			exit;
		}
		
		echo '<div class="pop-div-main"><form method="post" action="'.vma_base().$this->uri->rsegment(1).'/insert_request">
				<table class="table">
					<tr><td><h5>Join Request With Payment Detail</h5></td></tr>
					<tr><td><input type="text" required="required" name="subject" id="subject" placeholder="Subject" class="txtbox" /></td></tr>
					<tr><td><textarea id="msg" required="required" name="msg" placeholder="Enter your payment transaction details" class="txtarea"></textarea></td></tr>
					<tr><td><button type="submit" class="btn btn-success" name="">Send</button></td></tr>
				</table>
		</form></div>';	
	}
	
	function payment_confirm_from(){	
		echo '<div class="pop-div-main"><form method="post" action="'.vma_base().$this->uri->rsegment(1).'/payment_confirm" id="">
				<table class="table">
					<tr><td><h5>Payment Confirmation</h5></td></tr>
					<tr><td><input type="text" required="required" name="subject" id="subject" placeholder="Subject" class="txtbox" /></td></tr>
					<tr><td><textarea id="msg" required="required" name="msg" placeholder="Enter your payment transaction details" class="txtarea"></textarea></td></tr>
					<tr><td><button type="submit" class="btn btn-success" name="">Send</button></td></tr>
				</table>
		</form></div>';	
	}
	
	function insert_request()
	{
		if(!$this->comman_fun->check_record('vma_request',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']))){
			$data				=	array();
			$data['usercode']	=	$this->session->userdata['logged_ol_member']['usercode'];
			$data['timedt']		=	date('Y-m-d');
			$data['msg']		=	$_POST['msg'];
			$this->comman_fun->addItem($data,'vma_request');
			$msg='Request To Join VMA';
			$this->notification($msg);
			$this->payment_confirm();
		}
		header('Location: '.vma_base().$this->uri->rsegment(1).'/view/');
		exit;
		
	}
	
	function payment_confirm(){
	
		$data				=	array();
		$data['usercode']	=	$this->session->userdata['logged_ol_member']['usercode'];
		$data['type']		=	'payment_confirm';
		$data['subject']	=	$_POST['subject'];
		$data['msg']		=	$_POST['msg'];
		$data['timedt']		=	date('Y-m-d');
		$this->comman_fun->addItem($data,'vma_message');
		header('Location: '.vma_base().$this->uri->rsegment(1).'/view/p');
		exit;
	}
	
	protected function notification($msg){
		
		//upling_chain_opp
		
		$member_dt=$this->comman_fun->get_table_data('membermaster',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']));
	
		if($this->session->userdata['logged_ol_member']['usercode']=='Active'){
			$ref_dt	=	$this->comman_fun->get_table_data('membermaster',array('usercode'=>$member_dt[0]['referralid']));
			$tbl='member_node_master';	
		}
		else{
			$ref_dt	=	$this->comman_fun->get_table_data('membermaster',array('usercode'=>$member_dt[0]['referralid_free']));
			$tbl='member_node_master_free';
		}
		
	
		
		$result		=	$this->vma_class->upling_chain_opp($this->session->userdata['logged_ol_member']['usercode'],$tbl);
		
		$email_list	=	array();
		for($i=0;$i<count($result);$i++){
			if($result[$i]['email_verification']=='Y'){
				$email_list[]=$result[$i]['emailid'];
			}	
		}
		
		
		if(isset($email_list[0]))
		{
			$email_list=implode(', ',$email_list);
			// $message='<p>Name	:'.$member_dt[0]['fname'].' '.$member_dt[0]['lname'].'</p>';
			// $message.='<p>Email	:'.$member_dt[0]['emailid'].'</p>';
			// $message.='<p>Referral	:'.$ref_dt[0]['fname'].' '.$ref_dt[0]['lname'].'</p>';
			$message = get_email_cms_page_master('notification')->result()[0]->textdt;
			$message = str_replace("[fname]",$member_dt[0]['fname'],$message);
			$message = str_replace("[lname]",$member_dt[0]['lname'],$message);
			$message = str_replace("[email]",$member_dt[0]['emailid'],$message);
			$message = str_replace("[ref-fname]",$ref_dt[0]['fname'],$message);
			$message = str_replace("[ref-lname]",$ref_dt[0]['lname'],$message);
			
			$e_array=array("heading"=>$msg,"msg"=>$message,"contain"=>'');	
			$message=email_template_one($e_array);
			
			$list = array($email_list);
			// $this->email->from(FROM_EMAIL);
			// $this->email->to($list);
			// $this->email->subject($msg);
			// $this->email->message($message);
			// $this->email->send();
			sendemail(FROM_EMAIL,$msg,$list,$message);
		}
			
	}
	
	
}

