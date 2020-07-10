<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class page extends CI_Controller {

	function __construct()
 	{
   		parent::__construct();
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		
 	}
	
	function view(){
		$this->index();
	}
	
	public function index()
	{
		if($this->comman_fun->check_record('diamond_payment',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']))){
			$data['result']		=	$this->comman_fun->get_table_data('cms_pages_master',array('pagelable'=>'diamond_wallet_paid'));
		}else{
			$data['result']		=	$this->comman_fun->get_table_data('cms_pages_master',array('pagelable'=>'diamond_wallet_free'));		
		}
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('diamond/pages_view',$data);
		$this->load->view('comman/footer');
	}
	
	function payment_confirm_from(){
		echo '<div class="pop-div-main"><form method="post" action="'.diamond_base().'/page/payment_confirm" id="">
				<table class="table">
					<tr><td><h5>Payment Confirmation</h5></td></tr>
					<tr><td><input type="text" required="required" name="subject" id="subject" placeholder="Subject" class="txtbox" /></td></tr>
					<tr><td><textarea id="msg" required="required" name="msg" placeholder="Enter your payment transaction details" class="txtarea"></textarea></td></tr>
					<tr><td><button type="submit" class="btn btn-success" name="">Send</button></td></tr>
				</table>
		</form></div>';	
	}
	
	function message_to_admin_from(){
		echo '<div class="pop-div-main"><form method="post" action="'.diamond_base().'/page/message_to_admin" id="">
				<table class="table">
					<tr><td><h5>Message To Admin</h5></td></tr>
					<tr><td><input type="text" required="required" name="subject" id="subject" placeholder="Subject" class="txtbox" /></td></tr>
					<tr><td><textarea id="msg" required="required" name="msg" placeholder="Enter your message hear" class="txtarea"></textarea></td></tr>
					<tr><td><button type="submit" class="btn btn-success" name="">Send</button></td></tr>
				</table>
		</form></div>';	
	}
	
	
	
	function payment_confirm(){
	
		$data				=	array();
		$data['usercode']	=	$this->session->userdata['logged_ol_member']['usercode'];
		$data['type']		=	'payment_confirm';
		$data['subject']	=	$_POST['subject'];
		$data['msg']		=	$_POST['msg'];
		$data['timedt']		=	date('Y-m-d');
		$this->comman_fun->addItem($data,'diamond_payment_confirmation');
		
		$this->session->set_flashdata('show_msg', 'Payment confirmation send successfully');
		
		//diamond_payment
		$this->comman_fun->check_record('diamond_payment',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']));
		
		
		
		
		
		header('Location: '.diamond_base().$this->uri->rsegment(1).'/view/');
		exit;
	}
	
	function message_to_admin(){
	
		$data				=	array();
		$data['usercode']	=	$this->session->userdata['logged_ol_member']['usercode'];
		$data['type']		=	'admin_msg';
		$data['subject']	=	$_POST['subject'];
		$data['msg']		=	$_POST['msg'];
		$data['timedt']		=	date('Y-m-d');
		$this->comman_fun->addItem($data,'diamond_payment_confirmation');

		$this->session->set_flashdata('show_msg', 'Message Send To Admin Successfully');
		
		header('Location: '.diamond_base().$this->uri->rsegment(1).'/view/');
		exit;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

}

