<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class page extends CI_Controller {

	protected $m2m_admin='123';
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 	
		$this->load->model('d2v/me_module','ObjM',TRUE); 
		$this->load->library('email');
 	}
	
	
	
	public function view(){
		

		if($this->comman_fun->check_record('d2v_member',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']))){
			$this->dashboard();
		}else{
			$result		=	$this->comman_fun->get_table_data('d2v_payment_send',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode'],'status'=>'Active'));
			if(isset($result[0])){
				$this->pending();	
			}
			else{
				$this->front_page();
			}
			
		}
		
				
	}
	
	
	protected function dashboard(){
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('d2v/member/dashboard',$data);
		$this->load->view('comman/footer');
		
	}
	
	protected function front_page(){
		$data['contain']		=	$this->comman_fun->get_table_data('d2v_pages_master',array('pagelable'=>'main_page'));
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('d2v/member/front_page',$data);
		$this->load->view('comman/footer');
	}
	
	protected function pending($result){
		$data['contain']		=	$this->comman_fun->get_table_data('d2v_pages_master',array('pagelable'=>'panding_request page'));
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('d2v/member/pending',$data);
		$this->load->view('comman/footer');
	}
	
	
	
	
	function send_request(){
		if(!$this->comman_fun->check_record('d2v_member',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']))){
			$data['contain']		=	$this->comman_fun->get_table_data('d2v_pages_master',array('pagelable'=>'send_payment_page'));
			$this->load->view('comman/topheader');
			$this->load->view('comman/header');
			$this->load->view('d2v/member/payment_from',$data);
			$this->load->view('comman/footer');
			
		}	
	}
	
	function payment_insert(){
		if($this->input->server('REQUEST_METHOD') === 'POST'){
			if(!$this->comman_fun->check_record('d2v_member',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']))){
				
				$data['usercode']	=	$this->session->userdata['logged_ol_member']['usercode'];
				
				$data['paypal_account']		=	$_POST['paypal_account'];
				$data['paypal_email']		=	$_POST['paypal_email'];
				$data['transaction_id']		=	$_POST['transaction_id'];
				$data['amount']				=	$_POST['amount'];
				$data['notes']				=	$_POST['notes'];
				$data['date_info']			=	date('Y-m-d h:i:s');
				
				$this->comman_fun->addItem($data,'d2v_payment_send');
				$this->session->set_flashdata('show_msg', 'Payment Send Successfully');
				header('Location: '.base_url().'index.php/d2v/'.$this->uri->rsegment(1).'/view/');
				exit;
			}
		}	
	}
	
	function msg_to_admin(){
		$data['ref_url']			=	$_SERVER["HTTP_REFERER"];
		$data['contain']		=	$this->comman_fun->get_table_data('d2v_pages_master',array('pagelable'=>'send_payment_page'));
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('d2v/member/msg_to_admin',$data);
		$this->load->view('comman/footer');
	}
	function msg_to_admin_insert(){
		if($this->input->server('REQUEST_METHOD') === 'POST'){
			if(!$this->comman_fun->check_record('d2v_member',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']))){
				
				$data['send_from']			=	$this->session->userdata['logged_ol_member']['usercode'];
				$data['send_to']			=	0;
				$data['subject']			=	$_POST['subject'];
				$data['msg']				=	$_POST['msg'];
				$data['from_status']		=	1;
				$data['to_status']			=	1;
				$data['timedt']				=	date('Y-m-d h:i:s');
				
				$this->comman_fun->addItem($data,'d2v_message');
				$this->session->set_flashdata('show_msg', 'Send Successfully');
				
				if($_POST['ref_url']!=''){
					header('Location: '.$_POST['ref_url'].'');
					exit;
				}else{
					header('Location: '.base_url().'index.php/d2v/'.$this->uri->rsegment(1).'/view/');
					exit;
				}
				
				
			}
		}	
	}
	
	
	
	
   
	
	
	
	
	
	
	
	
}


