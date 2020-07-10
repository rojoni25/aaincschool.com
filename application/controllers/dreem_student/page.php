<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class page extends CI_Controller {

	protected $admin='123';
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 	
		//---------------change--------------------------//
		if(!$this->comman_fun->check_record('dreem_student_member',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode'])))
		{header('Location: '.base_url().'index.php/dashboard');exit;}
		//---------------change--------------------------//
		$this->load->model('dreem_student/me_module','ObjM',TRUE); 
		$this->load->library('email');
 	}
	
	
	
	public function view(){
		

		if($this->comman_fun->check_record('dreem_student_member',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']))){
			$this->dashboard();
		}else{
			$result		=	$this->comman_fun->get_table_data('dreem_student_request',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']));
			if(isset($result[0])){
			    if(isset($result[0]['upling'])){
					$this->payment($result[0]);
				}else{
					$this->pending();	
				}
			}else{
				$this->request();
			}
			
		}
		
				
	}
	
	
	protected function dashboard(){
		
		$data['under_process']		=	$this->ObjM->count_under_process();
		$data['get_member']			=	$this->ObjM->count_get_member();
		$data['detail']				=	$this->ObjM->member_position_detail();
		$data['send_payment_list']	=	$this->comman_fun->get_table_data('dreem_student_payment_confirmation',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']));
		
		
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('dreem_student/member/dashboard',$data);
		$this->load->view('comman/footer');
	}
	
	protected function request(){
		$data['contain']		=	$this->comman_fun->get_table_data('dreem_student_pages_master',array('pagelable'=>'request'));
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('dreem_student/member/request',$data);
		$this->load->view('comman/footer');
	}
	
	protected function pending($result){
		$data['contain']		=	$this->comman_fun->get_table_data('dreem_student_pages_master',array('pagelable'=>'pending'));
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('dreem_student/member/pending',$data);
		$this->load->view('comman/footer');
	}
	protected function payment($result){
		
		$data['upling']				=	$this->comman_fun->get_table_data('membermaster',array('usercode'=>$result['upling']));

		$payment_to_code			=	(isset($result['payto'])) ? $result['payto'] : $result['upling'];
	
		$data['payment_to']			=	$this->comman_fun->get_table_data('membermaster',array('usercode'=>$payment_to_code));
		$data['payment_option']		=	$this->comman_fun->get_table_data('payment_account_option',array('usercode'=>$payment_to_code,'status'=>'Active'));
		
		
		$data['send_payment_list']	=	$this->comman_fun->get_table_data('dreem_student_payment_confirmation',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']));
		
		
		
		$data['contain']		=	$this->comman_fun->get_table_data('dreem_student_pages_master',array('pagelable'=>'payment_send'));
			
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('dreem_student/member/payment',$data);
		$this->load->view('comman/footer');
	}
	
	
	function send_request(){
		if(!$this->comman_fun->check_record('dreem_student_request',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']))){
			$data=array();
			$data['usercode']	=	$this->session->userdata['logged_ol_member']['usercode'];
			$data['status']		=	'Active';
			$data['time_dt']	=	date('Y-m-d');
			$this->comman_fun->addItem($data,'dreem_student_request');
			$this->session->set_flashdata('show_msg', 'Request Send Successfully');
			header('Location: '.base_url().'index.php/dreem_student/'.$this->uri->rsegment(1).'/view/');
			exit;
		}	
	}
	
	function payment_insert(){
		if($this->input->server('REQUEST_METHOD') === 'POST'){
			if(!$this->comman_fun->check_record('dreem_student_member',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']))){
				$result		=	$this->comman_fun->get_table_data('dreem_student_request',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']));
				if(isset($result[0])){
					if(isset($result[0]['upling'])){
						
						$payment_to_code	=	(isset($result[0]['payto'])) ? $result[0]['payto'] : $result[0]['upling'];	
						
						$data['usercode']	=	$this->session->userdata['logged_ol_member']['usercode'];
						$data['payto']		=	$payment_to_code;
						$data['subject']	=	$_POST['subject'];
						$data['textdt']		=	$_POST['textdt'];
						$data['time_dt']	=	date('Y-m-d h:i:s');
						
							
						
						$this->comman_fun->addItem($data,'dreem_student_payment_confirmation');
						$this->session->set_flashdata('show_msg', 'Payment Send Successfully');
						header('Location: '.base_url().'index.php/dreem_student/'.$this->uri->rsegment(1).'/view/');
						exit;
						
					}
					
				}
			}
		}	
	}
	
	
	function send_email(){
		$member	=	$this->comman_fun->get_table_data('dreem_student_request',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']));
		
		if(isset($member[0])){
			
			$payment_to_code			=	(isset($member[0]['payto'])) ? $member[0]['payto'] : $member[0]['upling'];
			$data['result']				=	$this->comman_fun->get_table_data('membermaster',array('usercode'=>$payment_to_code));
			$this->load->view('comman/topheader');
			$this->load->view('comman/header');
			$this->load->view('dreem_student/member/send_email',$data);
			$this->load->view('comman/footer');
			
		}
		
		
	}
	
	function send_email_insert(){
		if($this->input->server('REQUEST_METHOD') === 'POST'){
			$member	=	$this->comman_fun->get_table_data('dreem_student_request',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']));
			
			if(isset($member[0])){
				$payment_to_code		=	(isset($member[0]['payto'])) ? $member[0]['payto'] : $member[0]['upling'];
				$result					=	$this->comman_fun->get_table_data('membermaster',array('usercode'=>$payment_to_code));
				
				$member					=	$this->comman_fun->get_table_data('membermaster',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']));
				
				// $message='<p>Name		:'.$member[0]['fname'].' '.$member[0]['lname'].'</p>';
				// $message.='<p>Usercode		:'.$member[0]['usercode'].'</p>';
				// $message.='<p>Email		:'.$member[0]['emailid'].'</p>';
				// $message.='<p>Subject	:<strong>'.$_POST['subject'].'</strong></p>';
				// $message.='<p><strong>Message</strong>	:'.$_POST['textdt'].'</p>';
				$message = get_email_cms_page_master('dreem-student-send-email-insert')->result()[0]->textdt;
				$message = str_replace("[fname]",$member[0]['fname'],$message);
				$message = str_replace("[lname]",$member[0]['lname'],$message);
				$message = str_replace("[email]",$member[0]['emailid'],$message);
				$message = str_replace("[textmsg]",$_POST['textdt'],$message);
				$message = str_replace("[usercode]",$member[0]['usercode'],$message);
				$message = str_replace("[subject]",$_POST['subject'],$message);
				
				$e_array=array("heading"=>"'Dreem Student","msg"=>$message,"contain"=>'');	
				$message=email_template_one($e_array);
			
				$list = array($result[0]['emailid']);
				
				// $this->email->from(FROM_EMAIL);
				// $this->email->to($result[0]['emailid']);
				// $this->email->subject('Dreem Student');
				// $this->email->message($message);
				// $this->email->send();
				sendemail(FROM_EMAIL,'Dreem Student',$result[0]['emailid'],$message);
				
				
				$this->session->set_flashdata('show_msg', 'Email Send Successfully');
				header('Location: '.base_url().'index.php/dreem_student/'.$this->uri->rsegment(1).'/send_email/');
				exit;
				
			}
			
		}
	}
	
	
	function page_view($eid){
		
		$data['contain']		=	$this->comman_fun->get_table_data('dreem_student_pages_master',array('pagelable'=>''.$eid.''));
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('dreem_student/member/page_view',$data);
		$this->load->view('comman/footer');
		
	}
	
   
	
	
	
	
	
	
	
	
}


